<?php
$ip_add = getenv("REMOTE_ADDR");

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    include "./includes/header-login.php";
}

else{
    include "./includes/header.php";
    // echo "<script> location.href='./index.php'; </script>";
}

?>