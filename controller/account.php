<?php
include_once '../model/User.php';
class Account 
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new UserModel($conn);
    }

    function default()
    {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Page" => "account_setting",
            "Title" => "",
            "User" => $this->user->getById($_SESSION['user_id']),
            "Plugin" => [
                "sweetalert2" => 1,
                "datepicker" => 1,
                "flatpickr" => 1,
                "jquery-validate" => 1,
                "notify" => 1,
            ],
            "Script" => "account_setting"
        ]);
    }
    public function check()
    {
        echo "<pre>";
        print_r($_SESSION);
    }
}