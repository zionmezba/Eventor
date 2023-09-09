<?php
include "../db/connect.php";

if (isset($_POST["sess_name"])) {
    $id = $con->real_escape_string($_POST['sessid']);
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
        $resperson = $con->real_escape_string($_POST['resperson']);
        // $resperson = $_POST['resperson'];
    } else
        $resperson = NULL;

    $sql = "UPDATE `sessions` SET `level`='$sess_name',`title`='$title',`talktitle`='$talktitle',`date`='$date',`timefrom`='$starttime',`timeto`='$endtime',`type`='$type',`venue`='$venue',`link`='$link',`zoomid`='$zoom',`papers`='$papers',`chair`='$chair',`moderator`='$moderator',`coordinator`='$coordinator',`resperson`='$resperson' WHERE  `id` = '$id'";

    if (mysqli_query($con, $sql)) {
        echo "<script> location.href='./event-timeline-edit.php?evntid=" . $eventid . "'; </script>";
        echo "Success";
        $_SESSION['alert'] = "Session Updated";
        exit();
    } else {
        $_SESSION['alert'] = "Session Not Updated";
        echo "<script> location.href='./event-timeline-edit.php?evntid=" . $eventid . "'; </script>";
        exit();
    }
}

// if (isset($_POST["delete_button"])) {
//     $id = $_POST['sessid'];
//     $evid = $_POST['evntid'];
//     $sq = "DELETE FROM `sessions` WHERE `id` = '$id'";
//     $_SESSION['alert'] = 'Session Deleted!';

// if (mysqli_query($con, $sq)) {
//     echo "<script> location.href='./event-timeline-edit.php?id=" . $eventid . "'; </script>";
// mysqli_close($con);
//     echo "Success";
//     exit();
// }
// }

?>