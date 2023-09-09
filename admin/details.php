<?php
include("../db/connect.php");
$applicationId = "";
if (isset($_GET['id'])) {
    $applicationId = $_GET['id'];
} else {
    echo "User ID not provided.";
    echo "<script> location.href='./admin/admin-dash.php'; </script>";
}
?>
<header>
    <link
        href="https://fonts.googleapis.com/css?family=Lato:400,700|Roboto:400,700|Montserrat:400,700|Open+Sans:400,700|Playfair+Display:400,700&display=swap"
        rel="stylesheet">

    <title>Application Details</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</header>

<body>
    <div class="wrapper">
        <div class="details">

            <?php
            $sql = "SELECT * FROM `applications` WHERE `id` = '$applicationId'";
            $result = mysqli_query($con, $sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="details">
                <h3>Application ID:
                    <?php echo $applicationId; ?>
                </h3>
                <h3>Title:
                    <?php echo $row['title'] ?>
                </h3>
            </div>
            <div class="details">
                <p><strong>Event Type:</strong>
                    <?php echo $row['type'] ?>
                </p>
                <p><strong>Paper Indexing:</strong>
                    <?php echo $row['indexing'] ?>
                </p>
                <p><strong>Hosted By:</strong>
                    <?php echo $row['host1'] ?>
                </p>
                <p><strong>Other Hosts:</strong>
                    <?php echo $row['host2'] ?>
                </p>
                <p><strong>Expected Date:</strong>
                    <?php echo $row['startdate'] ?> <strong>to</strong>
                    <?php echo $row['enddate'] ?>
                </p>
                <p><strong>Expected Participants:</strong>
                    <?php echo $row['participants'] ?>
                </p>
                <p><strong>Venue:</strong>
                    <?php echo $row['venue'] ?>
                </p>
                <p><strong>Country:</strong>
                    <?php echo $row['country'] ?>
                </p>
            </div>
            <div class="details">
                <h4>Applied By:
                    <?php echo $row['name'] ?>
                </h4>
                <p><strong>Position:</strong>
                    <?php echo $row['position'] ?>
                </p>
                <p><strong>Institute:</strong>
                    <?php echo $row['institute'] ?>
                </p>
                <p><strong>Mail:</strong>
                    <?php echo $row['mail'] ?>
                </p>
                <p><strong>Phone:</strong>
                    <?php echo $row['phone'] ?>
                </p>
                <p><strong>Portfolio:</strong>
                    <?php echo $row['portfolio'] ?>
                </p>
            </div>
            <div class="action-buttons">
                <button class="approve-button" name="approve" onclick="approveRecord()">Approve</button>
                <button class="reject-button" onclick="rejectRecord()">Reject</button>
            </div>

        </div>
    </div>
    
    <?php include("navbar.php"); ?>
</body>
<script>
        function approveRecord() {
            var userId = <?php echo $row['id']; ?>; 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_value.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    window.location.href = "admin-dash.php";
                }
            };
            xhr.send("action=approve&Id=" + userId);
        }
        function rejectRecord() {
            var userId = <?php echo $row['id']; ?>; 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_value.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    window.location.href = "admin-dash.php";
                }
            };
            xhr.send("action=reject&Id=" + userId);
        }
    </script>