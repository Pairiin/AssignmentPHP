<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?
  include("connect.php");
$conn = mysql_connect( $hostname, $username1, $password );
if (!$conn) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล cosmetic ได้" );
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
mysql_query("SET NAMES UTF8");

$sql = "UPDATE useraccount SET username  = '$username',password = '$password',status = '$status',name = '$name' WHERE id='$id'";

mysql_query($sql,$conn) or die("update ลงตาราง useraccount มีข้อผิดพลาดเกิดขึ้น".
mysql_error());
echo "<br><br><CENTER><H2>แก้ไขข้อมูลเรียบร้อย</H2><BR><BR></CENTER>";
echo "<CENTER><A HREF=\"showuser.php\">แสดงข้อมูลทั้งหมด</A></CENTER>";

mysql_close($conn);
?>
