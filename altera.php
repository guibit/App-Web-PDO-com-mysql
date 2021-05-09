<?php
require_once 'inicia.php';
/**Coletar as informações para alterar */
$id = isset($_POST["id"])?$_POST["id"]:null;
$nome = isset($_POST["nome"])?$_POST["nome"]:null;
$email = isset($_POST["email"])?$_POST["email"]:null;
$nascimento = isset($_POST["nascimento"])?$_POST["nascimento"]:null;
$estado = isset($_POST["estado"])?$_POST["estado"]:null;
$endereco = isset($_POST["endereco"])?$_POST["endereco"]:null;
$sexo = isset($_POST["sexo"])?$_POST["sexo"]:null;
$cartao = isset($_POST["cartao"])?$_POST["cartao"]:null;
$strcartao = implode(" - ", $cartao); 

/**verificar se usuario preencheu todos os campos do formulario */
if( empty($id) || empty($nome) || empty($email) || empty($nascimento) || empty($estado) || empty($endereco) || empty($sexo) || empty($cartao)) {
    echo "É preciso preencher todos os campos!";
    exit;
}
/**Alterar informações no banco de dados */
$PDO = conecta_bd();
$stmt = $PDO->prepare("UPDATE clientes SET nome=:nome,email=:email,nascimento=:nascimento,estado=:estado,endereco=:endereco,sexo=:sexo,cartao=:cartao WHERE id=:id;");
$stmt->bindParam(':id',$id, PDO::PARAM_INT);
$stmt->bindParam(':nome',$nome);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':nascimento',$nascimento);
$stmt->bindParam(':estado',$estado);
$stmt->bindParam('endereco',$endereco);
$stmt->bindParam('sexo',$sexo);
$stmt->bindParam('cartao',$strcartao);

if ($stmt->execute() ){
    header('Location: index.php');
}
else{
    echo "Ocorreu um erro na Alteração de registro";
    print_r($stmt->errorInfo());
}
?>