<html lang="utf-8">
<head>
  <title>Display Data From Table Book</title>
  <meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bulma.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body>
  <?
  include("connect.php");
  $conn = mysql_connect($hostname,$username,$password);
  if(!$conn) die ("ไม่สามารถติดต่อกับ MYSQL ได้");
  mysql_select_db($dbname,$conn) or die ("ไม่สามารถเลือกฐานข้อมูล cosmetic ได้");

  mysql_query("set names utf8");

$sqltxt = "SELECT * FROM product order by product_id ASC";
//$sqltxt = "SELECT product.product_id,product.product_name,product.brand_id,product.brand_name,product.price,product.protype_id,product.product_img FROM product INNER JOIN brand ON product.brand_id=brand.brand_id";
$result = mysql_query ($sqltxt,$conn);

$a=1;

?>
<nav class="nav has-shadow">
    <div class="container">
      <div class="nav-left">
        <a class="nav-item" href="index.php">
          <img src="assets/logo.png" >
        </a>
        <a href="showproduct.php" class="nav-item is-tab is-hidden-mobile is-active">Product List</a>
        <a href="showuser.php" class="nav-item is-tab is-hidden-mobile ">Member List</a>
        <a href="showorder.php" class="nav-item is-tab is-hidden-mobile ">Order List</a>
      </div>
      <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </div>
  </nav>

<section class="hero is-primary bsa">
<div class="hero-body" style=" padding-top: 80px; padding-bottom: 80px; ">
<div class="container">
<div class="columns">
<div class="column is-10">

<p class="title"> Product List </p>
<p class="subtitle"> Check Edit and Delete </p>

</div>
<div class="column is-2">

 <a class="button is-primary is-inverted is-outlined" HREF="insertproduct.php">
 <span class="icon is-small">
      <i class="fa fa-plus"></i>
  </span>
  <span>Add Product</span>
  </a>
      </div>
    </div>
  </div>
</div>
</section>

<div class="section">
    <div class="container">
      <div class="columns">

<table class="table">
  <thead>
    <tr>
      <th>No.</th>
      <th>ID</th>
      <th>Product Name</th>
      <th>Cost</th>
      <th>Picture</th>
      <th>Del</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php

while($rs = mysql_fetch_array($result)){
  echo "<tr>";
  echo "<td>$a</td>";
  echo "<td>";
  echo "<a href=\"detailproduct.php?id=$rs[0]\">$rs[0]</a></td>";
  echo "<td>$rs[1]</td>";
  echo "<td>$rs[4]</td>";
  echo '<td><img width="200px" name="image" src="data:image/jpeg;base64,'.base64_encode( $rs['product_img'] ).'"/></td>';
  echo "<td><a href=\"deleteproduct.php?id=$rs[0]\" ";
  echo "onclick=\"return confirm('ยืนยันการลบข้อมูลสินค้า $rs[1]')\">[DELETE]";
  echo "<td><a href=\"editproduct.php?id=$rs[0]\" >[EDIT]";
  echo "</a></td></tr>";
  $a++;
}
mysql_close($conn);

?>
  </tbody>
</table>
    </div>
  </div>
</div>
  <nav class="nav has-shadow" style=" height: 70px;"></nav>
<div class="container" style=" padding-top: 40px; padding-bottom: 100px;"></div>

<script async type="text/javascript" src="js/bulma.js"></script>
</body>
</html>
