<meta charset="utf-8">
<?php
$hostname = "localhost";
$username = "root";
$password = "12345678";
$dbname = "cosmetic";

$con = mysql_connect($hostname,$username,$password);
mysql_select_db("cosmetic",$con);
mysql_query("SET NAMES utf8");
?>
