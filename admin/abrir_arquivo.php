<?php
 include("conecta.php");
 try
	{
    $conecta = conecta_bd();
		$consultaSQL = "SELECT tipo, foto FROM pacote WHERE cod=$_GET[cod]";
		$exComando = $conecta->prepare($consultaSQL); //testar o comando
		$exComando->execute(array());
        foreach($exComando as $resultado) 
		{
            $tipo = $resultado['tipo'];
            $conteudo = $resultado['foto'];
            header("Content-Type: $tipo");
            echo $conteudo;
		}	
    }catch(PDOException $erro)
	{
		echo("Errrooooo! foi esse: " . $erro->getMessage());
	}
?>