<?php
class QuestionModel extends DB
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function addQuestion($examId, $question, $choice_A, $choice_B, $choice_C, $choice_D, $correctAnswer)
    {
        $sql = "INSERT INTO questions (exam_id, question, choice_A, choice_B, choice_C, choice_D, correct_answer) 
                VALUES (:examId, :question, :choice_A, :choice_B, :choice_C, :choice_D, :correctAnswer)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':examId', $examId);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':choice_A', $choice_A);
        $stmt->bindParam(':choice_B', $choice_B);
        $stmt->bindParam(':choice_C', $choice_C);
        $stmt->bindParam(':choice_D', $choice_D);
        $stmt->bindParam(':correctAnswer', $correctAnswer);
        return $stmt->execute();
    }

    // Hàm xóa câu hỏi theo ID
    public function deleteQuestion($id) {
        $this->db->query("DELETE FROM exam_question_tbl WHERE eqt_id = :id");
        $this->db->bind(':id', $id);
        
        // Thực thi câu lệnh xóa và trả về kết quả
        return $this->db->execute();
    }
    // Lấy câu hỏi theo ID
    public function getQuestionById($id) {
        $this->db->query("SELECT * FROM exam_question_tbl WHERE eqt_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Cập nhật câu hỏi
    public function updateQuestion($id, $question, $exam_ch1, $exam_ch2, $exam_ch3, $exam_ch4, $exam_final) {
        $this->db->query("UPDATE exam_question_tbl SET exam_question = :question, exam_ch1 = :exam_ch1, exam_ch2 = :exam_ch2, exam_ch3 = :exam_ch3, exam_ch4 = :exam_ch4, exam_answer = :exam_final WHERE eqt_id = :id");

        // Bind dữ liệu
        $this->db->bind(':question', $question);
        $this->db->bind(':exam_ch1', $exam_ch1);
        $this->db->bind(':exam_ch2', $exam_ch2);
        $this->db->bind(':exam_ch3', $exam_ch3);
        $this->db->bind(':exam_ch4', $exam_ch4);
        $this->db->bind(':exam_final', $exam_final);
        $this->db->bind(':id', $id);

        // Thực thi và trả về kết quả
        return $this->db->execute();
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
