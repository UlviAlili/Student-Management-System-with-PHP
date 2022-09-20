<?php
require_once "../classes/allClass.php";
require_once "../functions/safe.php";

$db = new \StudentManagementSystem\db\Database();
$operations = $_GET['page'];
$id = 2;
switch ($operations) {
    case 'InsertLesson':
        $message = null;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = security('name');

            if (empty($name)) {
                $message = "Please fill all fields:::warning";
            } elseif (strlen($name) < 3) {
                $message = "Name can't less than 3:::warning";
            } elseif (strlen($name) > 50) {
                $message = "Name can't more than 40:::warning";
            }  elseif (!preg_match('/^[a-zA-Z0-9\s]+$/u', $name)) {
                $message = "Please enter lesson name correctly:::warning";
            } else {
                $isHave = $db->getColumn("SELECT lesson_id FROM lesson WHERE lesson_name=?", array($name));
                if ($isHave) {
                    $message = "Already have this name and surname:::danger";
                } else {
                        //Insert Table
                        $addUser = $db->insert('INSERT INTO 
                                              lesson(teacher_id, lesson_name) 
                                              VALUES (?,?)', array($id,$name));

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
}
?>


