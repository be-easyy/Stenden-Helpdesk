<?php
$Host = "localHost";
$User = "root";
$Pass = ""; // TODO change me if necessary
$Database = "SupportDesk";
$SQLConnect = mysqli_connect($Host, $User, $Pass);
if (!$SQLConnect) {
    echo $SQLConnect->error;
    return;
}
$DBBool = mysqli_select_db($SQLConnect, $Database);
if (!$DBBool) {
    echo $SQLConnect->error;
    $SQLQuery = "CREATE DATABASE SupportDesk";
    $stmt = $SQLConnect->prepare($SQLQuery);
    $stmt->execute();
    $stmt->close();
}
$DBBool = mysqli_select_db($SQLConnect, $Database);
if (!$DBBool) {
    echo mysql_error($SQLConnect);
    return;
}
$SQLQuery = "DESCRIBE Incident";
$result = $SQLConnect->query("select * from Type");
if (!$result) {
    echo "<h1>PLEASE REFRESH THE PAGE</h1><hr>database initialized";
    $queries = array(
        "CREATE TABLE `Incident` (
                `Incident_ID` INT NOT NULL AUTO_INCREMENT,
                `Client_ID` INT NOT NULL,
                `Time_Registered` TIME NOT NULL,
                `Date` DATE NOT NULL,
                `Description` varchar(2000) NOT NULL,
                `Type_ID` INT NOT NULL,
                `Solution_ID` INT,
                `Employee_ID` INT,
                `Priority` INT,
                `Status_ID` INT,
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
                `Employee_Image` varchar(60) NOT NULL,
                `Employee_Pass` varchar(40) NOT NULL,
                `Employee_Permission` INT NOT NULL,
                PRIMARY KEY (`Employee_ID`)
            );",
        "CREATE TABLE `Solution` (
                `Solution_ID` INT NOT NULL AUTO_INCREMENT,
                `Solution_Description` varchar(1000) NOT NULL,
                PRIMARY KEY (`Solution_ID`)
            );",
        "CREATE TABLE `Status` (
                `Status_ID` INT NOT NULL,
                `Status_Description` varchar(300) NOT NULL,
                PRIMARY KEY (`Status_ID`)
            );",
        "CREATE TABLE `Client` (
                `Client_ID` INT NOT NULL AUTO_INCREMENT,
                `Client_Name` varchar(30) NOT NULL,
                `Client_Phone` varchar(20) NOT NULL,
                `Client_Pass` varchar(40) NOT NULL,
                `Client_Email` varchar(50) NOT NULL,
                `Client_Function` varchar(30) NOT NULL,
                `Client_License` INT NOT NULL,
                PRIMARY KEY (`Client_ID`)
            );",
        "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk0` FOREIGN KEY (`Client_ID`) REFERENCES `Client`(`Client_ID`);",
        "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk1` FOREIGN KEY (`Type_ID`) REFERENCES `Type`(`Type_ID`);",
        "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk2` FOREIGN KEY (`Solution_ID`) REFERENCES `Solution`(`Solution_ID`);",
        "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk3` FOREIGN KEY (`Status_ID`) REFERENCES `Status`(`Status_ID`);",
        "ALTER TABLE `Incident` ADD CONSTRAINT `Incident_fk4` FOREIGN KEY (`Employee_ID`) REFERENCES `Employee`(`Employee_ID`);"
    );

    foreach ($queries as $SQLQuery) {
        $stmt = $SQLConnect->prepare($SQLQuery);
        if ($stmt) {
            $stmt->execute();
        } else {
            echo $SQLConnect->error;
            return;
        }
    }

    // Create employee accounts

    $queryy = "SELECT * FROM `Employee` WHERE `Employee_Name` = 'admin'"; // TODO remove when ready with testing
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {
        $pass = md5("admin");

        $query = "INSERT INTO `Employee` (Employee_Name, Employee_Image, Employee_Pass, Employee_Permission)
        VALUES ('admin',
        'boss.jpg',
        '$pass',
        '0')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Employee` WHERE `Employee_Name` = 'employee1'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {
        $pass = md5("qwerty");

        $query = "INSERT INTO `Employee` (Employee_Name, Employee_Image, Employee_Pass, Employee_Permission)
        VALUES ('employee1',
        'employee1.png',
        '$pass',
        '1')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Employee` WHERE `Employee_Name` = 'employee2'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {
        $pass = md5("qwerty");

        $query = "INSERT INTO `Employee` (Employee_Name, Employee_Image, Employee_Pass, Employee_Permission)
        VALUES ('employee2',
        'employee2.png',
        '$pass',
        '1')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Client` WHERE `Client_Name` = 'dummy'"; // TODO remove when ready with testing
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {
        $pass = md5("dummy");

        $query = "INSERT INTO `Client` (Client_Name, Client_Pass, Client_Phone, Client_Email, Client_Function, Client_License)
        VALUES ('dummy',
        '$pass',
        '+9874123698412',
        'dummy@yoink.com',
        'Boss',
        '0')";

        $SQLConnect->query($query);
    }

    // Create status types

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '1'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('1','open')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '2'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('2','pending')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '3'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('3','forward to engineer')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '4'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('4','forward to account manager')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '5'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('5','closed')";


        $SQLConnect->query($query);
    }

    // Create type IDs

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '1'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('1','Technical Problem')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '2'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('2','Functional Problem')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '3'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('3','Failure')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '4'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('4','Question')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Type` WHERE `Type_ID` = '5'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `Type` (Type_ID, Type_Name)
        VALUES ('5','Wish')";

        $SQLConnect->query($query);
    }

    // Create solution IDs

    $queryy = "SELECT * FROM `Solution` WHERE `Solution_ID` = '1'";
    $res = $SQLConnect->query($queryy);
    if ($res->num_rows != 1) {

        $query = "INSERT INTO `Solution` (Solution_ID, Solution_Description)
        VALUES ('1','Some Solution')";

        $SQLConnect->query($query);
    }

    $SQLConnect->close();
}

    // ============================================================================
    // ============================================================================
    // ============================================================================
    // ============================================================================
    // ============================================================================
    // ============================================================================
    // FUNCTIONS HERE =============================================================
    // ============================================================================
    // ============================================================================
    // ============================================================================
    // ============================================================================
    // ============================================================================
    // ============================================================================


