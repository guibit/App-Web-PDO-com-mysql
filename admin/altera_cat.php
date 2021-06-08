<?php
require_once 'autentica.php';
require_once 'autentica_adm.php';
require_once 'inicia.php';
/**Coletar as informações para alterar */
$cod = isset($_POST["cod"])?$_POST["cod"]:null;
$nome = isset($_POST["nome"])?$_POST["nome"]:null;
$desc = isset($_POST["desc_categoria"])?$_POST["desc_categoria"]:null;


/**Alterar informações no banco de dados */
$PDO = conecta_bd();
$stmt = $PDO->prepare("UPDATE categoria 
SET nome=:nome,descricao=:descricao WHERE cod=:cod;");
$stmt->bindParam(':cod',$cod, PDO::PARAM_INT);
$stmt->bindParam(':nome',$nome);
$stmt->bindParam(':descricao',$desc);


if ($stmt->execute() ){
    header('Location: dashboard.php');
}
else{
    echo "Ocorreu um erro na Alteração de registro";
    print_r($stmt->errorInfo());
}
?>