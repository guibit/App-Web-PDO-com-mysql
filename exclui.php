<?php
require_once 'inicia.php';
/**Armazena o codigo do usuario a ser excluido */
$id = isset($_GET['id'])? $_GET['id'] :null;
/**Verifica se o codigo existe na tabela */
if(empty ($id)){
    echo "O ID do usuario não foi definido";
    exit;
}
/**Faz a exclusão do registro da tabela */
$PDO=conecta_bd();
$sql = "DELETE FROM clientes WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id',$id, PDO::PARAM_INT);
if($stmt->execute()){
    header('Location: index.php');
}
else{
    echo "Ocorreu um erro ao excluir o usuário";
    print_r($stmt->errorInfo());
}