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
                <a href="adminpanel.php">Admin Panel</a>
                <a href="history.php">Ticket History</a>
                <a href="overview.php">Overview</a> 
                <a class="open" href="edit_ticket.php">Edit Tickets</a> 
                <a href="faq_admin.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            
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