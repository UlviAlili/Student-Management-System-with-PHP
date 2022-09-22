<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
$db = new \StudentManagementSystem\db\Database();
?>

<div class="container-fluid">
    <div class="col">
        <div class="card-body">
            <a href="index.php" class="btn btn-primary">Back to Home page</a>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card mt-3">
                <div class="card-body m-lg-3">
                    <form method="post" id="FrmAddLesson">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" maxlength="50">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <p id="result"></p>
                            </div>
                        </div>
                        <button type="button" name="submit" id="submit"
                                onClick="SendForm('FrmChangePass','ChangePass','change-password-ajax.php')"
                                class="btn btn-warning">Change Password
                            <span class="myLoad"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<?php include('partials/footer.php'); ?>

