<?php
require_once "../classes/allClass.php";
require_once "../functions/safe.php";
session_start();

$db = new \StudentManagementSystem\db\Database();
$operations = $_GET['page'];
$student_username = $_SESSION['student_username'];
$student_id = $db->getColumn("SELECT student_id FROM student WHERE student_username = ?", array($student_username));
switch ($operations) {
    case 'InsertLesson':
        $message = null;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = security('lesson');

            if (empty($name)) {
                $message = "Please fill all fields:::warning";
            } elseif ($name == 0) {
                $message = "Please select Lesson:::warning";
            } elseif (!preg_match('/^[0-9\s]+$/u', $name)) {
                $message = "Please enter lesson name correctly:::warning";
            } else {
                $isHave = $db->getColumn("SELECT mark_id FROM mark JOIN
                                                lesson ON mark.lesson_id = lesson.lesson_id WHERE
                                                mark.student_id = ? AND lesson.lesson_id = ?", array($student_id, $name));

                if ($isHave) {
                    $message = "Already have this lesson:::danger";
                } else {
                    //Insert Table
                    $addLesson = $db->insert('INSERT INTO 
                                              mark(student_id, lesson_id) 
                                              VALUES (?,?)', array($student_id, $name));

                    if ($addLesson) {
                        $message = "Lesson added:::success";
                    } else {
                        $message = "Something get wrong:::danger";
                    }
                }
            }
        }
        echo $message;
        break;

    case 'DelLesson' :
        $ID = $_GET['ID'];
        $del = $db->delete("DELETE FROM mark WHERE lesson_id=?", array($ID));
        if ($del) {
            $message = "Lesson deleted:::success";
        } else {
            $message = "Something get wrong:::danger";
        }
        echo $message;
        break;

    case 'ChangePass' :
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $new_password = security('password');
            $old_password = security('old_password');
            $username = $_SESSION['student_username'];

            if (empty($old_password) or empty($new_password)) {
                $message = "Please fill all fields:::warning";
            } elseif (strlen($old_password) < 5 or strlen($new_password) < 5) {
                $message = "Password can't less than 5:::warning";
            } elseif (strlen($old_password) > 20 or strlen($new_password) > 20) {
                $message = "Password can't more than 20:::warning";
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{5,20}/u', $new_password)) {
                $message = "Password must contain 1 or more uppercase, lowercase and digit
                                characters and must be 5 or more characters length:::warning";
            } else {
                $old_password = md5(md5(md5(sha1($old_password))));
                $isHave = $db->getColumn("SELECT student_password FROM student WHERE student_username = ?", array($username));
                if ($isHave != $old_password) {
                    $message = "Old Password is not correct:::warning";
                } else {
                    $new_password = md5(md5(md5(sha1($new_password))));
                    if ($new_password == $old_password) {
                        $message = "New Password cannot be the same as Old Password:::warning";
                    } else {
                        $updatePass = $db->update("UPDATE student SET student_password = ?", array($new_password));
                        if ($updatePass) {
                            $message = "Password updated:::success";
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


