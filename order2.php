<?php
ob_start();
session_start();

if(!isset($_SESSION["intLine"])) //ถ้าไม่มีค่าให้ทำ
{

	 $_SESSION["intLine"] = 0;
	 $_SESSION["strProductID"][0] = $_GET["ProductID"];
	 $_SESSION["strQty"][0] = 1; //จำนวนสินค้าเริ่มต้น

	  echo "<meta http-equiv='refresh' content='1;URL=show.php'>";
}
else //ถ้ามีค่า
{

	$key = array_search($_GET["ProductID"], $_SESSION["strProductID"]); //หาว่ามี ProductID ใน strProductID มั้ย
	if((string)$key != "") //ถ้ามีรายการสินค้านั้นอยู่แล้วใน list
	{
		 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + 1;
	}
	else //ถ้ายังไม่มีรายการสินค้านั้นใน list
	{

		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
		 $intNewLine = $_SESSION["intLine"];
		 $_SESSION["strProductID"][$intNewLine] = $_GET["ProductID"];
		 $_SESSION["strQty"][$intNewLine] = 1;
	}

	  echo "<meta http-equiv='refresh' content='1;URL=show.php'>";

}
?>
