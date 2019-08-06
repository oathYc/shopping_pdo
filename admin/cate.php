<?php

session_start();
include("../db.php");
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
    $cat_id=$_GET['cat_id'];

    $had = $dbh->query("select * from products where product_cat = '$cat_id' ")or die("query is incorrect...");
    if($had->rowCount() > 0){
        die("<script>alert('该分类下已有商品，请先删除商品');setTimeout(function(){history.go(-1);},1000)</script>");
    }else{
        /*this is delet quer*/
        $dbh->query("delete from categories where cat_id='$cat_id'")or die("query is incorrect...");
    }
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
<?php include("include/header.php"); ?>

<div class="container-fluid">

<?php include("include/side_bar.php"); ?>
<div class="col-sm-9" style="margin-left:10px"> 
<div class="panel-heading" style="background-color:#c4e17f">
	<h1>商品类型 </h1></div><br>

<div style="overflow-x:scroll;">
<table class="table table-bordered table-hover table-striped" style="font-size:18px">
	<tr>
			    <th>商品ID</th>
			    <th>商品类型</th>
	<th><a href="add_cate.php">新增</a></th>
    </tr>
<?php 
$result=$dbh->query("select * from categories")or die ("query 2 incorrect.......");
foreach($result as $row)
{
echo "<tr><td>".$row['cat_id']."</td><td>".$row['cat_title']."</td>";

echo"<td>
<a href='cate.php?cat_id=".$row['cat_id']."&action=delete'>删除</a>
</td></tr>";
}
?>
</table>
</div>	
</div></div>
<?php include("include/js.php"); ?>
</body>
</html>