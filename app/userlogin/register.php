<?php
// Include config file
require_once '../utilities/config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = $usertype =  "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT uId FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = 'Please confirm password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Validate password
    $usertype = $_POST['usertype'];

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {


        if ($usertype == 'employee') {
            $sql = "INSERT INTO users (username, password, type, firstname, lastname) VALUES (?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_usertype, $param_firstname, $param_lastname);

                // Set parameters
                $param_username = $username;
                $param_usertype = $usertype == 'employee' ? 'e' : 'c';
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_firstname = $_POST["firstname"];
                $param_lastname = $_POST["lastname"];

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    $cookie_name = "isSignUp";
                    $cookie_value = "true";
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
        } else {
            $sql = "INSERT INTO users (username, password, type, companyname, firstname, lastname) VALUES (?, ?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_usertype, $param_companyname,$param_firstname, $param_lastname);

                // Set parameters
                $param_username = $username;
                $param_usertype = $usertype == 'employee' ? 'e' : 'c';
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_companyname =  $_POST["companyname"];
                $param_firstname = $_POST["firstname"];
                $param_lastname = $_POST["lastname"];

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    $cookie_name = "isSignUp";
                    $cookie_value = "true";
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                    var_dump($stmt);
                }
            }

        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="Make It Happen" property="og:title" />
    <meta content="https://s3-us-west-1.amazonaws.com/software-download-personal/picture/logo.png" property="og:image" />
    <meta name="description"
          content="CA Consultancy. We deliver. | Conference Room | Laptops | Microphone Rental">    <meta name="keywords" content="PHP,Company,Reserve">
    <meta name="author" content="Kiran Gautam">
    <link rel="icon" href="../assets/logo/favicon.ico">

    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/css-toggle-switch@latest/dist/toggle-switch.css"/>
    <link rel="stylesheet" href="../assets/style/generic-style.css">
</head>
<body>
<div class="container">

    <div class="jumbotron">
        <img src="../assets/logo/logo.png" alt="logo" />
        <h1>Welcome To Machine</h1>
    </div>

    <div class="wrapper">

        <h3>Sign Up</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-signin">
            <fieldset>
                <div class="switch-toggle alert alert-light">
                    <input id="employee" name="usertype" value="employee" type="radio" checked>
                    <label for="employee">Employee</label>

                    <input id="company" name="usertype" value="company" type="radio">
                    <label for="company">ExternalCompany</label>

                    <a class="btn btn-primary"></a>
                </div>
            </fieldset>

            <div class="form-group" id="firstname">
                <label>First Name</label>
                <input type="text" required name="firstname" id="firstnameinput" class="form-control">
            </div>

            <div class="form-group" id="lastname">
                <label>Last Name</label>
                <input type="text" required name="lastname" id="lastnameinput" class="form-control">
            </div>

            <div class="form-group" id="companyname" hidden>
                <label>Company Name</label>
                <input type="text" name="companyname" id="companynameinput" class="form-control">
            </div>

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" required name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" required name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" required name="confirm_password" class="form-control"
                       value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p style="text-align:center">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>

    <footer class="footer top25x">
        <p>&copy; All rights reserved</p>
    </footer>

</div> <!-- /container -->


<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src="../assets/js/userLogin.js"></script>

</body>
</html>