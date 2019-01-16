<?php
include("./includes/init-db.php");
include("./includes/init-session.php");
include("./includes/check-login.php");
CheckClient();

if (!isset($_GET["id"])) {
    header("Location: ./client_tickets.php");
    exit();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
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
                        <a href="./input_ticket.php">New Ticket</a> 
                        <a href="./history.php">Ticket History</a> 
                        <a href="./overview_client.php">Overview</a> 
                        <a href="./client_tickets.php">Your Tickets</a>
                        <a href="./faq.html">FAQ</a>
                    </div>
                </div>
                <div class="content">
                    <div class="content_margin">
                    <h2>Ticket No. <?php echo $_GET["id"] ?> - Stenden Helpdesk</h2>
                    <hr>
                    <h5>
                        <?php
                            $SQLConnect = OpenDBConnection();
                            $query = "SELECT
                            i.Time_Registered, i.Date, i.Description, t.Type_Name, i.Status_ID, s.Solution_Description
                            FROM Incident i
                            INNER JOIN Type t ON i.Type_ID = t.Type_ID
                            INNER JOIN Solution s ON i.Solution_ID = s.Solution_ID
                            WHERE i.Incident_ID = ?";
                            $stmt = $SQLConnect->prepare($query);
                            $stmt->bind_param("i", $_GET["id"]);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $res = $result->fetch_assoc();
                            $stmt->close();
                            CloseDBConnection($SQLConnect);
                            $status = "<i class='far fa-square'></i> Open";
                            if($res["Status_ID"] == 2)
                                $status = "<i class='far fa-minus-square'></i> Pending";
                                if($res["Status_ID"] == 3)
                                $status = "<i class='far fa-caret-square-up'></i> Forward to engineer";
                                if($res["Status_ID"] == 4)
                                $status = "<i class='far fa-caret-square-up'></i> Forward to account manager";
                                if($res["Status_ID"] == 5)
                                $status = "<i class='far fa-check-square'></i> Closed";
                            echo $status . " " . $res["Time_Registered"] . " " . $res["Date"];
                        ?>
                    </h5>
                    <?php
                        echo "<br><br><b>Type:</b><hr class='line'>" . $res["Type_Name"];
                        echo "<br><br><b>Description:</b><hr class='line'>" . $res["Description"];
                        echo "<br><br><br><b>Solution:</b><hr class='line'>" . $res["Solution_Description"];
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
