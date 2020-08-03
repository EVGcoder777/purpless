<?php
// Everything happens here, idk if it is good but when I learned mvc it looked like that
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
            $ip = $_SERVER['REMOTE_ADDR'];
            $upd_log = $db->prepare('UPDATE accounts SET login_datetime = NOW() , last_ip = ? WHERE id = ?');
            $upd_log->execute(array($ip, $data['id']));
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
    // checking if username contains only english letters and simple numbers
    if (!preg_match('/[^A-Za-z0-9]/', $a)) {
        $username = htmlspecialchars($a);
    }
    else {
        return 'The username contains invalid characters!';
    }
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

                $create_user = $db->prepare('INSERT INTO accounts(username, avatar, usergroup, generator_attempts, user_dsc, password, is_admin, money, reg_ip, last_ip, invited_by, login_datetime, reg_datetime) VALUES (:username, :avatar, :usergroup, :attempts, :dsc, :password, :is_admin, :money, :reg_ip, :last_ip, :invited_by, NOW(), NOW())');
                $create_user->execute(array(
                    'username' => $username,
                    'avatar' => 'default.png',
                    'usergroup' => 1,
                    'attempts' => 1,
                    'dsc' => 'No description',
                    'password' => $password,
                    'is_admin' => 0,
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

function updateProfile() {
    $db = db();

    if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
        $avatar_maxsize = 2097152;
        $avatar_extensions = array('jpg', 'jpeg', 'png');
        if ($_FILES['avatar']['size'] <= $avatar_maxsize) {
            $upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if (in_array($upload, $avatar_extensions)) {
                $file_name = generateRandomString();
                $path = 'avatars/' . $file_name . '.' . $upload;
                $uploading = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
                if ($uploading) {
                    $update_avatar = $db->prepare('UPDATE accounts SET avatar = ? WHERE id = ?');
                    $update_avatar->execute(array($file_name . '.' . $upload, $_SESSION['id']));
                }
                else {
                    return 'Error upload avatar!';
                }
            }
            else {
                return 'Wrong file extension.';
            }
        }
        else {
            return 'Your avatar size is too big (MAX 2MO).';
        }
    }

    if (isset($_POST['user-desc']) && !empty($_POST['user-desc'])) {
        $description = htmlspecialchars($_POST['user-desc']);
        $desc_length = strlen($description);
        if ($desc_length <= 100) {
            $upd_desc = $db->prepare('UPDATE accounts SET user_dsc = ? WHERE id = ?');
            $upd_desc->execute(array($description, $_SESSION['id']));
            return 'success';
        }
        else {
            return 'Description is too long.';
        }
    }
}

function getUserAvatar() {
    $db = db();
    $avatar = $db->prepare('SELECT avatar FROM accounts WHERE id = ?');
    $avatar->execute(array($_SESSION['id']));
    $avatar = $avatar->fetch();

    return $avatar['avatar'];
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
    $getNews = $db->query('SELECT * FROM news ORDER BY id DESC');
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

function insertItem($name, $price, $link) {
    $db = db();
    // checking if price is numeric, name length is ok and the link too
    $name = htmlspecialchars($name);
    $numeric = is_numeric($price);
    $name_length = strlen($name);
    $link_length = strlen($link);

    if ($numeric == 1 && $price < 10000) {
        if ($name_length <= 50) {
            if ($link_length <= 250) {
                $price = htmlspecialchars($price);
                $link = htmlspecialchars($link);

                $createItem = $db->prepare('INSERT INTO market(title, seller, item_link, price, added) VALUES(:title, :seller, :item_link, :price, NOW())');
                $createItem->execute(array(
                    'title' => $name,
                    'seller' => $_SESSION['id'],
                    'item_link' => $link,
                    'price' => $price
                ));
                return 'success';
            }
            else {
                return 'The link is too long!';
            }
        }
        else {
            return 'Item name is too long!';
        }
    }
    else {
        return 'An error was found in the price!';
    }
}

function buyItem($item_id) {
    $item_id = htmlspecialchars($item_id);

    // checking if item exists and is not replaced in the html code by a retard
    $db = db();
    $item_check = $db->prepare('SELECT COUNT(*) FROM market WHERE id = ?');
    $item_check->execute(array($item_id));
    $item_check = $item_check->fetchColumn();

    if ($item_check == 1) {
        // getting all data about the item
        $get_item_info = $db->prepare('SELECT id, title, seller, item_link, price FROM market WHERE id = ?');
        $get_item_info->execute(array($item_id));
        $get_item_info = $get_item_info->fetch();

        // getting user money count
        $user_balance = $db->prepare('SELECT money FROM accounts WHERE id = ?');
        $user_balance->execute(array($_SESSION['id']));
        $user_balance = $user_balance->fetch();

        $check_story = $db->prepare('SELECT COUNT(*) FROM market_sold WHERE item_id   = ?');
        $check_story->execute(array($item_id));
        $check_story = $check_story->fetchColumn();

        if ($check_story != 0) {
            return 'You have already purchased this item!';
        }

        if ($_SESSION['id'] !== $get_item_info['seller']) {
            // user has enough money
            if ($user_balance['money'] >= $get_item_info['price']) {
                $money = $user_balance['money'] - $get_item_info['price'];
                $sell = $db->prepare('INSERT INTO market_sold(item_id, title, seller, item_link, price, buyer, added) VALUES(:item_id, :title, :seller, :item_link, :price, :buyer, NOW())');
                $sell->execute(array(
                    'item_id' => $get_item_info['id'],
                    'title' => $get_item_info['title'],
                    'seller' => getUsernameById($get_item_info['seller']),
                    'item_link' => $get_item_info['item_link'],
                    'price' => $get_item_info['price'],
                    'buyer' => $_SESSION['id']
                ));

                $seller = $db->prepare('SELECT money FROM accounts WHERE id = ?');
                $seller->execute(array($get_item_info['seller']));
                $seller = $seller->fetch();

                // Sending $$$ to the seller
                $seller_money = $seller['money'] + $get_item_info['price'];
                $update_seller = $db->prepare('UPDATE accounts SET money = ? WHERE id = ?');
                $update_seller->execute(array($seller_money, $get_item_info['seller']));

                // Taking the money from the buyer
                $updateuser = $db->prepare('UPDATE accounts SET money = ? WHERE id = ?');
                $updateuser->execute(array($money, $_SESSION['id']));

                return 'success';
            }
            else {
                $error = 'You don\'t have enough money!';
                return $error;
            }
        }
        $error = 'You cannot buy your own item.';
        return $error;
    }
    else {
        $error = 'This item doesn\'t exist.';
        return $error;
    }
}

function generate($type) {
    $db = db();
    $type = htmlspecialchars($type);
    if ($type == 1) {

        // go check if there is some stock
        $get_stock = $db->prepare('SELECT COUNT(*) FROM generators_stock WHERE generator_type = ?');
        $get_stock->execute(array($type));
        $get_stock = $get_stock->fetchColumn();

        if ($get_stock > 0) {
            // check if user can generate
            $get_user_gen = $db->prepare('SELECT generator_attempts FROM accounts WHERE id = ?');
            $get_user_gen->execute(array($_SESSION['id']));
            $get_user_gen = $get_user_gen->fetch();

            if ($get_user_gen['generator_attempts'] > 0) {
                $get_line = $db->query('SELECT * FROM generators_stock WHERE generator_type = 1 LIMIT 1');
                $get_line = $get_line->fetch();

                // inserting the generation
                $insert_gen = $db->prepare('INSERT INTO generator_story(type, type_name, content, generated_by, generation_time) VALUES(:type, :type_name, :content, :generated_by, NOW())');
                $insert_gen->execute(array(
                   'type' => 1,
                    'type_name' => 'CS:GO 2LVL NP',
                    'content' => $get_line['content'],
                    'generated_by' => $_SESSION['id']
                ));

                // deleting from stock
                $del_stock = $db->prepare('DELETE FROM generators_stock WHERE id = ?');
                $del_stock->execute(array($get_line['id']));

                // -1 attempt for the user
                $user_attempts = $get_user_gen['generator_attempts'] - 1;
                $upd_att = $db->prepare('UPDATE accounts SET generator_attempts = ?, last_generation = NOW() WHERE id = ?');
                $upd_att->execute(array($user_attempts, $_SESSION['id']));
                return 'Success!';
            }
            return 'You have generated the maximum number of accounts in 24 hours. Soon you will be able to use generators again.';
        }
        else {
            return 'The generator has run out of accounts.';
        }
    }
    else {
        return 'Wrong type of generator.';
    }

}

function generatorUserAttempts() {
    $db = db();
    $get_attempts = $db->prepare('SELECT generator_attempts FROM accounts WHERE id = ?');
    $get_attempts->execute(array($_SESSION['id']));
    $get_attempts = $get_attempts->fetch();

    return $get_attempts['generator_attempts'];
}

function generatorStock() {
    // 1 query for every type of generator then return in array and display ** in future **
    $db = db();
    $stock = $db->query('SELECT COUNT(*) FROM generators_stock WHERE generator_type = 1');
    $csgo = $stock->fetchColumn();
    $array = array(
        'csgo' => $csgo
    );
    return $array;
}

// checking how much time from last gen, if 24hrs - update generation attempts
function generatorAttempts() {
    $db = db();
    $lastgen = $db->prepare('SELECT last_generation FROM accounts WHERE id = ?');
    $lastgen->execute(array($_SESSION['id']));
    $lastgen = $lastgen->fetch();

    $lastgen = strtotime($lastgen['last_generation']);
    $difference = time() - $lastgen;
    // there is more than 24 hours passed
    if ($difference > 86400) {
        $usergroup = getUserGroup();
        $attempts = generatorUserAttempts();
        if ($attempts == 0 && $usergroup == 1) {
            $setatt = $db->prepare('UPDATE accounts SET generator_attempts = 1 WHERE id = ?');
            $setatt->execute(array($_SESSION['id']));
        }
    }
}

function getUsergroupById($type) {
    switch ($type) {
        case 1:
            return 'Member';
            break;
        case 2:
            return 'Administrator';
            break;
        default:
            return 'Error!';
    }
}

function getUserGroup() {
    $db = db();
    $ugroup = $db->prepare('SELECT usergroup FROM accounts WHERE id = ?');
    $ugroup->execute(array($_SESSION['id']));
    $group = $ugroup->fetch();

    return $group['usergroup'];
}

function getMarketStory() {
    $db = db();
    $story = $db->prepare('SELECT * FROM market_sold WHERE buyer = ?');
    $story->execute(array($_SESSION['id']));

    return $story;
}

function getProfile($uid) {
$db = db();
$uid = htmlspecialchars($uid);

$user_info = $db->prepare('SELECT username, avatar, usergroup, user_dsc, money, invited_by FROM accounts WHERE id = ?');
$user_info->execute(array($uid));
$user_info = $user_info->fetch();

// if u got something with this id
if (!empty($user_info['username'])) {
    $user_array = array(
        'username' => $user_info['username'],
        'avatar' => $user_info['avatar'],
        'usergroup' => $user_info['usergroup'],
        'description' => $user_info['user_dsc'],
        'money' => $user_info['money'],
        'invited_by' => $user_info['invited_by'],
        'result' => 'success'
    );

    return $user_array;
    }
else {
    return 'error';
}
}

function isUserAdmin() {
    $db = db();
    $admin = $db->prepare('SELECT is_admin FROM accounts WHERE id = ?');
    $admin->execute(array($_SESSION['id']));
    $admin = $admin->fetch();

    if ($admin['is_admin'] == 1) {
        return true;
    }
}

function getUserInvites() {
    $db = db();
    $invites = $db->prepare('SELECT COUNT(*) FROM codes WHERE generated_by = ? AND used_by = 0');
    $invites->execute(array($_SESSION['id']));
    $invites = $invites->fetchColumn();

        $invites = $db->prepare('SELECT * FROM codes WHERE generated_by = ? AND used_by = 0');
        $invites->execute(array($_SESSION['id']));
        return $invites;
}

function getGeneratorStory() {
    $db = db();
    $story = $db->prepare('SELECT type_name, content, generation_time FROM generator_story WHERE generated_by = ?');
    $story->execute(array($_SESSION['id']));

    return $story;
}

function updateOnline() {
    $db = db();
    $time = time();
    if (isset($_SESSION['id'], $_SESSION['access'])) {
        $online = $db->prepare('SELECT COUNT(*) FROM online WHERE user_id = ?');
        $online->execute(array($_SESSION['id']));
        $online = $online->fetchColumn();

        if ($online == 0) {
            $online = $db->prepare('INSERT INTO online(user_id, username, last_action) VALUES(:user_id, :username, :last_action)');
            $online->execute(array(
               'user_id' => $_SESSION['id'],
               'username' => getUsernameById($_SESSION['id']),
                'last_action' => $time
            ));
        }
        else {
            $online = $db->prepare('UPDATE online SET last_action = ? WHERE user_id = ?');
            $online->execute(array($time, $_SESSION['id']));
        }
    }
}

function usersListing() {
    $db = db();
    $users = $db->query('SELECT * FROM accounts');
    return $users;
}

function getOnline() {
    $db = db();
    $online_users = $db->query('SELECT user_id, username FROM online');
    return $online_users;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-*/+';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}