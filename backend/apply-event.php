<?php
include "../db/connect.php";
$ip_add = getenv("REMOTE_ADDR");

echo $_SESSION['user_id'];
if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_id'];
    $event = $_GET['id'];
    $sql = "INSERT INTO `participants`(`userid`, `eventid`) VALUES ('$user','$event')";
    if (mysqli_query($con, $sql)) {
        echo "register_success";
        echo "<script> location.href='../index.php'; </script>";
        exit();
    }
} else {
    // include "login.php";
    echo "<script> location.href='../login.php'; </script>";
}

?>