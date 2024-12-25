<?php

// ExamController.php
include 'ExamModel.php';

class ExamController {
    private $examModel;

    public function __construct($conn) {
        $this->examModel = new ExamModel($conn);
    }

    // Function to load examinee data
    public function getExamineeResults() {
        $examineeData = $this->examModel->getExamineeData();
        $results = [];

        while ($row = $examineeData->fetch(PDO::FETCH_ASSOC)) {
            $eid = $row['exmne_id'];
            $examDetails = $this->examModel->getExamTitleByExaminee($eid);
            $exam_id = $examDetails['ex_id'];

            $scoreData = $this->examModel->getExamineeScore($eid, $exam_id);
            $score = $scoreData->rowCount();
            $over = $examDetails['ex_questlimit_display'];
            $percentage = ($score / $over) * 100;

            $results[] = [
                'fullname' => $row['exmne_fullname'],
                'exam_title' => $examDetails['ex_title'],
                'score' => "$score / $over",
                'percentage' => "$percentage%"
            ];
        }

        return $results;
    }
}

?>