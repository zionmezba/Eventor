<?php
include "db/connect.php";
include "./server/session-manager.php";
if (isset($_GET['session']))
    $sessid = $_GET['session'];
else
    echo "<script> location.href='./index.php'; </script>";

?>

<!DOCTYPE html>
<html lang="en">
<?php
$sql = "SELECT * FROM `sessions` WHERE `id` = '$sessid'";
$result = mysqli_query($con, $sql);
$sess = $result->fetch_assoc();
?>

<head>
    <title>Details of Session -
        <?php echo $sess['level']; ?>
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .wrapper {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            margin-bottom: 50px;
        }

        .details {
            padding: 15px;
            margin-top: 8px;
            background-color: hsl(217, 54%, 11%);
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 3px 1px rgb(207 0 255);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        p,
        strong {
            color: hsl(255, 51%, 70%);
        }

        .centered {
            text-align: center;
            font-weight: 800;
            color: wheat;
        }

        p {
            font-size: 18px;
            color: white;
        }
    </style>
</head>

<body style="background-color: black;">
    <div class="wrapper">
        <div class="details">
            <div class="details centered">
                <h5 class="centered">
                    <?php echo $sess['level']; ?>
                </h5>
            </div>
            <div class="details centered">
                <p style="text-align:center">
                    <?php echo date('l, d F Y', strtotime($sess['date'])); ?>
                </p>
                <p style="text-align:center">
                    <?php echo date('h:i A', strtotime($sess['timefrom'])) . ' - ' . date('h:i A', strtotime($sess['timeto'])); ?>
                </p>
            </div>

            <?php
            if ($sess['title'] != NULL) {
                echo '<div class="details">';
                echo '<p><strong>Title: </strong>' . $sess['title'] . '</p>
                </div>';
            }
            ?>
            <?php
            if ($sess['talktitle'] != NULL || $sess['resperson'] != NULL) {
                echo '<div class="details">';

                if ($sess['talktitle'] != NULL) {
                    echo '<p><strong>Title of the Invited Talk: </strong>' . $sess['talktitle'] . '</p>';
                }

                if ($sess['resperson'] != NULL) {
                    echo '<p><strong>Resource Person: </strong>' . nl2br($sess['resperson']) . '</p>
                </div>';
                }
            }
            ?>

            <?php
            if ($sess['type'] != NULL) {
                echo '<div class="details">';
                if ($sess['type'] == 'both')
                    echo '<p><strong>Session Type: </strong>Both Online & On Spot</p><p>';
                else if ($sess['type'] == 'offline')
                    echo '<p><strong>Session Type: </strong>On Spot</p><p>';
                else
                    echo '<p><strong>Session Type: </strong>Online</p><p>';
            }

            if ($sess['type'] == 'online') {
                if ($sess['link'] != NULL) {
                    echo "<p><strong>Session Link: </strong><a href='" .
                        htmlspecialchars($sess['link']) . "' style='overflow:hidden;text-decoration:revert;color:white;' target='_blank'> " .
                        $sess['link'] . "</a></p>";
                }
                if ($sess['zoomid'] != NULL) {
                    echo '<p><strong>Zoom ID: </strong>' . $sess['zoomid'] . '</p>';
                }
            } else if ($sess['type'] == 'offline') {
                if ($sess['venue'] != NULL) {
                    echo '<p><strong>Venue: </strong><a style="text-decoration:revert;"
                        href="https://www.google.com/maps/search/?api=1&query=' . urlencode($sess['venue']) . '" target="_blank"><span
                            style="padding-left:6px;color:var(--var-soft-blue)">' . $sess['venue'] . '</span></a></p>';
                }
            } else if ($sess['type'] == 'both') {
                if ($sess['link'] != NULL) {
                    echo "<strong>Session Link: </strong><a href='" .
                        htmlspecialchars($sess['link']) . "' style='overflow:hidden;text-decoration:revert;color:white;'  target='_blank'> " .
                        $sess['link'] . "</a>";
                }
                if ($sess['zoomid'] != NULL) {
                    echo '<p><strong>Zoom ID: </strong>' . $sess['zoomid'] . '</p>';
                }
                if ($sess['venue'] != NULL) {
                    echo '<p><strong>Venue: </strong><a style="text-decoration:revert;"
                        href="https://www.google.com/maps/search/?api=1&query=' . urlencode($sess['venue']) . '" target="_blank"><span
                            style="padding-left:6px;color:var(--var-soft-blue)">' . $sess['venue'] . '</span></a></p>';
                }
            } 
            echo '</div>';?>

            <div class="details">
                <?php
                if ($sess['chair'] != NULL) {
                    echo '<p><strong>Session Chair: </strong>' . nl2br($sess['chair']) . '</p>';
                }
                if ($sess['moderator'] != NULL) {
                    echo '<p><strong>Session Moderator: </strong>' . nl2br($sess['moderator']) . '</p>';
                }
                if ($sess['coordinator'] != NULL) {
                    echo '<p><strong>Session Co-ordinator: </strong>' . nl2br($sess['coordinator']) . '</p>';
                }
                ?>

            </div>
            <?php if ($sess['papers'] != NULL) {
                echo '<div class="details">';
                echo '<p><strong>Paper ID(s): </strong>' . $sess['papers'] . '</p>';
                $paperIds = explode(', ', $sess['papers']);
                $i = 1;
                foreach ($paperIds as $paperId) {
                    $paperQuery = "SELECT * FROM `papers` WHERE `paperid` = " . intval($paperId);
                    $paperResult = mysqli_query($con, $paperQuery);

                    if ($paperResult && mysqli_num_rows($paperResult) > 0) {
                        $paperDetails = mysqli_fetch_assoc($paperResult);
                        echo "<p><strong>Paper ID " . $i . ": </strong>" . $paperDetails['paperid'] . "<br>";
                        echo "<strong>Title: </strong>" . $paperDetails['title'] . "<br>";
                        echo "<strong>Author(s): </strong>" . $paperDetails['authors'] . "<br><p>";
                        echo "<hr style='color:white'>";
                        $i += 1;
                    }
                }
            }
            ?>
            </p>
        </div>

    </div>
    </div>
</body>

<?php
include "includes/footer.php";
include "cssjs/js.php";
?>
</body>
</html>