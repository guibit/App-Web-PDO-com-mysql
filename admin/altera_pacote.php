<?php
require_once 'autentica.php';
require_once 'autentica_adm.php';
require_once 'inicia.php';
/**Coletar as informações para alterar */
$cod = isset($_POST["cod"])?$_POST["cod"]:null;
$pacote_nome = isset($_POST["nome"])?$_POST["nome"]:null;
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



/**Alterar informações no banco de dados */
$PDO = conecta_bd();
$stmt = $PDO->prepare("UPDATE pacote 
SET nome=:nome,descricao=:descricao,valor=:valor,foto=:foto,fk_categoria_cod=:fk_categoria_cod,tipo=:tipo WHERE cod=:cod;");
$stmt->bindParam(':cod',$cod, PDO::PARAM_INT);
$stmt -> bindParam(':nome',$pacote_nome);
$stmt -> bindParam(':descricao',$pacote_desc);
$stmt -> bindParam(':valor',$pacote_valor);
$stmt -> bindParam(':foto',$conteudo, PDO::PARAM_LOB);
$stmt -> bindParam(':fk_categoria_cod',$fk_categoria);
$stmt -> bindParam(':tipo',$tipo);


if ($stmt->execute() ){
    header('Location: dashboard.php');
}
else{
    echo "Ocorreu um erro na Alteração de registro";
    print_r($stmt->errorInfo());
}
?>