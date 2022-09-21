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
                    <?php
                    $db = new \StudentManagementSystem\db\Database();
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Lesson Name</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Teacher Surname</th>
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
                            $getquery = $db->getRows("SELECT * FROM lesson JOIN teacher ON 
                                                            lesson.teacher_id = teacher.teacher_id");
                            foreach ($getquery as $item) {
                                ?>
                                <tr id="<?php echo $item->lesson_id; ?>">
                                    <th scope="row"><?php echo $number++; ?></th>
                                    <td><?php echo $item->lesson_name; ?></td>
                                    <td><?php echo $item->teacher_name; ?></td>
                                    <td><?php echo $item->teacher_surname; ?></td>
                                    <td>60</td>
                                    <td>85</td>
                                    <td>47</td>
                                    <td>57</td>
                                    <td class="text-success">Passed</td>
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


