<?php
require_once 'autentica.php';
require_once 'autentica_adm.php';
require_once 'conecta.php';
$PDO = conecta_bd();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Painel ADM </title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
            <link rel="stylesheet" type="" href="css.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="bg-dark" style="color:#d2edf7">
    <div class="nav justify-content-center">
        <h1 >Painel Administrativo</h1>
    </div>

    
   <ul class="nav justify-content-center" >
        <li class="nav-item" style="margin:10px;">
            <button class="nav-link btn btn-dark" aria-current="page"  id="show_pacote">Mostrar Pacotes</button>
        </li>
        <li class="nav-item" style="margin:10px;">
            <button class="nav-link btn btn-dark"  id="show_categoria">Mostrar Categoria</button>
        </li>
        <li class="nav-item" style="margin:10px;">
            <button class="nav-link btn btn-dark"  id="show_usuarios">Mostrar Usuários</button>
        </li>
  </ul> 
   <br><br>

   <div id="conteudo-pagina-lida"></div>
   <?php if(isset($_GET['sair'])){
    session_destroy();
    header('Location: login.php');
    } ?>
    <div style="text-align: center;"><a href="?sair">Logout</a></div>
     
   <script>
   $(document).ready(function(){
        $("#show_pacote").click(function(){
            $(function(){
                $("#conteudo-pagina-lida").load("show_pacote.php"); 
            });
        })

        $("#show_categoria").click(function(){
            $(function(){
                $("#conteudo-pagina-lida").load("show_cat.php"); 
            });
        })

        $("#show_usuarios").click(function(){
            $(function(){
                $("#conteudo-pagina-lida").load("index.php"); 
            });
        })
   });
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
     
</body>
</html>