<?php
function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

function getDBLink()
{
    $DB_SERVER = "ec2-13-57-248-248.us-west-1.compute.amazonaws.com";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "rootkiran";
    $DB_NAME = "app";

    $link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    return $link;
}

function getUserInfo($username)
{
    $sql = "SELECT username, type, firstname, lastname, companyname, sex, email, phone, profile FROM users WHERE username = '" . $username . "'";
    $link = getDBLink();
    $return_arr = [];
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_row($result)) {
            $return_arr = [
                "username" => $row[0],
                "type" => $row[1],
                "firstname" => $row[2],
                "lastname" => $row[3],
                "companyname" => $row[4],
                "sex" => $row[5],
                "email" => $row[6],
                "phone" => $row[7],
                "profile" => $row[8],
            ];
        }
        mysqli_free_result($result);
        mysqli_close($link);
    } else {
        echo "Error during DB call getuserinfo()" . var_dump($sql);
        return null;
    }
    return $return_arr;
}

function updateUser($userdetail, $username)
{
    $sql = "UPDATE users SET firstname = '" . $userdetail['firstname'] . "', lastname = '" . $userdetail['lastname'] . "', companyname = '" . $userdetail['companyname'] . "' , sex = '" . $userdetail['sex'] . "' , email = '" . $userdetail['email'] . "' , phone = '" . $userdetail['phone'] . "'  where username = '" .$username . "'";
    $link = getDBLink();
    if ($result = mysqli_query($link, $sql)) {
        mysqli_close($link);
        return true;
    } else {
        echo "Error during DB call updateUser()" . var_dump($sql);
        return false;
    }
}

function updateProfilePic($imagelocation, $username)
{
    $sql = "UPDATE users SET profile = '" .$imagelocation . "'  where username = '" .$username . "'";
    $link = getDBLink();
    if ($result = mysqli_query($link, $sql)) {
        mysqli_close($link);
        return true;
    } else {
        echo "Error during DB call updateProfilePic()" . var_dump($sql);
        return false;
    }
}

function getProfilePic($username)
{
    $sql = "select profile from users where username = '" .$username . "'";
    $link = getDBLink();
    $profile = "";
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_row($result)) {
            $profile =  $row[0];
        }
        mysqli_free_result($result);
        mysqli_close($link);
    } else {
        echo "Error during DB call getProfilePic()" . var_dump($sql);
        return null;
    }
    return $profile;
}

?>