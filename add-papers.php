<!DOCTYPE html>
<html lang="en">
<?php
include "db/connect.php";
include "cssjs/css.php";
include "./server/session-manager.php";
if (isset($_GET['id']))
    $event_id = $_GET['id'];
if (!isset($_SESSION['user_id']) || $event_id == NULL) {
    echo "<script> location.href='./index.php'; </script>";
}
$user_id = $_SESSION['user_id'];

?>

<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />

    <title>Add Papers</title>
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
</head>

<body>
    <?php
    include("includes/alert.php");
    ?>
    <section class="ftco-section contact-section ftco-degree-bg" style="background-color:black;padding: 10px;">
        <div class="container">
            <h1 style="color:white">Add Session</h1>
            <div class="alertpopup" id="paper_msg"></div>
            <hr style="border:1px solid white">

            <div class="row block-9">
                <div class="col-md-6 pr-md-5">
                    <form id="paper_form" onsubmit="return false" class="was-validated">

                        <div class="form-group">
                            <input type="text" name="paperid" class="form-control field-border" placeholder="Paper ID"
                                required>
                            <input hidden type="text" name="event_id" class="form-control field-border"
                                value="<?php echo $event_id ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" name="title" class="form-control field-border" placeholder="Paper Title"
                                required>
                        </div>

                        <div class="form-group">
                            <input type="text" name="author" class="form-control field-border"
                                placeholder="Paper Author(s)" required>
                        </div>

                        <div class="form-group">
                            <input type="text" name="mail" class="form-control field-border"
                                placeholder="Author Mail(s)">
                        </div>


                        <!-- Submit Button -->
                        <hr style="border:1px solid white">

                        <div class="form-group">
                            <input style="width:100%;background:green" value="Add Paper" id="addpButton" type="submit"
                                name="addp_button" class="btn btn-primary py-3 px-5 " required>
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