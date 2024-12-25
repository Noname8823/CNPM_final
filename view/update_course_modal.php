<!-- Modal For Update Course -->
<div class="modal fade myModal" id="updateCourse-<?php echo $course['cou_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" id="updateCourseFrm">
      <div class="modal-content myModal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cập Nhật ( <?php echo htmlspecialchars($course['cou_name']); ?> )</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="course_name">Khoá học</label>
            <input type="hidden" name="course_id" value="<?php echo $course['cou_id']; ?>">
            <input type="text" name="course_name" id="course_name" class="form-control" value="<?php echo htmlspecialchars($course['cou_name']); ?>">
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
