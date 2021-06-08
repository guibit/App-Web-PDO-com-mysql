<?php
require_once 'autentica.php';
require_once 'autentica_adm.php';
require_once 'conecta.php';
$PDO = conecta_bd();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Pacote</title>
    <link rel="stylesheet" type="" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="bg-dark" style="color:#d2edf7">
    <div class="container bg-dark">
        <p style="text-align:center;"><a href="cria_pacote.php" style="font-size: 16pt;">Adicionar Pacote</a></p>
        <h2 style="color:rgb(220, 238, 253)">Lista de Pacote cadastrados</h2>
        <?php
        
        /**Consulta para guardar o total de registro e outra para todos os registros */
        $stmt_count = $PDO->prepare("SELECT COUNT(*) AS total FROM pacote");
        $stmt_count->execute();
        $stmt = $PDO->prepare("SELECT * FROM pacote;");
        $stmt->execute();
        $total = $stmt_count->fetchColumn();
        /**caso total de registro seja maior que zero criamos a tabela */
        if ($total >0): ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Cod</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Foto</th>
                    <th>Cod da Categoria</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                
                <?php while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                <tr>
                    <td><?php echo $resultado['cod'] ?></td>
                    <td><?php echo $resultado['nome'] ?></td>
                    <td><?php echo $resultado['descricao']?></td>
                    <td><?php echo $resultado['valor']?></td>
                    <td><img src='abrir_arquivo.php?cod=<?php echo $resultado['cod']?>' width='120px'/></td>
                    <td><?php echo $resultado['fk_categoria_cod']?></td>

                    <td><a href="form_altera_pacote.php?cod=<?php echo $resultado['cod']?>"> Alterar</a>
                    <a href="exclui_pacote.php?cod=<?php echo $resultado['cod'] ?>" onclick="return confirm('Tem certeza de que desenha excluir o registro?');">Excluir</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p>Total de Pacote cadastrado: <?php echo $total ?></p>
        <?php else: ?>
        <p>Não há Pacote cadastrado</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>