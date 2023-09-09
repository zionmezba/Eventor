<?php
$indexing = "all";
$status = "all";

$servername = "localhost";
$username = "root";
$password = "";
$db = "if0_34955817_eventor_db";
$con = mysqli_connect($servername, $username, $password, $db);


if (isset($_GET["category1"]))
    $indexing = $_GET["category1"];
if (isset($_GET["category2"]))
    $status = $_GET["category2"];

$sql = "SELECT * FROM events WHERE `cover` IS NOT NULL";

if ($indexing != "all") {
    $sql .= " AND `indexing` = '$indexing'";
}
$sql .= " AND `status` != 0 ORDER BY `startdate` DESC";
?>

<head>
    <link href='https://fonts.googleapis.com/css?family=Dekko' rel='stylesheet'>
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-overlay {
            margin: 10px;
            padding-left: 5px;
            padding-right: 5px;
            position: absolute;
            top: 0;
            right: 0;
            background-color: rgba(0, 154, 23, 0.9);
            /* Semi-transparent yellow */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 5px;
        }

        .overlay-text {
            font-family: 'Dekko';
            color: white;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<?php
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stat = "Ended";
        if (strtotime(date("Y-m-d")) >= strtotime($row['startdate']) && strtotime(date("Y-m-d")) <= strtotime($row['enddate']))
            $stat = "Ongoing";
        elseif (strtotime(date("Y-m-d")) < strtotime($row['startdate']))
            $stat = "Upcoming";
        if ($status != "all" && $stat != $status)
            continue;
        echo '<div class="card-container image-container">
    <a href="./event-timeline.php?id=' . $row['id'] . '" class="hero-image-container">
        <img class="hero-image"
            src="./images/' . $row['cover'] . '" />';
        if ($stat == "Ended") {
            echo '<div class="image-overlay" style="background-color: rgba(255, 0, 0, 0.9)">';
        } elseif ($stat == "Upcoming") {
            echo '<div class="image-overlay" style="background-color: rgba(0, 0, 255, 0.9)">';
        } else
            echo '<div class="image-overlay">';
        echo '<span class="overlay-text">&#x2022;' . $stat . '</span>
            </div>
    </a>
    <main class="main-content">';
        echo '<h1><a href="./event-timeline.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h1>';
        if ($row['venue'] == "Host University")
            echo '<a style="text-decoration:none;"
            href="https://www.google.com/maps/search/?api=1&query=' . urlencode($row['host1']) . '"><i
                class="material-icons" style="vertical-align: middle;font-size:20px;color:var(--var-soft-blue)">location_on</i><span
                style="padding-left:6px;color:var(--var-soft-blue)">' . $row['host1'] . '</span></a>
        ';
        else
            echo '<a style="text-decoration:none;"
            href="https://www.google.com/maps/search/?api=1&query=' . urlencode($row['host2']) . '"><i
                class="material-icons" style="vertical-align: middle;font-size:20px;color:var(--var-soft-blue)">location_on</i><span
                style="padding-left:6px;color:var(--var-soft-blue)">' . $row['host2'] . '</span></a>
        ';
        echo '<div class="flex-row">
            <div class="time-left">
                <img src="https://i.postimg.cc/prpyV4mH/clock-selection-no-bg.png" alt="clock" class="small-image" />
                <p style="margin-top:15px;">' . date("d F Y", strtotime($row['startdate'])) . '<strong> - </strong>' .
            date("d F Y", strtotime($row['enddate'])) . '</p>
            </div>
        </div>
</div>';
    }
} else {
    echo "No events found.";
}

$con->close();
?>