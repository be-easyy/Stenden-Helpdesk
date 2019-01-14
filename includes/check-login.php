<?php

//var_dump($_SESSION);

$debug = true;

function CheckEmployee() {
    if (isset($_SESSION["log_type"])) {
        switch ($_SESSION["log_type"]) {
            case 1:
                CheckLogin("Employee", "Employee_Name");
                break;
            default:
                // no type set in sessions
                //$_SESSION["log_type"]
                if(!$debug) {
                    deleteSession();
                    header("Location: index.php");
                    exit();
                }
                echo "no type set in sessions";
                break;
        }
    }
}

function CheckClient() {
    if (isset($_SESSION["log_type"])) {
        switch ($_SESSION["log_type"]) {
            case 2:
                CheckLogin("Client", "Client_Name");
                break;
            default:
                // no type set in sessions
                //$_SESSION["log_type"]
                if(!$debug) {
                    deleteSession();
                    header("Location: index.php");
                    exit();
                }
                echo "no type set in sessions";
                break;
        }
    }
}

function CheckAny() {
    if (isset($_SESSION["log_type"])) {
        switch ($_SESSION["log_type"]) {
            case 1:
                CheckLogin("Employee", "Employee_Name");
                break;
            case 2:
                CheckLogin("Client", "Client_Name");
                break;
            default:
                // no type set in sessions
                //$_SESSION["log_type"]
                if(!$debug) {
                    deleteSession();
                    header("Location: index.php");
                    exit();
                }
                echo "no type set in sessions";
                break;
        }
    }
}

function CheckLogin($table, $name)
{
    if (isset($_SESSION["log_user"])) {
        $tmp_connection = mysqli_connect("localhost", "root", "", "SupportDesk");

        $query = "SELECT `$name` FROM `$table`";
        if($tmp_stmt = $tmp_connection->prepare($query)) {
            $tmp_stmt->execute();
            while ($value = $tmp_stmt->fetch()) {
                if ($value == md5($_SESSION["log_user"]))
                    return true;
            }
            $tmp_stmt->close();
            // user has not been found in the database
            if(!$debug) {
                deleteSession();
                header("Location: index.php");
                exit();
            }
            echo "no user in database";
        } else {
            // SQL statement is incorrect
            if(!$debug) {
                deleteSession();
                header("Location: index.php");
                exit();
            }
            echo "wrong SQL statement";
        }
        $tmp_connection->close();
    } else {
        // user is not set in session
        // $_SESSION["log_user"]
        if(!$debug) {
            deleteSession();
            header("Location: index.php");
            exit();
        }
        echo "no user set in sessions";
    }
}

function deleteSession() {
    if(isset($_SESSION["log_user"]))
        unset($_SESSION["log_user"]);

    if(isset($_SESSION["log_type"]))
        unset($_SESSION["log_type"]);
}

?>