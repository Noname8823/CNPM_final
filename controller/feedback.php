<?php
include_once" controller/FeedbackModel.php"
class FeedbackController {
    private $feedbackModel;

    public function __construct() {
        $this->feedbackModel = new FeedbackModel();
    }

    public function listFeedbacks() {
        // Lấy danh sách feedbacks từ Model
        $feedbacks = $this->feedbackModel->getFeedbacks();
        
        // Hiển thị thông qua View
        include 'view/feedbackList.php';
    }


    public function submitFeedback($postData) {
        session_start();
        $exmneSess = $_SESSION['examineeSession']['exmne_id'];
        $asMe = $postData['asMe'];
        $myFeedbacks = $postData['myFeedbacks'];

        // Kiểm tra số lượng feedbacks
        $feedbackCount = $this->feedbackModel->getFeedbackCountByExaminee($exmneSess);
        
        if ($feedbackCount >= 3) {
            return json_encode(["res" => "limit"]);
        } else {
            $date = date("F d, Y");
            $isInserted = $this->feedbackModel->insertFeedback($exmneSess, $myFeedbacks, $date, $asMe);
            
            if ($isInserted) {
                return json_encode(["res" => "success"]);
            } else {
                return json_encode(["res" => "failed"]);
            }
        }
    }
}