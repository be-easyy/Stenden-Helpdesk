<?php
include("./includes/init-db.php");
include("./includes/init-session.php");
include("./includes/check-login.php");
CheckAny();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <title>User - Stenden Helpdesk</title>
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
                    <a class="open" href="./history.php">Ticket History</a> 
                    <a href="./overview_client.php">Overview</a> 
                    <a href="./client_tickets.php">Your Tickets</a>
                    <a href="./faq.html">FAQ</a>
            </div>
        </div>

        <div class="content">
            <div class="content_margin">
            <h1>All Closed Tickets</h1><br/>
<?php // TODO change type, solution, and employee in table

$SQLConnect = OpenDBConnection();

$result = SelectDBResult($SQLConnect, 'Incident', '*', 'Status', 1);

if ($result === false) {
    echo "<p>There are no tickets in your name!</p>";
} else {
    echo "<table>";
    echo "<tr><th>ID</th> <th>Time Registered</th> <th>Date</th> <th>Description</th> <th>Type</th> <th>Solution ID</th> <th>Employee ID</th></tr>";
    foreach ($result as $value) {
        echo "<tr>";
        echo "<td>" . $value["Incident_ID"] . "</td>";
        echo "<td>" . $value["Time_Registered"] . "</td>";
                    //echo "<td>" . $client . "</td>";
        echo "<td>" . $value["Date"] . "</td>";
        echo "<td>" . $value["Description"] . "</td>";
        echo "<td>" . $value["Type_ID"] . "</td>";
        echo "<td>" . $value["Solution_ID"] . "</td>";
        echo "<td>" . $value["Employee_ID"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
CloseDBConnection($SQLConnect);
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