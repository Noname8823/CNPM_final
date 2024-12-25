<!-- Modal For Add Course -->
<div class="modal fade" id="modalForAddCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addCourseFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm khoá học</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Khoá học</label>
              <input type="" name="course_name" id="course_name" class="form-control" placeholder="Nhập tên khoá học" required="" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal For Update Course -->
<div class="modal fade myModal" id="updateCourse-<?php echo $selCourseRow['cou_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <form class="refreshFrm" id="addCourseFrm" method="post">
      <div class="modal-content myModal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update ( <?php echo $selCourseRow['cou_name']; ?> )</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Khoá học</label>
              <input type="" name="course_name" id="course_name" class="form-control" value="<?php echo $selCourseRow['cou_name']; ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal For Add Exam -->
<div class="modal fade" id="modalForExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addExamFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm kỳ thi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Chọn khoá học</label>
              <select class="form-control" name="courseSelected">
                <option value="0">Chọn khoá học</option>
                <?php
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC");
                if ($selCourse->rowCount() > 0) {
                  while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                  <?php }
                } else { ?>
                  <option value="0">Không tìm thấy!</option>
                <?php }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label>Thời gian thi</label>
              <select class="form-control" name="timeLimit" required="">
                <option value="0">Chọn thời gian</option>
                <option value="15">15 Minutes</option>
                <option value="30">30 Minutes</option>
                <option value="45">45 Minutes</option>
                <option value="60">60 Minutes</option>
                <option value="90">90 Minutes</option>
                <option value="120">120 Minutes</option>
              </select>
            </div>

            <div class="form-group">
              <label>Số câu hỏi</label>
              <input type="number" name="examQuestDipLimit" id="" class="form-control" placeholder="Nhập số câu hỏi">
            </div>

            <div class="form-group">
              <label>Tên kỳ thi</label>
              <input type="" name="examTitle" class="form-control" placeholder="Nhập tên kỳ thi" required="">
            </div>

            <div class="form-group">
              <label>Mô tả</label>
              <textarea name="examDesc" class="form-control" rows="4" placeholder="Nhập mô tả" required=""></textarea>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal For Add Examinee -->
<div class="modal fade" id="modalForAddExaminee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addExamineeFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm người thi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Tên</label>
              <input type="" name="fullname" id="fullname" class="form-control" placeholder="Nhập tên" autocomplete="off" required="">
            </div>
            <div class="form-group">
              <label>Ngày sinh</label>
              <input type="date" name="bdate" id="bdate" class="form-control" placeholder="Nhập ngày sinh" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Giới tính</label>
              <select class="form-control" name="gender" id="gender">
                <option value="0">Chọn giới tính</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
              </select>
            </div>
            <div class="form-group">
              <label>Khoá học</label>
              <select class="form-control" name="course" id="course">
                <option value="0">Chọn khoá học</option>
                <?php
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                <?php }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Năm học</label>
              <select class="form-control" name="year_level" id="year_level">
                <option value="0">Chọn năm học</option>
                <option value="first year">Năm 1</option>
                <option value="second year">Năm 2</option>
                <option value="third year">Năm 3</option>
                <option value="fourth year">Năm 4 trở đi</option>
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" autocomplete="off" required="">
            </div>
            <div class="form-group">
              <label>Mật khẩu</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" autocomplete="off" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </div>
    </form>
  </div>
</div>



<!-- Modal For Add Question -->
<div class="modal fade" id="modalForAddQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addQuestionFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm câu hỏi cho <br><?php echo $selExamRow['ex_title']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="refreshFrm" method="post" id="addQuestionFrm">
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group">
                <label>Câu hỏi</label>
                <input type="hidden" name="examId" value="<?php echo $exId; ?>">
                <input type="" name="question" id="course_name" class="form-control" placeholder="Nhập câu hỏi" autocomplete="off">
              </div>

              <fieldset>
                <legend>Nhập đáp án cho lựa chọn </legend>
                <div class="form-group">
                  <label>Choice A</label>
                  <input type="" name="choice_A" id="choice_A" class="form-control" placeholder="Nhập lựa chọn A" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Choice B</label>
                  <input type="" name="choice_B" id="choice_B" class="form-control" placeholder="Nhập lựa chọn B" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Choice C</label>
                  <input type="" name="choice_C" id="choice_C" class="form-control" placeholder="Nhập lựa chọn C" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Choice D</label>
                  <input type="" name="choice_D" id="choice_D" class="form-control" placeholder="Nhập lựa chọn D" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Đáp án đúng</label>
                  <input type="" name="correctAnswer" id="" class="form-control" placeholder="Nhập đáp án đúng" autocomplete="off">
                </div>
              </fieldset>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>
      </div>
    </form>
  </div>
</div>