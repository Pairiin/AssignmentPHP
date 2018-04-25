<?php

$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "cosmetic";

$conn = mysql_connect($hostname,$username,$password);
if(!$conn) die ("ไม่สามารถติดต่อกับ MYSQL ได้");
mysql_select_db($dbname,$conn) or die ("ไม่สามารถเลือกฐานข้อมูล itbook ได้");
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
mysql_query("SET NAMES UTF8");

$sqltext="select * from useraccount where id = $id";
$result = mysql_query($sqltext,$conn);
$data = mysql_fetch_array($result);
?>

<html>
<head>
  <meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bulma.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
  <title>แก้ไขข้อมูลสมาชิก</title>
</head>

<body>




<nav class="nav has-shadow">
    <div class="container">
      <div class="nav-left">
        <a class="nav-item" href="index.php">
          <img src="assets/logo.png">
        </a>

        <a href="showproduct.php" class="nav-item is-tab is-hidden-mobile ">Product List</a>
        <a href="showuser.php" class="nav-item is-tab is-hidden-mobile is-active">Member List</a>
        <a href="showorder.php" class="nav-item is-tab is-hidden-mobile">Order List</a>
      </div>
      <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
      </span>

    </div>
  </nav>
 <section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column is-4 is-offset-4">
            <h1 class="title">
              Edit Member Information
            </h1>
            <form method="POST" action="saveedituser.php?id=<?=$id?>">
              <div class="box">
                <label class="label">Member No.</label>
                <p class="control">
                <input class="input" type="text" placeholder="<?echo $data['id'];?>" disabled>
                  <!--<input class="input" type="text" name="name" placeholder="John Smith" required="">-->
                  <input class="input" type="hidden" name="id" value="<?=$data['id'];?>"><?=$data['id'];?>


                </p>
                <label class="label">Username</label>
                <p class="control">
                  <input class="input" type="text" name="username" required="" value="<?=$data['username'];?>">

                </p>
                <hr>
                <label class="label">Password</label>
                <p class="control">
                  <input class="input" type="text" name="password"  required="" value="<?=$data['password'];?>">
                </p>
                <hr>
                <label class="label">Status</label>
                <p class="control">
                  <input class="input" type="text" name="password"  required="" value="<?=$data['status'];?>">
                </p>
                <hr>
                <label class="label">Name</label>
                <p class="control">
                  <input class="input" type="text" name="password"  required="" value="<?=$data['name'];?>">
                </p>
                <hr>
                <p class="control">
                  <input type="submit" class="button is-primary" value="Confirm">

                  <a href='showuser.php' class="button is-default">Cancel</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
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
