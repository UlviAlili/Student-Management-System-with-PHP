<?php
session_set_cookie_params(null, '/', 'localhost', false, true);
session_start();

if (isset($_SESSION['LoginAdmin']) && $_SESSION['LoginAdmin'] === true) {

} else {
    \StudentManagementSystem\routing::go("../index.php");
    die();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../images/ico.ico" type="image/x-icon">
    <title>Student Management System - Admin Page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/datatables.min.css">

</head>
<body class="home">

<header class="header">
    <nav class="navbar navbar-expand-lg header-nav fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Student Management System</a>
            <?php $y = explode('/', $_SERVER['PHP_SELF']);
            $a = $y[count($y) - 1]; ?>
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">

                        <a class="nav-link <?php if ($a == 'index.php') echo 'active'; ?>" aria-current="page"
                           href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($a == 'teacher.php' or $a == 'add-teacher-ajax.php' or $a == 'update-teacher-ajax.php')
                            echo 'active'; ?>"
                           href="teacher.php">Teacher</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($a == 'lesson.php') echo 'active'; ?>" href="lesson.php">Lesson</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($a == 'student.php' or $a == 'show-student.php') echo 'active'; ?>"
                           href="student.php">Student</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <a href="../logout.php" class="btn">Logout</a>
                </ul>
            </div>
        </div>
    </nav>
</header>
<br><br><br><br><br>