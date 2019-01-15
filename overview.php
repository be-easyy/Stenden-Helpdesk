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
                <a href="history.php">Something</a> 
                <a href="history.php">Ticket History</a> 
                <a class="open" href="overview.php">Overview</a> 
                <a href="adminpanel.php">Admin Panel</a>
                <a href="faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
                <h1>My Details</h2>
                <img src="<?php $_SESSION['employee_image'] ?>" alt="employee_image">
                <h2>Username:</h2>
                <h2><?php $_SESSION['username'] ?></h2>
                <h2>Email:</h2>
                <h2><?php $_SESSION['email'] ?></h2>
                <h2>License:</h2>
                <h2><?php $_SESSION['license'] ?></h2>
                <h2>Employee Permission</h2>
                <h2><?php $_SESSION['permission'] ?></h2>
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