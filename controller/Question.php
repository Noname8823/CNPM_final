<?php
include_once '../models/QuestionModel.php';

class QuestionController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new QuestionModel($conn);
    }

    public function addQuestion()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $examId = $_POST['examId'];
            $question = $_POST['question'];
            $choice_A = $_POST['choice_A'];
            $choice_B = $_POST['choice_B'];
            $choice_C = $_POST['choice_C'];
            $choice_D = $_POST['choice_D'];
            $correctAnswer = $_POST['correctAnswer'];

            // Gọi model để thêm dữ liệu
            $result = $this->model->addQuestion($examId, $question, $choice_A, $choice_B, $choice_C, $choice_D, $correctAnswer);

            if ($result) {
                echo "Thêm câu hỏi thành công!";
            } else {
                echo "Thêm câu hỏi thất bại!";
            }
        }
    }

     // Hàm xóa câu hỏi
     public function delete($id) {
        // Gọi Model để xóa câu hỏi
        $examModel = $this->model('ExamModel');
        $result = $examModel->deleteQuestion($id);

        // Trả về kết quả dưới dạng JSON
        if ($result) {
            echo json_encode(["res" => "success"]);
        } else {
            echo json_encode(["res" => "failed"]);
        }
    }
    // Hàm để lấy thông tin câu hỏi và hiển thị form cập nhật
    public function update($id) {
        // Lấy dữ liệu câu hỏi từ Model
        $examModel = $this->model('ExamModel');
        $question = $examModel->getQuestionById($id);
        
        // Trả về view và dữ liệu câu hỏi
        $this->view('exam/update_question', $question);
    }

    // Hàm xử lý cập nhật câu hỏi
    public function updateQuestion($id) {
        // Kiểm tra và lấy dữ liệu từ form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $question = $_POST['question'];
            $exam_ch1 = $_POST['exam_ch1'];
            $exam_ch2 = $_POST['exam_ch2'];
            $exam_ch3 = $_POST['exam_ch3'];
            $exam_ch4 = $_POST['exam_ch4'];
            $exam_final = $_POST['exam_final'];

            // Gọi Model để cập nhật câu hỏi
            $examModel = $this->model('ExamModel');
            if ($examModel->updateQuestion($id, $question, $exam_ch1, $exam_ch2, $exam_ch3, $exam_ch4, $exam_final)) {
                // Redirect sau khi cập nhật thành công
                header('Location: ' . URLROOT . '/exam/list');
            }
        }
    }

}
?>
