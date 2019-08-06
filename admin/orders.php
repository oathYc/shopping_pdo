<?php

session_start();
include("../db.php");
error_reporting(0);
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$order_id=$_GET['order_id'];

/*this is delet query*/
$dbh->query("delete from orders where order_id='$order_id'")or die("delete query is incorrect...");
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
	<h1>订单  / Page <?php echo $page?$page:1;?> </h1></div><br>
<div class='table-responsive'>  
<div style="overflow-x:scroll;">
<table class="table  table-hover table-striped" style="font-size:18px">
<tr><th>顾客姓名</th><th>商品</th><th>联系 | 邮箱</th><th>地址</th><th>价格</th><th>运送</th><th>数量</th></tr>
<?php 
$result=$dbh->query("select order_id, product_title, first_name, mobile, email, address1, address2, product_price,address2,trx_id, qty from orders,products,user_info where orders.product_id=products.product_id and user_info.user_id=orders.user_id Limit $page1,10")or die ("query 1 incorrect.....");

foreach($result as $arr)
{
    $order_id =$arr['order_id'];
    $p_names =$arr['product_title'];
    $cus_name =$arr['first_name'];
    $contact_no =$arr['mobile'];
    $email =$arr['email'];
    $address =$arr['address1'];
    $country =$arr['address2'];
    $details =$arr['product_price'];
    $zip_code =$arr['address2'];
    $cardnumber =$arr['trx_id'];
    $quantity =$arr['qty'];
echo "<tr>
    <td>$cus_name</td>
    <td>$p_names</td>
    <td>$email<br>$contact_no</td>
    <td>$address<br>ZIP: $zip_code<br>$country</td>
    <td>$details</td>
    <td>$cardnumber</td>
    <td>$quantity</td>
<td>
<a class=' btn btn-success' href='orders.php?order_id=$order_id&action=delete'>删除</a>
</td></tr>";
}
?>
</table>
</div></div>
<nav align="center"> 
<?php 
//counting paging

$paging=$dbh->query("select * from order_info");
$count=$paging->rowCount();

$a=$count/5;
$a=ceil($a);
echo "<bt>";echo "<bt>";
for($b=1; $b<=$a;$b++)
{
?> 
<ul class="pagination " style="border:groove #666">
<li><a class="label-info" href="orders.php?page=<?php echo $b;?>"><?php echo $b." ";?></a></li></ul>
<?php	
}
?>
</nav>
</div></div>
<?php include("include/js.php");?>
</body>
</html>