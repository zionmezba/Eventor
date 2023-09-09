<?php
include "../db/connect.php";
$ip_add = getenv("REMOTE_ADDR");

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
else{
    // include "../index.php";
    echo "<script> location.href='../index.php'; </script>";
}

?>