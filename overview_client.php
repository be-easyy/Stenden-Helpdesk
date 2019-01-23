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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Client Overview - Stenden Support Desk</title>
</head>
<body>

<div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <a href="./overview_client.php">
                    <img id="logo" src="img/logo.png" alt="Logo">
                </a>
            </div>
            <div class="navbar">
                <a href="./input_ticket.php">New Ticket</a> 
                <a href="./history.php">Ticket History</a>  
                <a class="open" href="./overview_client.php">Overview</a> 
                <a href="./client_tickets.php">Your Tickets</a>
                <a href="./faq.html">FAQ</a><a  class="logout" href="./log_out.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
                <div class="detailss">
                <div class="details_header">
                        <h1 class="header_details">My Details</h1>
                    </div> 
                    <div class="details_holder">
                        <h2>Username:<h2>
                        <h3><?php echo $_SESSION['log_user']; ?></h3>
                        <h2>Email:</h2>
                        <h3><?php echo $_SESSION['log_email']; ?></h3>
                        <h2>Phone Number:</h2>
                        <h3><?php echo $_SESSION['log_phone']; ?></h3>
                        <h2>Function:</h2>
                        <h3><?php echo $_SESSION['log_func']; ?></h3>
                        <h2>License:</h2>
                        <h3>
                            <?php 
                                if($_SESSION['log_license'] == 0) {   
                                    echo "Maintenance";
                                }else{
                                    echo "User";
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="footer">
    <div class="footer_margin">
    </div>
    </div>
    </div>
</div>

</body>
</html>
