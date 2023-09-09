<?php
include "./db/connect.php";
include "./cssjs/css.php";
include "./server/session-manager.php";
$eventId = "";
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];
} else {
    echo "<script> location.href='index.php'; </script>";
}
?>

<head>
    <title>Event Details</title>
    <style>
        .board-hover {
            display: block;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid gray;
            box-shadow: 0px 3px 13px 0px rgb(33 37 191 / 90%), 0 2px 4px -1px rgb(211 41 41 / 90%);
        }

        .desc {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid gray;
            box-shadow: 0px 3px 13px 0px rgb(33 37 191 / 90%), 0 2px 4px -1px rgb(211 41 41 / 90%);
        }

        .info-conf {
            margin-top: 15px;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid gray;
            box-shadow: 0px 3px 13px 0px rgb(33 37 191 / 90%), 0 2px 4px -1px rgb(211 41 41 / 90%);
        }

        .info-conf p {
            font-size: 15px;

        }

        .desc p {
            font-size: 16px;
        }

        .joinbtn {
            width: 100%;
            margin: 15px 0 50px 0px;
            box-shadow: 0px 3px 14px 0px rgb(33 37 191 / 90%), 0 2px 4px -1px rgb(211 41 41 / 90%);
        }
    </style>
</head>


<body>
    <?php
    include("includes/alert.php");
    ?>
    <div class="container">
        <!-- <h1>Event Details</h1>
        <hr style="border:1px solid white"> -->
        <div class="">
            <?php
            $query = "SELECT * FROM `events` WHERE `id` = '$eventId'";
            $result = mysqli_query($con, $query);
            $row = $result->fetch_assoc();
            echo '<img src="./images/' . $row['cover'] . '">
            <h1>' . $row['title'] . '</h1>'; ?>
            <div class="board-hover">
                <?php
                if ($row['venue'] == "Host University")
                    echo '<a style="text-decoration:none;"
            href="https://www.google.com/maps/search/?api=1&query=' . urlencode($row['host1']) . '"><i
                class="material-icons" style="font-size:20px;color:var(--var-soft-blue)">location_on</i><span
                style="padding-left:6px;color:var(--var-soft-blue)">' . $row['host1'] . '</span></a>';
                echo '<div class="time-left">
                <img src="https://i.postimg.cc/prpyV4mH/clock-selection-no-bg.png" alt="clock" class="small-image" />
                <p style="margin-top:15px;">' . date("d F Y", strtotime($row['startdate'])) . '<strong> - </strong>' .
                    date("d F Y", strtotime($row['enddate'])) . '</p></div></div>'; ?>
                <div class="desc">
                    <p>
                        <?php echo $row['description']; ?>
                    </p>
                </div>
                <div class="info-conf">
                    <p><strong>Paper Indexing:</strong>
                        <?php echo $row['indexing']; ?>
                    </p>
                    <p> <strong>Hosted By:</strong>
                        <?php echo $row['host1'];
                        if ($row['host2'] != NULL) {
                            echo ' & ' . $row['host2'];
                        }
                        ?>
                    </p>
                </div>
                <div class="desc">
                    <p><strong>Registration Deadline:</strong>
                        <?php $dateTime = new DateTime($row['registration']);
                        echo $dateTime->format('d F Y, h:i A'); ?>
                    </p>
                </div>
                <a href="backend/apply-event.php?id=<?php echo $row['id'] ?>"><button class="board-hover joinbtn">Apply
                        Now</button></a>
            </div>
        </div>
    </div>
</body>

<?php
include "./cssjs/js.php";
include "includes/footer.php";
?>