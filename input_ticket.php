<?php
    include("./includes/init-db.php");
    include("./includes/init-session.php");
    include("./includes/check-login.php");
    CheckClient();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <title>Ticket Submission - Stenden Helpdesk</title>
    </head>
    <body>
    <div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
            <img id="logo" src="img/logo.png" alt="Logo">
            </div>
            <div class="navbar">
                <a class="open" href="input_ticket.php">New Ticket</a> 
                <a href="history.php">Ticket History</a> 
                <a href="overview_client.php">Overview</a> 
                <a href="#">Your Tickets</a>
                <a href="faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            <h2>Ticket Submission - Stenden Helpdesk</h2>
        <form method="POST" action="input_ticket.php">
            <p>Description <input type="text" name="desc"/></p>
            <p>Type of Issue  
            <select name="issue">
            <option value="tech">Technical Problem</option>
            <option value="func">Functional Problem</option>
            <option value="fail">Failure</option>
            <option value="question">Question</option>
            <option value="wish">Wish</option>
            </select></p>
            <p><input type="submit" value="Submit"></p>
        </form>
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

<?php
    if(!isset($_POST['submit'])){
    
    if (empty($_POST['desc']) || empty($_POST['issue'])) {
        echo "<p>You must fill in all the required elements.
            Click your browser's back button to return to the message form.</p>";
    } else {
        include ("includes/init-db.php");

        mysqli_select_db($DBConnect, $db_name);

        $desc = htmlentities($_POST['desc']);
        $type = htmlentities($_POST['issue']);

        $SQLstring2 = "";

        if ($stmt = mysqli_prepare($DBConnect, $SQLstring2)) {
            mysqli_stmt_bind_param($stmt, 'ss', $desc, $type);
            $QueryResult2 = mysqli_stmt_execute($stmt);
            if ($QueryResult2 === FALSE) {
                echo "<p>Unable to execute the query.</p>"
                . "<p>Error code "
                . mysqli_errno($DBConnect)
                . ": "
                . mysqli_error($DBConnect)
                . "</p>";
            } else {
                echo "<h1>Thank you for submitting your ticket!</h1>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "error";
        }
        mysqli_close($DBConnect);
    }
}
?>

