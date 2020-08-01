<?php
session_start();
$a = date('Y/m/d h:i:s');
$a = strtotime($a);

header("X-Frame-Options: DENY");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('controller/controller.php');
// $_GET['a'] is there fo "action"
if (isset($_GET['a'])) {
    $_GET['a'] = htmlspecialchars($_GET['a']);

    if (isset($_POST['purple-logout'])) {
        logout();
        header('Location: index.php?a=login');
    }

    elseif ($_GET['a'] == 'login') {
        if (!userAuthorized()) {
            login();
        }
        else {
            header('Location: index.php?a=dashboard');
        }
    }

    elseif ($_GET['a'] == 'register') {
        if (!userAuthorized()) {
            register();
        }
        else {
            header('Location: index.php?a=dashboard');
        }

    }

    elseif ($_GET['a'] == 'dashboard') {
        if (userAuthorized()) {
            dashboard();
        }
        else {
            header('Location: index.php?a=login');
        }
    }

    elseif ($_GET['a'] == 'mstory') {
        if (userAuthorized()) {
            marketStory();
        }
        else {
            header('Location: index.php?a=login');
        }
    }

    elseif ($_GET['a'] == 'citem') {
        if (userAuthorized()) {

            createItem();
        }
        else {
            header('Location: index.php?a=login');
        }
    }

    elseif ($_GET['a'] == 'generator') {
        if (userAuthorized()) {
            generator();
        }
        else {
            header('Location: index.php?a=login');
        }
    }

    elseif ($_GET['a'] == 'profile') {
        if (userAuthorized()) {
            profile();
        }
        else {
            header('Location: index.php?a=login');
        }
    }

    else {
        header('Location: index.php?a=login');
    }

}
else {
    header('Location: index.php?a=login');
}