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
        "CREATE TABLE `Status` (
                `Status_ID` INT NOT NULL,
                `Status_Description` varchar(300) NOT NULL,
                PRIMARY KEY (`Status_ID`)
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
}

    // Create employee accounts

$queryy = "SELECT * FROM `Employee` WHERE `Employee_Name` = 'admin'"; // TODO remove when ready with testing
$res = $SQLConnect->query($queryy);
if ($res->num_rows != 1) {
    $pass = md5("admin");

    $query = "INSERT INTO `Employee` (Employee_Name, Employee_Image, Employee_Pass, Employee_Permission)
        VALUES ('admin',
        'http://picsum.photos/192/192?random',
        '$pass',
        '0')";

    $SQLConnect->query($query);
}

$queryy = "SELECT * FROM `Client` WHERE `Client_Name` = 'dummy'"; // TODO remove when ready with testing
$res = $SQLConnect->query($queryy);
if ($res->num_rows != 1) {
    $pass = md5("dummy");

    $query = "INSERT INTO `Client` (Client_Name, Client_Pass, Client_License)
        VALUES ('dummy',
        '$pass',
        '0')";

    $SQLConnect->query($query);
}

    // Create status types

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '1'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('1','open')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '2'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query =  "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('2','pending')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '3'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query =  "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('3','forward to engineer')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '4'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

        $query = "INSERT INTO `status` (Status_ID, Status_Description)
        VALUES ('4','forward to account manager')";

        $SQLConnect->query($query);
    }

    $queryy = "SELECT * FROM `Status` WHERE `Status_ID` = '5'";
    $res = $SQLConnect->query($queryy);
    if($res->num_rows != 1) {

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

    // FUNCTIONS HERE ===================

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
//$query = "INSERT INTO $table (Time_Registered, Client_ID, Date, Description, Type_ID, Other) VALUES (CURRENT_TIME, NULL, CURRENT_DATE, ?, ?, NULL, NULL, NULL)";
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

    if($where_field != null && $where_val != null) {
        if(!ValidateFields($table, array($where_field))) {
            return false;
        }
    }

    $SQLQuery = "SELECT ";
    if($fields == "*") {
        $SQLQuery .= "*";
    } else {
        $counter = 1;
        foreach ($fields as $field) {
            $SQLQuery .= $field;

            if($counter != count($fields))
                $SQLQuery .= ", ";
            $counter++;
        }
    }
    $SQLQuery .= "FROM " . $table;
    if($where_field != null && $where_val != null) {
        $SQLQuery .= " WHERE `" . $where_field . "` = '" . $where_val . "'"; // TODO security
    }
    $stmt = $SQLConnect->prepare($SQLQuery);
    if($stmt == false) {
        echo "SelectDBResult:::SQL QUERY INCORRECT";
        return false;
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows < 1) {
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
}

function ValidateFields($table, $fields)
{
    $incident = array('Incident_ID', 'Client_ID', 'Time_Registered', 'Date', 'Description', 'Type_ID', 'Solution_ID', 'Employee_ID', 'Status');
    $type = array('Type_ID', 'Type_Name');
    $employee = array('Employee_ID', 'Employee_Name', 'Employee_Image', 'Employee_Pass', 'Employee_Permission');
    $client = array('Client_ID', 'Client_Name', 'Client_Pass', 'Client_License');
    $solution = array('Solution_ID', 'Solution_Description');

    $_FIELDS = array('Incident' => $incident, 'Type' => $type, 'Employee' => $employee, 'Client' => $client, 'Solution', $solution);

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
?>