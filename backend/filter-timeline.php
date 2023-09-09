<head>
    <style>
        strong {
            color: hsl(215, 51%, 70%);
        }
    </style>
</head>
<?php
include "../db/connect.php";

if (isset($_SESSION['user_id']))
    $user_id = $_SESSION['user_id'];

if (isset($_GET['id']))
    $event_id = $_GET['id'];
else
    $event_id = 'DIU45683';

$sql2 = "SELECT * FROM `events` WHERE `id` = '$event_id'";
$result2 = mysqli_query($con, $sql2);

$evnt = $result2->fetch_assoc();
$datetime1 = new DateTime($evnt['startdate']);
$datetime2 = new DateTime($evnt['enddate']);

$interval = $datetime1->diff($datetime2);
$days = $interval->format('%a') + 1;

// $date = date("Y-m-d");
$date = "2023-09-06";
$sessionArray = [];

$curDate = date("Y-m-d", strtotime("+0 day", strtotime($evnt['startdate'])));

$sql1 = "SELECT * FROM `sessions` WHERE `eventid` = '$event_id' AND `date` = '$curDate' ORDER BY `timefrom` ASC, `level` ASC";
$result1 = mysqli_query($con, $sql1);

if ($_GET['filter'] == 'personal0') {
    $q1 = "SELECT `name` FROM `users` WHERE `id` = '$user_id'";
    $r1 = $con->query($q1);
    $drow1 = $r1->fetch_assoc();

    $q2 = "SELECT `id`, `papers` FROM `sessions` WHERE `eventid` = '$event_id' AND `date` = '$curDate'";
    $r2 = $con->query($q2);

    if ($r2->num_rows > 0) {
        $drow2 = $r2->fetch_assoc();
        $paperIds = explode(", ", $drow2['papers']);
        foreach ($paperIds as $paperId) {
            $q3 = "SELECT `authors` FROM `papers` WHERE `paperid` = '$paperId'";
            $r3 = $con->query($q3);

            if ($r3->num_rows > 0) {
                $drow3 = $r3->fetch_assoc();
                if (strpos($drow3['authors'], $drow1['name']) !== false) {
                    $sessionArray[] = $drow2['id'];
                }
            }
        }
    }

    while ($sess = $result1->fetch_assoc()) {
        if (in_array($sess['id'], $sessionArray)) {
            echo '<div class="cd-timeline__block" id="' . $sess["id"] . '">
        <div class="cd-timeline__img cd-timeline__img--picture">';
            echo '<p style="color:white;font-size:12px;">' . date("g:i A", strtotime($sess['timefrom'])) . '</p>';
            // level 
            echo '</div>
        <div class="cd-timeline__content text-component">
        <h5 style="color:#ffffff; font-size:18px;">';
            echo $sess['level'];
            echo '</h5>';
            // title 
            if ($sess['title'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;"><span style="font-weight:600;color:wheat;">';
                echo $sess['title'];
                echo '</span></p>';
            }
            //Resource Person 
            if ($sess['resperson'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;">';
                echo '<strong><span style="color:white">Resource Person: </span>' . nl2br($sess['resperson']) . '</strong></p>';
            }
            //Chair 
            if ($sess['chair'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                echo '<strong><span style="color:white">Chair: </span>' . nl2br($sess['chair']) . '</strong></p>';
            }
            //Moderator 
            if ($sess['moderator'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                echo '<strong><span style="color:white">Moderator: </span>' . nl2br($sess['moderator']) . '</strong></p>';
            }
            //Coordinator
            if ($sess['coordinator'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                echo '<strong><span style="color:white">Coordinator: </span>' . nl2br($sess['coordinator']) . '</strong></p>';
            }
            //Venue
            if ($sess['type'] == "online" && $sess['link'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">videocam</i>';
                echo '<a style="text-decoration:underline;color:white" href="' . urlencode($sess['link']) . '"><span style="padding-left:6px;color:white">' . substr($sess['link'], 0, 25) . ".." . '</span></a>';
            } elseif ($sess['type'] == "offline" && $sess['venue'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">location_on</i>';
                echo '<a style="text-decoration:underline;color:white;" href="https://www.google.com/maps/search/?api=1&query=' . urlencode($sess['venue']) . '"><span style="padding-left:6px;color:white">' . $sess['venue'] . '</span></a></p>';
            } elseif ($sess['type'] == "both") {
                if ($sess['venue'] != NULL) {
                    echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                    echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">location_on</i>';
                    echo '<a style="text-decoration:underline;color:white" href="https://www.google.com/maps/search/?api=1&query=' . urlencode($sess['venue']) . '"><span style="padding-left:6px;color:white">' . $sess['venue'] . '</span></a></p>';
                }
                if ($sess['link'] != NULL) {
                    echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                    echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">videocam</i>';
                    echo '<a style="text-decoration:underline;color:white" href="' . urlencode($sess['link']) . '"><span style="padding-left:6px;color:white">' . substr($sess['link'], 0, 25) . ".." . '</span></a></p>';
                }
            }

            //Time 
            echo '</p>';
            echo '<p style = "color:white;"><i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">access_time</i>';
            echo date("g:i A", strtotime($sess['timefrom'])) . '<strong> - </strong>' .
                date("g:i A", strtotime($sess['timeto'])) . '</p>';
            //Papers
            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
            if ($sess['papers'] != NULL) {
                echo '<p style="color:white;"><strong><span style="color:white">Papers: </span>' . $sess['papers'] . '</strong></p>';
            }
            echo '
        <div class="flex justify-between items-center">
        <span class="cd-timeline__date">';

            // bottom date
            echo date("F j", strtotime($sess['date']));
            echo '</span>
        <a href="detail-view.php?session=' . $sess['id'] . '" class="btn btn--subtle">View Details</a>
        </div>
        </div>
        </div>';
        }
    }
} else {
    while ($sess = $result1->fetch_assoc()) {
        echo '<div class="cd-timeline__block" id="' . $sess["id"] . '">
        <div class="cd-timeline__img cd-timeline__img--picture">';
        echo '<p style="color:white;font-size:12px;">' . date("g:i A", strtotime($sess['timefrom'])) . '</p>';
        // level 
        echo '</div>
        <div class="cd-timeline__content text-component">
        <h5 style="color:#ffffff; font-size:18px;">';
        echo $sess['level'];
        echo '</h5>';
        // title 
        if ($sess['title'] != NULL) {
            echo '<p class="color-contrast-medium" style="margin-top:10px;"><span style="font-weight:600;color:wheat;">';
            echo $sess['title'];
            echo '</span></p>';
        }
        //Resource Person 
        if ($sess['resperson'] != NULL) {
            echo '<p class="color-contrast-medium" style="margin-top:10px;">';
            echo '<strong><span style="color:white">Resource Person: </span>' . nl2br($sess['resperson']) . '</strong></p>';
        }
        //Chair 
        if ($sess['chair'] != NULL) {
            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
            echo '<strong><span style="color:white">Chair: </span>' . nl2br($sess['chair']) . '</strong></p>';
        }
        //Moderator 
        if ($sess['moderator'] != NULL) {
            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
            echo '<strong><span style="color:white">Moderator: </span>' . nl2br($sess['moderator']) . '</strong></p>';
        }
        //Coordinator
        if ($sess['coordinator'] != NULL) {
            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
            echo '<strong><span style="color:white">Coordinator: </span>' . nl2br($sess['coordinator']) . '</strong></p>';
        }
        //Venue
        if ($sess['type'] == "online" && $sess['link'] != NULL) {
            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">videocam</i>';
            echo '<a style="text-decoration:underline;color:white" href="' . urlencode($sess['link']) . '"><span style="padding-left:6px;color:white">' . substr($sess['link'], 0, 25) . ".." . '</span></a>';
        } elseif ($sess['type'] == "offline" && $sess['venue'] != NULL) {
            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">location_on</i>';
            echo '<a style="text-decoration:underline;color:white;" href="https://www.google.com/maps/search/?api=1&query=' . urlencode($sess['venue']) . '"><span style="padding-left:6px;color:white">' . $sess['venue'] . '</span></a></p>';
        } elseif ($sess['type'] == "both") {
            if ($sess['venue'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">location_on</i>';
                echo '<a style="text-decoration:underline;color:white" href="https://www.google.com/maps/search/?api=1&query=' . urlencode($sess['venue']) . '"><span style="padding-left:6px;color:white">' . $sess['venue'] . '</span></a></p>';
            }
            if ($sess['link'] != NULL) {
                echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">videocam</i>';
                echo '<a style="text-decoration:underline;color:white" href="' . urlencode($sess['link']) . '"><span style="padding-left:6px;color:white">' . substr($sess['link'], 0, 25) . ".." . '</span></a></p>';
            }
        }

        //Time 
        echo '</p>';
        echo '<p style = "color:white;"><i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">access_time</i>';
        echo date("g:i A", strtotime($sess['timefrom'])) . '<strong> - </strong>' .
            date("g:i A", strtotime($sess['timeto'])) . '</p>';
        //Papers
        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
        if ($sess['papers'] != NULL) {
            echo '<p style="color:white;"><strong><span style="color:white">Papers: </span>' . $sess['papers'] . '</strong></p>';
        }
        echo '
        <div class="flex justify-between items-center">
        <span class="cd-timeline__date">';

        // bottom date
        echo date("F j", strtotime($sess['date']));
        echo '</span>
        <a href="detail-view.php?session=' . $sess['id'] . '" class="btn btn--subtle">View Details</a>
        </div>
        </div>
        </div>';
    }
}
?>