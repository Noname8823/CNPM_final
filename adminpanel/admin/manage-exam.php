<?php
session_start();

if (!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");


?>
<?php include("../../conn.php"); ?>
<!-- MAO NI ANG HEADER -->
<?php include("controller/header.php"); ?>

<!-- UI THEME DIRI -->
<?php include("controller/ui-theme.php"); ?>

<div class="app-main">
  <!-- sidebar diri  -->
  <?php include("controller/sidebar.php"); ?>


  <?php
  $exId = $_GET['id'];

  $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exId' ");
  $selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);

  $courseId = $selExamRow['cou_id'];
  $selCourse = $conn->query("SELECT cou_name as courseName FROM course_tbl WHERE cou_id='$courseId' ")->fetch(PDO::FETCH_ASSOC);
  ?>


  <div class="app-main__outer">
    <div class="app-main__inner">
      <div class="app-page-title">
        <div class="page-title-wrapper">
          <div class="page-title-heading">
            <div> QUẢN LÝ KỲ THI
              <div class="page-title-subheading">
                Thêm câu hỏi cho <?php echo $selExamRow['ex_title']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div id="refreshData">
          <div class="row">
            <div class="col-md-6">
              <div class="main-card mb-3 card">
                <div class="card-header">
                  <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Thông tin kì thi
                </div>
                <div class="card-body">
                  <form method="post" id="updateExamFrm">
                    <div class="form-group">
                      <label>Khóa học</label>
                      <select class="form-control" name="courseId" required="">
                        <option value="<?php echo $selExamRow['cou_id']; ?>"><?php echo $selCourse['courseName']; ?></option>
                        <?php
                        $selAllCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC");
                        while ($selAllCourseRow = $selAllCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $selAllCourseRow['cou_id']; ?>"><?php echo $selAllCourseRow['cou_name']; ?></option>
                        <?php }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Tên kì thi</label>
                      <input type="hidden" name="examId" value="<?php echo $selExamRow['ex_id']; ?>">
                      <input type="" name="examTitle" class="form-control" required="" value="<?php echo $selExamRow['ex_title']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Mô tả</label>
                      <input type="" name="examDesc" class="form-control" required="" value="<?php echo $selExamRow['ex_description']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Thời gian</label>
                      <select class="form-control" name="examLimit" required="">
                        <option value="<?php echo $selExamRow['ex_time_limit']; ?>"><?php echo $selExamRow['ex_time_limit']; ?> Phút</option>
                        <option value="15">15 Phút</option>
                        <option value="30">30 Phút</option>
                        <option value="45">45 Phút</option>
                        <option value="60">60 Phút</option>
                        <option value="90">90 Phút</option>
                        <option value="120">120 Phút</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Số lượng câu hỏi</label>
                      <input type="number" name="examQuestDipLimit" class="form-control" value="<?php echo $selExamRow['ex_questlimit_display']; ?>">
                    </div>

                    <div class="form-group" align="right">
                      <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                    </div>
                  </form>
                </div>
              </div>

            </div>
            <div class="col-md-6">
              <?php
              $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exId' ORDER BY eqt_id desc");
              ?>
              <div class="main-card mb-3 card">
                <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Câu hỏi
                  <span class="badge badge-pill badge-primary ml-2">
                    <?php echo $selQuest->rowCount(); ?>
                  </span>
                  <div class="btn-actions-pane-right">
                    <button class="btn btn-sm btn-primary " data-toggle="modal" data-target="#modalForAddQuestion">Thêm câu hỏi</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="scroll-area-sm" style="min-height: 400px;">
                    <div class="scrollbar-container">

                      <?php

                      if ($selQuest->rowCount() > 0) {  ?>
                        <div class="table-responsive">
                          <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                            <thead>
                              <tr>
                                <th class="text-left pl-1">Tên khoá học</th>
                                <th class="text-center" width="20%">Quản lý</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              if ($selQuest->rowCount() > 0) {
                                $i = 1;
                                while ($selQuestionRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <tr>
                                    <td>
                                      <b><?php echo $i++; ?> .) <?php echo $selQuestionRow['exam_question']; ?></b><br>
                                      <?php
                                      // Choice A
                                      if ($selQuestionRow['exam_ch1'] == $selQuestionRow['exam_answer']) { ?>
                                        <span class="pl-4 text-success">A - <?php echo  $selQuestionRow['exam_ch1']; ?></span><br>
                                      <?php } else { ?>
                                        <span class="pl-4">A - <?php echo $selQuestionRow['exam_ch1']; ?></span><br>
                                      <?php }

                                      // Choice B
                                      if ($selQuestionRow['exam_ch2'] == $selQuestionRow['exam_answer']) { ?>
                                        <span class="pl-4 text-success">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
                                      <?php } else { ?>
                                        <span class="pl-4">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
                                      <?php }

                                      // Choice C
                                      if ($selQuestionRow['exam_ch3'] == $selQuestionRow['exam_answer']) { ?>
                                        <span class="pl-4 text-success">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
                                      <?php } else { ?>
                                        <span class="pl-4">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
                                      <?php }

                                      // Choice D
                                      if ($selQuestionRow['exam_ch4'] == $selQuestionRow['exam_answer']) { ?>
                                        <span class="pl-4 text-success">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
                                      <?php } else { ?>
                                        <span class="pl-4">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
                                      <?php }

                                      ?>

                                    </td>
                                    <td class="text-center">
                                      <a rel="facebox" href="facebox_modal/updateQuestion.php?id=<?php echo $selQuestionRow['eqt_id']; ?>" class="btn btn-sm btn-primary">Cập nhật</a>
                                      <button type="button" id="deleteQuestion" data-id='<?php echo $selQuestionRow['eqt_id']; ?>' class="btn btn-danger btn-sm">Xóa</button>
                                    </td>
                                  </tr>
                                <?php }
                              } else { ?>
                                <tr>
                                  <td colspan="2">
                                    <h3 class="p-3">Không tìn thấy khóa học</h3>
                                  </td>
                                </tr>
                              <?php }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      <?php } else { ?>
                        <h4 class="text-primary">Không có câu hỏi nào...</h4>
                      <?php
                      }
                      ?>
                    </div>
                  </div>


                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>



    <!-- MAO NI IYA FOOTER -->
    <?php include("controller/footer.php"); ?>

    <?php include("controller/modals.php"); ?>