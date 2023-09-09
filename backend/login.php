<?php
include "../db/connect.php";
date_default_timezone_set('Asia/Dhaka');

if (isset($_POST["email"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $emailValidation = "/^.+@.+$/";
    $number = "/^[0-9]+$/";

    if (empty($email)) {
        echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
        exit();
    } else {

        if (!preg_match($emailValidation, $email)) {
            echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
            exit();
        }
        if ((strlen($password) < 8)) {
            echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Invalid Password</b>
			</div>
		";
            exit();
        }
        //existing email address in our database

        $sql = "SELECT `id`, `mail`, `password` FROM `users` WHERE `mail` = '$email'";
        $result = mysqli_query($con, $sql);
        $row = $result->fetch_assoc();

        $sql2 = "SELECT `id`, `mail`, `password` FROM `admin` WHERE `mail` = '$email'";
        $result2 = mysqli_query($con, $sql2);
        $row2 = $result2->fetch_assoc();

        if ($result->num_rows > 0) {
            if ($row['password'] == $password) {
                $_SESSION['user_id'] = $row['id'];
                $t = $row['id'];
                $sql2 = "UPDATE `users` SET `login_time`= NOW() WHERE `id` = '$t'";
                mysqli_query($con, $sql);
                echo "login_success";
                echo "<script> location.href='./profile.php'; </script>";
                exit();
            } else {
                echo "
                    <div class='alert alert-warning'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>Invalid Email or Password</b>
                    </div>
                ";
                exit();
            }
        }
        if ($result2->num_rows > 0) {
            if ($row2['password'] == $password) {
                $_SESSION['user_id'] = $row2['id'];
                // $t = $row2['id'];
                // $sql2 = "UPDATE `users` SET `login_time`= NOW() WHERE `id` = '$t'";
                // mysqli_query($con, $sql);
                echo "login_success";
                echo $row2['id']; 
                // echo "<script> location.href='./admin/admin-dash.php'; </script>";
                exit();
            } else {
                echo "
                    <div class='alert alert-warning'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>Invalid Email or Password</b>
                    </div>
                ";
                exit();
            }
        } else {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Invalid Email or Password</b>
                </div>
            ";
            exit();
        }

    }
}



?>