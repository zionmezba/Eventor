<?php
include "../db/connect.php";

function generateUniqueID($conn)
{
	$uniqueID = mt_rand(000000, 999999);
	$checkQuery = "SELECT id FROM users WHERE id = '$uniqueID'";
	$checkResult = $conn->query($checkQuery);

	if ($checkResult->num_rows > 0) {
		return generateUniqueID($conn);
	}

	return $uniqueID;
}

if (isset($_POST["full_name"])) {
	$id = generateUniqueID($con);
	$full_name = $con->real_escape_string($_POST["full_name"]);
	$email = $con->real_escape_string($_POST['email']);
	$phone = $con->real_escape_string($_POST['phone']);
	$college = $con->real_escape_string($_POST['college']);
	$position = $con->real_escape_string($_POST['position']);
	$country = $con->real_escape_string($_POST['country']);
	$state = $con->real_escape_string($_POST['state']);
	$password = $con->real_escape_string($_POST['password']);
	$cpassword = $con->real_escape_string($_POST['cpassword']);
	if (isset($_POST['paper'])) {
		$paper = $con->real_escape_string($_POST['paper']);
	} else
		$paper = NULL;

	$emailValidation = "/^.+@.+$/";
	$number = "/^[0-9]+$/";

	if (
		empty($full_name) || empty($email) ||
		empty($phone)
	) {
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
		if (!preg_match($number, $phone)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Phone number $phone is not valid</b>
			</div>
		";
			exit();
		}
		if (!(strlen($phone) > 6)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Phone number must be 11 digit</b>
			</div>
		";
			exit();
		}
		if ((!(strlen($password) > 7)) || ($password != $cpassword)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Invalid Password</b>
			</div>
		";
			exit();
		}
		//existing email address in our database
		$checkQuery = "SELECT id FROM users WHERE mail = '$email'";
		$checkResult = $con->query($checkQuery);
		if (!($checkResult->num_rows > 0)) {
			$sql = "INSERT INTO `users`(`id`, `name`, `mail`, `phone`, `institute`, `position`, `country`, `state`, `papers`, `password`) VALUES ('$id','$full_name','$email','$phone','$college','$position','$country','$state','$paper','$password')";

			if (mysqli_query($con, $sql)) {
				echo "register_success";
				echo "<script> location.href='./login.php'; </script>";
				exit();
			}
		} else {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>User Already Exists, Login Instead?</b>
			</div>
		";
			exit();
		}

	}

}



?>