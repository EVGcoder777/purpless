<?php
function db() {
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=purpless;charset=utf8', 'root', '');
        return $db;
    }
    catch (Exception $e)
    {
        die('Error: ' . $e->getMessage());
    }
}

function verifyCredentials($username, $password) {
    $db = db();
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $req = $db->prepare('SELECT id, username, password FROM accounts WHERE username = ?');
    $req->execute(array($username));
    $data = $req->fetch();

    if (!empty($data['username'])) {
        $check_password = password_verify($password, $data['password']);
        if ($check_password) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['access'] = 1;
            return 1;
        }
    }
}

function accountCreation($a, $b, $c, $d) {
    $error = '';
    $db = db();
    $ip = $_SERVER['REMOTE_ADDR'];
    $username = htmlspecialchars($a);
    $password = htmlspecialchars($b);
    $password2 = htmlspecialchars($c);
    $code = htmlspecialchars($d);

    // Check if username is not used
    $username_check = $db->prepare('SELECT COUNT(*) FROM accounts WHERE username = ?');
    $username_check->execute(array($username));
    $username_check = $username_check->fetchColumn();

    // If not used
    if ($username_check == 0) {
        // Checking if first password is equal to second
        if ($password == $password2) {
            $password = password_hash($password, PASSWORD_ARGON2I);
            // Checking code info
            $check_code = $db->prepare('SELECT * FROM codes WHERE code = ? AND used_by = ?');
            $check_code->execute(array($code, 0));
            $check_code = $check_code->fetch();
            if (!empty($check_code['code'])) {

                $create_user = $db->prepare('INSERT INTO accounts(username, password, money, reg_ip, last_ip, invited_by) VALUES (:username, :password, :money, :reg_ip, :last_ip, :invited_by)');
                $create_user->execute(array(
                    'username' => $username,
                    'password' => $password,
                    'money' => 50,
                    'reg_ip' => $ip,
                    'last_ip' => $ip,
                    'invited_by' => $check_code['generated_by']
                ));
                $_SESSION['id'] = $db->lastInsertId();

                $update_code = $db->prepare('UPDATE codes SET used_by = ? WHERE code = ?');
                $update_code->execute(array($_SESSION['id'], $code));
                return 'success';
            }
            else {
                return 'Wrong invitation code!';
            }
        }
        else {
            return 'Passwords do not match!';
        }
    }
    else {
        return 'Username is already in use!';
    }
}

function username() {
    $id = $_SESSION['id'];
    $db = db();
    $req = $db->prepare('SELECT username FROM accounts WHERE username = ?');
    $req->execute(array($id));
    $data = $req->fetch();

    return $data['username'];
}

function userBalance($userid) {
    $db = db();
    $moneycount = $db->prepare('SELECT money FROM accounts WHERE id = ?');
    $moneycount->execute(array($userid));
    $moneycount = $moneycount->fetch();

    return $moneycount['money'];
}

function itemSold() {
    $db = db();
    $itemSold = $db->query('SELECT COUNT(*) FROM market_sold');
    $itemSold = $itemSold->fetchColumn();
    return $itemSold;
}

function usersCount() {
    $db = db();
    $usersCount = $db->query('SELECT COUNT(*) FROM accounts');
    $usersCount = $usersCount->fetchColumn();

    $lastUser = $db->query('SELECT username FROM accounts ORDER BY id DESC LIMIT 1');
    $lastUser = $lastUser->fetch();
    $ar['a'] = $usersCount;
    $ar['b'] = $lastUser['username'];
    return $ar;
}

function moneyCount() {
    $db = db();
    $moneyCount = $db->query('SELECT SUM(money) as total_money FROM accounts');
    $moneyCount = $moneyCount->fetchColumn();
    return $moneyCount;
}

function getNews() {
    $db = db();
    $getNews = $db->query('SELECT * FROM news');
    return $getNews;
}

function getItems() {
    $db = db();
    $getItems = $db->query('SELECT * FROM market');
    return $getItems;
}

function getUsernameById($a) {
    $db = db();
    $getuser = $db->prepare('SELECT username FROM accounts WHERE id = ?');
    $getuser->execute(array($a));
    $getuser = $getuser->fetch();
    $username = $getuser['username'];
    return $username;
}

function userAuthorized() {
    if (isset($_SESSION['access']) && $_SESSION['access'] == 1) {
        return 1;
    }
    else {
        return 0;
    }
}