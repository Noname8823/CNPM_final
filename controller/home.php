<?php
// DashboardController.php
include 'DashboardModel.php';

class DashboardController {
    private $dashboardModel;

    public function __construct($conn) {
        $this->dashboardModel = new DashboardModel($conn);
    }

    // Function to get the dashboard data
    public function getDashboardData() {
        $totalCourse = $this->dashboardModel->getTotalCourses();
        $totalExam = $this->dashboardModel->getTotalExams();
        return [
            'totalCourse' => $totalCourse,
            'totalExam' => $totalExam
        ];
    }
}
?>