<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
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
                        <table class="table table-hover" id="example">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Lesson Name</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Teacher Surname</th>
                                <th scope="col">Add time</th>
                                <th scope="col">Delete</th>
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
                                    <td><?php echo $item->lesson_add_time; ?></td>
                                    <td><a href="javascript:void(0)"
                                           class="text-danger"
                                           onclick="RemoveAll('DelLesson','<?php echo $item->lesson_id; ?>')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                 fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </a></td>
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
