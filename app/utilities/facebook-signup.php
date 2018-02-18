<?php

//initialize facebook sdk

require '../vendor/autoload.php';
require_once '../utilities/fb-config.php';

if(!session_id()) {
    session_start();
}
try {

    if (isset($_SESSION['facebook_access_token'])) {

        $accessToken = $_SESSION['facebook_access_token'];
    } else {

        $accessToken = $helper->getAccessToken();
    }

} catch (Facebook\Exceptions\facebookResponseException $e) {

// When Graph returns an error

    echo 'Graph returned an error: ' . $e->getMessage();

    exit;

} catch (Facebook\Exceptions\FacebookSDKException $e) {

// When validation fails or other local issues

    echo 'Facebook SDK returned an error: ' . $e->getMessage();

    exit;

}

if (isset($accessToken)) {


    if (isset($_SESSION['facebook_access_token'])) {

        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

    } else {

// getting short-lived access token

        $_SESSION['facebook_access_token'] = (string)$accessToken;

        // OAuth 2.0 client handler

        $oAuth2Client = $fb->getOAuth2Client();

// Exchanges a short-lived access token for a long-lived one

        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

        $_SESSION['facebook_access_token'] = (string)$longLivedAccessToken;

// setting default access token to be used in script

        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

    }


// getting basic info about user
    try {

        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');

        $requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture

        $picture = $requestPicture->getGraphUser();

        $profile = $profile_request->getGraphUser();

        $fbid = $profile->getField('id');
        // To Get Facebook ID

        $fbfullname = $profile->getField('name'); // To Get Facebook full name

        $fbemail = $profile->getField('email');    //  To Get Facebook email

        $fbfirstname = $profile->getField('first_name'); // To Get Facebook full name

        $fblastname = $profile->getField('last_name'); // To Get Facebook full name

        $fbgender = $profile->getField('gender'); // To Get Facebook full name


        $fbpic = "<img src='" . $picture['url'] . "' class='img-rounded'/>";

# save the user nformation in cookie
        setcookie("fb_first_name", $fbfirstname, time() + (86400 * 30), "/");
        setcookie("fb_last_name", $fblastname, time() + (86400 * 30), "/");
        setcookie("fb_email", $fbemail, time() + (86400 * 30), "/");
        setcookie("fb_sex", $fbgender, time() + (86400 * 30), "/");
        setcookie("fb_pic", $picture['url'], time() + (86400 * 30), "/");
    } catch (Facebook\Exceptions\FacebookResponseException $e) {


        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();

        header("Location: ../userlogin/register.php");
        exit;

    } catch (Facebook\Exceptions\FacebookSDKException $e) {

        echo 'Facebook SDK returned an error: ' . $e->getMessage();

        exit;

    }
    header("Location: ../userlogin/register.php");
}
else {
    header("Location: ../userlogin/register.php");
}
?>