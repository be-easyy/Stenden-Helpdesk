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
                <a href="./adminpanel.php">Admin Panel</a>
                <a href="./history.php">Ticket History</a>
                <a class="open" href="./overview.php">Overview</a> 
                <a href="./edit_ticket.php">Edit Tickets</a> 
                <a href="./faq_admin.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
                <h1>My Details</h2>
                <img class="profile_image" src="img/<?php echo $_SESSION['log_image']; ?>" alt="employee_image">
                <h2>Employee ID:</h2>
                <h2><?php echo $_SESSION['log_id']; ?></h2>
                <h2>Username:</h2>
                <h2><?php echo $_SESSION['log_user']; ?></h2>
                <h2>Employee Permission:</h2>
                <h2>
                    <?php 
                        if($_SESSION['log_permission'] = 0) {
                            echo "Administrator";
                        }else{
                            echo "Employee";
                        }
                    ?>
                </h2>
            </div>
        </div>
    </div>

<div class="footer">
        <div class="logout_button">
            <button type="button" class="button button5">
                <p>Log out</p>
            </button>
        </div>
        <div class="footer_margin">
            
        </div>
    </div>
</div>

</body>
</html>