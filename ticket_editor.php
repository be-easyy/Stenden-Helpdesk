<?php
    include("./includes/init-db.php");
    include("./includes/init-session.php");
    include("./includes/check-login.php");
    CheckEmployee();
    $error = NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Client Overview - Stenden Support Desk</title>
</head>
<body>

<div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <a href="./overview.php">
                    <img id="logo" src="img/logo.png" alt="Logo">
                </a>
            </div>
            <div class="navbar"> 
                <a href="adminpanel.php">Admin Panel</a>
                <a href="./history_admin.php">Ticket History</a>
                <a href="overview.php">Overview</a> 
                <a href="edit_ticket.php">Edit Tickets</a> 
                <a href="faq_admin.html">FAQ</a><a  class="logout" href="./log_out.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            <?php

                if (!isset($_GET["id"])) {
                    header("Location: edit_ticket.php");
                    exit();
                } else {
                    if(isset($_POST["submit"])) {
                        if(!empty($_POST["solution"])) {
                            $SQLConnect = OpenDBConnection();
                            $SQLQuery = "UPDATE Solution s
                            INNER JOIN Incident i ON s.Solution_ID = i.Solution_ID
                            SET s.Solution_Name = ?
                            WHERE i.Incident_ID = ?";
                            $stmt = $SQLConnect->prepare($SQLQuery);
                            $stmt->bind_param("si", $_POST["solution"], $_GET["id"]);
                            $stmt->execute();
                            $stmt->close();
                            CloseDBConnection($SQLConnect);
                        }
                        if(!empty($_POST["assign"])) {
                            $SQLConnect = OpenDBConnection();
                            $SQLQuery = "UPDATE Incident
                            SET Employee_ID = ?
                            WHERE Incident_ID = ?";
                            $stmt = $SQLConnect->prepare($SQLQuery);
                            $stmt->bind_param("si", $_POST["assign"], $_GET["id"]);
                            $stmt->execute();
                            $stmt->close();
                            CloseDBConnection($SQLConnect);
                        }
                        if (isset($error)) {
                            $error = "";
                            switch ($error) {
                                case 0:
                                    $error = "Successfully changed incident.";
                                    break;
                                case 1:
                                    $error = "Nothing has changed.";
                                    break;
                                case 2:
                                    $error = "The image must be smaller than 1MB and must be JPG, JPEG, PNG or GIF format.";
                                    break;
                                case 3:
                                    $error = "For a New User you have to add Name, Password and Image.";
                                    break;
                            }
                            echo $error;
                        }
                    }
                    $SQLConnect = OpenDBConnection();
                    $result = SelectDBResult(
                        $SQLConnect,
                        "Incident",
                        array("Description"),
                        "Incident_ID",
                        $_GET["id"]
                    );
                    echo "<h3>Description</h3><br>";
                    echo $result[0]["Description"];
                    echo "<br><br><br>";
                    ?>
                        <form class="center-this" method="POST" action="ticket_editor.php">
                            <label class="small" for="solution">Solution</label>
                            <br>
                            <input type="text" id="solution" name="solution" placeholder="Same as before">
                            <br><br>
                            <label class="small" for="assign">Assign employee</label>
                            <br>
                            <select name="assign" id="assign">
                                <option value="-1">nobody</option>
                                <?php
                                    if($_SESSION["log_permission"] == 0) {
                                        $SQLConnect = OpenDBConnection();
                                        $result = SelectDBResult(
                                            $SQLConnect,
                                            "Employee",
                                            array("Employee_ID", "Employee_Name")
                                        );
                                        var_dump($result);
                                        foreach ($result as $key) {
                                            echo "<option value='"
                                            . $key["Employee_ID"]
                                            . "'>"
                                            . $key["Employee_Name"]
                                            . "</option>";
                                        }
                                    } else {
                                        echo "<option value='"
                                        . $_SESSION["log_id"]
                                        . "'>"
                                        . $_SESSION["log_user"]
                                        . "</option>";
                                    }
                                ?>
                            </select>
                            <br><br>
                            <input type="submit" name="submit" value="Save">
                        </form>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>

<div class="footer">
        <div class="footer_margin">
            
        </div>
    </div>
</div>

</body>
</html>