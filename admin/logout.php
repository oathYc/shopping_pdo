<?php

session_start();

unset($_SESSION["admin"]);

unset($_SESSION["adminId"]);

header('Location: login.php'); // default page
   

?>
