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


$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$sqltxt = "SELECT * FROM product";
  $result = mysql_query($sqltxt,$conn);
$a=0;
	while($rs = mysql_fetch_array($result))
  {

    if($rs["product_id"]==$product_id) {
			echo "<center>รหัสหนังสือซ้ำกันกรุณากรอกรหัสอื่น</center>";

			echo "<CENTER><A HREF=\"insertproduct.php\">เพิ่มข้อมูลใหม่อีกครั้ง</A></CENTER>";
			echo "<center><br><a href='showproduct.php'>ดูสินค้าทั้งหมด</a></center>";
			echo "<center><br><a href='admin_index.php'>กลับไปหน้าแรก</a></center>";
			$a=1;
		}
  }

if($a==0){
//$BDate = date("Y-m-d");
 $sql = "INSERT INTO product (product_id ,product_name,brand_id,product_detail,product_price,
	protype_id,product_img, product_num) VALUES
('$product_id','$product_name','$brand_id','$product_detail', '$product_price',
'$protype_id','$image','$product_num')";
//echo $sql;
mysql_query($sql,$conn) or die("INSERT ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
mysql_error());
echo "<br><br><CENTER><H2>บันทึกข้อมูลเรียบร้อย</H2><BR><BR></CENTER>";

echo "<CENTER><A HREF=\"showproduct.php\">ดูสินค้าทั้งหมด</A></CENTER>";
}
mysql_close($conn);
?>
