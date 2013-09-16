<?php
$host = "localhost";
$user = "root";
$pass = "";
$bd	  = "hassedco_andrei";

$conexao = mysql_connect($host,$user,$pass) or die (mysql_error());
$sql = mysql_select_db($bd) or die (mysql_error());
?>
