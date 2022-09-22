<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
$db = new \StudentManagementSystem\db\Database();
?>

<div class="container-fluid">
    <div class="col">
        <div class="card-body">
            <a href="change-password-ajax.php" class="btn btn-warning">Change Password</a>
        </div>
    </div>
</div>

<?php $username = $_SESSION['student_username']; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card mt-3">
                <div class="card-body m-lg-3">
                    <div class="mb-3 row text-primary fw-bold">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext text-success fw-bolder" id="staticEmail"
                                   value="<?php echo $db->getColumn("SELECT student_name FROM student WHERE student_username = ?",array($username)); ?>">
                        </div>
                    </div>
                    <div class="mb-3 row text-primary fw-bold">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Surname:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext text-success fw-bolder" id="staticEmail"
                                   value="<?php echo $db->getColumn("SELECT student_surname FROM student WHERE student_username = ?",array($username)); ?>">
                        </div>
                    </div>
                    <div class="mb-3 row text-primary fw-bold">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Username:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext text-success fw-bolder" id="staticEmail"
                                   value="<?php echo $username; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<?php include('partials/footer.php'); ?>
