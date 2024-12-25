<!-- Modal For Add Exam -->
<div class="modal fade" id="modalForExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addExamFrm" method="post" action="/exam/addExam">
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
                <?php foreach ($data['courses'] as $course): ?>
                  <option value="<?php echo $course['cou_id']; ?>"><?php echo $course['cou_name']; ?></option>
                <?php endforeach; ?>
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
              <input type="number" name="examQuestDipLimit" class="form-control" placeholder="Nhập số câu hỏi">
            </div>

            <div class="form-group">
              <label>Tên kỳ thi</label>
              <input type="text" name="examTitle" class="form-control" placeholder="Nhập tên kỳ thi" required="">
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