function OpenDBConnection($host = "localhost", $user = "root", $pass = "", $database = "SupportDesk")
{
    $SQLConnect = mysqli_connect($host, $user, $pass, $database);
    if ($SQLConnect == false) {
        echo "OpenDBConnection:::DATABASE ERROR";
        return false;
    }
    return $SQLConnect;
}

function CloseDBConnection($SQLConnect)
{
    if (!isset($SQLConnect) || $SQLConnect == false) {
        echo "CloseDBConnection:::DATABASE ERROR";
        return false;
    }
    $SQLConnect->close();
}

function InsertDBStatement($SQLConnect, $table, $fields, $values, $types)
{
    if (!ValidateTable($table, $fields)) {
        return false;
    }
    if (count($fields) != count($values)) {
        echo "InsertDBStatement:::FIELDS AND VALUES MUST BE THE SAME NUMBER";
        return false;
    }


    $SQLQuery = "INSERT INTO $table " . ArrayToFields($fields);
    $inserts = array();
    $counter = 1;
    foreach ($values as $value) {
        if ($value == "CURRENT_TIME") {
            $SQLQuery .= "CURRENT_TIME";
        } elseif ($value == "CURRENT_DATE") {
            $SQLQuery .= "CURRENT_DATE";
        } elseif ($value == "NULL") {
            $SQLQuery .= "NULL";
        } else {
            $SQLQuery .= "?";
            array_push($inserts, $value);
        }

        if ($counter != count($values))
            $SQLQuery .= ", ";
        $counter++;
    }

    $SQLQuery .= ");";

    if ($stmt = $SQLConnect->prepare($SQLQuery)) {
        $stmt->bind_param($types, ...$inserts);
        return $stmt;
    } else {
        echo "InsertDBStatement:::YOU SHOULD NEVER SEE THIS ERROR";
    }

}

function SelectDBResult($SQLConnect, $table, $fields, $where_field = null, $where_val = null)
{
    if (!ValidateTable($table)) {
        return false;
    }

    if ($where_field != null && $where_val != null && strpos($table, " ") === false) {
        if (!ValidateFields($table, array($where_field))) {
            return false;
        }
    }

    $SQLQuery = "SELECT ";
    if ($fields == "*") {
        $SQLQuery .= "*";
    } else {
        $counter = 1;
        foreach ($fields as $field) {
            $SQLQuery .= $field;

            if ($counter != count($fields))
                $SQLQuery .= ", ";
            $counter++;
        }
    }
    $SQLQuery .= " FROM " . $table;
    if ($where_field != null && $where_val != null) {
        $SQLQuery .= " WHERE `" . $where_field . "` = '" . $where_val . "'"; // TODO security
    }
    $stmt = $SQLConnect->prepare($SQLQuery);
    if ($stmt == false) {
        echo "SelectDBResult:::SQL QUERY INCORRECT";
        echo "<br><br>QUERY:::" . $SQLQuery . "<br><br>";
        return false;
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows < 1) {
        return false;
    }

    $data = array();
    while ($res = $result->fetch_assoc()) {
        array_push($data, $res);
    }
    $stmt->close();
    return $data;
}

