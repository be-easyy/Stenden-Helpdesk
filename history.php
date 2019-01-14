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
                    <a href="input_ticket.php">New Ticket</a> 
                    <a class="open" href="history.php">Ticket History</a> 
                    <a href="overview_client.php">Overview</a> 
                    <a href="#">Your Tickets</a>
                    <a href="faq.html">FAQ</a>
            </div>
        </div>

        <div class="content">
            <div class="content_margin">
            <h1>All Closed Tickets</h1><br/>
<?php

$Host = "localHost";
$User = "root";
$Pass = ""; // TODO change me if necessary
$Database = "supportDesk";
$SQLConnect = mysqli_connect($Host, $User, $Pass);

if (!$SQLConnect) {
    echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
} else {
    if (!mysqli_select_db($SQLConnect, $Database)) {
        echo "<p>There are no entries!</p>";
    } else {
        $TableName = "incident";
        $SQLstring = "SELECT * FROM ". $TableName;
        if ($stmt = mysqli_prepare($SQLConnect, $SQLstring)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $incidentid, $client, $time, $date, $desc, $type, $solution, $employee, $status);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "<p>There are no tickets in your name!</p>";
            } else {
                if ($status = 0){
                echo "<table>";
                echo "<tr><th>Incident</th> <th>Time</th> <th>Client</th> <th>Date</th> <th>Description</th> <th>Type</th> <th>Solution</th> <th>Employee</th></tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $incidentid . "</td>";
                    echo "<td>" . $time . "</td>";
                    echo "<td>" . $client . "</td>";
                    echo "<td>" . $date . "</td>";
                    echo "<td>" . $desc . "</td>";
                    echo "<td>" . $type . "</td>";
                    echo "<td>" . $solution . "</td>";
                    echo "<td>" . $employee . "</td></tr>";
                }
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($SQLConnect);
    }
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