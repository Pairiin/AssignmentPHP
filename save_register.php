<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?
  $hostname = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "cosmetic";
  $conn = mysql_connect( $hostname, $username, $password );
  if (!$conn) die( "ไม่สามารถติดต่อกับ MySQL ได้" );
  mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล bookstore ได้" );
  mysql_query("SET character_set_results=tis620");
  mysql_query("SET character_set_client=tis620");
  mysql_query("SET character_set_connection=tis620");
  mysql_query("SET NAMES UTF8");
  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];

//$BDate = date("Y-m-d");
 $sql = "INSERT INTO useraccount (username,password,status,name) VALUES
('$username','$password','2','$name')";
//echo $sql;
mysql_query($sql,$conn);
echo "<meta http-equiv='refresh' content='1;URL=login.php?id=success'>";
?>
