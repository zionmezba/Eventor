<?php
include "../db/connect.php";

function generateUniqueID($conn)
{
    $uniqueID = mt_rand(000000000, 999999999);
    $checkQuery = "SELECT `id` FROM `papers` WHERE `id` = '$uniqueID'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        return generateUniqueID($conn);
    }
    return $uniqueID;
}

if (isset($_POST["paperid"])) {
    $id = generateUniqueID($con);
    $eventid = $con->real_escape_string($_POST["event_id"]);
    $paperid = $con->real_escape_string($_POST["paperid"]);
    $title = $con->real_escape_string($_POST['title']);
    $author = $con->real_escape_string($_POST['author']);

    if (isset($_POST['mail'])) {
        $mail = $con->real_escape_string($_POST['mail']);
    } else
        $mail = NULL;

    $sql = "INSERT INTO `papers` (`id`, `eventid`, `paperid`, `title`, `authors`, `mail`) VALUES ('$id','$eventid','$paperid','$title','$author','$mail')";

    if (mysqli_query($con, $sql)) {
        echo "<script> location.href='./add-papers.php?id=" . $eventid . "'; </script>";
        echo "Success";
        exit();
    }
    else
        echo "Failed";
}
?>