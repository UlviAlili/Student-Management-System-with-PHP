<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
$db = new \StudentManagementSystem\db\Database();
$username = $_SESSION['student_username'];
$student_id = $db->getColumn("SELECT student_id FROM student WHERE student_username = ?", array($username));
?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="card-body">
                    <?php
                    $db = new \StudentManagementSystem\db\Database();
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Lesson Name</th>
                                <th scope="col">First Exam</th>
                                <th scope="col">Second Exam</th>
                                <th scope="col">Final Exam</th>
                                <th scope="col">Total Mark</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            //// Select Table
                            $number = 1;

                            $getquery = $db->getRows("SELECT * FROM mark JOIN
                                                            lesson ON mark.lesson_id = lesson.lesson_id WHERE
                                                            mark.student_id = ?", array($student_id));
                            foreach ($getquery as $item) {
                                ?>
                                <tr id="<?php echo $item->lesson_id; ?>">
                                    <th scope="row"><?php echo $number++; ?></th>
                                    <td><?php echo $item->lesson_name; ?></td>
                                    <td><?php echo $item->first_exam; ?></td>
                                    <td><?php echo $item->second_exam; ?></td>
                                    <td><?php echo $item->final_exam; ?></td>
                                    <td><?php echo $item->mark; ?></td>
                                    <td class="text-<?php if ($item->status == 'continue') echo 'warning';
                                    if ($item->status == 'passed') echo 'success';
                                    if ($item->status == 'failed') echo 'danger'; ?>">
                                        <?php echo $item->status; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<br><br>


<?php include('partials/footer.php'); ?>


