<?php
require_once __DIR__ . '/../model/UserModel.php';

class User {
    private $examineeModel;

    public function __construct() {
        $this->examineeModel = new UserModel();
    }

    public function addExaminee() {
        // Lấy dữ liệu từ POST
        $data = [
            'fullname' => $_POST['fullname'],
            'gender' => $_POST['gender'],
            'course' => $_POST['course'],
            'year_level' => $_POST['year_level'],
            'bdate' => $_POST['bdate'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        // Kiểm tra dữ liệu đầu vào
        if ($data['gender'] == "0") {
            echo json_encode(["res" => "noGender"]);
        } elseif ($data['course'] == "0") {
            echo json_encode(["res" => "noCourse"]);
        } elseif ($data['year_level'] == "0") {
            echo json_encode(["res" => "noLevel"]);
        } elseif ($this->examineeModel->isFullnameExist($data['fullname'])) {
            echo json_encode(["res" => "fullnameExist", "msg" => $data['fullname']]);
        } elseif ($this->examineeModel->isEmailExist($data['email'])) {
            echo json_encode(["res" => "emailExist", "msg" => $data['email']]);
        } else {
            if ($this->examineeModel->addExaminee($data)) {
                echo json_encode(["res" => "success", "msg" => $data['email']]);
            } else {
                echo json_encode(["res" => "failed"]);
            }
        }
    }
    public function UpdateExaminee($id)
    {
        $examinee = $this->model->getExamineeById($id);
        if ($examinee) {
            $course = $this->model->getCourseById($examinee['exmne_course']);
            $otherCourses = $this->model->getOtherCourses($examinee['exmne_course']);
            include("../view/edit_examinee_view.php");
        } else {
            echo "Không tìm thấy thông tin thí sinh.";
        }
    }

}
$id = $_GET['id'];
$controller = new ExamineeController($conn);
$controller->editExaminee($id);
?>
