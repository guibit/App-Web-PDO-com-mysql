<?php
session_start();

$pacote_nome = isset($_POST["nome_pacote"])?$_POST["nome_pacote"]:null;
$pacote_desc = isset($_POST["desc_pacote"])?$_POST["desc_pacote"]:null;
$pacote_valor = isset($_POST["valor_pacote"])?$_POST["valor_pacote"]:null;
$fk_categoria = isset($_POST["categoria_cod_pacote"])?$_POST["categoria_cod_pacote"]:null;

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

require_once  'conecta.php';
$PDO = conecta_bd();
$sql = "INSERT INTO pacote (nome,descricao,valor,foto,fk_categoria_cod, tipo)VALUE (:nome,:descricao,:valor,:foto,:fk_categoria_cod,:tipo);";
$stmt = $PDO ->prepare($sql);
$stmt -> bindParam(':nome',$pacote_nome);
$stmt -> bindParam(':descricao',$pacote_desc);
$stmt -> bindParam(':valor',$pacote_valor);
$stmt -> bindParam(':foto',$conteudo, PDO::PARAM_LOB);
$stmt -> bindParam(':fk_categoria_cod',$fk_categoria);
$stmt -> bindParam(':tipo',$tipo);



if ($stmt->execute() ){
  $_SESSION['pacotemsg'] = "Pacote cadastrado com sucesso!";
  header('Location: dashboard.php');
}
else{
  echo "Ocorreu um erro na inclusão de registro";
  print_r($stmt->errorInfo());
}
?>