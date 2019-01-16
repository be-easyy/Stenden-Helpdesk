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
            <img id="logo" src="img/logo.png" alt="Logo">
            </div>
            <div class="navbar">
                <a href="input_ticket.php">New Ticket</a> 
                <a href="history.php">Ticket History</a> 
                <a href="overview_client.php">Overview</a> 
                <a class="open" href="client_tickets.php">Your Tickets</a>
                <a href="faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            
<?php // TODO change type, and employee in table

$SQLConnect = OpenDBConnection();

$result = SelectDBResult($SQLConnect, "Incident", "*", "Client_ID", "1");

if($result === false) {
    echo "<p>There are no entries!</p>";
} else {
    echo "<table>";
    echo "<tr><th>ID</th> <th>Time Registered</th> <th>Date</th> <th>Description</th> <th>Type</th> <th>Solution</th> <th>Employee ID</th></tr>";
    foreach ($result as $value) {
        $link = "<a href='show_ticket.php?id=" . $value["Incident_ID"] . "'>";
        echo "<tr>";
        echo "<td>" . $link . "Open Ticket</a></td>";
        echo "<td>" . $value["Time_Registered"] . "</td>";
                    //echo "<td>" . $client . "</td>";
        echo "<td>" . $value["Date"] . "</td>";
        echo "<td>" . $value["Description"] . "</td>";
        echo "<td>" . GetTypeName($SQLConnect, $value["Type_ID"]) . "</td>";
        echo "<td>" . GetSolutionByID($SQLConnect, $value["Solution_ID"]) . "</td>";
        echo "<td>" . $value["Employee_ID"] . "</td>";
        echo "</a></tr>";
    }
}
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