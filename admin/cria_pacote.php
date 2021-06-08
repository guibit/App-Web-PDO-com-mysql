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
    <title>Criar novo Pacote</title>
    <link rel="stylesheet" type="" href="css.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="bg-dark" style="color:#d2edf7">
    <section class="formulario">
        <form enctype="multipart/form-data" name="cadastro" method="POST" action="inclui_pacote.php" class="row g-3">
            <?php
                if(isset($_SESSION['pacotemsg']) && !empty($_SESSION['pacotemsg'])){
                    print "<script>alert(\"{$_SESSION['pacotemsg']}\")</script>";
                    $_SESSION['pacotemsg'] = null;
                }
            ?> 
            <div class="col-md-12">
                <td><label for="nomen"class="form-label">Nome do Pacote:</label></td>
                <td><input type="text" name="nome_pacote" id="nomen" size="20" class="form-control" required></td>
            </div>
            <div class="col-md-12">
                <label for="descn" class="form-label">Descrição</label>
                <textarea class="form-control" id="descn" rows="3" name="desc_pacote" required></textarea>
            </div>
            <div class="col-md-12">
                <label for="valorn" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valorn" name="valor_pacote" required>
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
                <input type="file" name="arquivo" class="form-control" required>
            </div>
            
            <div class="col-md-6">
                <input type="submit" name="enviar" value="Cadastrar" class="form-control btn btn-primary" >
            </div>
            <div class="col-md-6">
                <input type="reset" name="limpar" value="Limpar" class="form-control btn btn-primary">
            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>