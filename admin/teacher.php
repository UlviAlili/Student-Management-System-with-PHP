<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
$db = new \StudentManagementSystem\db\Database();
?>

    <div class="container-fluid">
        <div class="col">
            <div class="card-body">
                <a href="add-teacher-ajax.php" class="btn btn-primary">Add Teacher</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="example">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Add time</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //// Select Table
                                $number = 1;
                                $getquery = $db->getRows("SELECT * FROM teacher");
                                foreach ($getquery as $item) {
                                    ?>
                                    <tr id="<?php echo $item->teacher_id; ?>">
                                        <th scope="row"><?php echo $number++; ?></th>
                                        <td><?php echo $item->teacher_name; ?></td>
                                        <td><?php echo $item->teacher_surname; ?></td>
                                        <td><?php echo $item->teacher_username; ?></td>
                                        <td><?php echo $item->teacher_add_time; ?></td>
                                        <td><a href="update-teacher-ajax.php?ID=<?php echo $item->teacher_id; ?>"
                                               class="text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                     fill="currentColor" class="bi bi-pencil-square"
                                                     viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a></td>
                                        <td><a href="javascript:void(0)"
                                               class="text-danger"
                                               onclick="RemoveAll('DelTeacher','<?php echo $item->teacher_id; ?>')">
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