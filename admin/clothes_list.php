<?php

session_start();
include("../db.php");
error_reporting(0);
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$product_id=$_GET['product_id'];
///////picture delete/////////
$result=$dbh->query("select product_image from products where product_id='$product_id'")
or die("query is incorrect...");

$picture=$result->fetch()['product_image'];
$path="../product_images/$picture";

if(file_exists($path)==true)
{
  unlink($path);
}
else
{}
/*this is delet query*/
$dbh->query("delete from products where product_id='$product_id'")or die("query is incorrect...");
}

///pagination

$page=$_GET['page'];

if($page=="" || $page=="1")
{
$page1=0;	
}
else
{
$page1=($page*10)-10;	
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>后台管理</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style/css/bootstrap.min.css" rel="stylesheet">
<link href="style/css/k.css" rel="stylesheet">
</head>
<body>
  <?php include("include/header.php");?>
   	<div class="container-fluid main-container">
	<?php include("include/side_bar.php");?>
    <div class="col-md-9 content" style="margin-left:10px">
    <div class="panel-heading" style="background-color:#c4e17f">
	<h1>商品列表 /  <?php echo $page;?> </h1></div><br>
<div class='table-responsive'>  
<div style="overflow-x:scroll;">
<table class="table  table-hover table-striped" style="font-size:18px">
<tr><th>图片</th><th>名称</th><th>价格</th><th>
	<a class=" btn btn-primary" href="add_product.php">添加商品</a></th></tr>
<?php 

$result=$dbh->query("select product_id,product_image, product_title,product_price from products  Limit $page1,10")or die ("query 1 incorrect.....");

foreach($result as $row)
{
echo "<tr><td><img src='../product_images/".$row['product_image']."' style='width:50px; height:50px; border:groove #000'></td><td>".$row['product_title']."</td>
<td>".$row['product_price']."</td>
<td>

<a class=' btn btn-success' href='edit_product.php?product_id=".$row['product_id']."'>编辑</a>
<a class=' btn btn-success' href='clothes_list.php?product_id=".$row['product_id']."&action=delete'>删除</a>
</td></tr>";
}

?>
</table>
</div></div>

<nav align="center">
  

<?php 
//counting paging

$paging=$dbh->query("select product_id,product_image, product_title,product_price from products ");
$count=$paging->rowCount();

$a=$count/10;
$a=ceil($a);
echo "<bt>";echo "<bt>";
for($b=1; $b<=$a;$b++)
{
?> 
<ul class="pagination" style="border:groove #666">
<li><a class="label-info" href="clothes_list.php?page=<?php echo $b;?>"><?php echo $b." ";?></a></li></ul>
<?php	
}
?>
</nav>
</div></div>
<?php include("include/js.php");?>
</body>
</html>