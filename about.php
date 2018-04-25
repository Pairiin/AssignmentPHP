
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
          <a href="index.php" class="nav-item is-tab is-hidden-mobile ">Home</a>
          <a href="allproduct.php" class="nav-item is-tab is-hidden-mobile">Product</a>
          <a href="about.php" class="nav-item is-tab is-hidden-mobile is-active">About</a>
        </div>
        <span class="nav-toggle">
          <span></span>
          <span></span>
          <span></span>
        </span>
        <div class="nav-right nav-menu">
          <a href="index.php" class="nav-item is-tab is-hidden-tablet is-active">Home</a>
          <a href="allproduct.php" class="nav-item is-tab is-hidden-tablet">Product</a>
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

    <section class="hero is-medium is-primary is-bold ">
      <div class="hero-body">
       <div class="container ">
      <div class="columns">

        <div class="column is-6">

          <h1 class="title">
            About Us
          </h1>
          <h2 class="subtitle">
            Contact
          </h2>

        </div>
        <div class="column is-6">

          <h2 class="subtitle">

                <p>มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ วิทยาเขตปราจีนบุรี</p>
                <hr>
                <p>129 ม.21 ตำบลเนินหอม อำเภอเมือง จังหวัดปราจีนบุรี 25230</p>
                <hr>
                <p>คณะเทคโนโลยีและการจัดการอุตสาหกรรม ภาควิชาเทคโนโลยีสารสนเทศ</p>
          </h2>
          </div>
        </div>
      </div>
       </div>
    </section>


    </body>

</html>
