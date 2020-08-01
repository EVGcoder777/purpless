<?php
require('model/model.php');
function main() {
    $items = itemSold();
    $users = usersCount();
    $money = moneyCount();
    $news = getNews();
    $market = getItems();
    require('views/index_view.php');
}

function edituser() {
    require('views/edit_user_view.php');
}

function news() {
    require('views/edit_news_view.php');
}

function items() {
    require('views/edit_item_view.php');
}

function adduser() {
    require('views/add_user_view.php');
}

function addnews() {
    require('views/add_news_view.php');
}

function logout() {
    session_destroy();
    session_unset();
    unset($_SESSION["access"]);
    header('Location: ../index.php');
}