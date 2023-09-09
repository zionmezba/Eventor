<?php
include("../db/connect.php")
    ?>
<header>
<link href="https://fonts.googleapis.com/css?family=Lato:400,700|Roboto:400,700|Montserrat:400,700|Open+Sans:400,700|Playfair+Display:400,700&display=swap" rel="stylesheet">

    <title>Eventor Admin</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</header>


<body>
    <?php include("navbar.php"); ?>
    <div class="container-body">
        <div class="details">
            <h1>Approved</h1>
        </div>
        <div class="details">
            <div class="app-table-wrap">
                <table class="app-table">
                    <thead>
                        <tr style="font-weight:600;">
                            <td style="width:30%">Title</td>
                            <td style="width:30%">By</td>
                            <td style="width:23%">Status</td>
                            <td>Details</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `applications` WHERE `status` = '1' ORDER BY `timestrap` ASC;";
                        $result = mysqli_query($con, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["title"] . "</td>";
                                echo "<td>" . $row["name"] . ", " . $row["position"] . ", " . $row["institute"] . "</td>";
                                if ($row["status"] == 0)
                                    echo "<td>Rejected</td>";
                                if ($row["status"] == 1)
                                    echo "<td>Approved</td>";
                                if ($row["status"] == 2)
                                    echo "<td>Pending</td>";
                                echo "<td><a href='details.php?id=" . $row['id'] . "'>View Details</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</body>