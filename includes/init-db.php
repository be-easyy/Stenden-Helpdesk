<?php
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
    $SQLQuery = "DESCRIBE Incident";
    $result = mysqli_query($SQLConnect, "select * from Type");
    if(!$result) {
        echo "<h1>PLEASE REFRESH THE PAGE</h1><hr>database initialized";
        $queries = array(
            "CREATE TABLE `Incident` (
                `Incident_ID` INT NOT NULL,
                `Client_ID` INT NOT NULL,
                `Time_Registered` TIME NOT NULL,
                `Date` DATE NOT NULL,
                `Description` varchar(280) NOT NULL,
                `Type_ID` INT NOT NULL,
                `Solution_ID` INT,
                `Employee_ID` INT,
                `Status` TINYINT,
                PRIMARY KEY (`Incident_ID`,`Time_Registered`)
            );",
            "CREATE TABLE `Type` (
                `Type_ID` INT NOT NULL AUTO_INCREMENT,
                `Type_Name` varchar(30) NOT NULL,
                PRIMARY KEY (`Type_ID`)
            );",
            "CREATE TABLE `Employee` (
                `Employee_ID` INT NOT NULL AUTO_INCREMENT,
                `Employee_Name` varchar(30) NOT NULL,
                `Employee_Image` varchar(30) NOT NULL,
                `Employee_Pass` varchar(40) NOT NULL,
                `Employee_Permission` INT NOT NULL,
                PRIMARY KEY (`Employee_ID`)
            );",
            "CREATE TABLE `Solution` (
                `Solution_ID` INT NOT NULL AUTO_INCREMENT,
                `Solution_Description` varchar(300) NOT NULL,
                PRIMARY KEY (`Solution_ID`)
            );",
            "CREATE TABLE `Client` (
                `Client_ID` INT NOT NULL AUTO_INCREMENT,
                `Client_Name` varchar(30) NOT NULL,
                `Client_Pass` varchar(40) NOT NULL,
                `Client_License` INT NOT NULL,
                PRIMARY KEY (`Client_ID`)
            );",
            "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk0` FOREIGN KEY (`Client_ID`) REFERENCES `Client`(`Client_ID`);",
            "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk1` FOREIGN KEY (`Type_ID`) REFERENCES `Type`(`Type_ID`);",
            "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk2` FOREIGN KEY (`Solution_ID`) REFERENCES `Solution`(`Solution_ID`);",
            "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk3` FOREIGN KEY (`Employee_ID`) REFERENCES `Employee`(`Employee_ID`);"
        );
        
        foreach ($queries as $SQLQuery) {
            $stmt = mysqli_prepare($SQLConnect, $SQLQuery);
            if($stmt) {
                mysqli_execute($stmt);
            } else {
                echo mysqli_error($SQLConnect);
                return;
            }
        }
    }

    // Create employee accounts

    $queryy = "SELECT * FROM `Employee` WHERE `Employee_Name` = 'admin'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {
        $pass = md5("admin");

        $query = "INSERT INTO `Employee` (Employee_Name, Employee_Image, Employee_Pass, Employee_Permission)
        VALUES ('admin',
        'http://picsum.photos/192/192?random',
        '$pass',
        '0')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Client` WHERE `Client_Name` = 'dummy'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {
        $pass = md5("dummy");
        
        $query = "INSERT INTO `Client` (Client_Name, Client_Pass, Client_License)
        VALUES ('dummy',
        '$pass',
        '0')";

        $SQLConnect->query($query);
    }
    
    $queryy = "SELECT * FROM `Employee` WHERE `Employee_Name` = 'employee1'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) 
        {
        $pass = md5("qwerty");

        $query = "INSERT INTO `Employee` (Employee_Name, Employee_Image, Employee_Pass, Employee_Permission)
        VALUES ('employee1',
        'http://picsum.photos/192/192?random',
        '$pass',
        '2')";
         }
        
    $queryy = "SELECT * FROM `Employee` WHERE `Employee_Name` = 'employee2'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1)
        {
        $pass = md5("qwerty");

        $query = "INSERT INTO `Employee` (Employee_Name, Employee_Image, Employee_Pass, Employee_Permission)
        VALUES ('employee2',
        'http://picsum.photos/192/192?random',
        '$pass',
        '2')";
        }

        $SQLConnect->query($query);

    // Create type IDs

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '1'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('1','Technical Problem')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '2'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('2','Functional Problem')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '3'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('3','Failure')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '4'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('4','Question')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '5'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('5','Wish')";

        $SQLConnect->query($query);
    }

    // Create solution IDs

    $queryy = "SELECT * FROM `Solution` WHERE `Solution_ID` = '1'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `Solution` (Solution_ID, Solution_Description)
        VALUES ('1','Some Solution')";

        $SQLConnect->query($query);
    }

    mysqli_close($SQLConnect);
?>