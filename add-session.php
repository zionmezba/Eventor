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
$eventid = $_GET['id'];
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
        function showInputField() {
            var dropdown = document.getElementById("location");
            var inputField = document.getElementById("inputField");

            if (dropdown.value === "Other") {
                inputField.style.display = "block";
            } else {
                inputField.style.display = "none";
            }
        }

    </script>
</head>

<body>
    <?php
    include("includes/alert.php");
    ?>
    <section class="ftco-section contact-section ftco-degree-bg" style="background-color:black;padding: 10px;">
        <div class="container">
            <h1 style="color:white">Add Session</h1>
            <div class="alertpopup" id="session_msg"></div>
            <?php
            $sql = "SELECT * FROM `users` WHERE `id` = '$user_id'";
            $result = mysqli_query($con, $sql);
            $row = $result->fetch_assoc();
            ?>
            <hr style="border:1px solid white">

            <div class="row block-9">
                <div class="col-md-6 pr-md-5">
                    <form id="session_form" onsubmit="return false" class="was-validated">

                        <div class="form-group">
                            <input type="text" name="sess_name" class="form-control field-border"
                                placeholder="Session Name" required>
                            <input hidden type="text" name="evntid" value="<?php echo $eventid; ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" name="title" class="form-control field-border"
                                placeholder="Session Title">
                        </div>

                        <div class="form-group">
                            <input type="text" name="talktitle" class="form-control field-border"
                                placeholder="Talk Session Title (if any)">
                        </div>

                        <div class="form-group">
                            <label for="date" style="margin-left:5px;color:#ddd">Date</label>
                            <input type="date" class="form-control field-border" name="date" placeholder="Date"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="date" style="margin-left:5px;color:#ddd">Start Time</label>
                            <input type="time" class="form-control field-border" name="starttime"
                                placeholder="Start Time" required>
                        </div>

                        <div class="form-group">
                            <label for="date" style="margin-left:5px;color:#ddd">End Time</label>
                            <input type="time" class="form-control field-border" name="endtime" placeholder="End Time"
                                required>
                        </div>

                        <select class="state-select" id="type1" name="type" required>
                            <option disabled selected>Event Type</option>
                            <option value="online">Online</option>
                            <option value="offline">On Spot</option>
                            <option value="both">Both</option>
                        </select>

                        <div class="form-group" id="offline1" style="display:none">
                            <input type="text" name="venue" class="form-control field-border"
                                placeholder="Venue/Location">
                        </div>

                        <div class="form-group" id="online1" style="display:none">
                            <input type="text" name="link" class="form-control field-border"
                                placeholder="Online Session Link (if any)">
                        </div>

                        <div class="form-group" id="online2" style="display:none">
                            <input type="text" name="zoom" class="form-control field-border"
                                placeholder="Zoom ID (if any)">
                        </div>

                        <div class="form-group">
                            <input type="text" name="papers" class="form-control field-border"
                                placeholder="Paper ID(s) (if any)">
                        </div>

                        <div class="form-group">
                            <input type="text" name="chair" class="form-control field-border"
                                placeholder="Session Chair (if any)">
                        </div>

                        <div class="form-group">
                            <input type="text" name="moderator" class="form-control field-border"
                                placeholder="Session Moderator (if any)">
                        </div>

                        <div class="form-group">
                            <input type="text" name="coordinator" class="form-control field-border"
                                placeholder="Session Coordinator (if any)">
                        </div>

                        <div class="form-group">
                            <input type="text" name="resperson" class="form-control field-border"
                                placeholder="Resource Person (if any)">
                        </div>

                        <!-- Submit Button -->
                        <hr style="border:1px solid white">

                        <div class="form-group">
                            <input style="width:100%;background:green" value="Add Session" id="addButton" type="submit"
                                name="add_button" class="btn btn-primary py-3 px-5 " required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const selectmenu = document.getElementById('type1');
        const input1 = document.getElementById('offline1');
        const input2 = document.getElementById('online1');
        const input3 = document.getElementById('online2');

        if (selectmenu.value === 'online') {
            input1.style.display = 'none';
            input2.style.display = 'block';
            input3.style.display = 'block';
        } else if (selectmenu.value === 'offline') {
            input1.style.display = 'block';
            input2.style.display = 'none';
            input3.style.display = 'none';
        } else if (selectmenu.value === 'both') {
            input1.style.display = 'block';
            input2.style.display = 'block';
            input3.style.display = 'block';
        }

        selectmenu.addEventListener('change', function () {
            const selectedValue = selectmenu.value;
            if (selectedValue === 'online') {
                input1.style.display = 'none';
                input2.style.display = 'block';
                input3.style.display = 'block';
            } else if (selectedValue === 'offline') {
                input1.style.display = 'block';
                input2.style.display = 'none';
                input3.style.display = 'none';
            } else if (selectedValue === 'both') {
                input1.style.display = 'block';
                input2.style.display = 'block';
                input3.style.display = 'block';
            }
        });
    </script>
    <?php
    include "cssjs/js.php";
    ?>

</body>

</html>