<?php
session_start();
unset($_SESSION['ses_id']);
unset($_SESSION['username']);
unset($_SESSION['password']);

echo "<meta http-equiv='refresh' content='1;URL=index.php'>";

 ?>
