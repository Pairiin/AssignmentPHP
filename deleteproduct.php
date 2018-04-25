<?php ob_start(); ?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta charset="utf-8">
<?
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "cosmetic";
$conn = mysql_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn ) or die ( "ไม่สามารถเลือกฐานข้อมูล cosmetic ได้" );
$sql = "DELETE FROM product WHERE product_id= '$id' ";
mysql_query($sql) or die ( "DELETE จาตาราง cosmetic มีข้อผิดพลาดเกิดขึ้น".mysql_error());
mysql_close ( $conn );
header("Location:showproduct.php");
?>
