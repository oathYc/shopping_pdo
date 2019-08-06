<?php
session_start();
include "db.php";


#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click() 

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = $_POST["email"];
	$password = $_POST["password"];
	$sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
	$run_query = $dbh->query($sql);
	$count =$run_query->rowCount();
    $row = $run_query->fetch();
		$_SESSION["uid"] = $row["user_id"];
		$_SESSION["name"] = $row["first_name"];
		$ip_add = getenv("REMOTE_ADDR");
		//we have created a cookie in login_form.php page so if that cookie is available means user is not login
        
	//if user record is available in database then $count will be equal to 1
	if($count == 1){
        $uid  = $row["user_id"];
			if (isset($_COOKIE["product_list"])) {
				$p_list = stripcslashes($_COOKIE["product_list"]);
				//here we are decoding stored json product list cookie to normal array
				$product_list = json_decode($p_list,true);
				for ($i=0; $i < count($product_list); $i++) { 
					//After getting user id from database here we are checking user cart item if there is already product is listed or not
					$verify_cart = "SELECT id FROM cart WHERE user_id = '$uid' AND p_id = ".$product_list[$i];
					$result = $dbh->query($verify_cart);
					if($result->rowCount() < 1){
						//if user is adding first time product into cart we will update user_id into database table with valid id
						$update_cart = "UPDATE cart SET user_id = '$uid' WHERE ip_add = '$ip_add' AND user_id = -1";
						$dbh->query($update_cart);
					}else{
						//if already that product is available into database table we will delete that record
						$delete_existing_product = "DELETE FROM cart WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = ".$product_list[$i];
						$dbh->query($delete_existing_product);
					}
				}
				//here we are destroying user cookie
				setcookie("product_list","",strtotime("-1 day"),"/");
				//if user is logging from after cart page we will send cart_login
				echo "cart_login";
				
				
				exit();
				
			}
			//if user is login from page we will send login_success
			echo "login_success";
            die("<script type='text/javascript'>
                       window.location.reload();
					</script>");
			$BackToMyPage = $_SERVER['HTTP_REFERER'];
				if(!isset($BackToMyPage)) {
					header('Location: '.$BackToMyPage);
					echo"<script type='text/javascript'>
                        alert('登录成功');setTimeout(function(){window.location.reload()},1000);
					</script>";
				} else {
					header('Location: index.php'); // default page
				}
			
            exit;

		}
    
	
}

?>