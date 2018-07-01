<?php
$id = $_GET["id"];
  include("connect.php");
$conn = mysql_connect($hostname,$username,$password);
if(!$conn) die ("ไม่สามารถติดต่อกับ MYSQL ได้");
mysql_select_db($dbname,$conn) or die ("ไม่สามารถเลือกฐานข้อมูล cosmetic ได้");
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
mysql_query("SET NAMES UTF8");

$sqltext="select * from product where product_id = $id";
$result = mysql_query($sqltext,$conn);
$data = mysql_fetch_array($result);


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

<html>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EditProduct</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bulma.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
<head>
  <meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <title>แก้ไขข้อมูลสินค้า</title>
</head>

<body>
<section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column is-8 is-offset-2">
            <h1 class="title">
              Edit Product Information
            </h1>

<form method="POST" action="saveeditproduct.php?id=<?=$id?>" enctype="multipart/form-data">
 <div class="box">

    <label class="label">Name</label>
                <p class="control">
      <input type="hidden" name="product_id" value="<?=$data['user_id'];?>"><?=$data['product_id'];?>
       <input input class="input is-primary" type="text" name="product_name" size="40" value="<?=$data['product_name'];?>">
    </p>

    <label class="label">Brand Name : </label>
    <?=getbrandSelect($data['brand_id']);?>
    <hr>

    <label class="label">Details</label>
                <p class="control">
                <textarea class="textarea is-primary" name="product_detail" rows="5" cols="40"><?=$data['product_detail'];?></textarea>
                </p>

                <label class="label">Cost</label>
                <p class="control">
                  <input class="input is-primary" type="text" name="product_price" value="<?=$data['product_price'];?>">
                </p>

     <label class="label">Type</label>
                <?=gettypeSelect($data['protype_id']);?>
                <hr>

                <label class="label">Picture</label>
                <p class="control">
                  <? echo '<td><img width="200px" src="data:image/jpeg;base64,'.base64_encode( $data['product_img'] ).'"/>';?>
                </p>
                <hr>

                  <label class="label">Quantity</label>
                <p class="control">
                  <input class="input is-primary" type="text" name="product_num" value="<?=$data['product_num'];?>">
                </p>
                <hr>

                <p class="control">
                  <input type="submit" class="button is-primary" value="Confirm">

                  <a href='showproduct.php' class="button is-default">Cancel</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
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
<?php
      echo "<center><br><a href='showproduct.php'>กลับไปที่หน้าหลัก</a></center>";

 ?>
