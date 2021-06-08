<?php
require_once 'autentica.php';
require_once 'autentica_adm.php';
require 'inicia.php';
//Recebe valores do Id escolhido para alterar
$cod = isset($_GET["cod"])?$_GET["cod"]:null;
if(empty($cod)){
    echo"cod não cadastrado";
    exit;
}
/**Busca na tabela os dados do usuario a ser alterado */
$PDO = conecta_bd();
$stmt= $PDO->prepare("SELECT * FROM pacote WHERE cod = :cod");
$stmt->bindParam(':cod', $cod, PDO::PARAM_INT);
$stmt->execute();
$resultado =  $stmt->fetch(PDO::FETCH_ASSOC);
/**Se o fetch acima nao retornar um array, o id nao existe */
if(!is_array($resultado)){
    echo "nenhuma categoria encontrado com o id informado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alterando categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="bg-dark" style="color:#d2edf7">
    <h2>Cadastro de Categoria - Alteração</h2>
    <form enctype="multipart/form-data" action="altera_pacote.php" method="POST" style="max-width: 400px; margin-left:30px" class="row g-3" >
        
        <div class="col-md-12">
            <label for="id" class="form-label">Cod:</label>
            <input class="form-control" type="text" placeholder="<?=$resultado['cod']?>" aria-label="Id número" name="cod"  disabled>
        </div>

        
        <div class="col-md-12">
            <td><label for="ncompleto" class="form-label">Nome:</label></td>
            <td><input type="text" name="nome" id="ncompleto" class="form-control" value="<?=$resultado['nome']?>" required></td>
        </div>

        <div class="col-md-12">
            <label for="descn" class="form-label">Descrição</label>
            <textarea class="form-control" id="descn" rows="3" name="desc_pacote" required><?=$resultado['descricao']?></textarea>
        </div>

        <div class="col-md-12">
            <label for="valorn" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valorn" name="valor_pacote" value="<?=$resultado['valor']?>" required>
        </div>

        <div class="col-md-12">
            <?php
    
            /**Consulta para guardar o total de registro e outra para todos os registros */
            $stmt_count = $PDO->prepare("SELECT COUNT(*) AS total FROM categoria");
            $stmt_count->execute();
            $stmt = $PDO->prepare("SELECT * FROM categoria;");
            $stmt->execute();
            $total = $stmt_count->fetchColumn();
            /**caso total de registro seja maior que zero criamos a tabela */
            if ($total >0): ?>
            <label for="catn" class="form-label">Categoria</label>
            <select class="form-select" aria-label="Default select example" name="categoria_cod_pacote" id="catn" required>
                    <option selected hidden>-- Categorias --</option>
            <?php while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                <option value="<?php echo $resultado['cod']?>"><?php echo $resultado['nome']?></option>
            <?php endwhile; ?>
            </select>
            <?php else: ?>
            <p>Não há Pacote cadastrado</p>
            <?php endif; ?>
        </div>

        <div class="col-md-12">
            <label>Foto</label>
            <input type="file" name="arquivo" class="form-control" value="<?=$resultado['foto']?>"required>
        </div>

        <input class="form-control" name="cod" type="hidden" placeholder="<?=$resultado['cod']?>" aria-label="Id número" value="<?=$cod ?>">
        <input type="submit" value="Alterar">
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>