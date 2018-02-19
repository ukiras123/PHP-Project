<?php
require_once 'generic-function.php';

session_start();
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $lastname = $companyname = $sex = $email = $phone = "";
    if (!empty(trim($_POST["firstname"]))) {
        $firstname = $_POST["firstname"];
    }

    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $companyname = trim($_POST["companyname"]);
    $sex = trim($_POST["sex"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $departmentid = null;
    if (isset($_POST["department"])) {
        $departmentid = trim($_POST["department"]);
    }
    $userdetail = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "companyname" => $companyname,
        "sex" => $sex,
        "email" => $email,
        "phone" => $phone ,
        "department" => $departmentid ,
    ];
    updateUser($userdetail, $username);
    header("location: ../profile.php");
    exit;
}
else
{
    header("location: ../profile.php");
    exit;
}



?>