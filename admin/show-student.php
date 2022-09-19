<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";

$id = $_GET['ID'];
$db = new \StudentManagementSystem\db\Database();

 $getquery1 = $db->getRows("SELECT * FROM student WHERE student_id = $id");
 foreach ($getquery1 as $items){
?>

<p><h1 class="text-center"><?php echo $items->student_name." ".$items->student_surname; ?></h1></p>
<p><h3 class="text-center"><?php echo $items->student_username; } ?></h3> </p>

<div class="container-fluid">
    <div class="col">
        <div class="card-body">
            <a href="student.php" class="btn btn-primary">Back to list</a>
        </div>
    </div>
</div>

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
                                <th scope="col">Lesson Name</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Teacher Surname</th>
                                <th scope="col">Mark</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            //// Select Table
                            $number = 1;
                            $getquery = $db->getRows("SELECT * FROM mark JOIN lesson ON 
                                                                mark.lesson_id = lesson.lesson_id JOIN teacher ON
                                                                lesson.teacher_id = teacher.teacher_id 
                                                                WHERE mark.student_id = $id");
                            foreach ($getquery as $item) {
                                ?>
                                <tr id="<?php echo $item->student_id; ?>">
                                    <th scope="row"><?php echo $number++; ?></th>
                                    <td><?php echo $item->lesson_name; ?></td>
                                    <td><?php echo $item->teacher_name; ?></td>
                                    <td><?php echo $item->teacher_surname; ?></td>
                                    <td><?php echo $item->mark; ?></td>
                                    <td><?php echo $item->status; ?></td>
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
