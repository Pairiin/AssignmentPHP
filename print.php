<?php
	require_once "mpdf/mpdf.php";
	ob_start();
  session_start();
	include_once "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body>

<?php echo "วันที่".DateThai(date("Y-m-d"))."";?>

<?php
$strSQL = "SELECT * FROM orders WHERE order_id = '".$_GET["OrderID"]."' ";
$objQuery = mysql_query($strSQL)  or die(mysql_error());
$objResult = mysql_fetch_array($objQuery);
?>

<table class="table" style="width:70%" style="border: 1px solid black;">
  <tbody >
    <tr style="border: 1px solid black;">
      <td>รหัสการสั่งซื้อ    : </td>
      <td><?php echo $objResult["order_id"];?></td>
    </tr>
    <tr>
      <td>ชื่อลูกค้า : </td>
      <td><?php echo $objResult["Name"];?></td>
    </tr>
    <tr>
      <td>ที่อยู่  : </td>
      <td><?php echo $objResult["Address"];?></td>
    </tr>
    <tr>
      <td>เบอร์โทร : </td>
      <td><?php echo $objResult["Tel"];?></td>
    </tr>
    <tr>
      <td>อีเมลล์  : </td>
      <td><?php echo $objResult["Email"];?></td>
    </tr>
  </tbody>
</table>
  <br><br>
  <table width="704" border="1" align="center"  >
    <thead>
      <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>ราคารวม</th>
      </tr>
    </thead>
    <tbody>
  <?php
  $Total = 0;
  $SumTotal = 0;

  $strSQL2 = "SELECT * FROM orders_detail WHERE order_id = '".$_GET["OrderID"]."' ";
  $objQuery2 = mysql_query($strSQL2)  or die(mysql_error());

  while($objResult2 = mysql_fetch_array($objQuery2))
  {
      $strSQL3 = "SELECT * FROM product WHERE product_id = '".$objResult2["product_id"]."' ";
      $objQuery3 = mysql_query($strSQL3)  or die(mysql_error());
      $objResult3 = mysql_fetch_array($objQuery3);
      $Total = $objResult2["qty"] * $objResult3["product_price"];
      $SumTotal = $SumTotal + $Total;
      ?>
      <tr>
        <td><?php echo $objResult2["product_id"];?></td>
        <td><?php echo $objResult3["product_name"];?></td>
        <td><?php echo $objResult3["product_price"];?></td>
        <td><?php echo $objResult2["qty"];?></td>
        <td><?php echo number_format($Total,2);?></td>
      </tr>

      <?
   }
    ?>
<tr><td colspan="5" align="right"><?php echo "ราคารวมทั้งหมด : ".number_format($SumTotal,2)." บาท ";?></td></tr>
    </tbody>
  </table>
</body>
</html>


<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสดง

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return " $strDay $strMonthThai $strYear";
	}
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->
