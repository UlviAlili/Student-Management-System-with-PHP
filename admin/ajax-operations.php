<?php
require_once "../classes/allClass.php";
require_once "../functions/safe.php";

$db = new \StudentManagementSystem\db\Database();
$operations = $_GET['page'];
switch ($operations) {
    case 'InsertTeacher':
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
                $isHave = $db->getColumn("SELECT teacher_id FROM teacher WHERE teacher_name=? AND teacher_surname=?", array($name, $surname));
                if ($isHave) {
                    $message = "Already have this name and surname:::danger";
                } else {
                    $isHave2 = $db->getColumn("SELECT teacher_id FROM teacher WHERE teacher_username =?", array($username));
                    if ($isHave2) {
                        $message = "Already have this username:::danger";
                    } else {
                        $password = md5(md5(md5(sha1($password))));
                        //Insert Table
                        $addUser = $db->insert('INSERT INTO 
                                              teacher(teacher_name,teacher_surname,teacher_username,teacher_password) 
                                              VALUES (?,?,?,?)', array($name, $surname, $username, $password));

                        if ($addUser) {
                            $message = "Teacher added:::success";
                        } else {
                            $message = "Something get wrong:::danger";
                        }
                    }
                }
            }
        }
        echo $message;
        break;

    case 'UpdateTeacher':
        $ID = intval($_GET['ID']);
        $message = null;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = security('username');
            $name = security('name');
            $surname = security('surname');

            if (empty($name) or empty($surname) or empty($username)) {
                $message = "Please fill all fields:::warning";
            } elseif (strlen($name) < 3 or strlen($surname) < 3 or strlen($username) < 3) {
                $message = "Name , Surname and Username can't less than 3:::warning";
            } elseif (strlen($name) > 40 or strlen($surname) > 40 or strlen($username) > 40) {
                $message = "Name , Surname and username can't more than 40:::warning";
            } elseif (!preg_match('/^[a-zA-Z\s]+$/u', $name)) {
                $message = "Please enter your name correctly:::warning";
            } elseif (!preg_match('/^[a-zA-Z\s]+$/u', $surname)) {
                $message = "Please enter your surname correctly:::warning";
            } elseif (!preg_match('/^[0-9a-zA-Z-_.\s]+$/u', $username)) {
                $message = "Please enter your username correctly:::warning";
            } else {
                $isHave = $db->getColumn("SELECT teacher_id FROM teacher WHERE 
                                   teacher_name=? AND teacher_surname=? AND teacher_id != ?", array($name, $surname, $ID));
                if ($isHave) {
                    $message = "Already have this name and surname:::danger";
                } else {
                    $isHave2 = $db->getColumn("SELECT teacher_id FROM teacher WHERE
                                   teacher_username =? AND teacher_id != ?", array($username, $ID));
                    if ($isHave2) {
                        $message = "Already have this username:::danger";
                    } else {
                        //Insert Table
                        $updateTeacher = $db->update('UPDATE teacher SET
                                                 teacher_name=?,
                                                 teacher_surname=?,
                                                 teacher_username=?
                                                 WHERE teacher_id = ?', array($name, $surname, $username, $ID));

                        if ($updateTeacher) {
                            $message = "Teacher updated:::success";
                        } else {
                            $message = "Something get wrong:::danger";
                        }
                    }
                }
            }
        }
        echo $message;
        break;
    case 'DelTeacher' :
        $ID = $_GET['ID'];
        $del = $db->delete("DELETE FROM teacher WHERE teacher_id=?", array($ID));
        if ($del) {
            $message = "Teacher deleted:::success";
        } else {
            $message = "Something get wrong:::danger";
        }
        echo $message;
        break;
}
?>


