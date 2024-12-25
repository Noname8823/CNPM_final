<?php
class CourseModel extends DB {
  

    // Kiểm tra xem khóa học đã tồn tại chưa
    public function checkCourseExist($courseName) {
        $this->db->query("SELECT * FROM course_tbl WHERE cou_name = :course_name");
        $this->db->bind(':course_name', $courseName);
        return $this->db->single();
    }

    // Thêm khóa học mới
    public function addCourse($courseName) {
        $this->db->query("INSERT INTO course_tbl(cou_name) VALUES(:course_name)");
        $this->db->bind(':course_name', $courseName);
        return $this->db->execute();
    }

    // Lấy thông tin khóa học theo ID
    public function getCourseById($id) {
        $this->db->query("SELECT * FROM course_tbl WHERE cou_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Cập nhật tên khóa học
    public function updateCourseName($id, $newCourseName) {
        $this->db->query("UPDATE course_tbl SET cou_name = :newCourseName WHERE cou_id = :id");
        $this->db->bind(':newCourseName', $newCourseName);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
     // Xóa khóa học theo ID
     public function deleteCourseById($id) {
        $this->db->query("DELETE FROM course_tbl WHERE cou_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>
