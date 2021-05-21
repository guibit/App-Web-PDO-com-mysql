<?php
$senha= "gui123";
$senhacript = md5($senha);
$senhashash = password_hash($senha,PASSWORD_DEFAULT);
echo "$senha <br>";
echo "$senhacript <br>";
echo "$senhashash";


?>