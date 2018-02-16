<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="Make It Happen" property="og:title" />
    <meta content="https://avatars2.githubusercontent.com/u/11082638?s=400&amp;v=4" property="og:image" />
    <meta name="description" content="My Company. We do all short of things. This is where we get things done. Bla Bla Bla.">
    <meta name="keywords" content="PHP,Company,Reserve">
    <meta name="author" content="Kiran Gautam">


    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/style/page-layout.css">
</head>
<body>


<div class="container">

    <div class="masthead">

        <nav>
            <ul class="nav nav-pills nav-justified">
                <li class="<?php echo $indexActive ?>"><a href="index.php">Home</a></li>
                <li class="<?php echo $reserveActive ?>"><a href="reserve.php"><?php echo $reserve_rent ?></a></li>
                <li class="<?php echo $reportActive ?>"><a href="report.php">View Reports</a></li>
                <li class="<?php echo $profileActive ?>">
                <a href="" class="btn btn-default dropdown-toggle thick" data-toggle="dropdown"
                   data-hover="dropdown"><?php echo $name ?></a>
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
        <h1>MY Company!</h1>
        <p class="lead">Lets make it work</p>
    </div>

    <div class="row">
        <?php echo $content; ?>
    </div>


    <footer class="footer">
        <p>&copy; All rights reserved</p>
    </footer>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>