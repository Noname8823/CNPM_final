<?php
include_once '../model/ExamModel.php';
class ExamController{

    private $model;

    public function __construct($conn)
    {
        $this->model = new ExamModel($conn);
    }
    // Hàm hiển thị form thêm kỳ thi
    public function showAddExamForm() {
        $examModel = $this->model('ExamModel');
        $courses = $examModel->getCourses();
        $this->view('exam/addExam', ['courses' => $courses]);
    }

    // Hàm thêm kỳ thi
    public function addExam() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $courseId = $_POST['courseSelected'];
            $timeLimit = $_POST['timeLimit'];
            $questionLimit = $_POST['examQuestDipLimit'];
            $examTitle = $_POST['examTitle'];
            $examDesc = $_POST['examDesc'];

            // Gọi Model để thêm kỳ thi
            $examModel = $this->model('ExamModel');
            $result = $examModel->addExam($courseId, $timeLimit, $questionLimit, $examTitle, $examDesc);

            if ($result) {
                echo json_encode(["res" => "success"]);
            } else {
                echo json_encode(["res" => "failed"]);
            }
        }
    }
     // Hàm xóa kỳ thi
     public function deleteExam() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $examId = $_POST['id'];
            
            // Gọi Model để xóa kỳ thi
            $examModel = $this->model('ExamModel');
            $result = $examModel->deleteExam($examId);

            if ($result) {
                echo json_encode(["res" => "success"]);
            } else {
                echo json_encode(["res" => "failed"]);
            }
        }
    }
    public function updateExam() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $examId = $_POST['examId'];
            $courseId = $_POST['courseId'];
            $examTitle = $_POST['examTitle'];
            $examLimit = $_POST['examLimit'];
            $examQuestDipLimit = $_POST['examQuestDipLimit'];
            $examDesc = $_POST['examDesc'];

            // Gọi Model để cập nhật kỳ thi
            $examModel = $this->model('ExamModel');
            $result = $examModel->updateExam($examId, $courseId, $examTitle, $examLimit, $examQuestDipLimit, $examDesc);

            if ($result) {
                echo json_encode(["res" => "success", "msg" => $examTitle]);
            } else {
                echo json_encode(["res" => "failed"]);
            }
        }
    }
}
?>
