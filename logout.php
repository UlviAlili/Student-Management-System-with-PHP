<?php
require_once "classes/allClass.php";
session_start();
session_unset();
session_destroy();
\StudentManagementSystem\routing::go("index.php");
