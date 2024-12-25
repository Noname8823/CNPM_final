<?php
include"../conn.php"
class takeExam
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy thông tin bài kiểm tra
    public function getExam($examId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM exam_tbl WHERE ex_id = :examId");
        $stmt->bindParam(":examId", $examId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách câu hỏi cho bài kiểm tra
    public function getQuestions($examId, $limit)
    {
        $stmt = $this->conn->prepare("SELECT * FROM exam_question_tbl WHERE exam_id = :examId ORDER BY RAND() LIMIT :limit");
        $stmt->bindParam(":examId", $examId, PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
public function checkAttempt($exmne_id, $exam_id)
{
    $query = $this->conn->query("SELECT * FROM exam_attempt WHERE exmne_id='$exmne_id' AND exam_id='$exam_id'");
    return $query->rowCount();
}

public function checkAnswers($exmne_id, $exam_id)
{
    $query = $this->conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$exam_id'");
    return $query->rowCount();
}

public function updateOldAnswers($exmne_id, $exam_id)
{
    return $this->conn->query("UPDATE exam_answers SET exans_status='old' WHERE axmne_id='$exmne_id' AND exam_id='$exam_id'");
}

public function insertAnswer($exmne_id, $exam_id, $quest_id, $answer)
{
    return $this->conn->query("INSERT INTO exam_answers(axmne_id, exam_id, quest_id, exans_answer) VALUES('$exmne_id', '$exam_id', '$quest_id', '$answer')");
}

public function insertAttempt($exmne_id, $exam_id)
{
    return $this->conn->query("INSERT INTO exam_attempt(exmne_id, exam_id) VALUES('$exmne_id', '$exam_id')");
}


public function submitExam($postData)
{
    $exmne_id = $_SESSION['examineeSession']['exmne_id'];
    $exam_id = $postData['exam_id'];
    $answers = $postData['answer'];

    if ($this->model->checkAttempt($exmne_id, $exam_id) > 0) {
        return array("res" => "alreadyTaken");
    }

    if ($this->model->checkAnswers($exmne_id, $exam_id) > 0) {
        $updateStatus = $this->model->updateOldAnswers($exmne_id, $exam_id);
        if ($updateStatus) {
            return $this->processAnswers($answers, $exmne_id, $exam_id);
        }
        return array("res" => "failed");
    }

    return $this->processAnswers($answers, $exmne_id, $exam_id);
}

private function processAnswers($answers, $exmne_id, $exam_id)
{
    foreach ($answers as $quest_id => $value) {
        $answer = $value['correct'];
        $insertAns = $this->model->insertAnswer($exmne_id, $exam_id, $quest_id, $answer);
        if (!$insertAns) {
            return array("res" => "failed");
        }
    }

    $insertAttempt = $this->model->insertAttempt($exmne_id, $exam_id);
    if ($insertAttempt) {
        return array("res" => "success");
    }

    return array("res" => "failed");
}








}
?>
