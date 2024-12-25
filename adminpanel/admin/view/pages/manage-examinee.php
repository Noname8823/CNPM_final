<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>QUẢN LÝ NGƯỜI THI</div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Danh sách người thi
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Khoá học</th>
                                <th>Cấp bậc</th>
                                <th>Email</th>
                                <th>Mật khẩu</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                // Thực hiện truy vấn với JOIN
                                $selExmne = $conn->query("
                                    SELECT examinee_tbl.*, course_tbl.cou_name 
                                    FROM examinee_tbl
                                    LEFT JOIN course_tbl ON examinee_tbl.exmne_course = course_tbl.cou_id
                                    ORDER BY examinee_tbl.exmne_id DESC
                                ");

                                // Kiểm tra nếu có dữ liệu
                                if ($selExmne->rowCount() > 0) {
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($selExmneRow['exmne_fullname']); ?></td>
                                            <td><?php echo htmlspecialchars($selExmneRow['exmne_gender']); ?></td>
                                            <td><?php echo htmlspecialchars($selExmneRow['exmne_birthdate']); ?></td>
                                            <td><?php echo htmlspecialchars($selExmneRow['cou_name'] ?? 'Không xác định'); ?></td>
                                            <td><?php echo htmlspecialchars($selExmneRow['exmne_year_level']); ?></td>
                                            <td><?php echo htmlspecialchars($selExmneRow['exmne_email']); ?></td>
                                            <td><?php echo htmlspecialchars($selExmneRow['exmne_password']); ?></td>
                                            <td><?php echo htmlspecialchars($selExmneRow['exmne_status']); ?></td>
                                            <td>
                                                <a rel="facebox" href="facebox_modal/updateExaminee.php?id=<?php echo $selExmneRow['exmne_id']; ?>" class="btn btn-sm btn-primary">Cập nhật</a>
                                                <a rel="facebox" href="facebox_modal/deleteExaminee.php?id=<?php echo $selExmneRow['exmne_id']; ?>" class="btn btn-sm btn-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="9">
                                            <h3 class="p-3">Không tìm thấy người thi nào!</h3>
                                        </td>
                                    </tr>
                                <?php }
                            } catch (PDOException $e) {
                                // Hiển thị lỗi nếu có vấn đề với truy vấn
                                echo "<tr><td colspan='9'>Lỗi truy vấn: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
