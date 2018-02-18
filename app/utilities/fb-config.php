<?php

require '../vendor/autoload.php';
if(!session_id()) {
    session_start();
}

$fb = new Facebook\Facebook([
    'app_id' => '408656882889297',
    'app_secret' => '6d0d9c45d82605ffee25e2b9fabd3974',
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // optional

?>