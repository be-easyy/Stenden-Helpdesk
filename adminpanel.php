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
    <title>Admin Panel - Stenden Support Desk</title>
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
                <a class="open" href="overview.php">Overview</a> 
                <a href="adminpanel.php">Admin Panel</a>
                <a href="faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
			<?php
    $Host = "localHost";
    $User = "root";
    $Pass = ""; // TODO change me if necessary
    $Database = "supportdesk";
    $SQLConnect = mysqli_connect($Host, $User, $Pass);

    if (!$SQLConnect) {
        echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
    } else {
        if (!mysqli_select_db($SQLConnect, $Database)) {
            echo "<p>There are no entries!</p>";
        } else {
            $TableName = "incident";
            $SQLstring = "SELECT * FROM " . $TableName;
            if ($stmt = mysqli_prepare($SQLConnect, $SQLstring)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $incidentid, $time, $client, $date, $desc, $type, $solution, $employee, $priority, $status);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "<p>There are no tickets in your name!</p>";
                } else {
                    if ($status = 1) {
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
                            echo "<td>" . $employee . "</td>";
                            echo "<td><a href='adminpanel.php?id=" . $incidentid . "'>Click</a></td></tr>";
                        }
                    }
                }
                mysqli_stmt_close($stmt);
            }
                       //mysqli_close($SQLConnect);
        }
    }
    ?>
            <?php
            //this is gonna go horribly wrong
            if (isset($_POST['submit'])) {
                if (isset($_GET['id'])) {
                    $SQLConnect = OpenDBConnection();

                    $table = "Solution";

                    $fields = array("Solution_Description");
                    $values = array($_POST['solution']);

                    $stmt = InsertDBStatement($SQLConnect, $table, $fields, $values, "s");
                    if ($stmt === false) {
                        echo "Error: Could not execute.";
                    } else {
                        $stmt->execute();
                    }


                    mysqli_select_db($SQLConnect, $Database) or die('Couldnt select db.');
                    $SQLstring = "UPDATE incident SET Solution_ID = ?, Employee_ID = ? WHERE Incident_ID = ?;";
                    if ($stmt = mysqli_prepare($SQLConnect, $SQLstring)) {
                        $stmt->bind_param('ii', intval($_POST['solution']), intval($_POST['employee']), intval($_GET['id'])); //check if id exists in db
                        if (mysqli_stmt_execute($stmt)) {
                            echo "Report changed succesfully!";
                        } else {
                            echo "Error: Could not execute.";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error: Could not prepare.";
                    }
                } else {
                    echo "No ID given!";
                }
            }

            if (isset($_GET['id'])) {
                mysqli_select_db($SQLConnect, $Database);
                $SQLstring = "SELECT * FROM incident WHERE incident_ID = ?";
                if ($stmt = mysqli_prepare($SQLConnect, $SQLstring)) {
                    $id = $_GET['id'];
                    mysqli_stmt_bind_param($stmt, 'i', $id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $incidentid, $time, $client, $date, $desc, $type, $solution, $employee, $status);
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        echo "<p>This report does not exist!</p>";
                    } else {
                        mysqli_stmt_fetch($stmt);

                        echo "<tr><td>" . $incidentid . "</td>";
                        echo "<td>" . $time . "</td>";
                        echo "<td>" . $client . "</td>";
                        echo "<td>" . $date . "</td>";
                        echo "<td>" . $desc . "</td>";
                        echo "<td>" . $type . "</td>";
                        ?>
								<h2>Change Incident</h2> 
								<form action="<?php echo htmlentities($_SERVER['PHP_SELF'] . '?id=') . $incidentid; ?>" method="POST">
									<label for="solution">solution</label>
									<input type="text" name="solution" id="solution" value="<?php echo $solution; ?>">
									
									<label for="employee">employee</label>
									<input type="number" name="employee" id="employee" value="<?php echo $employee; ?>">

									<input type="submit" name="submit" value="Submit">
								</form></tr>
	<?php

}

}
mysqli_stmt_close($stmt);
} else {
    echo "<p>ID not given!</p>";
}



mysqli_close($SQLConnect);
?>
	<p><a href="adminpanel.php">Show reports</a></p>
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