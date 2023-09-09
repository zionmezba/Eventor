<?php
include "db/connect.php";
$ip_add = getenv("REMOTE_ADDR");
if (isset($_SESSION['user_id'])) {
    echo "<script> location.href='index.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "cssjs/css.php";
?>

<head>
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />
    <style>
        .field-border {
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <?php
    include("includes/header.php");
    include("includes/alert.php");
    ?>

    <section class="ftco-section contact-section ftco-degree-bg" style="background-color:black; padding-top: 10px;">
        <div class="container">
            <h1 style="color:white; padding-bottom:10px">Login to Sync</h1>
            <div class="alertpopup" id="signin_msg">
                <!--Alert from signin form-->
            </div>

            <div class="row block-9">
                <div class="col-md-6 pr-md-5">
                    <form id="signin_form" onsubmit="return false" class="was-validated">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control field-border" placeholder="Email"
                                required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control field-border" name="password"
                                placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <input value="Login" style="width:100%" type="submit" name="signin_button"
                                class="btn btn-primary py-3 px-5 " required>
                        </div>
                    </form>
                    <a href="maintenance.php" style="display:flex;justify-content: right;">Forgot Password?</a>
                    <h4 style="display:flex;justify-content: center;color:white;">or</h4>
                    <a href="register.php" style="width:100%"
                        class="btn btn-secondary py-3 px-5"><span>Resister</span></a>
                </div>

            </div>
        </div>
    </section>





    <?php
    include "includes/footer.php";
    include "cssjs/js.php";
    ?>
</body>

</html>