<?php
class ExamModel extends DB{


    // Thêm kỳ thi mới
    public function addExam($courseId, $timeLimit, $questionLimit, $examTitle, $examDesc) {
        $this->db->query("INSERT INTO exam_tbl (course_id, time_limit, question_limit, exam_title, exam_desc) 
                          VALUES (:course_id, :time_limit, :question_limit, :exam_title, :exam_desc)");
        $this->db->bind(':course_id', $courseId);
        $this->db->bind(':time_limit', $timeLimit);
        $this->db->bind(':question_limit', $questionLimit);
        $this->db->bind(':exam_title', $examTitle);
        $this->db->bind(':exam_desc', $examDesc);

        return $this->db->execute();
    }

    // Lấy danh sách khóa học để hiển thị trong form
    public function getCourses() {
        $this->db->query("SELECT * FROM course_tbl ORDER BY cou_id DESC");
        return $this->db->resultSet();
    }

     // Hàm xóa kỳ thi
     public function deleteExam($examId) {
        $this->db->query("DELETE FROM exam_tbl WHERE ex_id = :examId");
        $this->db->bind(':examId', $examId);
        
        return $this->db->execute();
    }
    // Hàm cập nhật kỳ thi
    public function updateExam($examId, $courseId, $examTitle, $examLimit, $examQuestDipLimit, $examDesc) {
        $this->db->query("UPDATE exam_tbl 
                          SET cou_id = :courseId, ex_title = :examTitle, ex_time_limit = :examLimit, 
                              ex_questlimit_display = :examQuestDipLimit, ex_description = :examDesc
                          WHERE ex_id = :examId");
        
        // Liên kết các tham số
        $this->db->bind(':examId', $examId);
        $this->db->bind(':courseId', $courseId);
        $this->db->bind(':examTitle', $examTitle);
        $this->db->bind(':examLimit', $examLimit);
        $this->db->bind(':examQuestDipLimit', $examQuestDipLimit);
        $this->db->bind(':examDesc', $examDesc);
        
        return $this->db->execute();
    }
}
?>
