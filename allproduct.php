<!DOCTYPE html>
<?php
  ob_start();
  @session_start();
  include("connect.php");
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/bulma.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <nav class="nav has-shadow">
      <div class="container">
        <div class="nav-left">
          <a class="nav-item" href="index.php">
            <img src="assets/logo.png" >
          </a>
          <a href="index.php" class="nav-item is-tab is-hidden-mobile">Home</a>
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

    <div class="page">
      <div class="container">
        <div class="columns">
          <div class="column is-3">
            <aside class="menu">
              <p class="menu-label">
                PRODUCT
              </p>
              <?php
                $sql = mysql_query("SELECT * FROM product_type");
                $num = mysql_num_rows($sql);
              ?>
              <ul class="menu-list">
                <?php while($user = mysql_fetch_array($sql)){ ?>
                  <li><a href="protypelist.php?id=<?php echo $user["protype_id"]; ?>"><?php echo $user["protype_name"]; ?></a></li>
                <?php } ?>
              </ul>
              <p class="menu-label">
                BRANDS
              </p>
              <?php
                $sql = mysql_query("SELECT * FROM brand");
                $num = mysql_num_rows($sql);
              ?>
              <ul class="menu-list">
                <?php while($user = mysql_fetch_array($sql)){ ?>
                  <li><a href="productlist.php?id=<?php echo $user["brand_id"]; ?>"><?php echo $user["brand_name"]; ?></a></li>
                <?php } ?>
              </ul>
            </aside>
          </div>
          <div class="column is-9">
            <div class="container">
              <h1 class="title">
                All Products
              </h1>
              <h2 class="subtitle">
                Hero subtitle
              </h2>
              <div class="columns is-multiline">
                <?php
                  $sql = mysql_query("SELECT * FROM product JOIN brand ON product.brand_id = brand.brand_id");
                  $num = mysql_num_rows($sql);
                  while($user = mysql_fetch_array($sql)){
                ?>
                <div class="column is-3" style="width: 350px;">
                  <div class="card" style="height: 100%">
                    <a href="product.php?id=<?php echo $user['product_id'];?>">
                      <div class="card-image">
                        <figure class="image is-1by1" style="margin:20px">
                          <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $user['product_img'] ).'"/>' ?>
                        </figure>
                      </div>
                      <div class="card-content" style="padding: 0px 0 20px 0">
                        <div class="media">
                          <div class="media-content" style="margin: 0px 0 10px 0">
                            <div class="has-text-centered">
                              <p class="title is-5" style="margin: 10px 0"><?php echo $user["brand_name"]; ?></p>
                              <p class="title is-6"><?php echo $user["product_name"]; ?></p>
                            </div>
                          </div>
                        </div>
                        <div class="content">
                          <?php if($user["product_num"] == 0){?>
                            <div class="has-text-centered">
                              <a class="button is-danger is-disabled" title="Disabled button" disabled>Sold Out</a>
                            </div>
                          <?php } else {?>
                          <div class="has-text-centered">
                            <a class="button is-primary is-outlined" href="order2.php?ProductID=<?php echo $user["product_id"];?>">Add<i class="fa fa-shopping-basket" style="margin-left:10px"></i> </a>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <div class="content has-text-centered">
          <p>
            <strong>Assignment Web Programming </strong> by KMUTNB
          </p>
        </div>
      </div>
    </footer>


  </body>
</html>
