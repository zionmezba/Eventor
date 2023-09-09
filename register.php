<?php
include "db/connect.php";
$ip_add = getenv("REMOTE_ADDR");
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "cssjs/css.php";
?>

<head>
  <title>Registration</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />

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
    function updateStates() {
      var countrySelect = document.getElementById("country");
      var stateSelect = document.getElementById("state");

      var selectedCountry = countrySelect.value;
      var states = stateData[selectedCountry];

      // Clear existing state options
      stateSelect.innerHTML = "";

      // Add new state options
      for (var i = 0; i < states.length; i++) {
        var option = document.createElement("option");
        option.value = states[i];
        option.textContent = states[i];
        stateSelect.appendChild(option);
      }
    }

    // Example state data
    var stateData = {
      "Bangladesh": [
        "Dhaka", "Chittagong", "Khulna", "Rajshahi", "Barisal", "Sylhet", "Rangpur", "Other"
      ]
    };
    window.onload = function () {
      updateStates();
    };

  </script>
</head>

<body>
  <?php
  include("includes/header.php");
  include("includes/alert.php");
  ?>


  <section class="ftco-section contact-section ftco-degree-bg" style="background-color:black;padding: 10px;">
    <div class="container">
      <h1 style="color:white">Register to Sync</h1>
      <div class="alertpopup" id="signup_msg">
        <!--Alert from signup form-->
      </div>
      <div class="row block-9">
        <div class="col-md-6 pr-md-5">
          <form id="signup_form" onsubmit="return false" class="was-validated">
            <p style="color:white;margin-left:5px">Basic Information</p>
            <div class="form-group">
              <input type="text" name="full_name" class="form-control field-border" placeholder="Enter Name*" required>
            </div>

            <div class="form-group">
              <input type="email" name="email" class="form-control field-border" placeholder="Enter Email*" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control field-border" name="phone" placeholder="Phone Number*" required>
            </div>

            <p style="color:white;margin-left:5px">Affiliation</p>
            <div class="form-group">
              <input type="text" class="form-control field-border" name="college" placeholder="Institute*" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control field-border" name="position" placeholder="Position or Title*"
                required>
            </div>

            <select class="state-select" id="country" name="country" onselect="updateStates()">
              <option value="Bangladesh">Bangladesh</option>
            </select>

            <br>

            <select class="state-select" id="state" name="state">
            </select>

            <p style="color:white;margin-left:5px">Are You an Author? (If more than one paper separate with comma)</p>
            <div class="form-group">
              <input type="text" class="form-control field-border" name="paper" placeholder="Your Paper ID">
            </div>
            <p style="color:white;margin-left:5px">Security</p>
            <div class="form-group">
              <input type="password" class="form-control field-border" name="password" placeholder="Set Password*"
                required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control field-border" name="cpassword" placeholder="Confirm Password*"
                required>
            </div>

            <div class="form-group">
              <input style="width:100%" value="Register" type="submit" name="signup_button"
                class="btn btn-primary py-3 px-5 " required>
            </div>
          </form>
          <h4 style="display:flex;justify-content: center; color: white;margin:5px;">Already have an account?</h4>
          <a href="login.php" style="width:100%;margin-bottom:20px"
            class="btn btn-secondary py-3 px-5"><span>Login</span></a>

        </div>

        <!-- <div class="col-md-6" id="map"></div> -->
      </div>
    </div>
  </section>


  <?php
  include "includes/footer.php";
  ?>

  <?php
  include "cssjs/js.php";

  ?>
</body>

</html>