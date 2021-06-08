<?php
if ($_SESSION['tipo'] !== "A" ){
    header('Location: login.php');
    die();
}
?>