<?php

require_once 'utilities/generic-function.php';

$title = "My Profile";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "";
$reportActive = "";
$profileActive = "active";
$indexActive = "";
$profile = "";
$additionalHead = "";
$content2 = "";

session_start();
// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: userlogin/login.php");
    exit;
} else {

    $profile = IsNullOrEmptyString($_SESSION['profile']) ? "assets/logo/placeholder-profile-male.jpg" : $_SESSION['profile'];

    if (!file_exists($profile)) {
        $profile = "assets/logo/placeholder-profile-male.jpg";
    }

    $user_detail = getUserInfo($_SESSION['username']);

    $db_firstname = $user_detail['firstname'];
    $db_lastname = $user_detail['lastname'];
    $type = $_SESSION['type'];
    $db_fullname = $db_firstname . ' ' . $db_lastname;

    $db_sex = $user_detail['sex'];
    $db_email = $user_detail['email'];
    $db_phone = $user_detail['phone'];
    $db_companyname = $user_detail['companyname'];


    $maleselected = $femaleselected = "";
    $db_companyaddress = $db_companyphone = $db_companynote = "";
    if ($db_sex == "male") {
        $maleselected = 'selected = "selected"';
    } elseif ($db_sex == "female") {
        $femaleselected = 'selected = "selected"';
    }

    $companyhidden = "";

    if ($type == "employee") {
        $companyhidden = "hidden";
    } else {
        $companyhidden = "";
        $company_detail = getCompanyInfo($_SESSION['companyID']);
        $db_companyaddress = $company_detail['companyAddress'];
        $db_companyphone = $company_detail['companyPhone'];
        $db_companynote = $company_detail['notes'];
    }

    $reserve_rent = $_SESSION['type'] == 'employee' ? "Reserve" : "Rent";
    $_SESSION['type'] == 'e' ? $title = "Reserve" : "Rent";
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' . "&nbsp;&nbsp;&nbsp;" . $_SESSION['username'];
}


$content = '

<div class="row">
    <div class="center center-text">
        <h3> ' . $db_fullname . '</h3>
        <img src=' . $profile . ' alt="ProfilePic">
        <form action="utilities/upload.php" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="4194304"/>
            <input type="file" required accept="image/*" name="fileToUpload" id="fileToUpload" align="center"
                   class="center-text left20x" aria-describedby="fileHelp">
            <input type="submit" value="Upload Image" name="submit">
         </div>
        </form>
    </div>
</div>




<form action="utilities/profileupdate.php" method="post" class="center" style="width: 700px">

    <div class="row">

        <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="firstname">
                <label>First Name</label>
                <input type="text" required name="firstname" id="firstnameinput" class="form-control"
                       value="' . $db_firstname . '">
            </div>

        </div>

        <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="lastname">
                <label>Last Name</label>
                <input type="text" required name="lastname" id="lastnameinput" class="form-control"
                       value="' . $db_lastname . '">
            </div>
        </div>

            <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="email">
                <label>Email</label>
                <input type="email"
                       pattern="[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*"
                       name="email" id="emailinput" class="form-control" value="' . $db_email . '">
            </div>

        </div>
        
    </div>


    <div class="row">
        <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="sex">
                <label for="sexinput">Sex</label>
                <select class="form-control" name="sex" id="sexinput">
                    <option
                    ' . $maleselected . ' value = "male">Male</option>
                    <option
                    ' . $femaleselected . ' value = "female">Female</option>
                </select>
            </div>
        </div>

        <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="phone">
                <label>Phone No.</label>
                <input type="text" name="phone" id="phoneinput"
                       class="form-control"
                       value="' . $db_phone . '" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
        </div>
        
        <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="companyname"
            ' . $companyhidden . ' >
            <label>Company Name</label>
            <input type="text" name="companyname" id="companynameinput" class="form-control"
                   value="' . $db_companyname . '">
            </div>
        </div>
    </div>
    
    <div class="row">

    <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="companyaddress"
            ' . $companyhidden . ' >
            <label>Company Address</label>
            <input type="text" name="companyaddress" id="companyaddress" class="form-control"
                   value="' . $db_companyaddress . '">
            </div>
        </div>

       <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="companyphone"
            ' . $companyhidden . ' >
            <label>Company Phone</label>
            <input type="text" name="companyphone" id="companyphone" class="form-control"
                   value="' . $db_companyphone . '" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
        </div>
        
        <div class="form-group col-xs-4 col-md-4">

            <div class="form-group" id="companynote"
            ' . $companyhidden . ' >
            <label>Company Note</label>
            <input type="text" name="companynote" id="companynote" class="form-control"
                   value="' . $db_companynote . '">
            </div>
        </div>
    </div>
    

    <div class="row">
    <div class="col-xs-4 col-md-4">
    </div>
            <div class="col-xs-4 col-md-4">
        <button style="padding: 10px 24px;" type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>


';


include 'template.php';

?>
