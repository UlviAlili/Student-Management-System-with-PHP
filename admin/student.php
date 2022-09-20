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
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Student Surname</th>
                                    <th scope="col">Student Username</th>
                                    <th scope="col">Add time</th>
                                    <th scope="col">Show Student</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                //// Select Table
                                $number = 1;
                                $getquery = $db->getRows("SELECT * FROM student");
                                foreach ($getquery as $item) {
                                    ?>
                                    <tr id="<?php echo $item->student_id; ?>">
                                        <th scope="row"><?php echo $number++; ?></th>
                                        <td><?php echo $item->student_name; ?></td>
                                        <td><?php echo $item->student_surname; ?></td>
                                        <td><?php echo $item->student_username; ?></td>
                                        <td><?php echo $item->student_add_time; ?></td>
                                        <td><a href="show-student.php?ID=<?php echo $item->student_id; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                 fill="currentColor" class="bi bi-caret-down-square"
                                                 viewBox="0 0 16 16">
                                                <path d="M3.626 6.832A.5.5 0 0 1 4 6h8a.5.5 0 0 1 .374.832l-4 4.5a.5.5 0 0 1-.748 0l-4-4.5z"/>
                                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2z"/>
                                            </svg> </a>
                                        </td>
                                        <td><a href="javascript:void(0)"
                                               class="text-danger"
                                               onclick="RemoveAll('DelStudent','<?php echo $item->student_id; ?>')">
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