function ArrayToFields($fields)
{
    $start = "(";
    $main = "";
    $end = ") VALUES (";
    $counter = 1;
    foreach ($fields as $field) {
        $main .= $field;
        if ($counter != count($fields))
            $main .= ", ";
        $counter++;
    }

    return $start . $main . $end;
}

function ValidateTable($table, $fields = null)
{
    echo strpos($table, " ");
    if (strpos($table, " ") === false) {
        $_TABLES = array("Incident", "Type", "Employee", "Client", "Solution");

        $selected = "";
        foreach ($_TABLES as $value) {
            if ($value == $table) {
                if ($fields != null)
                    return ValidateFields($table, $fields);
                else
                    return true;
            }
        }
        echo "ValidateTable:::TABLE (" . $table . ") CANNOT BE VALIDATED";
        return false;
    } else {
        return true;
    }
}

function ValidateFields($table, $fields)
{
    $incident = array('Incident_ID', 'Client_ID', 'Time_Registered', 'Date', 'Description', 'Type_ID', 'Solution_ID', 'Employee_ID', 'Status_ID');
    $type = array('Type_ID', 'Type_Name');
    $employee = array('Employee_ID', 'Employee_Name', 'Employee_Image', 'Employee_Pass', 'Employee_Permission');
    $client = array('Client_ID', 'Client_Name', 'Client_Pass', 'Client_License');
    $solution = array('Solution_ID', 'Solution_Description');

    $_FIELDS = array('Incident' => $incident, 'Type' => $type, 'Employee' => $employee, 'Client' => $client, 'Solution' => $solution);

    $_selected = $_FIELDS[$table];


    foreach ($fields as $field) {
        $validated = false;
        foreach ($_selected as $_field) {
            if ($field == $_field) {
                $validated = true;
            }
        }
        if (!$validated) {
            echo "ValidateFields:::FIELD (" . $field . ") CANNOT BE VALIDATED";
            echo "<br>";
            var_dump($fields);
            echo "<br>";
            var_dump($_selected);
            return false;
        }
    }
    return true;
}

function DisplayDBError($SQLConnect)
{
    echo "<p>Unable to execute the query.</p>"
        . "<p>Error "
        . $SQLConnect->errno
        . ": "
        . $SQLConnect->error
        . "</p>";
}

function NewSolution($SQLConnect)
{
    $table = "Solution";
    $fields = array("Solution_Description");
    $values = array("this is a random string to help with DB initialization");
    $stmt = InsertDBStatement($SQLConnect, $table, $fields, $values, "s");

    $stmt->execute();

    $query = "SELECT `Solution_ID` FROM Solution WHERE `Solution_Description` = 'this is a random string to help with DB initialization'";
    $stmt = $SQLConnect->prepare($query);

    $stmt->execute();
    $tmp = $stmt->get_result();
    $id = $tmp->fetch_assoc()["Solution_ID"];

    InitSolution($SQLConnect, $id);

    return $id;
}

function InitSolution($SQLConnect, $id)
{
    $query = "UPDATE Solution SET Solution_Description = '' WHERE Solution_ID = '$id'";
    $SQLConnect->query($query);
}

function GetSolutionByID($SQLConnect, $ID)
{
    $result = SelectDBResult($SQLConnect, "Solution", array("Solution_Description"), "Solution_ID", $ID);
    if ($result === false) {
        echo $SQLConnect->error;
        return false;
    } else {
        return $result[0]["Solution_Description"];
    }
    return false;
}

function GetTypeName($SQLConnect, $ID)
{
    $result = SelectDBResult($SQLConnect, "Type", array("Type_Name"), "Type_ID", $ID);
    if ($result === false) {
        echo $SQLConnect->error;
        return false;
    } else {
        return $result[0]["Type_Name"];
    }
    return false;
}

function GetEmployeeByID($SQLConnect, $ID) {
    $result = SelectDBResult($SQLConnect,
        "Employee",
        array("Employee_Name", "Employee_Image"),
        "Employee_ID",
        $ID
    );
    if ($result === false) {
        echo $SQLConnect->error;
        return false;
    } else {
        $res = array($result[0]["Employee_Name"], $result[0]["Employee_Image"]);
        return $res;
    }
    return false;
}
?>