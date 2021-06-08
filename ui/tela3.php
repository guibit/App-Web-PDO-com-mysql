<?php
require_once '../admin/conecta.php';
$PDO = conecta_bd();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>JFK Turismos</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!--css-->
        <link rel="stylesheet" href="css3/estilologin.css">
    </head>
  <body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="#">JFK Turismo</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="tela1.php">Home <span class="sr-only">(Página atual)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                      </a>
                      <?php    
                      /**Consulta para guardar o total de registro e outra para todos os registros */
                      $stmt_count = $PDO->prepare("SELECT COUNT(*) AS total FROM categoria");
                      $stmt_count->execute();
                      $stmt = $PDO->prepare("SELECT * FROM categoria;");
                      $stmt->execute();
                      $total = $stmt_count->fetchColumn();
                      /**caso total de registro seja maior que zero criamos a tabela */
                      if ($total >0): ?>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <?php while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)):?>               
                            <a class="dropdown-item" href="#"><?php echo $resultado['nome']?></a>
                      <?php endwhile; ?>
                      </div>
                      <?php else: ?>
                      <p>Não há Pacote cadastrado</p>
                      <?php endif; ?>
                    </li>
                  <li class="nav-item">
                    <a class="nav-link" href="tela3.php">Minha Conta</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                  </li>   
                </ul>
              </div>
            </nav>
    </header>
    <button type="button" id="ler-pagina">Ler página</button>
        <section>
          <div id="carregalogin"></div>
        </section>
        <script>
          $(document).ready(function(){

            $("#ler-pagina").click(function(){
              $(function(){
                $("#carregalogin").load("../admin/login.php"); 
              });
            })
          });
        </script>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  <footer class="">
    JFK
</footer>
</html>