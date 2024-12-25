<fieldset style="width:543px;">
   <legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Cập nhật <b>( <?php echo strtoupper($examinee['exmne_fullname']); ?> )</b></i></legend>
   <div class="col-md-12 mt-4">
      <form method="post" id="updateExamineeFrm">
         <div class="form-group">
            <legend>Tên</legend>
            <input type="hidden" name="exmne_id" value="<?php echo $examinee['exmne_id']; ?>">
            <input type="text" name="exFullname" class="form-control" required value="<?php echo $examinee['exmne_fullname']; ?>">
         </div>

         <div class="form-group">
            <legend>Giới tính</legend>
            <select class="form-control" name="exGender">
               <option value="<?php echo $examinee['exmne_gender']; ?>"><?php echo $examinee['exmne_gender']; ?></option>
               <option value="male">Nam</option>
               <option value="female">Nữ</option>
            </select>
         </div>

         <div class="form-group">
            <legend>Ngày sinh</legend>
            <input type="date" name="exBdate" class="form-control" required value="<?php echo date('Y-m-d', strtotime($examinee["exmne_birthdate"])); ?>" />
         </div>

         <div class="form-group">
            <legend>Khoá học</legend>
            <select class="form-control" name="exCourse">
               <option value="<?php echo $course['cou_id']; ?>"><?php echo $course['cou_name']; ?></option>
               <?php foreach ($otherCourses as $row): ?>
                  <option value="<?php echo $row['cou_id']; ?>"><?php echo $row['cou_name']; ?></option>
               <?php endforeach; ?>
            </select>
         </div>

         <div class="form-group">
            <legend>Năm học</legend>
            <input type="text" name="exYrlvl" class="form-control" required value="<?php echo $examinee['exmne_year_level']; ?>">
         </div>

         <div class="form-group">
            <legend>Email</legend>
            <input type="email" name="exEmail" class="form-control" required value="<?php echo $examinee['exmne_email']; ?>">
         </div>

         <div class="form-group">
            <legend>Mật khẩu</legend>
            <input type="password" name="exPass" class="form-control" required value="<?php echo $examinee['exmne_password']; ?>">
         </div>

         <div class="form-group">
            <legend>Trạng thái</legend>
            <input type="text" name="exStatus" class="form-control" required value="<?php echo $examinee['exmne_status']; ?>">
         </div>

         <div class="form-group" align="right">
            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
         </div>
      </form>
   </div>
</fieldset>
