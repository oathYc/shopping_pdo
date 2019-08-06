<?php

session_start();
include("../db.php");

if(isset($_POST['btn_save']))
{
    $cat_name = $_POST['cat_name'];

    mysqli_query($con,"insert into categories(cat_title) values ('$cat_name')")
    or die ("Query 1 is inncorrect........");
    header("location: cate.php");
    mysqli_close($con);
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

    <div class="col-sm-9 " align="center">
        <div class="panel-heading" style="background-color:#c4e17f;">
            <h1>添加商品分类  </h1></div><br>

        <form action="add_cate.php" name="form" method="post">
            <div class="col-sm-6">
                <input name="cat_name" class="input-lg" type="text"  id="cat_name" style="font-size:18px; width:330px" placeholder="名称" autofocus required><br><br>
            </div>
            <div class="col-sm-7" style="margin:20px;margin-left:90px;">
                <button type="submit" class="btn btn-success btn-block center" name="btn_save" id="btn_save" style="font-size:18px">提交</button></div>
        </form>
    </div></div>
<?php include("include/js.php"); ?>
</body>
</html>