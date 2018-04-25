<?php
ob_start();
session_start();
include("connect.php");
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
      $strSQL = "SELECT * FROM product WHERE product_id = '".$_SESSION["strProductID"][$i]."'";
      $objQuery = mysql_query($strSQL)  or die(mysql_error());
      $objResult = mysql_fetch_array($objQuery);
      $stock_id = $objResult["product_num"];
      if($_POST["txtQty".$i] > $objResult["product_num"])
      {
        $error="true";
      }
      else
      {
			  $_SESSION["strQty"][$i] = $_POST["txtQty".$i];
	    }
    }
  }
  if($error=="true"){
    echo "<meta http-equiv='refresh' content='1;URL=show.php?over=true'>";
  }
  else{
    echo "<meta http-equiv='refresh' content='1;URL=show.php'>";
  }
?>
