<?php
require 'inicia.php';
//Recebe valores do Id escolhido para alterar
$id = isset($_GET["id"])?$_GET["id"]:null;
if(empty($id)){
    echo"id não cadastrado";
    exit;
}
/**Busca na tabela os dados do usuario a ser alterado */
$PDO = conecta_bd();
$stmt= $PDO->prepare("SELECT * FROM clientes WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$resultado =  $stmt->fetch(PDO::FETCH_ASSOC);
/**Se o fetch acima nao retornar um array, o id nao existe */
if(!is_array($resultado)){
    echo "nenhum usuário encontrado com o id informado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <h2>Cadastro de Usuário - Alteração</h2>
    <form action="altera.php" method="POST" style="max-width: 400px; margin-left:30px" class="row g-3">
        
        <div class="col-md-12">
            <label for="id" class="form-label">ID:</label>
            <input class="form-control" type="text" placeholder="<?=$resultado['id']?>" aria-label="Id número"  disabled>
        </div>

        
        <div class="col-md-12">
            <td><label for="ncompleto" class="form-label">Nome Completo:</label></td>
            <td><input type="text" name="nome" id="ncompleto" class="form-control" value="<?=$resultado['nome']?>" required></td>
        </div>
        

        
        <div class="col-md-12">
            <td><label for="emailn"class="form-label">Email:</label></td>
            <td><input type="email" name="email" id="emailn" size="20" class="form-control" value="<?=$resultado['email']?>" required></td>
        </div>

        <div class="col-md-12">
            <label for="dtnasc">Data de Nascimento:</label>
            <input type="date" name="nascimento" id="dtnasc" class="form-control" value="<?=$resultado['nascimento']?>" required>
        </div>

        <div class="col-md-12">
            <label for="estd"class="form-label">Estado:</label>
            <select name="estado" id="estd" class="form-control" value="<?=$resultado['estado']?>" required>
                <option value="sec" hidden><?=$resultado['estado']?></option>
                <option value="PR">Paraná</option>
                <option value="SC">Santa Catarina</option>
                <option value="RS">Rio Grande do Sul</option>
            </select>
        </div>



        <div class="col-md-12">
            <td><label for="end"class="form-label">Endereço:</label></td>
            <td><input type="text" name="endereco" id="end" class="form-control" value="<?=$resultado['endereco']?>" required></td>
        </div>

        <?php if($resultado['sexo']=='Masculino'):?>
        <div class="col-md-12" class="form-label">Sexo:</div>
            <div class="col-md-6 form-check">
                <input type="radio" name="sexo" value="Masculino" class="form-check-input" id="mascid" checked><label class="form-label" for="mascid"> Masculino</label>
            </div>
            <div class="col-md-6 form-check">
                <input type="radio" name="sexo" value="Feminino" class="form-check-input" id="femid" ><label class="form-label" for="femid"> Feminino</label> 
            </div>
        </div>
        <?php else:?>
            <div class="col-md-12" class="form-label">Sexo:</div>
            <div class="col-md-6 form-check">
                <input type="radio" name="sexo" value="Masculino" class="form-check-input" id="mascid"><label class="form-label" for="mascid" > Masculino</label>
            </div>
            <div class="col-md-6 form-check">
                <input type="radio" name="sexo" value="Feminino" class="form-check-input" id="femid" checked><label class="form-label" for="femid" > Feminino</label> 
            </div>
        </div>
        <?php endif ;?>
        
        
        <div class="col-md-12">
            <label class="form-label">Cartão de Crédito: </label>
        </div>
        
        <div class="col-md-6 form-check">
            <input class="form-check-input" name="cartao[]" type="checkbox" value="Visa" id="visaid">
            <label class="form-check-label" for="visaid">
            Visa
            </label>
        </div>
        <div class="col-md-6 form-check">
            <input class="form-check-input" name="cartao[]" type="checkbox" value="Elo" id="eloid">
            <label class="form-check-label" for="eloid">
            Elo
            </label>
        </div>
        <div class="col-md-6 form-check">
            <input class="form-check-input" name="cartao[]" type="checkbox" value="Master" id="masterid">
            <label class="form-check-label" for="masterid">
            Master Card
            </label>
        </div>
        <div class="col-md-6 form-check">
            <input class="form-check-input" name="cartao[]" type="checkbox" value="Diners" id="dinersid">
            <label class="form-check-label" for="dinersid">
            Diners Club
            </label>
        </div>
        <div class="col-md-12">
            O cartão selecionado pelo cliente foi: <B><?=$resultado['cartao']?></B>
        </div>

        <input class="form-control" name="id" type="hidden" placeholder="<?=$resultado['id']?>" aria-label="Id número" value="<?=$id ?>">
        <input type="submit" value="Alterar">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
