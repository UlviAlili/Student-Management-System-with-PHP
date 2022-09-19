<?php
require_once "../classes/allClass.php";
require_once "partials/header.php";
require_once "../functions/safe.php";
?>

<?php
$message = null;
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $db = new \StudentManagementSystem\db\Database();
    $username = security('username');
    $password = security('password');
    $name = security('name');
    $surname = security('surname');

    if (empty($name) or empty($surname) or empty($username) or empty($password)) {
        $message = "Please fill all fields";
    } elseif (strlen($name) < 3 or strlen($surname) < 3 or strlen($username) < 3) {
        $message = "Name , Surname and Username can't less than 3";
    } elseif (strlen($password) < 5) {
        $message = "Password can't less than 5";
    } elseif (strlen($name) > 40 or strlen($surname) > 40 or strlen($username) > 40) {
        $message = "Name , Surname and username can't more than 40";
    } elseif (strlen($password) > 20) {
        $message = "Password can't more than 20";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/u', $name)) {
        $message = "Please enter your name correctly";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/u', $surname)) {
        $message = "Please enter your surname correctly";
    } elseif (!preg_match('/^[0-9a-zA-Z-_.\s]+$/u', $username)) {
        $message = "Please enter your username correctly";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{5,20}/u', $password)) {
        $message = "Password must contain 1 or more uppercase, lowercase and digit
                                characters and must be 5 or more characters length";
    } else {
        $isHave = $db->getColumn("SELECT teacher_id FROM teacher WHERE teacher_name=? AND teacher_surname=?", array($name, $surname));
        if ($isHave) {
            $message = "Already have this name and surname";
        } else {
            $isHave2 = $db->getColumn("SELECT teacher_id FROM teacher WHERE teacher_username =?", array($username));
            if ($isHave2) {
                $message = "Already have this username";
            } else {
                $password = md5(md5(md5(sha1($password))));
                //Insert Table
                $addUser = $db->insert('INSERT INTO 
                                              teacher(teacher_name,teacher_surname,teacher_username,teacher_password) 
                                              VALUES (?,?,?,?)', array($name, $surname, $username, $password));

                if ($addUser){
                    $_SESSION['addTeacher'] = "<div class='card-body col-2 text-success'>Teacher added</div>";
                } else{
                    $_SESSION['addTeacher'] = "<div class='card-body col-2 text-danger'>Something get wrong</div>";
                }
                header("location:" . "teacher.php");
            }
        }
    }
}

?>

<div class="container-fluid">
    <div class="col">
        <div class="card-body">
            <a href="teacher.php" class="btn btn-primary">Back to list</a>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card mt-3">
                <div class="card-body m-lg-3">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="mb-3">
                            <label for="teacher_name" class="form-label">Name</label>
                            <input type="text" name="name" id="teacher_name" class="form-control" maxlength="40">
                        </div>
                        <div class="mb-3">
                            <label for="teacher_surname" class="form-label">Surname</label>
                            <input type="text" name="surname" id="teacher_surname" class="form-control" maxlength="40">
                        </div>
                        <div class="mb-3">
                            <label for="teacher_username" class="form-label">Username</label>
                            <input type="text" name="username" id="teacher_username" class="form-control"
                                   maxlength="40">
                        </div>
                        <div class="mb-3">
                            <label for="teacher_password" class="form-label">Password</label>
                            <input type="password" name="password" id="teacher_password" class="form-control"
                                   maxlength="20">
                            <small class="text-muted">Password must contain 1 or more uppercase, lowercase and digit
                                characters and must be 5 or more characters length</small>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9">
                                <div class="text-danger"><?php echo $message; ?></div><br>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Add Teacher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>


<?php include('partials/footer.php'); ?>

