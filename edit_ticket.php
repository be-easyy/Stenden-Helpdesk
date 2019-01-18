<?php
    include("./includes/init-db.php");
    include("./includes/init-session.php");
    include("./includes/check-login.php");
    CheckEmployee();
    $error = NULL;
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
                <a href="adminpanel.php">Admin Panel</a>
                <a href="history.php">Ticket History</a>
                <a href="overview.php">Overview</a> 
                <a class="open" href="edit_ticket.php">Edit Tickets</a> 
                <a href="faq_admin.html">FAQ</a><a  class="logout" href="./log_out.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
                <form method='POST' action='<?php htmlentities($_SERVER['PHP_SELF'])?>'>
                    <textarea name='sol'>
                        <?php
                            if($db = new PDO('mysql:host=localhost;dbname=supportdesk;charset=utf8', 'root', '')){
                                if($stmt=$db->prepare('SELECT solution_description FROM solution WHERE solution_ID = ?')){
                                    if($stmt->execute(array(htmlentities($_GET['id'])))){
                                        $solution = $stmt->fetchAll();
                                        //var_dump($solution);
                                        foreach($solution as $sth){
                                            echo $solution[0][0];
                                        }
                                    } else {echo'could not execute';}
                                }else{echo'could not prepare';}
                            }//else{echo'could not connect to database';}
                        ?>
                    </textarea>
                    <input type="submit" name="submit">
                </form>
                <?php
                    if (isset($_POST['submit'])){
                        //if(!empty($_POST['sol'])){
                            if($db = new PDO('mysql:host=localhost;dbname=supportdesk;charset=utf8', 'root', '')){
                                if($stmt=$db->prepare('UPDATE solution, SET solution_description = ? WHERE solution_ID = ?')){
                                    if($stmt->execute(array(htmlentities($_POST['sol']), htmlentities($_GET['id'])))){
                                        echo 'successfully updated ticket';
                                        $stmt = NULL;
                                        $db = NULL;
                                    }$error = 'could not execute';
                                }$error = 'could not prepare';
                            }$error = 'could not connect to database';
                        //}$error = 'please fill in a solution';
                    }
                    echo $error;
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