<?php
session_start();
if($_SESSION['login'] != true){
    header('Location: login.php');
    session_destroy();
    die();
}
?>