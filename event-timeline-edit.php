<?php
include "db/connect.php";
include "server/session-manager.php";
if (!isset($_SESSION['user_id'])) {
    echo "<script> location.href='./index.php'; </script>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />
    <link rel="stylesheet" href="css/event-timeline.css">
    <title>Current Event</title>

    <style>
        .menu {
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #333;
        }

        button {
            padding: 10px 26px;
            border-radius: 5px;
            margin: 0 5px;
            color: white;
            background-color: #ffb70b;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        button:focus {
            outline: none;
        }

        .active {
            background-color: #0080FF;
            color: white;
            box-shadow: 0px 3px 7px 1px rgb(233 255 0), 0 2px 4px -1px rgb(211 41 41 / 90%);
            border: none;
        }

        .views-container {
            /* overflow: hidden; */
            position: relative;
            /* height: ; */
        }

        .btnview {
            width: 100%;
            height: 100%;
            display: none;
            position: absolute;
            text-align: justify;
            /* padding-top: 100px; */
        }
    </style>
</head>

<?php
$eventid = $_GET['evntid'];
$userid = $_SESSION['user_id'];

$sql2edit = "SELECT * FROM `events` WHERE `id` = '$eventid'";
$sql2res = mysqli_query($con, $sql2edit);
$evnt = $sql2res->fetch_assoc();

if ($evnt['editor'] != $userid) {
    // echo "<script> location.href='./index.php'; </script>";
}

$datetime1 = new DateTime($evnt['startdate']);
$datetime2 = new DateTime($evnt['enddate']);

$interval = $datetime1->diff($datetime2);
$days = $interval->format('%a') + 1;

$date = date("Y-m-d");
?>

<body>
    <?php
    include("includes/alert.php");
    ?>
    <header class="cd-main-header text-center flex flex-column flex-center menu">
        <p style="padding-bottom:20px;font-size:19px;font-weight:600;color:white;">
            <?php echo $evnt['title']; ?>
        </p>

        <div class="">
            <button class="active" name="increment" id="view1Btn" value="0">Day 01</button>
            <?php
            for ($i = 1; $i < $days; $i++) {
                echo '<button name="increment" id="view';
                echo $i + 1;
                echo 'Btn" value="';
                echo $i;
                echo '">Day 0';
                echo $i + 1;
                echo '</button>';
            }
            ?>
        </div>

        <?php
        $curDate = date("Y-m-d", strtotime("+0 day", strtotime($evnt['startdate'])));
        $sql1 = "SELECT * FROM `sessions` WHERE `eventid` = '$eventid' AND `date` = '$curDate' ORDER BY `timefrom` ASC";
        $result1 = mysqli_query($con, $sql1);
        ?>
    </header>
    <div class="views-container">
        <div class="btnview" id="view1">
            <section class="cd-timeline js-cd-timeline">
                <div class="container max-width-lg cd-timeline__container">
                    <!-- Timeline Start -->
                    <?php
                    while ($sess = $result1->fetch_assoc()) {
                        echo '<div class="cd-timeline__block">
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
                            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white"><strong>';
                            echo $sess['title'];
                            echo '</strong></p>';
                        }
                        //Chair
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['chair'] != NULL) {
                            echo '<p><strong>Chair: ' . $sess['chair'] . '</strong></p>';
                        }
                        //Moderator
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['moderator'] != NULL) {
                            if ($sess['moderator'] == "Registration Sub-committee")
                                echo '<p><strong>Registration Sub-committee: ' . $sess['moderator'] . '</strong></p>';
                            else
                                echo '<p><strong>Moderator: ' . $sess['moderator'] . '</strong></p>';
                        }
                        //Moderator
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['coordinator'] != NULL) {
                            echo '<p><strong>Coordinator: ' . $sess['coordinator'] . '</strong></p>';
                        }
                        //Venue
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['type'] == "online") {
                            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">videocam</i>';
                        } elseif ($sess['type'] == "offline") {
                            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">location_on</i>';
                        }
                        echo $sess['venue'];
                        //Time 
                        echo '</p>';
                        echo '<p style = "color:white;"><i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">access_time</i>';
                        echo date("g:i A", strtotime($sess['timefrom'])) . '<strong> - </strong>' .
                            date("g:i A", strtotime($sess['timeto'])) . '</p>';
                        //Papers
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['papers'] != NULL) {
                            echo '<p style="color:white;">Papers: ' . $sess['papers'] . '</p>';
                        }
                        echo '
                            <div class="flex justify-between items-center">
                                <span class="cd-timeline__date">';

                        // bottom date
                        echo date("F j", strtotime($sess['date']));
                        echo '</span>
                                <a href="update-session.php?event=' . $sess['id'] . '" class="btn btn--subtle">Edit</a>
                            </div>
                        </div>
                    </div>';
                    }
                    ?>

                    <!-- Timeline End -->


                </div>
            </section> <!-- cd-timeline -->
        </div>
        <div class="btnview" id="view2">
            <section class="cd-timeline js-cd-timeline">
                <div class="container max-width-lg cd-timeline__container">
                    <!-- Timeline Start -->
                    <?php
                    $curDate = date("Y-m-d", strtotime("+1 day", strtotime($evnt['startdate'])));
                    $sql1 = "SELECT * FROM `sessions` WHERE `eventid` = '$eventid' AND `date` = '$curDate' ORDER BY `timefrom` ASC";
                    $result1 = mysqli_query($con, $sql1);

                    while ($sess = $result1->fetch_assoc()) {
                        echo '<div class="cd-timeline__block">
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
                            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white"><strong>';
                            echo $sess['title'];
                            echo '</strong></p>';
                        }
                        //Chair
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['chair'] != NULL) {
                            echo '<p><strong>Chair: ' . $sess['chair'] . '</strong></p>';
                        }
                        //Moderator
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['moderator'] != NULL) {
                            if ($sess['moderator'] == "Registration Sub-committee")
                                echo '<p><strong>Registration Sub-committee: ' . $sess['moderator'] . '</strong></p>';
                            else
                                echo '<p><strong>Moderator: ' . $sess['moderator'] . '</strong></p>';
                        }
                        //Moderator
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['coordinator'] != NULL) {
                            echo '<p><strong>Coordinator: ' . $sess['coordinator'] . '</strong></p>';
                        }
                        //Venue
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['type'] == "online") {
                            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">videocam</i>';
                        } elseif ($sess['type'] == "offline") {
                            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">location_on</i>';
                        }
                        echo $sess['venue'];
                        //Time 
                        echo '</p>';
                        echo '<p style = "color:white;"><i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">access_time</i>';
                        echo date("g:i A", strtotime($sess['timefrom'])) . '<strong> - </strong>' .
                            date("g:i A", strtotime($sess['timeto'])) . '</p>';
                        //Papers
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['papers'] != NULL) {
                            echo '<p style="color:white;">Papers: ' . $sess['papers'] . '</p>';
                        }
                        echo '
                            <div class="flex justify-between items-center">
                                <span class="cd-timeline__date">';

                        // bottom date
                        echo date("F j", strtotime($sess['date']));
                        echo '</span>
                        <a href="update-session.php?event=' . $sess['id'] . '" class="btn btn--subtle">Edit</a>
                            </div>
                        </div>

                    </div>';
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="btnview" id="view3">
            <section class="cd-timeline js-cd-timeline">
                <div class="container max-width-lg cd-timeline__container">
                    <!-- Timeline Start -->
                    <?php
                    $curDate = date("Y-m-d", strtotime("+2 day", strtotime($evnt['startdate'])));
                    $sql1 = "SELECT * FROM `sessions` WHERE `eventid` = '$eventid' AND `date` = '$curDate' ORDER BY `timefrom` ASC";
                    $result1 = mysqli_query($con, $sql1);

                    while ($sess = $result1->fetch_assoc()) {
                        echo '<div class="cd-timeline__block">
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
                            echo '<p class="color-contrast-medium" style="margin-top:10px;color:white"><strong>';
                            echo $sess['title'];
                            echo '</strong></p>';
                        }
                        //Chair
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['chair'] != NULL) {
                            echo '<p><strong>Chair: ' . $sess['chair'] . '</strong></p>';
                        }
                        //Moderator
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['moderator'] != NULL) {
                            if ($sess['moderator'] == "Registration Sub-committee")
                                echo '<p><strong>Registration Sub-committee: ' . $sess['moderator'] . '</strong></p>';
                            else
                                echo '<p><strong>Moderator: ' . $sess['moderator'] . '</strong></p>';
                        }
                        //Moderator
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['coordinator'] != NULL) {
                            echo '<p><strong>Coordinator: ' . $sess['coordinator'] . '</strong></p>';
                        }
                        //Venue
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['type'] == "online") {
                            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">videocam</i>';
                        } elseif ($sess['type'] == "offline") {
                            echo '<i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">location_on</i>';
                        }
                        echo $sess['venue'];
                        //Time 
                        echo '</p>';
                        echo '<p style = "color:white;"><i class="material-icons" style="vertical-align: middle;margin-right:10px;font-size:20px;color:hsl(215, 51%, 70%)">access_time</i>';
                        echo date("g:i A", strtotime($sess['timefrom'])) . '<strong> - </strong>' .
                            date("g:i A", strtotime($sess['timeto'])) . '</p>';
                        //Papers
                        echo '<p class="color-contrast-medium" style="margin-top:10px;color:white">';
                        if ($sess['papers'] != NULL) {
                            echo '<p style="color:white;">Papers: ' . $sess['papers'] . '</p>';
                        }
                        echo '
                            <div class="flex justify-between items-center">
                                <span class="cd-timeline__date">';

                        // bottom date
                        echo date("F j", strtotime($sess['date']));
                        echo '</span>
                        <a href="update-session.php?event=' . $sess['id'] . '" class="btn btn--subtle">Edit</a>
                            </div>
                        </div>
                    </div>';
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
<script>
    $(document).ready(function () {
        // Show view1 by default on page load
        $("#view1").show();

        $(".menu button").click(function () {
            $(".menu button").removeClass("active");
            $(this).addClass("active");

            var viewId = $(this).attr("id").replace("Btn", "");
            $(".btnview").hide();
            $("#" + viewId).fadeIn(500);
        });
    });

    (function () {
        // Vertical Timeline - by CodyHouse.co
        function VerticalTimeline(element) {
            this.element = element;
            this.blocks = this.element.getElementsByClassName("cd-timeline__block");
            this.images = this.element.getElementsByClassName("cd-timeline__img");
            this.contents = this.element.getElementsByClassName("cd-timeline__content");
            this.offset = 0.8;
            this.hideBlocks();
        };

        VerticalTimeline.prototype.hideBlocks = function () {
            if (!"classList" in document.documentElement) {
                return;
            }
            var self = this;
            for (var i = 0; i < this.blocks.length; i++) {
                (function (i) {
                    if (self.blocks[i].getBoundingClientRect().top > window.innerHeight * self.offset) {
                        self.images[i].classList.add("cd-timeline__img--hidden");
                        self.contents[i].classList.add("cd-timeline__content--hidden");
                    }
                })(i);
            }
        };

        VerticalTimeline.prototype.showBlocks = function () {
            if (! "classList" in document.documentElement) {
                return;
            }
            var self = this;
            for (var i = 0; i < this.blocks.length; i++) {
                (function (i) {
                    if (self.contents[i].classList.contains("cd-timeline__content--hidden") && self.blocks[i].getBoundingClientRect().top <= window.innerHeight * self.offset) {
                        // add bounce-in animation
                        self.images[i].classList.add("cd-timeline__img--bounce-in");
                        self.contents[i].classList.add("cd-timeline__content--bounce-in");
                        self.images[i].classList.remove("cd-timeline__img--hidden");
                        self.contents[i].classList.remove("cd-timeline__content--hidden");
                    }
                })(i);
            }
        };

        var verticalTimelines = document.getElementsByClassName("js-cd-timeline"),
            verticalTimelinesArray = [],
            scrolling = false;
        if (verticalTimelines.length > 0) {
            for (var i = 0; i < verticalTimelines.length; i++) {
                (function (i) {
                    verticalTimelinesArray.push(new VerticalTimeline(verticalTimelines[i]));
                })(i);
            }

            //show timeline blocks on scrolling
            window.addEventListener("scroll", function (event) {
                if (!scrolling) {
                    scrolling = true;
                    (!window.requestAnimationFrame) ? setTimeout(checkTimelineScroll, 250) : window.requestAnimationFrame(checkTimelineScroll);
                }
            });
        }

        function checkTimelineScroll() {
            verticalTimelinesArray.forEach(function (timeline) {
                timeline.showBlocks();
            });
            scrolling = false;
        };
    })();

</script>

<?php

// include "includes/footer.php";
include "cssjs/js.php";
?>

</html>