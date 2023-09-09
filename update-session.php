<!DOCTYPE html>
<html lang="en">
<?php
include "db/connect.php";
include "cssjs/css.php";
include "./server/session-manager.php";

if (!isset($_SESSION['user_id'])) {
    echo "<script> location.href='./index.php'; </script>";
}

$user_id = $_SESSION['user_id'];
// $eventid = $_GET['id'];
$sessid = $_GET['event'];
?>

<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />

    <title>Add Session Details</title>
    <style>
        .field-border {
            border-radius: 20px;
        }

        .state-select {
            width: 100%;
            font-size: 16px;
            padding: 10px;
            border-radius: 15px;
            margin-bottom: 15px;
        }
    </style>

    <script>
        function confirmFormSubmission() {
            var confirmed = confirm("Confirm Delete?");
            if (confirmed) {
                document.getElementById("session_update_form").submit();
            }
        }
    </script>
</head>
<?php
$sql = "SELECT * FROM `sessions` WHERE `id` = '$sessid'";
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();
?>

<body>
    <section class="ftco-section contact-section ftco-degree-bg" style="background-color:black;padding: 10px;">
        <div class="container">
            <h1 style="color:white">Update Session</h1>
            <div class="alertpopup" id="session_msg"></div>

            <hr style="border:1px solid white">
            <div class="row block-9">
                <div class="col-md-6 pr-md-5">
                    <form id="session_update_form" onsubmit="return false" class="was-validated">

                        <div class="form-group">
                            <label for="sess_name">Session Name</label>
                            <input type="text" name="sess_name" class="form-control field-border"
                                placeholder="Session Name" value="<?php echo $row['level'] ?>" required />

                            <input hidden type="text" name="sessid" value="<?php echo $row['id'] ?>" />
                            <input hidden type="text" name="evntid" value="<?php echo $row['eventid'] ?>" />
                        </div>

                        <div class="form-group">
                            <label for="title">Session Title</label>
                            <input type="text" name="title" class="form-control field-border"
                                placeholder="Session Title" value="<?php echo $row['title'] ?>" />
                        </div>

                        <div class="form-group">
                            <label for="talktitle" style="margin-left:5px;">Talk Session Title</label>
                            <input type="text" name="talktitle" class="form-control field-border"
                                placeholder="Talk Session Title (if any)" value="<?php echo $row['talktitle'] ?>" />
                        </div>

                        <div class="form-group">
                            <label for="date" style="margin-left:5px;color:#ddd">Date</label>
                            <input type="date" class="form-control field-border" name="date" placeholder="Date"
                                value="<?php echo $row['date'] ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="starttime" style="margin-left:5px;color:#ddd">Start Time</label>
                            <input type="time" class="form-control field-border" name="starttime"
                                placeholder="Start Time" value="<?php echo $row['timefrom'] ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="endtime" style="margin-left:5px;color:#ddd">End Time</label>
                            <input type="time" class="form-control field-border" name="endtime" placeholder="End Time"
                                value="<?php echo $row['timeto'] ?>" required />
                        </div>

                        <label for="type">Event Type</label>
                        <select class="state-select" id="type1" name="type" required>
                            <option value="<?php echo $row['type'] ?>" selected><?php echo $row['type'] ?></option>
                            <option value="online">Online</option>
                            <option value="offline">On Spot</option>
                            <option value="both">Both</option>
                        </select>

                        <div class="form-group">
                            <input type="text" name="venue" class="form-control field-border"
                                placeholder="Venue/Location" value="<?php echo $row['venue'] ?>" />
                        </div>

                        <div class="form-group">
                            <input type="text" name="link" class="form-control field-border"
                                placeholder="Online Session Link (if any)" value="<?php echo $row['link'] ?>" />
                        </div>

                        <div class="form-group">
                            <input type="text" name="zoom" class="form-control field-border"
                                placeholder="Zoom ID (if any)" value="<?php echo $row['zoomid'] ?>" />
                        </div>

                        <label for="papers">Papers</label>
                        <div class="form-group">
                            <input type="text" name="papers" class="form-control field-border"
                                placeholder="Paper ID(s) (if any)" value="<?php echo $row['papers'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="chair">Session Chair (if any)</label>
                            <input type="text" name="chair" class="form-control field-border"
                                placeholder="Session Chair (if any)" value="<?php echo $row['chair'] ?>" />
                        </div>

                        <div class="form-group">
                            <label for="moderator">Session Moderator (if any)</label>
                            <input type="text" name="moderator" class="form-control field-border"
                                placeholder="Session Moderator (if any)" value="<?php echo $row['moderator'] ?>" />
                        </div>

                        <div class="form-group">
                            <label for="coordinator">Session Coordinator (if any)</label>
                            <input type="text" name="coordinator" class="form-control field-border"
                                placeholder="Session Coordinator (if any)" value="<?php echo $row['coordinator'] ?>" />
                        </div>

                        <div class="form-group">
                            <label for="coordinator">Resource Person (if any)</label>
                            <input type="text" name="resperson" class="form-control field-border"
                                placeholder="Resource Person (if any)" value="<?php echo $row['resperson'] ?>" />
                        </div>

                        <!-- Submit Button -->
                        <hr style="border:1px solid white">

                        <div class="form-group">
                            <input style="width:70%;background:green;" name="update_button" value="UpdateSession"
                                type="submit" class="btn btn-primary py-3 px-3"></input>

                            <input style="width:27%" value="Delete" type="submit" onclick="confirmFormSubmission()"
                                name="delete_button" class="btn btn-primary py-3 px-3 "></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    include "cssjs/js.php";
    ?>

</body>

</html>