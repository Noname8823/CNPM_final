<?php
// File: model/FeedbackModel.php
class FeedbackModel extends DB {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getFeedbackCountByExaminee($exmneId) {
        $stmt = $this->conn->query("SELECT * FROM feedbacks_tbl WHERE exmne_id = '$exmneId'");
        return $stmt->rowCount();
    }

    public function insertFeedback($exmneId, $feedbackText, $date, $asMe) {
        $stmt = $this->conn->prepare("INSERT INTO feedbacks_tbl (exmne_id, fb_exmne_as, fb_feedbacks, fb_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$exmneId, $asMe, $feedbackText, $date]);
    }
    public function getFeedbacks() {
        global $conn;
        $stmt = $conn->query("SELECT * FROM feedbacks_tbl ORDER BY fb_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
