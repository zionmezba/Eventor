<!DOCTYPE html>
<html lang="en">
<?php
include "db/connect.php";
include "cssjs/css.php";
include "./server/session-manager.php";
if (!isset($_SESSION['user_id'])) {
  echo "<script> location.href='./index.php'; </script>";
}
?>

<head>
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
    function showInputField() {
      var dropdown = document.getElementById("location");
      var inputField = document.getElementById("inputField");

      if (dropdown.value === "Other") {
        inputField.style.display = "block";
      } else {
        inputField.style.display = "none";
      }
    }


    function enableSubmit() {
      var checkbox = document.getElementById("termsCheckbox");
      var submitButton = document.getElementById("submitButton");

      submitButton.disabled = !checkbox.checked;
    }

  </script>
</head>

<body>
  <?php
  include("includes/alert.php");
  ?>

  <section class="ftco-section contact-section ftco-degree-bg" style="background-color:black;padding: 10px;">
    <div class="container">
      <h1 style="color:white">Register to Sync</h1>
      <div
        style="border-radius:5px;padding:10px;text-align:justify;color:white;font-size:15px;color:red;background-color:yellow;">
        <li>Submit an application to host a conference with accurate and authentic information.</li>
        <li>Ensure all details are valid and complete before submission.</li>
        <li>Our team carefully reviews each application to maintain quality and relevance.</li>
        <li>Once approved, you'll receive a confirmation email with further instructions.</li>
        <li>Your commitment to accurate information enhances the credibility of the conference.</li>
        <li>We prioritize transparency and professionalism in every step of the application process.</li>
      </div>

      <div class="alertpopup" id="application_msg">
        <!--Alert from application form-->
      </div>

      <?php
      $sql = "SELECT * FROM `users` WHERE `id` = '$user_id'";
      $result = mysqli_query($con, $sql);
      $row = $result->fetch_assoc();
      ?>
      <hr style="border:1px solid white">

      <div class="row block-9">
        <div class="col-md-6 pr-md-5">
          <form id="application_form" onsubmit="return false" class="was-validated">

            <p style="color:white;margin-left:5px;margin-top:15px">Basic Information</p>
            <div class="form-group">
              <input disabled type="text" name="full_name" class="form-control field-border"
                value="<?php echo $row['name']; ?>">
              <input hidden type="text" name="full_name" class="form-control field-border"
                value="<?php echo $row['name']; ?>">
            </div>

            <div class="form-group">
              <input disabled type="email" name="email" class="form-control field-border"
                value="<?php echo $row['mail']; ?>">
              <input hidden type="email" name="email" class="form-control field-border"
                value="<?php echo $row['mail']; ?>">
            </div>

            <div class="form-group">
              <input disabled type="text" class="form-control field-border" name="phone"
                value="<?php echo $row['phone']; ?>">
              <input hidden type="text" class="form-control field-border" name="phone"
                value="<?php echo $row['phone']; ?>">
            </div>
            <hr style="border:1px solid white">

            <!-- Affiliation -->
            <p style="color:white;margin-left:5px">Affiliation</p>

            <div class="form-group">
              <input disabled type="text" class="form-control field-border" name="college"
                value="<?php echo $row['institute']; ?>">
              <input hidden type="text" class="form-control field-border" name="college"
                value="<?php echo $row['institute']; ?>">
            </div>

            <select class="state-select" id="position" name="position" required>
              <option disabled selected>Position/Title *</option>
              <option value="Professor">Professor</option>
              <option value="Associate Professor">Associate Professor</option>
              <option value="Assistant Professor">Assistant Professor</option>
            </select>

            <br>
            <div class="form-group">
              <input type="text" class="form-control field-border" name="web_link"
                placeholder="Professional Website/Portfolio Link *" required>
            </div>
            <hr style="border:1px solid white">

            <!-- Conference Information -->
            <p style="color:white;margin-left:5px">Conference Information</p>

            <div class="form-group">
              <input type="text" class="form-control field-border" name="title" placeholder="Title of Event *" required>
            </div>

            <select class="state-select" id="country" name="country" required>
              <option value="Bangladesh" selected>Bangladesh</option>
              <option value="India">India</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Nepal">Nepal</option>
              <option value="Japan">Japan</option>
              <option value="China">China</option>
            </select>

            <div class="form-group">
              <input type="text" class="form-control field-border" name="host" placeholder="Host University *" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control field-border" name="sub_host"
                placeholder="Another Host University or leave empty">
            </div>

            <select class="state-select" id="type" name="type" required>
              <option disabled selected>Article Type *</option>
              <option value="Conference">Conference</option>
              <option value="Journal">Journal</option>
            </select>

            <select class="state-select" id="indexing" name="indexing" required>
              <option disabled selected>Paper Indexing *</option>
              <option value="IEEE Xplore">IEEE Xplore</option>
              <option value="Scopus">Scopus</option>
              <option value="SpringerLink">SpringerLink</option>
              <option value="Web of Science">Web of Science</option>
              <option value="ScienceDirect">ScienceDirect</option>
              <option value="Directory of Open Access Journals (DOAJ)">Directory of Open Access Journals (DOAJ)</option>
              <option value="JSTOR">JSTOR</option>
              <option value="ERIC">ERIC</option>
              <option value="PubMed">PubMed</option>
            </select>
            <hr style="border:1px solid white">

            <!-- Date and Venue -->
            <p style="color:white;margin-left:5px">Date and Venue</p>

            <div class="form-group">
              <label for="startdate" style="margin-left:5px;color:#ddd">Expected Date From</label>
              <input type="date" class="form-control field-border" name="startdate" placeholder="Expected Date"
                required>
            </div>

            <div class="form-group">
              <label for="enddate" style="margin-left:5px;color:#ddd">To</label>
              <input type="date" class="form-control field-border" name="enddate" placeholder="Expected End Date"
                required>
            </div>

            <select class="state-select" id="location" name="location" onchange="showInputField()" required>
              <option disabled selected>Location / Venue *</option>
              <option value="Host University">Host University</option>
              <option value="Online">Online</option>
              <option value="Blended">Blended / Both Online and Offline</option>
              <option>Other</option>
            </select>

            <div class="form-group" id="inputField" style="display:none">
              <input type="text" class="form-control field-border" name="location2"
                placeholder="Please Mention the Location *">
            </div>

            <select class="state-select" id="participants" name="participants" required>
              <option disabled selected>Expected Number of Participants *</option>
              <option value="100">10 - 100</option>
              <option value="300">100 - 300</option>
              <option value="500">300 - 500</option>
              <option value="1000">500 - 1000</option>
              <option value="2000"> >1000</option>
            </select>

            <!-- Submit Button -->
            <hr style="border:1px solid white">

            <label style="font-size: 15px; color: red;">
              <input style="transform:scale(1.4); margin-right:10px;" type="checkbox" id="termsCheckbox"
                onchange="enableSubmit()">
              All Informations are Correct
            </label>

            <div class="form-group">
              <input style="width:100%" value="Apply" id="submitButton" type="submit" name="apply_button"
                class="btn btn-primary py-3 px-5 " disabled required>
            </div>

          </form>
        </div>

        <!-- <div class="col-md-6" id="map"></div> -->
      </div>
    </div>
  </section>


  <?php
  include "includes/footer.php";
  include "cssjs/js.php";
  ?>
  <script>

  </script>
</body>

</html>