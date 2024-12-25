<!-- Form Update Exam -->
<form id="updateExamFrm" method="POST">
  <input type="hidden" name="examId" value="<?php echo $data['exam']['ex_id']; ?>">
  <div class="form-group">
    <label for="courseId">Khoá học</label>
    <select name="courseId" class="form-control">
      <option value="0">Chọn khoá học</option>
      <?php foreach ($data['courses'] as $course): ?>
        <option value="<?php echo $course['cou_id']; ?>" <?php echo ($course['cou_id'] == $data['exam']['cou_id']) ? 'selected' : ''; ?>>
          <?php echo $course['cou_name']; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label for="examTitle">Tên kỳ thi</label>
    <input type="text" name="examTitle" class="form-control" value="<?php echo $data['exam']['ex_title']; ?>" required>
  </div>

  <div class="form-group">
    <label for="examLimit">Thời gian (phút)</label>
    <input type="number" name="examLimit" class="form-control" value="<?php echo $data['exam']['ex_time_limit']; ?>" required>
  </div>

  <div class="form-group">
    <label for="examQuestDipLimit">Số câu hỏi hiển thị</label>
    <input type="number" name="examQuestDipLimit" class="form-control" value="<?php echo $data['exam']['ex_questlimit_display']; ?>" required>
  </div>

  <div class="form-group">
    <label for="examDesc">Mô tả</label>
    <textarea name="examDesc" class="form-control" rows="4" required><?php echo $data['exam']['ex_description']; ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
