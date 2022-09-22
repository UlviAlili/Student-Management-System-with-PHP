<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
$db = new \StudentManagementSystem\db\Database();
$id = $_GET['ID'];
$lesson_name = $_GET['lesson_name'];
$lesson_id = $db->getColumn('SELECT lesson_id FROM lesson WHERE lesson_name = ?', array($lesson_name));
?>

    <div class="container-fluid">
        <div class="col">
            <div class="card-body">
                <a href="student.php" class="btn btn-primary">Back to list</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card mt-3">
                    <div class="card-body m-lg-3">
                        <form method="post" id="FrmAddMark">
                            <div class="mb-3">
                                <label for="teacher_name" class="form-label">Student Name</label>
                                <p class="text-primary fw-bold">
                                    <?php echo $db->getColumn("SELECT student_name FROM student WHERE student_id = ?", array($id)); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="teacher_surname" class="form-label">Student Surname</label>
                                <p class="text-primary fw-bold ">
                                    <?php echo $db->getColumn("SELECT student_surname FROM student WHERE student_id = ?", array($id)); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="lesson_name" class="form-label">Lesson Name</label>
                                <p class="text-primary fw-bold">
                                    <?php echo $lesson_name; ?>
                                </p>
                            </div>
                            <input type="hidden" name="student_id" id="student_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="lesson_id" id="lesson_id"
                                   value="<?php echo $lesson_id; ?>">
                            <div class="mb-3">
                                <label for="first_exam" class="form-label">First Exam Mark</label>
                                <input type="number" name="first_exam" id="first_exam" class="form-control"
                                       maxlength="3"
                                       value="<?php echo $db->getColumn('SELECT first_exam FROM mark WHERE
                                                    student_id=? AND lesson_id =?', array($id, $lesson_id)); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="second_exam" class="form-label">Second Exam Mark</label>
                                <input type="number" name="second_exam" id="second_exam" class="form-control"
                                       maxlength="3" value="<?php echo $db->getColumn('SELECT second_exam FROM mark WHERE
                                                    student_id=? AND lesson_id =?', array($id, $lesson_id)); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="final_exam" class="form-label">Final Exam Mark</label>
                                <input type="number" name="final_exam" id="final_exam" class="form-control"
                                       maxlength="3" value="<?php echo $db->getColumn('SELECT final_exam FROM mark WHERE
                                                    student_id=? AND lesson_id =?', array($id, $lesson_id)); ?>">
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p id="result"></p>
                                </div>
                            </div>
                            <button type="button" name="submit" id="submit"
                                    onClick="SendForm('FrmAddMark','InsertMark','add-mark-ajax.php')"
                                    class="btn btn-primary">Add Mark
                                <span class="myLoad"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

<?php include('partials/footer.php'); ?>