<?php
 include("conecta.php");
 try
	{
    $conecta = conecta_bd();
		$consultaSQL = "SELECT arquivo_tipo, Foto FROM clientes WHERE id=$_GET[id]";
		$exComando = $conecta->prepare($consultaSQL); //testar o comando
		$exComando->execute(array());
        foreach($exComando as $resultado) 
		{
            $tipo = $resultado['arquivo_tipo'];
            $conteudo = $resultado['Foto'];
            header("Content-Type: $tipo");
            echo $conteudo;
		}	
    }catch(PDOException $erro)
	{
		echo("Errrooooo! foi esse: " . $erro->getMessage());
	}
?>