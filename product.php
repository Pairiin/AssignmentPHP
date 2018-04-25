<?php
  ob_start();
  @session_start();
  include("connect.php");
  $id = $_GET["id"];
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bulma.css">
  <link rel="stylesheet" type="text/css" href="css/products.css">
</head>
<body>
  <nav class="nav has-shadow">
    <div class="container">
      <div class="nav-left">
        <a class="nav-item" href="index.php">
          <img src="assets/logo.png" >
        </a>
        <a href="index.php" class="nav-item is-tab is-hidden-mobile ">Home</a>
        <a href="allproduct.php" class="nav-item is-tab is-hidden-mobile is-active">Product</a>
        <a href="about.php" class="nav-item is-tab is-hidden-mobile">About</a>
      </div>
      <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
      </span>
      <div class="nav-right nav-menu">
        <a href="index.php" class="nav-item is-tab is-hidden-tablet">Home</a>
        <a href="allproduct.php" class="nav-item is-tab is-hidden-tablet is-active">Product</a>
        <a href="about.php" class="nav-item is-tab is-hidden-tablet">About</a>
        <?php
        $total = 0;
        for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
        {
          if($_SESSION["strProductID"][$i] != "")
          {
            $total += $_SESSION["strQty"][$i];
          }
        }
        ?>
        <a href="show.php" class="nav-item is-tab"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $total;?></a>
        <?php if(isset($_SESSION['ses_id'])){ ?>
          <div class="nav-item is-tab">
            <?php echo $_SESSION['username'];?>
          </div>
          <a href="logout.php" class="nav-item is-tab">Logout</a>
        <?php } else { ?>
          <a href="login.php" class="nav-item is-tab">Login</a>
        <?php } ?>
      </div>
    </div>
  </nav>

  <?php
    $sql = mysql_query("SELECT * FROM product JOIN brand ON product.brand_id = brand.brand_id where product_id = $id ");
    $num = mysql_num_rows($sql);
    while($user = mysql_fetch_array($sql)){
  ?>

  <div class="section product-header">
    <div class="container">
      <div class="columns">
        <div class="column">
          <span class="title is-3"><strong><?php echo $user["brand_name"]; ?>&nbsp;</strong><?php echo $user["product_name"]; ?></span>
          <span class="title is-3 has-text-muted">&nbsp;|&nbsp;</span>
          <span class="title is-4 has-text-muted"></span>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-6">
          <div class="image is-2by2">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $user['product_img'] ).'"/>' ?>
          </div>
        </div>
        <div class="column is-5 is-offset-1">
          <?php if($_GET['over'] == "true") {?>
            <div class="notification is-warning">
              <div class="has-text-centered">
                Sorry! Your Quantity is over. Please Try again.
              </div>
            </div>
          <?php } ?>
          <div class="title is-2"><strong><?php echo $user["brand_name"]; ?>&nbsp;</strong><?php echo $user["product_name"]; ?></div>
          <p class="title is-3 has-text-muted">฿ <?php echo $user["product_price"]; ?></p>
          <hr>
          <p><?php echo $user["product_detail"]; ?></p>
          <br>
          <br>
          <p>
            <form action="order.php" method="post">
              <input type="hidden" name="txtProductID" value="<?php echo $user["product_id"];?>" size="2">
              <input type="number" class="input has-text-centered" name="txtQty" value="1" style="width:60px;">
              &nbsp; &nbsp; &nbsp;
              <?php if($user["product_num"] == 0){ ?>
                <a class="button is-danger is-disabled" title="Disabled button" disabled>Sold Out</a>
              <?php } else {?>
                <input type="submit" class="button is-primary" value="Add to cart">
              <?php } ?>
	          </form>
          </p>
          <br>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>

  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          <strong>Assignment Web Programming </strong> by KMUTNB
        </p>
      </div>
    </div>
  </footer>
<script async type="text/javascript" src="js/bulma.js"></script>
</body>
</html>
