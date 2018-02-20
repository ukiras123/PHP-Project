<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta content="Make It Happen" property="og:title" />
    <meta content="https://s3-us-west-1.amazonaws.com/software-download-personal/picture/logo.png" property="og:image" />
    <meta name="description"
          content="CA Consultancy. We deliver. | Conference Room | Laptops | Microphone Rental">    <meta name="keywords" content="PHP,Company,Reserve">
    <meta name="author" content="Kiran Gautam">
    <link rel="icon" href="./assets/logo/favicon.ico">

    <title><?php echo $title; ?></title>
    <?php echo $additionalHead; ?>


    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/style/page-layout.css">
</head>
<body>


<div class="container-fluid">

    <div class="masthead">

        <nav>
            <ul class="nav nav-pills nav-justified">
                <li class="<?php echo $indexActive ?>"><a href="index.php">Home</a></li>
                <li class="<?php echo $reserveActive ?>"><a href="reserve.php"><?php echo $reserve_rent ?></a></li>
                <li class="<?php echo $reportActive ?>"><a href="report.php">View Reports</a></li>
                <li class="<?php echo $profileActive ?>">
                <a href="" class="btn btn-default dropdown-toggle thick" data-toggle="dropdown"
                   data-hover="dropdown"><?php echo $nameWthLogo ?></a>
                <ul class="dropdown-menu">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="myhistory.php">My History</a></li>
                    <li><a href="userlogin/logout.php">Logout <span class="glyphicon glyphicon-off"></span> </a></a>
                    </li>
                </ul>
                </li>
            </ul>
        </nav>

    </div>


    <div class="jumbotron container-fluid">
        <img src="assets/logo/logo.png" alt="logo" />
        <h1 class = "generic-heading">Empowering the Nation
        </h1>
<!--        <p class="lead generic-heading">In Service We Trust</p>-->
    </div>


    <?php echo $content; ?>
    <?php echo $content2; ?>

    <div class="row">
        <div class="col-xs-4 col-md-4">
        <footer class="footer top50x">
            <p>&copy; All rights reserved</p>
        </footer>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="assets/js/userLogin.js"></script>
<script src="assets/js/userBooking.js"></script>

</body>
</html>