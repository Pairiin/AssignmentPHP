<?php
session_start();
include("connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

  $sql = mysql_query("SELECT * FROM useraccount WHERE username = '$username' AND password = '$password' ");

  $num = mysql_num_rows($sql);
  if($num <= 0){
    echo "<meta http-equiv='refresh' content='1;URL=login.php?id=fail'>";
  }
  else{
    while($user = mysql_fetch_array($sql)){
      if($user['status'] == 1)
      {
        $_SESSION['ses_id'] = session_id();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['status'] = 1;
        echo "<meta http-equiv='refresh' content='1;URL=showproduct.php'>";
      }
      else {
        $_SESSION['ses_id'] = session_id();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['status'] = 2;
        echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
      }
    }
  }

 ?>
