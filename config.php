
<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'shop');
   $dbh = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE,DB_USERNAME,DB_PASSWORD);
if (!$dbh) {
    die("Connection failed: " . $dbh->errorInfo());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM register WHERE Name='$username' OR email='$email' LIMIT 1";
  $result = $dbh->query($user_check_query);
  $user = $result->fetch();

  if ($user) { // if user exists
    if ($user['Name'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO register (Name, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	$dbh->query($query);
  	$_SESSION['Name'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
if (isset($_POST['login_user'])) {
  $username =$_POST['email'];
  $password =  $_POST['password'];

  if (empty($username)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM register WHERE email='$username' AND password='$password'";
  	$results = $dbh->query($query);
  	if ($results->rowCount() == 1) {
  	  $_SESSION['email'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>