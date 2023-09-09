<?php
date_default_timezone_set('Asia/Dhaka');
include "db/connect.php";
include "server/session-manager.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <link rel="stylesheet" href="css/event-timeline.css">
    <title>Current Event</title>
    <style>
        .status {
            width: 100%;
            height: 25px;
            background-color: red;
            display: flex;
            justify-content: center;
            color: wheat;
            padding: 1px;
        }

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
            background-color: #ffb70bb5;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        button:focus {
            outline: none;
        }

        .active {
            background-color: #10375ea6;
            color: white;
            box-shadow: 0px 3px 7px 1px rgb(238 165 255 / 79%), 0 2px 4px -1px rgb(211 41 41 / 90%);
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

        .filter-container {
            padding: 10px;
            padding-right: 250px;
            background-color: black;
            display: flex;
            justify-content: flex-end;
        }

        .toggler-wrapper {
            display: block;
            width: 45px;
            height: 25px;
            cursor: pointer;
            position: relative;
        }

        .toggler-wrapper input[type="checkbox"] {
            display: none;
        }

        .toggler-wrapper input[type="checkbox"]:checked+.toggler-slider {
            background-color: #44cc66;
        }

        .toggler-wrapper .toggler-slider {
            background-color: #ccc;
            /* position: absolute; */
            border-radius: 100px;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all 300ms ease;
            transition: all 300ms ease;
        }

        .toggler-wrapper .toggler-knob {
            position: absolute;
            -webkit-transition: all 300ms ease;
            transition: all 300ms ease;
        }

        .toggler-wrapper.style-23 input[type="checkbox"]:checked+.toggler-slider {
            background-color: transparent;
            border-color: #44cc66;
        }

        .toggler-wrapper.style-23 input[type="checkbox"]:checked+.toggler-slider:before {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 0.7;
        }

        .toggler-wrapper.style-23 input[type="checkbox"]:checked+.toggler-slider:after {
            opacity: 0;
            -webkit-transform: translateY(20px);
            transform: translateY(20px);
        }

        .toggler-wrapper.style-23 input[type="checkbox"]:checked+.toggler-slider .toggler-knob {
            left: calc(100% - 19px - 3px);
            background-color: #44cc66;
        }

        .toggler-wrapper.style-23 .toggler-slider {
            background-color: transparent;
            border: 2px solid #eb4f37;
        }

        .toggler-wrapper.style-23 .toggler-slider:before {
            content: 'Show All Events';
            color: white;
            position: absolute;
            /* top: 8px; */
            right: -140px;
            font-size: 75%;
            text-transform: uppercase;
            font-weight: 500;
            opacity: 0;
            -webkit-transition: all 300ms ease;
            transition: all 300ms ease;
            -webkit-transform: translateY(-20px);
            transform: translateY(-20px);
        }

        .toggler-wrapper.style-23 .toggler-slider:after {
            content: 'Show my events (As Author)';
            color: white;
            position: absolute;
            /* top: 8px; */
            right: -190px;
            font-size: 75%;
            text-transform: uppercase;
            font-weight: 500;
            /* opacity: 0.7; */
            -webkit-transition: all 300ms ease;
            transition: all 300ms ease;
        }

        .toggler-wrapper.style-23 .toggler-knob {
            width: calc(25px - 6px);
            height: calc(25px - 6px);
            border-radius: 50%;
            left: 3px;
            top: 3px;
            background-color: #eb4f37;
        }
    </style>
</head>


<?php
if (isset($_SESSION['user_id']))
    $user_id = $_SESSION['user_id'];
if (isset($_GET['id']))
    $event_id = $_GET['id'];
else
    $event_id = 'DIU45683';
$sql2 = "SELECT * FROM `events` WHERE `id` = '$event_id'";
$result2 = mysqli_query($con, $sql2);
$conf = $result2->fetch_assoc();
$datetime1 = new DateTime($conf['startdate']);
$datetime2 = new DateTime($conf['enddate']);

$interval = $datetime1->diff($datetime2);
$days = $interval->format('%a') + 1;

$date = date("Y-m-d");
// $date = "2023-09-8";

$activeButton = "";
$viewClass = "";

if ($date == date("Y-m-d", strtotime("+0 day", strtotime($conf['startdate'])))) {
    $activeButton = "button1";
    $viewClass = "view1";
} elseif ($date == date("Y-m-d", strtotime("+1 day", strtotime($conf['startdate'])))) {
    $activeButton = "button2";
    $viewClass = "view2";
} elseif ($date == "2023-08-08") {
    $activeButton = "button3";
    $viewClass = "view3";
} else {
    $activeButton = "button1";
    $viewClass = "no-view";
}
?>

<body>
    <?php
    if (strtotime($conf['enddate']) < strtotime($date)) {
        echo '<div class="status">Event Has Ended</div>';
    } else {
        echo '<div class="status" style="background-color:black">';
        echo date("F j", strtotime($date));
        echo '</div>';
    }
    ?>

    <header class="cd-main-header text-center flex flex-column flex-center menu"
        style="background-image:url('./images/test2.jpg');background-size: cover;background-blend-mode: overlay;">
        <p style="padding-bottom:20px;font-size:19px;font-weight:600;color:white;">
            <?php echo $conf['title']; ?>
        </p>

        <div class="">
            <button name="increment" id="view1Btn" value="0">Day 01</button>
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

    </header>

    <div class="views-container" id="event-container">
        <div class="btnview" id="view1">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<div class="filter-container">
                <form method="post" action="' . $_SERVER["PHP_SELF"] . '">
                <label class="toggler-wrapper style-23">
                <input type="checkbox" id="personal">
                <div class="toggler-slider">
                    <div class="toggler-knob"></div>
                </div>
                </label>
                </form>
                </div>';
            }
            ?>
            <section class="cd-timeline js-cd-timeline">
                <div class="container max-width-lg cd-timeline__container" id="timeline">
                    <!-- Timeline Start -->
                    <?php
                    if (isset($_POST['personal']) && $_POST['personal'] == 'on') {
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="btnview" id="view2">
            <section class="cd-timeline js-cd-timeline">
                <div class="container max-width-lg cd-timeline__container">
                    <!-- Timeline Start -->

                    <?php
                    $curDate = date("Y-m-d", strtotime("+1 day", strtotime($conf['startdate'])));
                    $sql1 = "SELECT * FROM `sessions` WHERE `eventid` = '$event_id' AND `date` = '$curDate' ORDER BY `timefrom` ASC";
                    $result1 = mysqli_query($con, $sql1);

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
                    ?>
                </div>
            </section>
        </div>
        <div class="btnview" id="view3">
            <section class="cd-timeline js-cd-timeline">
                <div class="container max-width-lg cd-timeline__container">
                    <!-- Timeline Start -->
                    <?php
                    $curDate = date("Y-m-d", strtotime("+2 day", strtotime($conf['startdate'])));
                    $sql1 = "SELECT * FROM `sessions` WHERE `eventid` = '$event_id' AND `date` = '$curDate' ORDER BY `timefrom` ASC";
                    $result1 = mysqli_query($con, $sql1);

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
        // var divID = "417459866";
        // $(window).on("load", function () {
        //     $("html, body").animate({
        //         scrollTop: $("#" + divID).offset().top
        //     }, 2000);
        // });
        if (<?php echo json_encode(strtotime("+0 day", strtotime($conf['startdate']))); ?> == <?php echo json_encode(strtotime($date)); ?>) {
            $("#view1").show();
            $("#view1").show();
            document.getElementById("view1Btn").classList.add("active");
        }
        else if (<?php echo json_encode(strtotime("+1 day", strtotime($conf['startdate']))); ?> == <?php echo json_encode(strtotime($date)); ?>) {
            $("#view2").show();
            document.getElementById("view2Btn").classList.add("active");
        }
        else {
            $("#view3").show();
            document.getElementById("view3Btn").classList.add("active");
        }

        $(".menu button").click(function () {
            $(".menu button").removeClass("active");
            $(this).addClass("active");

            var viewId = $(this).attr("id").replace("Btn", "");
            $(".btnview").hide();
            $("#" + viewId).fadeIn(500);
        });
    });

    (function () {
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

    $(document).ready(function () {
        function reloadDiv() {
            $("#timeline").load("backend/filter-timeline.php?id=<?php echo $event_id; ?>&filter=personal");
        }
        function reloadDiv2() {
            $("#timeline").load("backend/filter-timeline.php?id=DIU45683&filter=all");
        }

        $("#personal").change(function () {
            if (this.checked) {
                reloadDiv();
            }
            else {
                reloadDiv2();
            }
        });
        reloadDiv2();
    });

    const duration = 60 * 60 * 1000,
        animationEnd = Date.now() + duration,
        defaults = { startVelocity: 30, spread: 360, ticks: 20, zIndex: 0 };

    function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
    }

    const interval = setInterval(function () {
        const timeLeft = animationEnd - Date.now();

        if (timeLeft <= 0) {
            return clearInterval(interval);
        }

        const particleCount = 20 * (timeLeft / duration);

        confetti(
            Object.assign({}, defaults, {
                particleCount,
                origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
            })
        );
        confetti(
            Object.assign({}, defaults, {
                particleCount,
                origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
            })
        );
    }, 250);

</script>
<script type="module">
    import confetti from 'https://cdn.skypack.dev/canvas-confetti';
    if (<?php echo json_encode(strtotime($conf['enddate'])); ?> < <?php echo json_encode(strtotime($date)); ?>) {

        var duration = 1 * 500;
        var end = Date.now() + duration;

        (function frame() {
            confetti({
                particleCount: 7,
                angle: 60,
                spread: 55,
                origin: { x: 0 }
            });
            confetti({
                particleCount: 7,
                angle: 120,
                spread: 55,
                origin: { x: 1 }
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());
    }
</script>
<?php
include "cssjs/js.php";
?>

</html>