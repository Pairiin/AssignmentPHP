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
              <h1 class="title" style="margin-top:30px">
                View Order
              </h1>
              <?php
              $strSQL = "SELECT * FROM orders WHERE order_id = '".$_GET["OrderID"]."' ";
              $objQuery = mysql_query($strSQL)  or die(mysql_error());
              $objResult = mysql_fetch_array($objQuery);
              ?>

              <table class="table" style="width:70%">
                <tbody>
                  <tr>
                    <td>OrderID</td>
                    <td><?php echo $objResult["order_id"];?></td>
                  </tr>
                  <tr>
                    <td>Name</td>
                    <td><?php echo $objResult["Name"];?></td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td><?php echo $objResult["Address"];?></td>
                  </tr>
                  <tr>
                    <td>Tel</td>
                    <td><?php echo $objResult["Tel"];?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?php echo $objResult["Email"];?></td>
                  </tr>
                </tbody>
              </table>

              <h2 class="subtitle">
                Product List
              </h2>

              <table class="table" style="width:70%">
                <thead>
                  <tr>
                    <th>ProductID</th>
                    <th>ProductName</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
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
                </tbody>
              </table>
              <div class="columns">
                <div class="column">
                  <div style="width:70%">
                    <div class="is-pulled-right">
                      Sum Total <?php echo number_format($SumTotal,2);?>
                    </div>
                  </div>
                </div>
              </div>

              <?php
              mysql_close();
              ?>
              <div class="columns">
                <div class="column">
                  <div style="width:70%">
                    <div class="has-text-centered">
                      <a href="print.php?OrderID=<?php echo $_GET["OrderID"];?>" target="_blank" class="button is-info is-outlined"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Report</a>
                      <a href="index.php" class="button is-success is-outlined"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Home</a>
                    </div>
                  </div>
                </div>
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
