<?php
include_once("../../../conn.php");
include_once("../model/takeExam.php");

class ExamController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ExamModel($db);
    }

    // Xử lý để hiển thị thông tin bài kiểm tra
    public function showExam($examId)
    {
        $exam = $this->model->getExam($examId);
        $questions = $this->model->getQuestions($examId, $exam['ex_questlimit_display']);

        return [
            'exam' => $exam,
            'questions' => $questions
        ];
    }
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

    $controller = new ExamController($conn);

    // Khởi tạo controller
    if (isset($_GET['id'])) {
        $examId = $_GET['id'];
        $controller = new ExamController($conn);
        $examData = $controller->showExam($examId);

        // Truyền dữ liệu sang view
        include_once("../view/takeExam_view.php");
    }
        // Lấy dữ liệu POST và xử lý
    $postData = $_POST;
    $response = $controller->submitExam($postData);

    // Trả về JSON response
    echo json_encode($response);
?>
