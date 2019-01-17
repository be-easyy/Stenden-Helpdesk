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
                <a href="./client_tickets.php">Your Tickets</a>
                <a href="faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            <h2>Ticket Submission - Stenden Helpdesk</h2>
        <form method="POST" action="input_ticket.php">
            <p>Description <input type="text" name="desc" maxlength="400"></p>
            <p>Type of Issue  
            <select name="issue">
            <option value="1">Technical Problem</option>
            <option value="2">Functional Problem</option>
            <option value="3">Failure</option>
            <option value="4">Question</option>
            <option value="5">Wish</option>
            </select></p>
            <p><input type="submit" name="submit" value="Submit"></p>
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
if (isset($_POST['submit'])) {
    if (empty($_POST['desc']) || empty($_POST['issue'])) {
        echo "<p>You must fill in all the required elements.
            Click your browser's back button to return to the message form.</p>";
    } else {
        $SQLConnect = OpenDBConnection();

        $id = NewSolution($SQLConnect);

        $desc = htmlentities($_POST['desc']);
        $type = htmlentities($_POST['issue']);

        $fields = array('Time_Registered', 'Client_ID', 'Date', 'Description', 'Type_ID', 'Status_ID', 'Solution_ID');
        $values = array('CURRENT_TIME', '1', 'CURRENT_DATE', $desc, $type, '1', $id); // TODO change NULL to CLient_ID

        $stmt = InsertDBStatement($SQLConnect, "Incident", $fields, $values, "isiii");
        if ($stmt != false) {
            $QueryResult2 = $stmt->execute();
            if ($QueryResult2 === false) {
                DisplayDBError($SQLConnect);
            } else {
                echo "<h1>Thank you for submitting your ticket!</h1>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "error";
        }
        CloseDBConnection($SQLConnect);
    }
}
?>

