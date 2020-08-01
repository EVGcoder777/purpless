<?php
$title = 'Purpless - Login page';
ob_start();
?>
<div style="width: 500px !important; margin: auto; margin-top: 10%;" class="card">
    <div class="card-body">
        <form method="POST" action="">
            <h2 style="margin-bottom: 15px;"><font color="#cf50dd">Purple</font>ss login</h2>
            <?php if (isset($error)) { ?>
            <div style="background-color: #c44dd3;" class="alert alert-primary" role="alert">
                <?= $error ?>
            </div>
            <?php } ?>
                <div class="form-group">
                    <label for="user-input">Username</label>
                    <input type="text" name="purple-username" value="<?php if (isset($_POST['purple-username'])) echo $_POST['purple-username'] ?>" class="form-control" id="user-input" placeholder="Enter username">
                </div>

            <div class="form-group">
                <label for="user-password">Password</label>
                <input type="password" name="purple-password" class="form-control" id="user-password" placeholder="Enter password">
            </div>
            <button name="purple-submit" type="submit" class="btn btn-primary">Submit</button> <a href="?a=register"><button type="button" class="btn btn-primary">Register</button></a>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
require('reglog_template.php');
?>