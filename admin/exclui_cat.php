<?php
require_once 'autentica.php';
require_once 'autentica_adm.php';
require_once 'inicia.php';
/**Armazena o codigo do usuario a ser excluido */
$cod = isset($_GET['cod'])? $_GET['cod'] :null;
/**Verifica se o codigo existe na tabela */
if(empty ($cod)){
    echo "O ID do usuario não foi definido";
    exit;
}
/**Faz a exclusão do registro da tabela */
$PDO=conecta_bd();
$sql = "DELETE FROM categoria WHERE cod = :cod";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':cod',$cod, PDO::PARAM_INT);
if($stmt->execute()){
    header('Location: show_cat.php');
}
else{
    echo "Ocorreu um erro ao excluir o usuário";
    print_r($stmt->errorInfo());
}