<?php
// File: models/ExamineeModel.php

class ExamineeModel extends DB
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getExamineeById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCourses()
    {
        $stmt = $this->conn->query("SELECT * FROM course_tbl");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM course_tbl WHERE cou_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
