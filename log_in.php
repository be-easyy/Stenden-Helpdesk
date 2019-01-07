<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Host = "localHost";
    $User = "root";
    $Pass = ""; // TODO change me if necessary
    $Database = "SupportDesk";
    $SQLConnect = mysqli_connect($Host, $User, $Pass);
    if(!$SQLConnect) {
        echo mysqli_error($SQLConnect);
        return;
    }
    $DBBool = mysqli_select_db($SQLConnect, $Database);
    if(!$DBBool) {
        echo mysqli_error($SQLConnect);
        $SQLQuery = "CREATE DATABASE SupportDesk";
        $stmt = mysqli_prepare($SQLConnect, $SQLQuery);
        mysqli_execute($stmt);
    }
    $DBBool = mysqli_select_db($SQLConnect, $Database);
    if(!$DBBool) {
        echo mysql_error($SQLConnect);
        return;
    }

    $user = $_POST["user"]; 
    $pass = $_POST["pass"];
    $hash = md5($pass);

    $sql = "SELECT Employee_ID FROM Employees WHERE Employee_Name = '$user' Employee_Pass = '$hash'";
    $result = mysqli_query($SQLConnect, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($result);

    if($count == 1) {
        session_register($user);
        $_SESSION['login_user'] = $user;
        
        header("location: overview.php");
        exit();
     }else {
        $sql = "SELECT * FROM Client WHERE Client_Name = '$user' Client_Pass = '$hash'";
        $result = mysqli_query($SQLConnect, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);

        if($count == 1) {
            session_register($user);
            $_SESSION['login_user'] = $user;
            
            header("location: overview_client.php");
            exit();
        } else {
            header("location: error.php");
            exit();
        }
     }
}
?>