<?php

session_start();
include("../db.php");
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$user_id=$_GET['user_id'];

/*this is delet quer*/
$result = $dbh->query("delete from user_info where user_id='$user_id'")or die("query is incorrect...");
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
	<h1>管理用户 </h1></div><br>

<div style="overflow-x:scroll;">
<table class="table table-bordered table-hover table-striped" style="font-size:18px">
	<tr>
			    <th>用户姓名</th>
			    <th>用户邮箱</th>
			    <th>用户电话</th>
                <th>用户密码</th>
	<th><a href="add_user.php">新增</a></th></tr>
<?php 
$result=$dbh->query("select user_id,first_name, email, password,mobile from user_info")or die ("query 2 incorrect.......");
foreach($result as $arr){

$user_id = $arr['user_id'];
$user_name = $arr['first_name'];
$user_email = $arr['email'];
$user_password  = $arr['password'];
$user_mobile = $arr['mobile'];

echo "<tr><td>$user_name</td><td>$user_email</td><td>$user_password</td><td>$user_mobile</td>";

echo"<td>
<a href='edit_user.php?user_id=$user_id'>编辑</a>
<a href='manage_users.php?user_id=$user_id&action=delete'>删除</a>
</td></tr>";
}
?>
</table>
</div>	
</div></div>
<?php include("include/js.php"); ?>
</body>
</html>