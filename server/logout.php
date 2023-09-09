<?php
include "../db/connect.php";
// session_start();
session_unset();
session_destroy();
mysqli_close($con);
echo "<script> location.href='../index.php'; </script>";
?>