<?php
$title = 'Purpless - Login page';
ob_start();
?>
<div style="width: 500px !important; margin: auto; margin-top: 10%;" class="card">
    <div class="card-body">
        <form method="POST" action="">
            <h2 style="margin-bottom: 15px;"><font color="#cf50dd">Purple</font>ss registration</h2>
            <?php if (isset($error)) { ?>
                <div style="background-color: #c44dd3;" class="alert alert-primary" role="alert">
                    <?= $error ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="user-input">Username</label>
                <input type="text" name="reg-purple-username" value="<?php if (isset($_POST['reg-purple-username'])) echo $_POST['reg-purple-username'] ?>" class="form-control" id="user-input" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label for="user-password">Password</label>
                <input type="password" name="reg-purple-password" class="form-control" id="user-password" placeholder="Enter password">
            </div>

            <div class="form-group">
                <label for="user-password2">Confirm password</label>
                <input type="password" name="reg-purple-password2" class="form-control" id="user-password2" placeholder="Confirm password">
            </div>

            <div class="form-group">
                <label for="user-code">Invitation code</label>
                <input type="text" name="reg-purple-code" value="<?php if (isset($_POST['reg-purple-code'])) echo $_POST['reg-purple-code'] ?>" class="form-control" id="user-code" placeholder="Enter invitation code">
            </div>
            <button type="submit" name="reg-purple-submit" class="btn btn-primary">Submit</button><a style="margin-left: 5px;" href="?a=login"><button type="button" class="btn btn-primary">Login</button></a>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
require('reglog_template.php');
?>