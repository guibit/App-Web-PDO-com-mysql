<?php
require_once 'autentica.php';
require_once 'autentica_adm.php';
require_once 'inicia.php';
/**Coletar as informações para alterar */
$id = isset($_POST["id"])?$_POST["id"]:null;
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
if( empty($id) || empty($nome) || empty($email) || empty($nascimento) || empty($estado) || empty($endereco) || empty($sexo) || empty($cartao) || empty($arquivo)) {
    echo "É preciso preencher todos os campos!";
    exit;
}
/**Alterar informações no banco de dados */
$PDO = conecta_bd();
$stmt = $PDO->prepare("UPDATE clientes 
SET nome=:nome,email=:email,nascimento=:nascimento,estado=:estado,endereco=:endereco,sexo=:sexo,cartao=:cartao, Foto=:conteudo, arquivo_tipo=:tipo WHERE id=:id;");
$stmt->bindParam(':id',$id, PDO::PARAM_INT);
$stmt->bindParam(':nome',$nome);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':nascimento',$nascimento);
$stmt->bindParam(':estado',$estado);
$stmt->bindParam('endereco',$endereco);
$stmt->bindParam('sexo',$sexo);
$stmt->bindParam('cartao',$strcartao);
$stmt->bindParam(':conteudo',$conteudo, PDO::PARAM_LOB);
$stmt->bindParam(':tipo',$tipo);

if ($stmt->execute() ){
    header('Location: dashboard.php');
}
else{
    echo "Ocorreu um erro na Alteração de registro";
    print_r($stmt->errorInfo());
}
?>