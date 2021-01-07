<?php
$message = '';
session_start();
include 'vendor/autoload.php';

use App\classes\Login;

if (!isset($_SESSION['userinfo']['id'])) {
    header('location: index.php');
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'logout') {
        $login = new Login();
        $message = $login->logout();
    }
}

if (isset($_POST['btn_reset_password'])){
    if ($_POST['new_password'] != $_POST['cf_new_password']){
        $message = 'Password and Confirm Password does not match!';
    } else {
        $login = new Login();
        $message = $login->reset_password();
    }
}

include 'header.php';
?>
<div class="section p-2">
    <h4 class="text-center text-warning"><?php echo $message; ?></h4>
    <h4 class="text-center text-danger"><?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } ?>
    </h4>
</div>
<div class="section">
    <div class="card">
        <h5 class="card-header bg-success text-light text-center">Reset Your Password</h5>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="" data-toggle="validator">
                <div class="row">
                    <label class="col-md-4 control-label">User ID</label>
                    <div class="col-md-8 form-group has-feedback">
                        <input type="text" class="form-control" name="bd_no" value="<?php echo $_SESSION['userinfo']['user_name'].' ('.$_SESSION['userinfo']['section_name'].')'; ?>" disabled>
                    </div>

                    <label class="col-md-4 control-label">New Password</label>
                    <div class="col-md-8 form-group has-feedback">
                        <input type="password" id="password" data-minlength="4"
                               data-error="Password minimum 4 character !" class="form-control"
                               placeholder="Password" name="new_password" required>
                        <div class="help-block with-errors"></div>
                    </div>

                    <label class="col-md-4 control-label">Confirm New Password</label>
                    <div class="col-md-8 form-group has-feedback">
                        <input type="password" data-match="#password"
                               data-error="Password and Confirm password does not match !" class="form-control"
                               placeholder="Confirm Password" name="cf_new_password" required>
                        <div class="help-block with-errors"></div>
                    </div>

                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-8 form-group">
                        <div class="">
                            <button type="submit" class="btn btn-success btn-block" name="btn_reset_password">Change your Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

