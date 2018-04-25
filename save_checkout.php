<?php
session_start();

include("connect.php");

  $Total = 0;
  $SumTotal = 0;

  $strSQL = "
	INSERT INTO orders (OrderDate,Name,Address,Tel,Email)
	VALUES
	('".date("Y-m-d H:i:s")."','".$_POST["txtName"]."','".$_POST["txtAddress"]."','".$_POST["txtTel"]."','".$_POST["txtEmail"]."')
  ";
  mysql_query($strSQL) or die(mysql_error());

  $strOrderID = mysql_insert_id();

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
			  $strSQL = "
				INSERT INTO orders_detail (order_id,product_id,qty)
				VALUES
				('".$strOrderID."','".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."')
			  ";
			  mysql_query($strSQL) or die(mysql_error());

        $strSQL1 = mysql_query("SELECT * FROM product WHERE product_id = '".$_SESSION["strProductID"][$i]."'");
        while($user = mysql_fetch_array($strSQL1)){
          $pro_num = $user["product_num"] - $_SESSION["strQty"][$i];
        }

        $strSQL2 = "UPDATE product SET product_num = '".$pro_num."' WHERE product_id = '".$_SESSION["strProductID"][$i]."'";
        mysql_query($strSQL2) or die(mysql_error());
	  }
  }
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
      $_SESSION["strProductID"][$i] = "";
      $_SESSION["strQty"][$i] = "";
      $_SESSION["intLine"]=0;
    }
  }

mysql_close();

// session_destroy();

echo "<meta http-equiv='refresh' content='1;URL=view_order.php?OrderID=".$strOrderID."'>";

// header("location:finish_order.php?OrderID=".$strOrderID);
?>
