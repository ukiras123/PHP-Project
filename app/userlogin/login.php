<?php
// Include config file
require_once '../utilities/config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

$cookie_name = "isSignUp";
$tohide = "hidden";
if (isset($_COOKIE[$cookie_name])) {
    if ($_COOKIE[$cookie_name] == "true") {
        $tohide = "";
    }
    setcookie($cookie_name, "", time() - 3600, '/');
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = 'Please enter username.';
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT username, password, type, companyname, firstname, lastname, profile FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password, $type, $companyname, $firstname, $lastname, $profile);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {

                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['profile'] = $profile;
                            $_SESSION['type'] = $type == 'e' ? 'employee' : 'company';
                            header("location: ../index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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

    <meta content="Make It Happen" property="og:title"/>
    <meta content="https://s3-us-west-1.amazonaws.com/software-download-personal/picture/logo.png" property="og:image"/>
    <meta name="description"
          content="CA Consultancy. We deliver. | Conference Room | Laptops | Microphone Rental">
    <meta name="keywords" content="PHP,Company,Reserve">
    <meta name="author" content="Kiran Gautam">
    <link rel="icon" href="../assets/logo/favicon.ico">

    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/style/generic-style.css">
</head>
<body>
<div class="container">

    <div class="jumbotron">
        <a href="./login.php"><img src="../assets/logo/logo.png" alt="logo" /></a>
        <h1>Welcome To Machine</h1>
    </div>


    <div class="alert alert-success" <?php echo $tohide ?>>
        <strong>Success!</strong> User successfully Created.
    </div>

    <div class="wrapper">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" required name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" required name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
    <footer class="footer top25x">
        <p>&copy; All rights reserved</p>
    </footer>
</div>

</body>
</html>