<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
?>
<br><br>


<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card pt-3 bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title text-center"><a href="teacher.php" style="color: white;">Teachers</a></h4>
                    <h3 class="card-title text-center">5</h3>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card pt-3 bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title text-center">Lessons</h4>
                    <h3 class="card-title text-center">8</h3>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card pt-3 bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title text-center">Students</h4>
                    <h3 class="card-title text-center">12</h3>
                </div>
            </div>
        </div>
    </div>

</div>
<br><br><br><br>
<!--Main Content Section starts-->
<!--<div class="container-sm">-->
<!--        <div class="wrapper">-->
<!--    <br>-->
<!--    <br><br>-->
<!---->
<!--    <div class="text-center" style="width: 18%; margin: 1%; padding: 2%; float: left; background-color: #E7E7E7;">-->
<!---->
<!--        Teacher-->
<!--    </div>-->
<!--    <div class="text-center" style="width: 18%; margin: 1%; padding: 2%; float: left; background-color: #E7E7E7;">-->
<!---->
<!--        Student-->
<!--    </div>-->
<!--    <div class="text-center" style="width: 18%; margin: 1%; padding: 2%; float: left; background-color: #E7E7E7;">-->
<!---->
<!--        Lesson-->
<!--    </div>-->
<!---->
<!--</div>-->
<!--<br><br><br><br><br><br>-->
<!--Main Content Section ends-->

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
