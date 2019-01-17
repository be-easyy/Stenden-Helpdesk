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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>User - Stenden Helpdesk</title>
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
                <a class="open" href="./history_admin.php">Ticket History</a>
                <a href="./overview.php">Overview</a> 
                <a href="./edit_ticket.php">Edit Tickets</a> 
                <a href="./faq_admin.html">FAQ</a><a  class="logout" href="./log_out.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>

        <div class="content">
            <div class="content_margin">
            <h1>All Closed Tickets</h1><br/>
<?php // TODO change type, solution, and employee in table

$SQLConnect = OpenDBConnection();

$result = SelectDBResult($SQLConnect, 'Incident', '*', 'Status_ID', 5);

if ($result === false) {
    echo "<p>There are no tickets in your name!</p>";
} else {
    echo "<table>";
    echo "<tr><th></th> <th>Date</th> <th>Description</th> <th>Type</th> <th>Solution</th></tr>";
    foreach ($result as $value) {
        $link = "<a href='show_ticket.php?id=" . $value["Incident_ID"] . "'>";
        echo "<tr>";
        echo "<td>" . $link . "Open Ticket</a></td>";
                    //echo "<td>" . $client . "</td>";
        echo "<td>" . $value["Date"] . "</td>";
        echo "<td>" . $value["Description"] . "</td>";
        echo "<td>" . GetTypeName($SQLConnect, $value["Type_ID"]) . "</td>";
        echo "<td>" . GetSolutionByID($SQLConnect, $value["Solution_ID"]) . "</td>";
        echo "</a></tr>";
    }
    echo "</table>";
}
CloseDBConnection($SQLConnect);
?>
            </div>
        </div>
    </div>

    <div class="footer">
    </div>
        <div class="footer_margin">
        </div>
    </div>
</div>
</body>
</html>