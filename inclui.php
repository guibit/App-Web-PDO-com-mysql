<?php
/**Coleta as informações digitadas no formulario */
$nome = isset($_POST["nome"])?$_POST["nome"]:null;
$email = isset($_POST["email"])?$_POST["email"]:null;
$nascimento = isset($_POST["nascimento"])?$_POST["nascimento"]:null;
$estado = isset($_POST["estado"])?$_POST["estado"]:null;
$endereco = isset($_POST["endereco"])?$_POST["endereco"]:null;
$sexo = isset($_POST["sexo"])?$_POST["sexo"]:null;
$cartao = isset($_POST["cartao"])?$_POST["cartao"]:null;
$strcartao = implode(" - ", $cartao); 

/**verificar se usuario preencheu todos os campos do formulario */
if( empty($nome) || empty($email) || empty($nascimento) || empty($estado) || empty($endereco) || empty($sexo) || empty($cartao)) {
    echo "É preciso preencher todos os campos!";
    exit;
}
/**Insere as informações na tabela do banco de dados */
require_once  'conecta.php';
$PDO = conecta_bd();
$sql = "INSERT INTO
clientes (nome,email,nascimento,estado,endereco,sexo,cartao)
VALUES (:nome,:email,:nascimento,:estado,:endereco,:sexo,:cartao);";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome',$nome);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':nascimento',$nascimento);
$stmt->bindParam(':estado',$estado);
$stmt->bindParam('endereco',$endereco);
$stmt->bindParam('sexo',$sexo);
$stmt->bindParam('cartao',$strcartao);
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