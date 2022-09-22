<?php
// Admin Username: admin
//       Password: Admin123
require_once "../classes/allClass.php";
require_once "partials/header.php";
$db = new \StudentManagementSystem\db\Database();
?>
<br><br>

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card pt-3 bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title text-center"><a href="teacher.php" style="color: white;">Teachers</a></h4>
                    <h3 class="card-title text-center"><?php
                        echo $db->getColumn("SELECT count(teacher_id) FROM teacher"); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card pt-3 bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title text-center"><a href="lesson.php" style="color: white;">Lessons</a></h4>
                    <h3 class="card-title text-center"><?php
                        echo $db->getColumn("SELECT count(lesson_id) FROM lesson"); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card pt-3 bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title text-center"><a href="student.php" style="color: white;">Students</a></h4>
                    <h3 class="card-title text-center"><?php
                        echo $db->getColumn("SELECT count(student_id) FROM student"); ?></h3>
                </div>
            </div>
        </div>
    </div>

</div>
<br><br><br><br>

<?php
$db = new \StudentManagementSystem\db\Database();

// Add Admin
/*$full_name = "Ulvi Alili";
$username = "admin";
$password = md5(md5(sha1("admin")));
$addAdmin = $db->insert("INSERT INTO admin SET
                               full_name = ?,
                               username = ?,
                               password = ?",array($full_name,$username,$password));
*/

?>


<?php include('partials/footer.php'); ?>
