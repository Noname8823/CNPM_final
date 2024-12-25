<!-- Modal For Add Course -->
<div class="modal fade" id="modalForAddCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="addCourseFrm" method="post" action="../controllers/CourseController.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm khoá học</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="course_name">Khoá học</label>
            <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Nhập tên khoá học" required autocomplete="off">
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
