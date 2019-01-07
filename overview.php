<?php
    include("includes/init-db.php");
    include("includes/init-session.php");
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
                <a class="open" href="#">Overview</a> 
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            
<?php
$Host = "localHost";
$User = "root";
$Pass = ""; // TODO change me if necessary
$Database = "SupportDesk";
$SQLConnect = mysqli_connect($Host, $User, $Pass);

if (!$SQLConnect) {
    echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
} else {
    if (!mysqli_select_db($SQLConnect, $Database)) {
        echo "<p>There are no entries!</p>";
    } else {
        $TableName = "Incident";
        $SQLstring = "SELECT * FROM" . $TableName." WHERE Client_ID = (SELECT Client_ID FROM Client WHERE Client_Name = '$User')";
        if ($stmt = mysqli_prepare($SQLConnect, $SQLstring)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $incidentid, $time, $client, $date, $desc, $type, $other, $solution, $employee);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "<p>There are no survey entries</p>";
            } else {
                echo "<table width='100%' border='1' style='text-align:center;'>";
                echo "<tr><th>Incident_ID</th> <th>Time Registered</th> <th>Client ID</th> <th>Date</th> <th>Description</th> <th>Type ID</th> <th>Other</th> <th>Solution ID</th> <th>Employee ID</th></tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $incidentid . "</td>";
                    echo "<td>" . $time . "</td>";
                    echo "<td>" . $client . "</td>";
                    echo "<td>" . $date . "</td>";
                    echo "<td>" . $desc . "</td>";
                    echo "<td>" . $type . "</td>";
                    echo "<td>" . $other . "</td>";
                    echo "<td>" . $solution . "</td>";
                    echo "<td>" . $employee . "</td></tr>";
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