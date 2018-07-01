<html lang="utf-8">
  <meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bulma.css">
  <link rel="stylesheet" type="text/css" href="css/products.css">
<head>
  <title>Display Data From Table Book</title>
  <meta charset="utf-8">
</head>
<body>
  <?
  include("connect.php");

  $conn = mysql_connect($hostname,$username,$password);
  if(!$conn) die ("ไม่สามารถติดต่อกับ MYSQL ได้");
  mysql_select_db($dbname,$conn) or die ("ไม่สามารถเลือกฐานข้อมูล cosmetic ได้");

mysql_query("set names utf8");
$id = $_GET["id"];
$sql = "select * from product where product_id='$id'";
$result = mysql_query($sql);
$data = mysql_fetch_array($result);

?>
<br>
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

  <div class="section product-header">
    <div class="container">
      <div class="columns">
        <div class="column">
          <span class="title is-3"><strong>&nbsp;</strong><?php echo $data["product_name"]; ?></span>
          <span class="title is-3 has-text-muted">&nbsp;|&nbsp;</span>
          <span class="title is-4 has-text-muted"></span>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-4">
          <div class="image is-2by2">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $data['product_img'] ).'"/>' ?>
          </div>
        </div>
        <div class="column is-7 is-offset-1">
          <?php if($_GET['over'] == "true") {?>
            <div class="notification is-warning">
              <div class="has-text-centered">
                Sorry! Your Quantity is over. Please Try again.
              </div>
            </div>
          <?php } ?>
          <div class="title is-2"><strong><?php echo $user["brand_name"]; ?>&nbsp;</strong><?php echo $data["product_name"]; ?></div>
          <p class="title is-3 has-text-muted">฿ <?php echo $data["product_price"]; ?></p>
          <hr>
          <p><strong>ประเภทสินค้า : </strong><?php echo $data["protype_id"]; ?></p>
          <p><strong>จำนวนสินค้า : </strong><?php echo $data["product_num"]; ?></p>
          <p><strong>รายละเอียด : </strong><?php echo $data["product_detail"]; ?></p>
          <br>
          <br>

          <br>
        </div>
      </div>
    </div>
  </div>


<nav class="nav has-shadow" style=" height: 70px;">

  </nav>
<div class="container" style=" padding-top: 40px;">
    <div class="nav-center">
    <a class="button is-medium" href="showproduct.php">
       Back to product list
    </a>
    </div>


<script async type="text/javascript" src="js/bulma.js"></script>
</body>
</html>
