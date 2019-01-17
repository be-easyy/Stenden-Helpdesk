<?php

include "../includes/init-db.php";

if (!isset($_POST["submit"])) {
    header("Location: ../log_in.php");
    exit();
}

if (!isset($_POST["em_name"]) && !isset($_POST["em_pass"]) && !isset($_FILES["image"])) {
    header("Location: ../adminpanel.php?error=1");
    exit();
}

if (empty($_POST["em_name"]) && empty($_POST["em_pass"]) && empty($_FILES["image"])) {
    header("Location: ../adminpanel.php?error=1");
    exit();
}

if(isset($_POST["user"]) && $_POST["user"] == "new") {
    if(isset($_POST["em_name"]) && strlen($_POST["em_name"]) > 3
        && isset($_POST["em_pass"]) && strlen($_POST["em_pass"]) > 3
        && isset($_FILES["image"]) && !empty($_FILES["image"]) && strlen($_FILES["image"]["name"]) > 1) {
        $SQLConnect = OpenDBConnection();
        $pass = md5($_POST["em_pass"]);
        $stmt = InsertDBStatement(
            $SQLConnect,
            "Employee",
            array(
                "Employee_Name",
                "Employee_Pass",
                "Employee_Image",
                "Employee_Permission"
            ),
            array(
                $_POST["em_name"],
                $pass,
                GetImagePath($_FILES["image"]),
                "1"
            ),
            "sssi"
        );
        $stmt->execute();
        $stmt->close();
        CloseDBConnection($SQLConnect);
        header("Location: ../adminpanel.php?error=0");
        exit();
    } else {
        header("Location: ../adminpanel.php?error=3");
        exit();
    }
}

if (!empty($_FILES["image"])) {
    SaveImage($_FILES["image"], $_POST["user"]);
}
if (!empty($_POST["em_name"])) {
    SaveName($_POST["em_name"], $_POST["user"]);
}
if (!empty($_POST["em_pass"])) {
    SavePass($_POST["em_pass"], $_POST["user"]);
}

header("Location: ../adminpanel.php?error=0");
exit();

// functions below ===================

function GetImagePath($image) {
    $target_file = basename($image["name"]);
    $uploadOk = 1;
    if (isset($_POST["submit"])) {
        $tmp = mime_content_type($image["tmp_name"]);
        $check = in_array($tmp, array("image/jpeg", "image/png", "image/gif"));
        if ($check) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        unlink($target_file);
        $uploadOk = 1;
    }

    if ($image["size"] > 1000000) {
        echo "Max file size is 1MB.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header("Location: ../adminpanel.php?error=2");
        exit();

    } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            return $image["name"];
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function SaveImage($image, $id)
{
    $target_file = basename($image["name"]);
    $uploadOk = 1;
    if (isset($_POST["submit"])) {
        $tmp = mime_content_type($image["tmp_name"]);
        $check = in_array($tmp, array("image/jpeg", "image/png", "image/gif"));
        if ($check) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        unlink($target_file);
        $uploadOk = 1;
    }

    if ($image["size"] > 1000000) {
        echo "Max file size is 1MB.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header("Location: ../adminpanel.php?error=2");
        exit();

    } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $SQLConnect = OpenDBConnection();
            $SQLQuery = "UPDATE Employee
            SET Employee_Image = ?
            WHERE Employee_ID = ?";
            $stmt = $SQLConnect->prepare($SQLQuery);
            $path = $image["name"];
            $stmt->bind_param("si", $path, $id);
            $stmt->execute();
            $stmt->close();
            CloseDBConnection($SQLConnect);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function SaveName($name, $id)
{
    $SQLConnect = OpenDBConnection();
    $SQLQuery = "UPDATE Employee
    SET Employee_Name = ?
    WHERE Employee_ID = ?";
    $stmt = $SQLConnect->prepare($SQLQuery);
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    $stmt->close();
    CloseDBConnection($SQLConnect);
}

function SavePass($pass, $id)
{
    $SQLConnect = OpenDBConnection();
    $SQLQuery = "UPDATE Employee
    SET Employee_Pass = ?
    WHERE Employee_ID = ?";
    $stmt = $SQLConnect->prepare($SQLQuery);
    $tmp = md5($pass);
    $stmt->bind_param("si", $tmp, $id);
    $stmt->execute();
    $stmt->close();
    CloseDBConnection($SQLConnect);
}

?>