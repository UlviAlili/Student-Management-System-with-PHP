<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Management System - Home Page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
                        <a class="nav-link <?php if ($a == 'lesson.php') echo 'active'; ?>" href="#">Lesson</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($a == 'student.php') echo 'active'; ?>" href="#">Student</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <button class="btn">Logout</button>
                </ul>
                <!--        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                <!--      <form class="d-flex">-->
                <!--        <button class="btn btn-outline-success" type="submit">Logout</button>-->
                <!--      </form>-->
                <!--        &nbsp;&nbsp;&nbsp;&nbsp;-->
            </div>
        </div>
    </nav>
</header>
<br><br><br><br><br>