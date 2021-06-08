<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=cadastroviagens', "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->query("SELECT SYSDATE() 'SYSDATE'");
    $registro = $query->fetch();
    echo $registro["SYSDATE"];
    
} catch(PDOException $e) {
    echo 'Erro ao conectar: ' . $e->getMessage();
}
?>