<?php
session_start();
header("X-Frame-Options: DENY");
// Enable when will publy website, to avoid error display //error_reporting(0);
require('controller/controller.php');

// $_GET['a'] is there fo "action"
if (isset($_GET['a'])) {

    if (isset($_POST['purple-logout'])) {
        logout();
        login();
    }

    elseif ($_GET['a'] == 'main') {
        main();
    }

    elseif ($_GET['a'] == 'edituser') {
    edituser();
    }

    elseif ($_GET['a'] == 'editnw') {
    news();
    }

    elseif ($_GET['a'] == 'edititem') {
    items();
    }

    elseif ($_GET['a'] == 'adduser') {
    adduser();
    }

    elseif ($_GET['a'] == 'addnews') {
    addnews();
    }

    elseif ($_GET['a'] == 'logout') {
        logout();
    }

    else {
        header('Location: index.php?a=main');
    }

}
else {
    header('Location: index.php?a=main');
}