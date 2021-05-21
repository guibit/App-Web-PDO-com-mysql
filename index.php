<?php
require_once 'autentica.php';
require_once 'conecta.php';
$PDO = conecta_bd();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastando Clientes</title>
    <link rel="stylesheet" type="" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="bg-dark" style="color:#d2edf7">
    <div class="container bg-dark">
        <h1 style="text-align: center;">Cadastro de Clientes </h1>
        <?php echo '<h3>Olá '.$_SESSION['nome'].'</h3>';    ?>
        <p style="text-align:center;"><a href="formulario.php" style="font-size: 16pt;">Adicionar Cliente</a></p>
        <h2>Lista de clientes cadastrados</h2>
        <?php
        /**Consulta para guardar o total de registro e outra para todos os registros */
        $stmt_count = $PDO->prepare("SELECT COUNT(*) AS total FROM clientes");
        $stmt_count->execute();
        $stmt = $PDO->prepare("SELECT * FROM clientes;");
        $stmt->execute();
        $total = $stmt_count->fetchColumn();
        /**caso total de registro seja maior que zero criamos a tabela */
        if ($total >0): ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                    <th>Estado</th>
                    <th>Endereço</th>
                    <th>Sexo</th>
                    <th>Cartão</th>
                    <th>Abrir</th>
                    <th>Thumbnail</th>
                    <th>Mudar</th>
                </tr>
            </thead>
            <tbody>
                
                <?php while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                <tr>
                    <td><?php echo $resultado['id'] ?></td>
                    <td><?php echo $resultado['nome'] ?></td>
                    <td><?php echo $resultado['email']?></td>
                    <td><?php echo $resultado['nascimento'] ?></td>
                    <td><?php echo $resultado['estado'] ?></td>
                    <td><?php echo $resultado['endereco']?></td>
                    <td><?php echo $resultado['sexo'] ?></td>
                    <td><?php echo $resultado['cartao']?></td>
                    <td><a href='abrir_arquivo.php?id=<?php echo $resultado['id']?>'>abrir</a></td>
                    <td><img src='abrir_arquivo.php?id=<?php echo $resultado['id']?>' width='120px'/></td>

                    <td><a href="form_altera.php?id=<?php echo $resultado['id'] ?>">Alterar</a>
                    <a href="exclui.php?id=<?php echo $resultado['id'] ?>" onclick="return confirm('Tem certeza de que desenha excluir o registro?');">Excluir</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p>Total de Clientes cadastrados: <?php echo $total ?></p>
        <?php else: ?>
        <p>Não há Clientes cadastrados</p>
        <?php endif; ?>
        <?php if(isset($_GET['sair'])){
            session_destroy();
            header('Location: login.php');
        } ?>
        <div style="text-align: center;"><a href="?sair">Logout</a></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>