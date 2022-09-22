<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
$db = new \StudentManagementSystem\db\Database();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Surname</th>
                                <th scope="col">Lesson Name</th>
                                <th scope="col">First Exam</th>
                                <th scope="col">Second Exam</th>
                                <th scope="col">Final Exam</th>
                                <th scope="col">Mark</th>
                                <th scope="col">Status</th>
                                <th scope="col">Add Mark</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //// Select Table
                            $number = 1;
                            $username = $_SESSION['teacher_username'];
                            $id = $db->getColumn("SELECT teacher_id FROM teacher WHERE teacher_username = ?", array($username));

                            $getquery = $db->getRows("SELECT * FROM lesson JOIN student ON
                                                                student.teacher_id = lesson.teacher_id JOIN mark ON
                                                                lesson.lesson_id = mark.lesson_id WHERE
                                                                lesson.teacher_id = ?", array($id));
                            foreach ($getquery as $item) {
                                ?>
                                <tr id="<?php echo $item->student_id; ?>">
                                    <th scope="row"><?php echo $number++; ?></th>
                                    <td><?php echo $item->student_name; ?></td>
                                    <td><?php echo $item->student_surname; ?></td>
                                    <td><?php echo $item->lesson_name; ?></td>
                                    <td><?php echo $item->first_exam; ?></td>
                                    <td><?php echo $item->second_exam; ?></td>
                                    <td><?php echo $item->final_exam; ?></td>
                                    <td><?php echo $item->mark; ?></td>
                                    <td class="text-<?php if ($item->status == 'continue') echo 'warning';
                                                          if ($item->status == 'passed') echo 'success';
                                                          if ($item->status == 'failed') echo 'danger'; ?>">
                                                          <?php echo $item->status; ?></td>
                                    <td>
                                        <a href="add-mark-ajax.php?ID=<?php echo $item->student_id; ?>&lesson_name=<?php echo $item->lesson_name; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                 fill="currentColor" class="bi bi-caret-down-square"
                                                 viewBox="0 0 16 16">
                                                <path d="M3.626 6.832A.5.5 0 0 1 4 6h8a.5.5 0 0 1 .374.832l-4 4.5a.5.5 0 0 1-.748 0l-4-4.5z"/>
                                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2z"/>
                                            </svg>
                                        </a>
                                    </td>
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
