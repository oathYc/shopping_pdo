<?php
session_start();
    include('../db.php');
    if(isset($_POST['userName']) && isset($_POST['userPass'])){
        $userName = $_POST['userName'];
        $userPass = $_POST['userPass'];
        $userPass = md5($userPass);
        $result = mysqli_query($con,"select * from admin_info where admin_name='$userName' and admin_password = '$userPass' and admin_id = 1")or die('query is incorrect ...');
        if($row = mysqli_fetch_row($result)){
            $_SESSION['admin'] = 'admin';
            $_SESSION['adminId'] = 1;
            header("Location:index.php");
        }else{
            die("<script>alert('用户名或密码错误，请重试！');setTimeout(function(){history.go(-1);},1000)</script>");
        }
    };
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商城后台</title>
    <link rel="stylesheet" type="text/css" href="./style/css/styles.css">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <h1>商城后台</h1>
        <form class="form" method="post" action="./login.php">
            <input type="text" name="userName" placeholder="用户名">
            <input type="password" name="userPass" placeholder="密码">
            <button type="submit" id="login-button">登录</button>
        </form>
    </div>
    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
</body>
</html>
