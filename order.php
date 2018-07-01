<?php
ob_start();
session_start();
include("connect.php");
$id= $_POST["txtProductID"]; //Id สินค้าที่เลือกมา
$strSQL = "SELECT * FROM product WHERE product_id = '".$_POST["txtProductID"]."'";
$objQuery = mysql_query($strSQL)  or die(mysql_error());
$objResult = mysql_fetch_array($objQuery);
$stock_id=$objResult["product_num"]; //จำนวนสินค้าที่มีในสต๊อก
if($_POST["txtQty"] > $objResult["product_num"]) //เช็คว่าเลขที่เลือกมันมีมากกว่าสินค้าที่มีในสต๊อกมั้ย
{
	echo "<meta http-equiv='refresh' content='1;URL=product.php?id=$id&over=true'>";
}
else
{

	if(!isset($_SESSION["intLine"])) //ถ้าไม่มีการเลือกสินค้า
	{
		if(isset($_POST["txtProductID"]))
		{
			 $_SESSION["intLine"] = 0; //เลือกสินค้า a ชิ้น = 1 || เลือกสินค้า a 2ชิ้น b 3ชิ้น =2
			 $_SESSION["strProductID"][0] = $_POST["txtProductID"]; //idสินค้าที่อยู่ในตะกร้า
			 $_SESSION["strQty"][0] = $_POST["txtQty"]; //จำนวนสินค้าที่เลือก

			 echo "<meta http-equiv='refresh' content='1;URL=show.php'>";
		}
	}
	else //ถ้ามีการเลือกสินค้า
	{

		$key = array_search($_POST["txtProductID"], $_SESSION["strProductID"]); //ดูว่า txtProductID มีอยู่ใน strProductID หรือป่าว
		if((string)$key != "") //กรณีมีรายการนั้นอยู่ในตะกร้าแล้ว
		{
			 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + $_POST["txtQty"];
		}
		else //ถ้ายังไม่มีสินค้าในตะกร้า
		{

			 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
			 $intNewLine = $_SESSION["intLine"];
			 $_SESSION["strProductID"][$intNewLine] = $_POST["txtProductID"];
			 $_SESSION["strQty"][$intNewLine] = $_POST["txtQty"];
		}

		 echo "<meta http-equiv='refresh' content='1;URL=show.php'>";

	}
}
?>
