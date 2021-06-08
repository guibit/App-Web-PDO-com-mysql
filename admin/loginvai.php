<?php
// Conexão com o banco de dados
require_once 'conecta.php';
session_start();

// Recupera o login
$login = isset($_POST["usuario"]) ? $_POST["usuario"] : FALSE;
// Recupera a senha, a criptografando em hash
$senha = isset($_POST["senha"]) ?$_POST["senha"] : FALSE;

// Usuário não forneceu a senha ou o login
if(!$login || !$senha)
{
	echo "Você deve digitar sua senha e login!";
	exit;
}

/**
* Executa a consulta no banco de dados.
* Caso o número de linhas retornadas seja 1 o login é válido,
* caso 0, inválido.
*/
$pdo = conecta_bd();
$sql = $pdo->prepare("SELECT * FROM usuario WHERE login = ?");
$sql->execute([$login]);
//verifica usuario
if($sql->rowCount() == 1){
	$info = $sql->fetch();
	//verifica senhas hash
	if(password_verify($senha, $info['senha'])){
		$_SESSION['login'] = true;
		$_SESSION['nome'] = $info['nome'];
		$_SESSION['tipo'] = $info['tipo'];
		header("Location: dashboard.php");
		die();
	}else{
		//Erro
		$_SESSION['senhainvalida'] = "Senha incorreta!";
		header('Location: login.php');
	}
}else{
	//Erro
	$_SESSION['senhainvalida'] = "Usuário não encontrado!";
	header('Location: login.php');
}
?>