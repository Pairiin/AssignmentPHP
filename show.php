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
              <?php if($_GET['over'] == "true") {?>
              <div class="notification is-warning" style="width:70%">
                Sorry! Your Quantity is over. Please Try again.
              </div>
              <?php } ?>
              <h1 class="title" style="margin-top:30px">
                Cart
              </h1>
              <form action="update.php" method="post">
                <table class="table" style="width:70%">
                  <thead>
                    <tr>
                      <th>ProductID</th>
                      <th>ProductName</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Total</th>
                      <th>Del</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $Total = 0;
                    $SumTotal = 0;

                    for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                    {
                  	  if($_SESSION["strProductID"][$i] != "")
                  	  {
                  		$strSQL = "SELECT * FROM product WHERE product_id = '".$_SESSION["strProductID"][$i]."' ";
                  		$objQuery = mysql_query($strSQL)  or die(mysql_error());
                  		$objResult = mysql_fetch_array($objQuery);
                  		$Total = $_SESSION["strQty"][$i] * $objResult["product_price"];
                  		$SumTotal = $SumTotal + $Total;
                  	  ?>
                  	  <tr>
                    		<td><?php echo $_SESSION["strProductID"][$i];?><input type="hidden" name="txtProductID<?php echo $i;?>" value="<?php echo $_SESSION["strProductID"][$i];?>"></td>
                    		<td><?php echo $objResult["product_name"];?></td>
                    		<td><?php echo $objResult["product_price"];?></td>
                    		<td><div style="width:60px"><input class="input" type="number" min="1" name="txtQty<?php echo $i;?>" value="<?php echo $_SESSION["strQty"][$i];?>"></div></td>
                    		<td><?php echo number_format($Total,2);?></td>
                    		<td><a href="delete.php?Line=<?php echo $i;?>">x</a></td>
                  	  </tr>
                  	  <?php
                  	  }
                    }
                    ?>
                  </tbody>
                </table>
                <div class="columns">
                  <div class="column">
                    <div style="width:70%">
                      <div class="is-pulled-left">
                        <input class="button is-light" type="submit" value="Update">
                      </div>
                      <div class="is-pulled-right">
                        Sum Total <?php echo number_format($SumTotal,2);?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="columns">
                  <div class="column">
                    <div style="width:70%">
                      <div class="is-pulled-left" >
                        <a class="button is-primary is-inverted" href="allproduct.php">
                          <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                          Go to Product
                        </a>
                      </div>
                      <div class="is-pulled-right">
                        <?php
                        	if($SumTotal > 0)
                        	{
                        ?>
                          <a class="button is-primary is-inverted" href="checkout.php">
                          	CheckOut&nbsp;
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                          </a>
                        <?php
                        	}
                        ?>
                        <?php
                        mysql_close();
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
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
