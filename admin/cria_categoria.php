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
    <title>Criar nova Categoria</title>
    <link rel="stylesheet" type="" href="css.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="bg-dark" style="color:#d2edf7">
    <section class="formulario">
        <form name="cadastro" method="POST" action="inclui_cat.php" class="row g-3">
            <?php
                if(isset($_SESSION['catmsg']) && !empty($_SESSION['catmsg'])){
                    print "<script>alert(\"{$_SESSION['catmsg']}\")</script>";
                    $_SESSION['catmsg'] = null;
                }
            ?> 
            <div class="col-md-12">
                <td><label for="nomen"class="form-label">Nome da Categoria:</label></td>
                <td><input type="text" name="nome_categoria" id="nomen" size="20" class="form-control" required></td>
            </div>
            <div class="col-md-12">
                <label for="descn" class="form-label">Descrição</label>
                <textarea class="form-control" id="descn" rows="3" name="desc_categoria" required></textarea>
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