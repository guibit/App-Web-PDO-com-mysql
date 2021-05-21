<?php
session_start();
/**Coleta as informações digitadas no formulario */
$nome = isset($_POST["nome"])?$_POST["nome"]:null;
$email = isset($_POST["email"])?$_POST["email"]:null;
$nascimento = isset($_POST["nascimento"])?$_POST["nascimento"]:null;
$estado = isset($_POST["estado"])?$_POST["estado"]:null;
$endereco = isset($_POST["endereco"])?$_POST["endereco"]:null;
$sexo = isset($_POST["sexo"])?$_POST["sexo"]:null;
$cartao = isset($_POST["cartao"])?$_POST["cartao"]:"null";
$strcartao = implode(" - ", $cartao);

//coleta informações do arquivo
$arquivo = $_FILES["arquivo"]["tmp_name"];
$tamanho = $_FILES["arquivo"]["size"];
$tipo = $_FILES["arquivo"]["type"];
$nomefoto = $_FILES["arquivo"]["name"];

if ( $arquivo != "none" )
  {
    $fp = fopen($arquivo, "rb");
    $conteudo = fread($fp, $tamanho);
    $conteudo = addslashes($conteudo);
    fclose($fp);
  }
/**verificar se usuario preencheu todos os campos do formulario */
if( empty($nome) || empty($email) || empty($nascimento) || empty($estado) || empty($endereco) || empty($sexo) || empty($cartao) || empty($arquivo)) {
    echo "É preciso preencher todos os campos!";
    exit;
}
/**Insere as informações na tabela do banco de dados */
require_once  'conecta.php';
$PDO = conecta_bd();
$sql = "INSERT INTO
clientes (nome,email,nascimento,estado,endereco,sexo,cartao, Foto, arquivo_tipo)
VALUES (:nome,:email,:nascimento,:estado,:endereco,:sexo,:cartao,:conteudo,:tipo);";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome',$nome);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':nascimento',$nascimento);
$stmt->bindParam(':estado',$estado);
$stmt->bindParam('endereco',$endereco);
$stmt->bindParam('sexo',$sexo);
$stmt->bindParam('cartao',$strcartao);
$stmt->bindParam(':conteudo',$conteudo, PDO::PARAM_LOB);
$stmt->bindParam(':tipo',$tipo);
/**$stmt->execute();*/

if ($stmt->execute() ){
    $_SESSION['mensagem'] = "Usuario cadastrado com sucesso!";
    header('Location: formulario.php');
}
else{
    echo "Ocorreu um erro na inclusão de registro";
    print_r($stmt->errorInfo());
}
?>