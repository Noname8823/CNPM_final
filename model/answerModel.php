<?php
class ExamModel extends DB{

    // Kiểm tra xem thí sinh đã làm kỳ thi chưa
    public function isExamTaken($exmne_id, $exam_id) {
        $this->db->query("SELECT * FROM exam_attempt WHERE exmne_id = :exmne_id AND exam_id = :exam_id");
        $this->db->bind(':exmne_id', $exmne_id);
        $this->db->bind(':exam_id', $exam_id);
        return $this->db->rowCount() > 0;
    }

    // Kiểm tra xem thí sinh đã có câu trả lời nào không
    public function hasAnswers($exmne_id, $exam_id) {
        $this->db->query("SELECT * FROM exam_answers WHERE axmne_id = :exmne_id AND exam_id = :exam_id");
        $this->db->bind(':exmne_id', $exmne_id);
        $this->db->bind(':exam_id', $exam_id);
        return $this->db->rowCount() > 0;
    }

    // Cập nhật trạng thái câu trả lời cũ
    public function updateLastAnswerStatus($exmne_id, $exam_id) {
        $this->db->query("UPDATE exam_answers SET exans_status = 'old' WHERE axmne_id = :exmne_id AND exam_id = :exam_id");
        $this->db->bind(':exmne_id', $exmne_id);
        $this->db->bind(':exam_id', $exam_id);
        return $this->db->execute();
    }

    // Thêm câu trả lời vào cơ sở dữ liệu
    public function insertAnswer($exmne_id, $exam_id, $quest_id, $exans_answer) {
        $this->db->query("INSERT INTO exam_answers(axmne_id, exam_id, quest_id, exans_answer) VALUES(:exmne_id, :exam_id, :quest_id, :exans_answer)");
        $this->db->bind(':exmne_id', $exmne_id);
        $this->db->bind(':exam_id', $exam_id);
        $this->db->bind(':quest_id', $quest_id);
        $this->db->bind(':exans_answer', $exans_answer);
        return $this->db->execute();
    }

    // Thêm thông tin kỳ thi đã được làm
    public function insertExamAttempt($exmne_id, $exam_id) {
        $this->db->query("INSERT INTO exam_attempt(exmne_id, exam_id) VALUES(:exmne_id, :exam_id)");
        $this->db->bind(':exmne_id', $exmne_id);
        $this->db->bind(':exam_id', $exam_id);
        return $this->db->execute();
    }
}
?>
