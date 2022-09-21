<?php
require_once "classes/allClass.php";
require_once "functions/safe.php";
session_start();

$db = new \StudentManagementSystem\db\Database();
$operations = $_GET['page'];
switch ($operations) {
    case 'Login':
        $message = null;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = security('username');
            $password = security('password');

            if (empty($username) or empty($password)) {
                $message = "Please fill all fields:::warning";
            } elseif (strlen($username) < 3) {
                $message = "Username can't less than 3:::warning";
            } elseif (strlen($password) < 5) {
                $message = "Password can't less than 5:::warning";
            } elseif (strlen($username) > 40) {
                $message = "Username can't more than 40:::warning";
            } elseif (strlen($password) > 20) {
                $message = "Password can't more than 20:::warning";
            } elseif (!preg_match('/^[0-9a-zA-Z-_.\s]+$/u', $username)) {
                $message = "Please enter your username correctly:::warning";
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{5,20}/u', $password)) {
                $message = "Password must contain 1 or more uppercase, lowercase and digit
                                characters and must be 5 or more characters length:::warning";
            } else {
                $password = md5(md5(md5(sha1($password))));

                $admin = $db->getColumn("SELECT admin_id FROM admin WHERE 
                                               admin_username = ? AND admin_password = ?", array($username, $password));
                $teacher = $db->getColumn("SELECT teacher_id FROM teacher WHERE
                                                  teacher_username = ? AND teacher_password = ?", array($username, $password));
                $student = $db->getColumn("SELECT student_id FROM student WHERE
                                                  student_username = ? AND student_password = ?", array($username, $password));

                if ($admin) {
                    session_regenerate_id(true);
                    $_SESSION['LoginAdmin'] = true;
                    $_SESSION['admin_username'] = $username;
                    $message = "Admin Login Successfully:::success";
                } else if ($teacher) {
                    session_regenerate_id(true);
                    $_SESSION['LoginTeacher'] = true;
                    $_SESSION['teacher_username'] = $username;
                    $message = "Teacher Login Successfully:::success";
                } else if ($student) {
                    session_regenerate_id(true);
                    $_SESSION['LoginStudent'] = true;
                    $_SESSION['student_username'] = $username;
                    $message = "Student Login Successfully:::success";
                } else {
                    $message = "Username or Password don't match:::danger";
                }
            }
        }
        echo $message;
        break;
        case 'InsertStudent':
        $message = null;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = security('username');
            $password = security('password');
            $name = security('name');
            $surname = security('surname');

            if (empty($name) or empty($surname) or empty($username) or empty($password)) {
                $message = "Please fill all fields:::warning";
            } elseif (strlen($name) < 3 or strlen($surname) < 3 or strlen($username) < 3) {
                $message = "Name , Surname and Username can't less than 3:::warning";
            } elseif (strlen($password) < 5) {
                $message = "Password can't less than 5:::warning";
            } elseif (strlen($name) > 40 or strlen($surname) > 40 or strlen($username) > 40) {
                $message = "Name , Surname and username can't more than 40:::warning";
            } elseif (strlen($password) > 20) {
                $message = "Password can't more than 20:::warning";
            } elseif (!preg_match('/^[a-zA-Z\s]+$/u', $name)) {
                $message = "Please enter your name correctly:::warning";
            } elseif (!preg_match('/^[a-zA-Z\s]+$/u', $surname)) {
                $message = "Please enter your surname correctly:::warning";
            } elseif (!preg_match('/^[0-9a-zA-Z-_.\s]+$/u', $username)) {
                $message = "Please enter your username correctly:::warning";
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{5,20}/u', $password)) {
                $message = "Password must contain 1 or more uppercase, lowercase and digit
                                characters and must be 5 or more characters length:::warning";
            } else {
                $isHave = $db->getColumn("SELECT student_id FROM student WHERE student_name=? AND student_surname=?", array($name, $surname));
                if ($isHave) {
                    $message = "Already have this name and surname:::danger";
                } else {
                    $isHave2 = $db->getColumn("SELECT student_id FROM student WHERE student_username =?", array($username));
                    if ($isHave2) {
                        $message = "Already have this username:::danger";
                    } else {
                        $password = md5(md5(md5(sha1($password))));
                        //Insert Table
                        $addUser = $db->insert('INSERT INTO 
                                              student(student_name,student_surname,student_username,student_password) 
                                              VALUES (?,?,?,?)', array($name, $surname, $username, $password));

                        if ($addUser) {
                            $message = "Sign Up successfully:::success";
                        } else {
                            $message = "Something get wrong:::danger";
                        }
                    }
                }
            }
        }
        echo $message;
        break;
}
?>


