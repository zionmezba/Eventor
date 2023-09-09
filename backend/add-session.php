<?php
include "../db/connect.php";

function generateUniqueID($conn)
{
    $uniqueID = mt_rand(000000000, 999999999);
    $checkQuery = "SELECT `id` FROM `sessions` WHERE `id` = '$uniqueID'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        return generateUniqueID($conn);
    }
    return $uniqueID;
}

if (isset($_POST["sess_name"])) {
    $id = generateUniqueID($con);
    $eventid = $con->real_escape_string($_POST["evntid"]);
    $sess_name = $con->real_escape_string($_POST["sess_name"]);
    $date = $con->real_escape_string($_POST['date']);
    $starttime = $con->real_escape_string($_POST['starttime']);
    $endtime = $con->real_escape_string($_POST['endtime']);
    $type = $con->real_escape_string($_POST['type']);

    if (isset($_POST['title'])) {
        $title = $con->real_escape_string($_POST['title']);
    } else
        $title = NULL;

    if (isset($_POST['talktitle'])) {
        $talktitle = $con->real_escape_string($_POST['talktitle']);
    } else
        $talktitle = NULL;

    if (isset($_POST['link'])) {
        $link = $con->real_escape_string($_POST['link']);
    } else
        $link = NULL;

    if (isset($_POST['zoom'])) {
        $zoom = $con->real_escape_string($_POST['zoom']);
    } else
        $zoom = NULL;

    if (isset($_POST['venue'])) {
        $venue = $con->real_escape_string($_POST['venue']);
    } else
        $venue = NULL;

    if (isset($_POST['papers'])) {
        $papers = $con->real_escape_string($_POST['papers']);
    } else
        $papers = NULL;

    if (isset($_POST['chair'])) {
        // $chair = $con->real_escape_string($_POST['chair']);
        $chair = $_POST['chair'];
    } else
        $chair = NULL;

    if (isset($_POST['moderator'])) {
        $moderator = $_POST['moderator'];
    } else
        $moderator = NULL;

    if (isset($_POST['coordinator'])) {
        // $coordinator = $con->real_escape_string($_POST['coordinator']);
        $coordinator = $_POST['coordinator'];
    } else
        $coordinator = NULL;

    if (isset($_POST['resperson'])) {
        // $resperson = $con->real_escape_string($_POST['resperson']);
        $resperson = $_POST['resperson'];
    } else
        $resperson = NULL;

    $sql = "INSERT INTO `sessions`(`id`, `eventid`, `level`, `title`, `talktitle`, `date`, `timefrom`, `timeto`, `type`, `venue`, `link`, `zoomid`, `papers`, `chair`, `moderator`, `coordinator`, `resperson`) VALUES ('$id','$eventid','$sess_name','$title','$talktitle','$date','$starttime','$endtime','$type','$venue','$link','$zoom','$papers','$chair','$moderator','$coordinator','$resperson')";

    if (mysqli_query($con, $sql)) {
        echo "<script> location.href='./add-session.php?id=" . $eventid . "'; </script>";
        echo "Success";
        exit();
    }
}


?>