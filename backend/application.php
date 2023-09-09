<?php
include "../db/connect.php";

function generateUniqueID($conn)
{
    $uniqueID = mt_rand(0000000, 9099999);
    $checkQuery = "SELECT id FROM `applications` WHERE id = '$uniqueID'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        return generateUniqueID($conn);
    }

    return $uniqueID;
}


if (isset($_POST["position"])) {
    // echo "<script> location.href='./home.php'; </script>";
    $userid = $_SESSION['user_id'];
    $id = generateUniqueID($con);
    $full_name = $con->real_escape_string($_POST["full_name"]);
    $email = $con->real_escape_string($_POST['email']);
    $phone = $con->real_escape_string($_POST['phone']);
    $college = $con->real_escape_string($_POST['college']);
    $position = $con->real_escape_string($_POST['position']);
    $web_link = $con->real_escape_string($_POST['web_link']);
    $title = $con->real_escape_string($_POST['title']);
    $country = $con->real_escape_string($_POST['country']);
    $host = $con->real_escape_string($_POST['host']);
    if (isset($_POST['sub_host'])) {
        $sub_host = $con->real_escape_string($_POST['sub_host']);
    } else
        $sub_host = "None";
    $type = $con->real_escape_string($_POST['type']);
    $indexing = $con->real_escape_string($_POST['indexing']);
    $startdate = $con->real_escape_string($_POST['startdate']);
    $enddate = $con->real_escape_string($_POST['enddate']);
    if (isset($_POST['location']) && $_POST['location'] != "Other") {
        $location = $con->real_escape_string($_POST['location']);
    } elseif (isset($_POST['location2'])) {
        $location = $con->real_escape_string($_POST['location2']);
    } else
        $location = $con->real_escape_string($_POST['host']);
    $participants = $con->real_escape_string($_POST['participants']);


    $sql = "INSERT INTO `applications`(`id`, `name`, `mail`, `phone`, `institute`, `position`, `portfolio`, `title`, `country`, `host1`, `host2`, `type`, `indexing`, `startdate`, `enddate`, `venue`, `participants`,`timestrap`,`status`,`applicant`) VALUES ('$id','$full_name','$email','$phone','$college','$position','$web_link','$title','$country','$host','$sub_host','$type','$indexing','$startdate','$enddate','$location','$participants',NOW(),'2','$userid')";

    if (mysqli_query($con, $sql)) {
        echo "applied_successfully";
        // echo "<script> location.href='./index.php'; </script>";
        exit;
    }
}


?>