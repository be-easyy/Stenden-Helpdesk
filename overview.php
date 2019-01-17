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
                <a href="./adminpanel.php">Admin Panel</a>
                <a href="./history_admin.php">Ticket History</a>
                <a class="open" href="./overview.php">Overview</a> 
                <a href="./edit_ticket.php">Edit Tickets</a> 
                <a href="./faq_admin.html">FAQ</a><a  class="logout" href="./log_out.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
                <div class="detailss">
                    <div class="details_header">
                        <h1 class="header_details">My Details</h1>
                    </div> 
                    <div class="details_image">     
                        <img class="profile_image" src="img/<?php echo $_SESSION['log_image']; ?>" alt="employee_image">
                    </div>  
                    <div class="details_holder">     
                        <h2>Employee ID:</h2>
                        <h3><?php echo $_SESSION['log_id']; ?></h3>
                        <h2>Username:</h2>
                        <h3><?php echo $_SESSION['log_user']; ?></h3>
                        <h2>Employee Permission:</h2>
                        <h3>
                            <?php 
                                if($_SESSION['log_permission'] == 0) {   
                                    echo "Administrator";
                                }else{
                                    echo "Employee";
                                }
                            ?>
                        </h3>
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

</body>
</html>