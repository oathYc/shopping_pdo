<?php

session_start();
include("../db.php");
$user_id=$_REQUEST['user_id'];

$result=$dbh->query("select user_id, first_name,email,mobile, password from user_info where user_id='$user_id'")or die ("query 1 incorrect.......");
$arr = $result->fetch();
$user_id = $arr['user_id'];
$user_name = $arr['first_name'];
$user_email = $arr['email'];
$user_mobile = $arr['mobile'];
$user_password = $arr['password'];


if(isset($_POST['btn_save'])) 
{
$user_name=$_POST['first_name'];
$user_email = $_POST['email'];
$user_mobile = $_POST['mobile'];
$user_password=$_POST['password'];

$dbh->query("update user_info set email='$user_email',first_name='$user_name',mobile='$user_mobile', password='$user_password' where user_id='$user_id'")or die("Query 2 is inncorrect..........");

header("location: manage_users.php");
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
   	<div class="container-fluid main-container">
	<?php include("include/side_bar.php");?>
    
	<div class="col-md-9 content" align="center">  
<div class="panel-heading" style="background-color:#c4e17f">
	<h1>修改用户信息 </h1></div><br>
<form action="edit_user.php" name="form" method="post" enctype="multipart/form-data">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />


<div class="col-sm-7 ">
    <label style="font-size:18px;">姓名</label><br>
    <input class="input-lg" style="font-size:18px; width:280px" name="first_name" type="text"  id="first_name" value="<?php echo $user_name; ?>" autofocus><br><br>
</div>
<div class="col-sm-7 ">
    <label style="font-size:18px;">邮箱</label><br>
    <input class="input-lg" style="font-size:18px; width:280px" name="email" type="text"  id="email" value="<?php echo $user_email; ?>" autofocus><br><br>
</div>
    <div class="col-sm-7 ">
    <label style="font-size:18px;">电话</label><br>
    <input class="input-lg" style="font-size:18px; width:280px" name="mobile" type="text"  id="mobile" value="<?php echo $user_mobile; ?>" autofocus><br><br>
</div>


<div class="col-sm-7 ">
<label style="font-size:18px;">Password</label><br>
<input class="input-lg" style="font-size:18px; width:280px" name="password" type="text"  id="password" value="<?php echo $user_password; ?>">
    <br><br></div>
    <div class="col-sm-7">
        <button type="submit" class="btn btn-success " name="btn_save" id="btn_save" style="font-size:18px">提交</button></div>
</form>
</div></div>
<?php include("include/js.php");?>
</body>
</html>