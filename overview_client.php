<?php
    include("./includes/init-db.php");
    include("./includes/init-session.php");
    include("./includes/check-login.php");
    CheckClient();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <title>Client Overview - Stenden Support Desk</title>
</head>
<body>

<div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
            <img id="logo" src="img/logo.png" alt="Logo">
            </div>
            <div class="navbar">
                <a href="./input_ticket.php">New Ticket</a> 
                <a href="./history.php">Ticket History</a> 
                <a class="open" href="./overview_client.php">Overview</a> 
                <a href="./client_tickets.php">Your Tickets</a>
                <a href="./faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
                <h1>My Details</h2>
                <h2>Username:
                <?php echo $_SESSION['log_user']; ?></h2>
                <h2>Email:
                <?php echo $_SESSION['log_email']; ?></h2>
                <h2>Phone Number:
                <?php echo $_SESSION['log_phone']; ?></h2>
                <h2>Function:
                <?php echo $_SESSION['log_func']; ?></h2>
                <h2>License:
                <?php echo $_SESSION['log_license']; ?></h2>
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