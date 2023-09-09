$(document).ready(function () {
	$("#signup_form").on("submit", function (event) {
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "backend/register.php",
			method: "POST",
			data: $("#signup_form").serialize(),
			success: function (data) {
				$(".overlay").hide();
				if (data == "register_success") {
					window.location.href = "./login.php";
				} else {
					$("#signup_msg").html(data);
				}

			}
		})
	})

	$("#session_form").on("submit", function (event) {
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "backend/add-session.php",
			method: "POST",
			data: $("#session_form").serialize(),
			success: function (data) {
				$(".overlay").hide();
				if (data == "Success") {
					window.location.href = "add-session.php";
				} else {
					$("#session_msg").html(data);
				}

			}
		})
	})

	$("#paper_form").on("submit", function (event) {
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "backend/add-papers.php",
			method: "POST",
			data: $("#paper_form").serialize(),
			success: function (data) {
				$(".overlay").hide();
				if (data == "Success") {
					window.location.href = "add-papers.php";
				} else {
					$("#paper_msg").html(data);
				}

			}
		})
	})

	$("#session_update_form").on("submit", function (event) {
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "backend/update-session.php",
			method: "POST",
			data: $("#session_update_form").serialize(),
			success: function (data) {
				$(".overlay").hide();
			}
		})
	})

	$("#signin_form").on("submit", function (event) {
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "backend/login.php",
			method: "POST",
			data: $("#signin_form").serialize(),
			success: function (data) {
				$(".overlay").hide();
				if (data == "login_success") {
					window.location.href = "./profile.php";
				} else {
					$("#signin_msg").html(data);
				}

			}
		})
	})

	$("#application_form").on("submit", function (event) {
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "backend/application.php",
			method: "POST",
			data: $("#application_form").serialize(),
			success: function (data) {
				$(".overlay").hide();
				if (data == "applied_successfully") {
					window.location.href = "./index.php";
				} else {
					$("#application_msg").html(data);
				}

			}
		})
	})
})






















