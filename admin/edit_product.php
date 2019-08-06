<?php

session_start();
include("../db.php");
$product_id = $_REQUEST['product_id'];
$result = $dbh->query("select product_title,product_desc,product_price,product_image,product_cat,product_brand,product_keywords from products where product_id = '$product_id'");
$arr = $result->fetch();
$product_name=$arr['product_title'];
$product_detail = $arr['product_desc'];
$product_price = $arr['product_price'];
$product_image=$arr['product_image'];
$product_cat=$arr['product_cat'];
$product_brand=$arr['product_brand'];
$product_keywords=$arr['product_keywords'];
if(isset($_POST['submit']))
{
$product_name=$_POST['product_name'];
$details=$_POST['details'];
$price=$_POST['price'];
$product_type=$_POST['product_type'];
$brand=$_POST['brand'];
$tags=$_POST['tags'];

//picture coding
if($_FILES['picture']['name'] && $_FILES['picture']['type']){
    $picture_name=$_FILES['picture']['name'];
    $picture_type=$_FILES['picture']['type'];
    $picture_tmp_name=$_FILES['picture']['tmp_name'];
    $picture_size=$_FILES['picture']['size'];
    if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
    {
        if($picture_size<=50000000)

        $pic_name=time()."_".$picture_name;
        move_uploaded_file($picture_tmp_name,"../product_images/".$pic_name);
    }
}else{
    $pic_name = $_POST['pictureOld'];
}
    $result = $dbh->query("update products set product_cat='$product_type',product_brand='$brand',product_title='$product_name',product_price='$price', product_desc='$details', product_image='$pic_name',product_keywords='$tags' where product_id = '$product_id'") or die ("query incorrect");
    header("location: sumit_form.php?success=1");
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
 
   	 <?php include("include/header.php");?>
   	<div class="container-fluid">
        <?php include("include/side_bar.php");?>
        <div class="col-md-9 content" style="margin-left:10px">

            <form action="edit_product.php" name="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id;?>" />
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#c4e17f">
                    <h1><span class="glyphicon glyphicon-tag"></span> 商品 / 编辑商品  </h1>
                </div><br>
                <div class="panel-body" style="background-color:#E6EEEE;">
                <div class="col-lg-7">
                <div class="well">
                <form action="add_product.php" method="post" name="form" enctype="multipart/form-data">
                <p>名称</p>
                <input class="input-lg thumbnail form-control" value="<?php echo $product_name;?>" type="text" name="product_name" id="商品名称" autofocus style="width:100%" placeholder="Product Name" required>
        <p>描述</p>
        <textarea class="thumbnail form-control" name="details" id="details" style="width:100%; height:100px" placeholder="商品详情" required><?php echo $product_detail;?></textarea>
        <p>添加图片</p>
        <div style="background-color:#CCC">
        <input type="file" style="width:100%" name="picture"  class="btn thumbnail" id="picture" >
        <input type="hidden"  name="pictureOld" value="<?php echo $product_image;?>" class="btn thumbnail" id="pictureOld" >
        </div>
        </div>
        <div class="well">
        <h3>定价</h3>
        <p>价格</p>
        <div class="input-group">
              <div class="input-group-addon">Rs</div>
              <input type="text" class="form-control" name="price" value="<?php echo $product_price;?>" id="price"  placeholder="0.00" required>
            </div><br>


            </div>
                </div>
                <div class="col-lg-5">
                <div class="well">
        <h3>分类</h3>
        <p>商品类型</p>
        <input type="number" name="product_type" id="product_type" value="<?php echo $product_cat;?>" class="form-control" placeholder="1 数码产品,2 女装,3 男装">
        <br>
        <p>供应商/品牌</p>
        <input type="number" name="brand" id="brand" class="form-control" value="<?php echo $product_brand;?>" placeholder="1 HP,2 Samsung,3 Apple,4 motorolla">
        <br>
        <p>其他标签</p>
        <input type="text" name="tags" id="tags" class="form-control" value="<?php echo $product_keywords;?>" placeholder="夏季、柔软、棉质等">
        </div>
        </div>

        <div align="center">
            <button type="submit" name="submit" id="submit" class="btn btn-success" style="width:150px; height:60px""> 修改</button>
            </div>
                </form>

            </div>
            </div>
        </div>
    </div>
<?php include("include/js.php"); ?>
</body>
</html>