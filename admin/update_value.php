<?php
include("../db/connect.php");

function generateUniqueID($conn,$extt)
{
    $uniqueID = mt_rand(00000, 99999);
    $id = $extt.$uniqueID;
    $checkQuery = "SELECT `id` FROM `events` WHERE `id` = '$id'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        return generateUniqueID($conn);
    }
    return $uniqueID;
}
function extractLetters($sentence)
{
    $words = explode(' ', $sentence);

    $result = '';
    foreach ($words as $word) {
        $result .= substr($word, 0, 1);
        if (strlen($result) >= 3) {
            break;
        }
    }

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "approve") {
    $appId = $_POST["Id"];
    $query = "UPDATE `applications` SET `status`='1' WHERE `id`='$appId'";
    mysqli_query($con, $query);

    $query = "SELECT `title`, `country`, `host1`, `host2`, `type`, `indexing`, `startdate`, `enddate`, `venue`, `applicant` FROM `applications` WHERE `id` = '$appId'";
    $result = mysqli_query($con, $query);
    list($title, $country, $host1, $host2, $type, $indexing, $startdate, $enddate, $venue, $applc) = mysqli_fetch_array($result);
    $ext = extractLetters($host1);
    $id = generateUniqueID($con, $ext);

    $query = "INSERT INTO `events`(`id`,`title`, `type`, `indexing`, `host1`, `host2`, `startdate`, `enddate`, `venue`, `country`,`timestrap`,`editor`) VALUES ('$id','$title','$type','$indexing','$host1','$host2','$startdate','$enddate','$venue','$country',NOW(),'$applc')";
    mysqli_query($con, $query);

    echo "User Approved!";
    // header('./admin/admin-dash.php');

} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "reject") {
    $appId = $_POST["Id"];
    $query = "UPDATE `applications` SET `status`='0' WHERE `id`='$appId'";
    mysqli_query($con, $query);

    echo "User Rejected!";
    header('./admin/admin-dash.php');
} else {
    echo "Invalid request.";
}


?>