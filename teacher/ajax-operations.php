<?php
require_once "../classes/allClass.php";
require_once "../functions/safe.php";
session_start();

$db = new \StudentManagementSystem\db\Database();
$operations = $_GET['page'];
$username = $_SESSION['teacher_username'];
$message = null;
switch ($operations) {
    case 'InsertLesson':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = security('name');

            if (empty($name)) {
                $message = "Please fill all fields:::warning";
            } elseif (strlen($name) < 3) {
                $message = "Name can't less than 3:::warning";
            } elseif (strlen($name) > 50) {
                $message = "Name can't more than 40:::warning";
            } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/u', $name)) {
                $message = "Please enter lesson name correctly:::warning";
            } else {
                $isHave = $db->getColumn("SELECT lesson_id FROM lesson WHERE lesson_name=?", array($name));
                if ($isHave) {
                    $message = "Already have this lesson:::danger";
                } else {
                    $id = $db->getColumn("SELECT teacher_id FROM teacher WHERE teacher_username = ?", array($username));
                    //Insert Table
                    $addUser = $db->insert('INSERT INTO 
                                              lesson(teacher_id, lesson_name) 
                                              VALUES (?,?)', array($id, $name));

                    if ($addUser) {
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
        $del = $db->delete("DELETE FROM lesson WHERE lesson_id=?", array($ID));
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
            $username = $_SESSION['teacher_username'];

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
                $isHave = $db->getColumn("SELECT teacher_password FROM teacher WHERE teacher_username = ?", array($username));
                if ($isHave != $old_password) {
                    $message = "Old Password is not correct:::warning";
                } else {
                    $new_password = md5(md5(md5(sha1($new_password))));
                    if ($new_password == $old_password) {
                        $message = "New Password cannot be the same as Old Password:::warning";
                    } else {
                        $updatePass = $db->update("UPDATE teacher SET teacher_password = ?", array($new_password));
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

    case 'InsertMark' :
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $first_exam = security('first_exam');
            $second_exam = security('second_exam');
            $final_exam = security('final_exam');
            $student_id = security('student_id');
            $lesson_id = security('lesson_id');
//            $status = security('status');

            if ($first_exam > 100 or $second_exam > 100 or $final_exam > 100) {
                $message = "Mark can't more than 100:::warning";
//            } elseif ($first_exam < 0 or $second_exam < 0 or $final_exam < 0) {
//                $message = $first_exam . "Mark can't less than 0:::warning";
            } elseif (!preg_match('/^[0-9\s-]+$/u', $first_exam)) {
                $message = "Please enter first exam mark correctly:::warning";
            } elseif (!preg_match('/^[0-9\s-]+$/u', $second_exam) && !empty($second_exam)) {
                $message = "Please enter second exam mark correctly:::warning";
            } elseif (!preg_match('/^[0-9\s-]+$/u', $final_exam) && !empty($final_exam)) {
                $message = "Please enter final exam mark correctly:::warning";
            } else {
                if (empty($first_exam)) {
                    $message = "Please add first exam mark:::warning";
                } else if (empty($second_exam) && !empty($final_exam)) {
                    $message = "Please add second exam mark:::warning";
                } else {
                    if (empty($second_exam) or empty($final_exam)) {
                        $mark = "";
                    } else {
                        $mark = ($first_exam * 0.25) + ($second_exam * 0.25) + ($final_exam * 0.5);
                    }
                    if (empty($second_exam) or empty($final_exam)) {
                        $status = "continue";
                    } else {
                        if ($mark < 50) {
                            $status = "failed";
                        } else {
                            $status = "passed";
                        }
                    }
                    $addMark = $db->update('UPDATE mark SET first_exam = ?,second_exam = ?,final_exam = ?, mark = ? ,status = ?
                                              WHERE lesson_id = ? AND student_id = ?',
                        array($first_exam, $second_exam, $final_exam, $mark, $status, $lesson_id, $student_id));
                    if ($addMark) {
                        $message = "Mark added:::success";
                    } else {
                        $message = "Something get wrong:::danger";
                    }
                }
            }
        }
        echo $message;
        break;


}
?>


