<?php
require_once 'generic-function.php';

session_start();
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_SESSION['type'] == 'employee')
    {
        $firstname = $lastname = $sex = $email = $phone = "";
        if (!empty(trim($_POST["firstname"]))) {
            $firstname = $_POST["firstname"];
        }
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $sex = trim($_POST["sex"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $userdetail = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "sex" => $sex,
            "email" => $email,
            "phone" => $phone ,
        ];
        updateUser($userdetail, $username);
        header("location: ../profile.php");
        exit;

    } elseif ($_SESSION['type'] == 'company')
    {

        $firstname = $lastname = $sex = $email = $phone = "";
        if (!empty(trim($_POST["firstname"]))) {
            $firstname = $_POST["firstname"];
        }
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $sex = trim($_POST["sex"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $userdetail = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "sex" => $sex,
            "email" => $email,
            "phone" => $phone ,
        ];
        updateUser($userdetail, $username);

        $companyName = $companyAddress = $companyPhone = $note = "";
        $companyName = trim($_POST["companyname"]);
        $companyAddress = trim($_POST["companyaddress"]);
        $companyPhone = trim($_POST["companyphone"]);
        $notes = trim($_POST["companynote"]);
        $companyID = $_SESSION['companyID'];

        $companydetail = [
            "companyName" => $companyName,
            "companyAddress" => $companyAddress,
            "companyPhone" => $companyPhone,
            "notes" => $notes,
        ];
        updateCompany($companydetail, $companyID);

        header("location: ../profile.php");
        exit;
    }
}
else
{
    header("location: ../profile.php");
    exit;
}



?>