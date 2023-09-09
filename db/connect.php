<?php
session_start();
$_SESSION['alert'] = "";

$servername = "localhost";
$username = "root";
$password = "";
$db = "if0_34955817_eventor_db";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_SESSION['counted'])) {
    $sql = "SELECT `visitor` FROM `site_stat`  WHERE id = '9876543210'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $visitorCount = $row["visitor"];

    $visitorCount++;

    $sql = "UPDATE site_stat SET visitor = $visitorCount WHERE id = '9876543210'";
    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error updating count: " . $con->error;
    }
    $_SESSION['counted'] = true;
}

?>
