<?php
class userModel extends DB
{

    public function create($id, $email, $fullname, $password, $ngaysinh, $gioitinh, $trangthai)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `nguoidung`(`id`, `email`,`hoten`, `gioitinh`,`ngaysinh`,`matkhau`,`trangthai`, ) VALUES ('$id','$email','$fullname','$gioitinh','$ngaysinh','$password',$trangthai, )";
        $check = true;
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            $check = false;
        }
        return $check;
    }

    public function delete($id)
    {
        $check = true;
        $sql = "DELETE FROM `nguoidung` WHERE `id`='$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $check = false;
        return $check;
    }

    public function update( $email, $fullname, $password, $ngaysinh, $gioitinh,$trangthai)
    {
        $query = "UPDATE examinee_tbl SET
                  exmne_fullname = :fullname,
                  exmne_gender = :gender,
                  exmne_birthdate = :birthdate,
                  exmne_course = :course,
                  exmne_year_level = :year_level,
                  exmne_email = :email,
                  exmne_password = :password,
                  exmne_status = :status
                  WHERE exmne_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fullname', $data['fullname']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':birthdate', $data['birthdate']);
        $stmt->bindParam(':course', $data['course']);
        $stmt->bindParam(':year_level', $data['year_level']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function checkLogin($masv, $password)
    {
        $user = $this->getById($masv);
        if ($user == '') {
            return json_encode(["message" => "Tài khoản không tồn tại !", "valid" => "false"]);
        } else if ($user['trangthai'] == 0) {
            return json_encode(["message" => "Tài khoản bị khóa !", "valid" => "false"]);
        } else {
            $result = password_verify($password, $user['matkhau']);
            if ($result) {
                $token = time() . password_hash($masv, PASSWORD_DEFAULT);
                $resultToken = $this->updateToken($masv, $token);
                if ($resultToken) {
                    setcookie("token", $token, time() + 7 * 24 * 3600, "/");
                    return json_encode(["message" => "Đăng nhập thành công !", "valid" => "true"]);
                } else {
                    return json_encode(["message" => "Đăng nhập không thành công !", "valid" => "false"]);
                }
            } else {
                return json_encode(["message" => "Sai mật khẩu !", "valid" => "false"]);
            }
        }
    }


    public function logout()
    {
        setcookie("token", "", time() - 10, '/');
        $id = $_SESSION['user_id'];
        $sql = "UPDATE `nguoidung` SET `token`= NULL WHERE `id` = '$id'";
        session_destroy();
        $result = mysqli_query($this->con, $sql);
        return $result;
    }


    public function checkEmail($id)
    {
        $sql = "SELECT * FROM nguoidung where id = '$id'";
        $result = mysqli_query($this->con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['email'];
    }

    public function checkEmailExist($email)
    {
        $sql = "SELECT * FROM nguoidung where email = '$email'";
        $result = mysqli_query($this->con, $sql);
        $row = $result->num_rows;
        return $row;
    }

    public function updateEmail($id, $email)
    {
        $sql = "UPDATE `nguoidung` SET `email`='$email' WHERE `id`='$id'";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
}