<?php
include_once("../../../conn.php");
include_once("../model/CourseModel.php");
class CourseController {

    private $model;

    public function __construct($db)
    {
        $this->model = new CourseModel($db);
    }
    public function default()
    {
        if (AuthCore::checkPermission("monhoc", "view")) {
            $this->view("main_layout", [
                "Page" => "subject",
                "Title" => "Quản lý môn học",
                "Script" => "subject",
                "Plugin" => [
                    "sweetalert2" => 1,
                    "jquery-validate" => 1,
                    "notify" => 1,
                    "pagination" => [],
                ]
            ]);
        } else $this->view("single_layout", ["Page" => "error/page_403", "Title" => "error !"]);
    }

    // Hàm thêm khóa học mới
    public function addCourse() {
        $courseName = strtoupper($_POST['course_name']);

        // Gọi Model để kiểm tra khóa học đã tồn tại chưa
        $courseModel = $this->model('CourseModel');
        $existingCourse = $courseModel->checkCourseExist($courseName);

        if ($existingCourse) {
            // Khóa học đã tồn tại
            echo json_encode(array("res" => "exist", "course_name" => $courseName));
        } else {
            // Khóa học chưa tồn tại, thêm khóa học mới
            $result = $courseModel->addCourse($courseName);

            if ($result) {
                // Thêm khóa học thành công
                echo json_encode(array("res" => "success", "course_name" => $courseName));
            } else {
                // Thêm khóa học thất bại
                echo json_encode(array("res" => "failed", "course_name" => $courseName));
            }
        }
    }
        // Hiển thị modal cập nhật
        public function showUpdateModal($id)
        {
            $course = $this->model->getCourseById($id);
            include("../view/update_course_modal.php");
        }
    
        // Xử lý cập nhật khóa học
        public function updateCourse()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['course_id'];
                $name = $_POST['course_name'];
    
                if ($this->model->updateCourse($id, $name)) {
                    echo "Cập nhật thành công!";
                } else {
                    echo "Có lỗi xảy ra khi cập nhật.";
                }
            }
        }
    }
    
    // Hàm xóa khóa học
    public function deleteCourse() {
        // Lấy dữ liệu từ POST
        $id = $_POST['id'];

        // Gọi Model để xóa khóa học
        $courseModel = $this->model('CourseModel');
        $result = $courseModel->deleteCourseById($id);

        if ($result) {
            // Thông báo thành công
            echo json_encode(array("res" => "success"));
        } else {
            // Thông báo thất bại
            echo json_encode(array("res" => "failed"));
        }
    }
    // Xử lý yêu cầu
    $controller = new CourseController($conn);
    if (isset($_GET['action']) && $_GET['action'] == 'showUpdateModal') {
        $controller->showUpdateModal($_GET['id']);
    }
    if (isset($_POST['course_name'])) {
        $controller->updateCourse();
    
}
?>
