<?php
session_start();
require_once '../../database/database.php';
require_once('../../models/scores/score_assignment.model.php');
require_once('../../models/assignments/assignment.model.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    if (isset($_POST['student_id']) && isset($_POST['score'])) {

        $studentIds = ($_POST['student_id']);
        $userGraded = [];
        $scores = $_POST['score'];
        for ($i = 0; $i < count($scores); $i++) {
            if ($scores[$i] !== "") {
                $userGraded = getUserById($studentIds[$i]);
                insertAssignScore($scores[$i], $userGraded['id'], $id);
                updateGraded($userGraded['id'], $_SESSION['class_id']);
                updateStudentStatus($_SESSION['user']['id'], false, $_SESSION['class_id']);
                updateSubmitGraded($userGraded['id'], $id);
            }
        }
 
    }

    header("Location: /student_work?id=$id");
}
