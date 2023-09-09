<?php
include "db/connect.php";
include "server/session-manager.php";
if (!isset($_SESSION['user_id'])) {
    echo "<script> location.href='./index.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href='https://fonts.googleapis.com/css?family=Dekko' rel='stylesheet'>
    <style>
        .image-container2 {
            position: relative;
            display: inline-block;
            pointer-events: none;
            /* Enable clicks on the overlay button */
        }

        .overlay-button {
            width: 35%;
            height: 60px;
            pointer-events: auto;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            margin: 15px;
            padding: 25px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .overlay-button.top-left {
            top: 25px;
            left: 10px;
        }

        .overlay-button.top-right {
            top: 25px;
            right: 10px;
        }

        .overlay-button.bottom-left {
            top: 90px;
            left: 10px;
        }

        .image-overlay {
            margin: 10px;
            padding-left: 5px;
            padding-right: 5px;
            position: absolute;
            top: 0;
            right: 0;
            background-color: rgba(0, 154, 23, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 5px;
        }

        .overlay-button:hover {
            color: white;
            background-color: green;
        }

        .overlay-text {
            font-family: 'Dekko';
            color: white;
            font-size: 14px;
            font-weight: 600;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <?php
    include("includes/alert.php");
    $user = $_SESSION["user_id"];
    $sql = "SELECT * FROM `users` WHERE `id` = '$user'";
    $result = mysqli_query($con, $sql);
    $row2 = $result->fetch_assoc();
    ?>
    <div class="pcontainer" x-data="{ rightSide: false, leftSide: false }">

        <div class="pmain">
            <div class="pmain-pcontainer">
                <div class="profile">
                    <div class="profile-avatar">
                        <img src="images/<?php echo $row2['avatar']; ?>" alt="" class="profile-img">
                        <div class="profile-name">
                            <?php echo $row2['name']; ?>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1585241645927-c7a8e5840c42?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80"
                        alt="" class="profile-cover">
                    <div class="profile-menu">
                        <a class="profile-menu-link active" style="color:wheat;" id="myevent">My Events</a>
                        <a class="profile-menu-link" style="color:wheat;" id="host">Hosted Events</a>
                        <a class="profile-menu-link" style="color:wheat;" id="about">About</a>
                    </div>
                </div>
                <div class="timeline" id="#events">
                    <?php
                    $sql = "SELECT * FROM events WHERE `id`= 'DIU45683' ORDER BY `timestrap` DESC";
                    $result1 = mysqli_query($con, $sql);
                    while ($row = $result1->fetch_assoc()) {
                        $stat = "Ended";
                        if (strtotime(date("Y-m-d")) >= strtotime($row['startdate']) && strtotime(date("Y-m-d")) <= strtotime($row['enddate']))
                            $stat = "Ongoing";
                        elseif (strtotime(date("Y-m-d")) < strtotime($row['startdate']))
                            $stat = "Upcoming";

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
                    ?>
                </div>
                <div class="timeline hidden" id="#hosted">
                    <?php
                    $sql = "SELECT * FROM `events` WHERE `editor` = '$user' ORDER BY `timestrap` DESC";
                    $result = mysqli_query($con, $sql);
                    while ($row = $result->fetch_assoc()) {
                        $stat = "Ended";
                        if (strtotime(date("Y-m-d")) >= strtotime($row['startdate']) && strtotime(date("Y-m-d")) <= strtotime($row['enddate']))
                            $stat = "Ongoing";
                        elseif (strtotime(date("Y-m-d")) < strtotime($row['startdate']))
                            $stat = "Upcoming";
                        echo '<div class="card-container image-container2">
                
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
                        <a class="overlay-button top-left" href="add-session.php?id=' . $row['id'] . '">Add Session</a>
                        <a class="overlay-button top-right" href="event-timeline-edit.php?evntid=' . $row['id'] . '">Edit Sessions</a>
                        <a class="overlay-button bottom-left" href="add-papers.php?id=' . $row['id'] . '">Add Papers</a>
                </a>
                <main class="main-content">';
                        echo '<h1><a href="./add-session.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h1>';
                        if ($row['venue'] == "Host University")
                            echo '<a style="text-decoration:none;"
                        href="https://www.google.com/maps/search/?api=1&query=' . urlencode($row['host1']) . '"><i
                            class="material-icons" style="font-size:20px;color:var(--var-soft-blue)">location_on</i><span
                            style="padding-left:6px;color:var(--var-soft-blue)">' . $row['host1'] . '</span></a>
                    ';
                        else
                            echo '<a style="text-decoration:none;"
                        href="https://www.google.com/maps/search/?api=1&query=' . urlencode($row['host2']) . '"><i
                            class="material-icons" style="font-size:20px;color:var(--var-soft-blue)">location_on</i><span
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
                    ?>
                </div>
            </div>
        </div>

        <div class="overlay" @click="rightSide = false; leftSide = false" :class="{ 'active': rightSide || leftSide }">
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const event = document.getElementById("myevent");
        const host = document.getElementById("host");
        const about = document.getElementById("about");
        const div1 = document.getElementById("#events");
        const div2 = document.getElementById("#hosted");
        // const div2 = document.getElementById("#hosted");

        event.addEventListener("click", function () {
            div1.style.display = "block";
            div2.style.display = "none";
            event.classList.add("active");
            host.classList.remove("active");
            about.classList.remove("active");
        });

        host.addEventListener("click", function () {
            div1.style.display = "none";
            div2.style.display = "block";
            event.classList.remove("active");
            host.classList.add("active");
            about.classList.remove("active");
        });
        about.addEventListener("click", function () {
            // div1.style.display = "none";
            // div2.style.display = "block";
            event.classList.remove("active");
            host.classList.remove("active");
            about.classList.add("active");
        });
    });

</script>
<?php
include "includes/footer.php";
include "cssjs/js.php";
?>

</html>