<?php
include("./includes/init-db.php");
include("./includes/init-session.php");
include("./includes/check-login.php");
CheckEmployee();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <title>Admin Panel - Stenden Support Desk</title>
</head>
<body>

<div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <img id="logo" src="img/logo.png" alt="Logo">
            </div>
            <div class="navbar">
                <a class="open" href="./adminpanel.php">Admin Panel</a>
                <a href="./history_admin.php">Ticket History</a>
                <a href="./overview.php">Overview</a> 
                <a href="./edit_ticket.php">Edit Tickets</a> 
                <a href="./faq_admin.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
                <?php
                    if($_SESSION["log_permission"] == 1) {
                        echo "You have no permission to view this page";
                    } else {
                        ?>
                        <form class="center-this" method="POST" action="img/process.php" enctype="multipart/form-data">
                            <label class="small" for="empo">Select employee</label>
                            <br>
                            <select id="empo" name="user">
                                <?php
                                    $SQLConnect = OpenDBConnection();
                                    $result = SelectDBResult($SQLConnect, "Employee", "*", "Employee_Permission", "1");
                                    foreach ($result as $key) {
                                        echo "<option value='" . $key["Employee_ID"] . "'>";
                                        echo $key["Employee_Name"];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                            <br><br>
                            <label class="small" for="username">Employee Name</label>
                            <br>
                            <input type="text" id="username" name="em_name" placeholder="Same as before">
                            <br><br>
                            <label class="small" for="password">Employee Password</label>
                            <br>
                            <input type="password" id="password" name="em_pass" placeholder="Same as before">
                            <br><br>
                            <label class="small" for="image">Upload image</label>
                            <br>
                            <input type="file" id="image" name="image">
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