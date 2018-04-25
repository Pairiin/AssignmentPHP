<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">


<?
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "cosmetic";
$conn = mysql_connect( $hostname, $username, $password );
if (!$conn) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล cosmetic ได้" );
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
mysql_query("SET NAMES UTF8");

function getbrandSelect($id){
  global $conn;
  $sqltext = "select * from brand";
  $dbquery = mysql_query($sqltext,$conn);

  if(!$dbquery)
  die("(FunctionDB:getbrandSelect) SELECT brand มีข้อผิดพลาด".mysql_error());
 
  
  echo "<p class=\"control\"> <span class=\"select is-primary\"> ";
  echo "<select name=\"brand_id\"> <option value=\"\">เลือกแบรนด์</option>";




while($rs = mysql_fetch_array($dbquery))
  {
    echo "<option value=\"".$rs['brand_id']."\">";
    if($rs['brand_id']==$brand_id) echo "selected";
    echo "".$rs['brand_name']."</option>";
    //echo $rs['StatusName']."</option>";
  }
  echo "</select> </span> </p>  ";
}



function gettypeSelect($id){
  global $conn;
  $sqltext = "select * from product_type";
  $dbquery = mysql_query($sqltext,$conn);

  if(!$dbquery)
  die("(FunctionDB:gettypeSelect) SELECT product_type มีข้อผิดพลาด".mysql_error());
  
  echo "<p class=\"control\"> <span class=\"select is-primary\"> ";
  echo "<select name=\"protype_id\"> <option value=\"\">เลือกประเภท</option>";



while($rs = mysql_fetch_array($dbquery))
  {
    echo "<option value=\"".$rs['protype_id']."\">";
    if($rs['protype_id']==$brand_id) echo "selected";
    echo "".$rs['protype_name']."</option>";
    //echo $rs['StatusName']."</option>";
  }
  echo "</select> </span> </p>  ";
}
?>
<html><head><title>เพิ่มข้อมูลสินค้า</title></head>
  <meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bulma.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
<body >

<nav class="nav has-shadow">
    <div class="container">
      <div class="nav-left">
        <a class="nav-item" href="index.php">
          <img src="assets/logo.png" >
        </a>
        
        <a href="showproduct.php" class="nav-item is-tab is-hidden-mobile is-active">Product List</a>
        <a href="showuser.php" class="nav-item is-tab is-hidden-mobile ">Member List</a>
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
              Edit Product Information
            </h1>
            <form enctype="multipart/form-data" name="save" method="post" action="saveproduct.php">
              <div class="box">
              
                <label class="label">Name</label>
                <p class="control">
                  <input class="input is-primary" type="text" name="product_name" size="50" maxlength="50" required="" >

                  

                
              </p>
              <label class="label">ฺBrand Name : </label>
                  
                <?=getbrandSelect($data['brand_id']);?>
                <hr>


                <label class="label">Details</label>
                <p class="control">
                  
                  <textarea class="textarea is-primary" name="product_detail" size="50" maxlength="50"></textarea>
                </p>
               
                <label class="label">Cost</label>
                <p class="control">
                  <input class="input is-primary" type="text" name="product_price" maxlength="25" size="20" required="" >
                </p>
               

                <label class="label">Type</label>
                <?=gettypeSelect($data['protype_id']);?>
                <hr>

                <label class="label">Picture</label>
                <p class="control">
                  
                  
                  <input type = "hidden" name = "max_size" value="1000000">
                  
                  <a class="button is-primary is-outlined"><input type = "file" name="image" size="50"></a>
                </p>
                <hr>
                
                
                      

                <label class="label">Quantity</label>
                <p class="control">
                  <input class="input is-primary" type="text" name="product_num" maxlength="25" size="20">
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


<meta http-equiv=Content-Type content="text/html; charset=utf-8">
</body>
</html>
