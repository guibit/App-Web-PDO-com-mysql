<?php
/**Constantes com as informacoes para o acesso ao Banco de Dados */
define('DB_HOST','localhost');
define('DB_NAME','cadastroviagens');
define('DB_USER','root');
define('DB_PASS','');
/**Habilitando mensagens de erro */
ini_set ('display_errors',true);
error_reporting(E_ALL);
/**Inclui o arquivo que conecta */
require_once 'conecta.php';
?>