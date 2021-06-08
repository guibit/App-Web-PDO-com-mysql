<?php
session_start();

$cate_nome = isset($_POST["nome_categoria"])?$_POST["nome_categoria"]:null;
$cate_desc = isset($_POST["desc_categoria"])?$_POST["desc_categoria"]:null;

require_once  'conecta.php';
$PDO = conecta_bd();
$sql = "INSERT INTO categoria (nome,descricao)VALUE (:nome,:descricao);";
$stmt = $PDO ->prepare($sql);
$stmt -> bindParam(':nome',$cate_nome);
$stmt -> bindParam(':descricao',$cate_desc);


if ($stmt->execute() ){
  $_SESSION['catmsg'] = "Categoria cadastrada com sucesso!";
  header('Location: dashboard.php');
}
else{
  echo "Ocorreu um erro na inclusão de registro";
  print_r($stmt->errorInfo());
}
?>