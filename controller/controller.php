<?php
require('model/model.php');
function logout() {
    session_destroy();
    session_unset();
    unset($_SESSION["access"]);
}

function login() {
    if (isset($_POST['purple-username'], $_POST['purple-password'], $_POST['purple-submit'])) {
        if (!empty($_POST['purple-username'] && $_POST['purple-password'])) {
            if (verifyCredentials($_POST['purple-username'], $_POST['purple-password'])) {
                header('Location: index.php?a=dashboard');
            }
            else {
                $error = 'Wrong username or password!';
            }
        }
        else {
            $error = 'Fill in all fields!';
        }
    }
    require('views/login_view.php');
}

function register() {
    if (isset($_POST['reg-purple-username'], $_POST['reg-purple-password'], $_POST['reg-purple-password2'], $_POST['reg-purple-code'], $_POST['reg-purple-submit'])) {
        if (!empty($_POST['reg-purple-username'] && $_POST['reg-purple-password'] && $_POST['reg-purple-password2'] && $_POST['reg-purple-code'])) {
            $reg = accountCreation($_POST['reg-purple-username'], $_POST['reg-purple-password'], $_POST['reg-purple-password2'], $_POST['reg-purple-code']);
            if ($reg == 'success') {
                $_SESSION['access'] = 1;
                header('Location: index.php?a=dashboard');
                return;
            }
            else {
                $error = $reg;
            }
        }
        else {
            $error = 'Fill in all fields!';
        }
    }
    require('views/register_view.php');
}

function dashboard() {
    if (isset($_POST['buy-item']) && !empty($_POST['buy-item'])) {
        $result = buyItem($_POST['buy-item']);
        if ($result == 'success') {
            header('Location: index.php?a=mstory');
        }
        else {
            $error = $result;
        }
    }
    $items = itemSold();
    $users = usersCount();
    $money = moneyCount();
    $news = getNews();
    $market = getItems();
    require('views/dashboard_view.php');
}

function marketStory() {
    $story = getMarketStory();
    require('views/market_history_view.php');
}

function generator() {
    if (isset($_POST['generate-btn']) && !empty($_POST['generate-btn'])) {
        $result = generate($_POST['generate-btn']);
        if ($result == 'sucess')
        {
            $success = 'Hello World!!!';
        }
        else {
            $error = $result;
        }
    }
    generatorAttempts();
    $attempts = generatorUserAttempts();
    $stock = generatorStock();
    $story = getGeneratorStory();
    require('views/generator_view.php');
}

function profile() {
    if (isset($_GET['uid']) && !empty($_GET['uid'])) {
        $result = getProfile($_GET['uid']);
        if ($result['result'] == 'success') {
            $data = $result;
            $invites = getUserInvites();
            if (isset($_POST['profile-edit'])) {
                $result = updateProfile;
                if ($result == 'success') {
                    $error = 'Description successfully updated';
                    header('Refresh: 1');
                }
                else {
                    $error = $result;
                }
            }
            require('views/profile_view.php');
        }
        else {
            header('Location: index.php?a=profile&uid=' . $_SESSION['id']);
        }
    }
    else {
        header('Location: index.php?a=profile&uid=' . $_SESSION['id']);
    }
}

function createItem() {
    if (isset($_POST['item-name'], $_POST['item-price'], $_POST['item-link'], $_POST['add-item-submit'])) {
        if (!empty($_POST['item-name'] && $_POST['item-price'] && $_POST['item-link'])) {
            $result = insertItem($_POST['item-name'], $_POST['item-price'], $_POST['item-link']);
            if ($result == 'success') {
                header('Location: index.php?a=dashboard');
                return;
            }
            else {
                $error = $result;
            }
        }
        else {
            $error = 'Fill in all fields!';
        }
    }
    require('views/create_item_view.php');
}