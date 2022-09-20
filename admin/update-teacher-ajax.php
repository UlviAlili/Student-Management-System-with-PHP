<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
require_once "../functions/safe.php";

$db = new \StudentManagementSystem\db\Database();
$ID = intval($_GET['ID']);
$teachers = $db->getRow("SELECT * FROM teacher WHERE teacher_id = ?", array($ID));

?>

<div class="container-fluid">
    <div class="col">
        <div class="card-body">
            <a href="teacher.php" class="btn btn-primary">Back to list</a>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card mt-3">
                <div class="card-body m-lg-3">
                    <form method="post" id="FrmUpdateTeacher">
                        <div class="mb-3">
                            <label for="teacher_name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" maxlength="40"
                                   value="<?php echo $teachers->teacher_name; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="teacher_surname" class="form-label">Surname</label>
                            <input type="text" name="surname" id="surname" class="form-control" maxlength="40"
                                   value="<?php echo $teachers->teacher_surname ?>">
                        </div>
                        <div class="mb-3">
                            <label for="teacher_username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   maxlength="40" value="<?php echo $teachers->teacher_username; ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <p id="result"></p>
                            </div>
                        </div>
                        <button type="button" name="submit" id="submit"
                                onClick="SendForm('FrmUpdateTeacher','UpdateTeacher&ID=<?php echo $teachers->teacher_id;?>','update-teacher-ajax.php')"
                                class="btn btn-danger">Update Teacher
                            <span class="myLoad"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>


<?php include('partials/footer.php'); ?>

