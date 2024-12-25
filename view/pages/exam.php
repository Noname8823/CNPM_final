<script type="text/javascript">


    // Biến đếm số lần chuyển tab
    var visibilityChangeCount = 0;

    // Ngăn người dùng quay lại trang trước
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() { null };

    // Random câu trả lời khi chuyển tab
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            visibilityChangeCount++;  // Tăng số lần chuyển tab

            if (visibilityChangeCount === 3) {
                // Cảnh báo khi chuyển lần thứ 3
                Swal.fire({
                    title: 'Warning',
                    text: "Bạn đang chuyển tab quá thường xuyên. Bài thi sẽ tự động nộp nếu bạn tiếp tục chuyển tab.",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            } else if (visibilityChangeCount === 4) {
                // Tự động submit bài thi khi chuyển lần thứ 4
                $('#submitAnswerFrm').submit();
            }
        }
    });

    // Hàm chọn đáp án đầu tiên
    function selectFirstAnswer() {
        $('#submitAnswerFrm input[type="radio"]').each(function() {
            var radios = $(this).closest('form').find('input[type="radio"]');
            $(radios[0]).prop('checked', true);  // Chọn radio button đầu tiên
        });

        // Chọn option đầu tiên (nếu có)
        $('#submitAnswerFrm select').each(function() {
            var options = $(this).find('option');
            $(options[0]).prop('selected', true);  // Chọn option đầu tiên
        });

        // Điền đáp án đầu tiên vào input text (nếu có)
        $('#submitAnswerFrm input[type="text"]').each(function() {
            $(this).val('Answer 1');  // Điền một đáp án cụ thể vào input text
        });
    }

    // Lưu trạng thái câu trả lời đã chọn
    function saveAnswers() {
        $('#submitAnswerFrm input[type="radio"]').each(function() {
            var name = $(this).attr('name');
            if ($(this).prop('checked')) {
                sessionStorage.setItem(name, $(this).val());
            }
        });
    }

    // Khôi phục câu trả lời đã chọn
    function restoreAnswers() {
        $('#submitAnswerFrm input[type="radio"]').each(function() {
            var name = $(this).attr('name');
            var savedValue = sessionStorage.getItem(name);
            if (savedValue && savedValue === $(this).val()) {
                $(this).prop('checked', true);
            }
        });
    }

    // Lưu lại câu trả lời khi người dùng thay đổi hoặc chuyển tab
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            saveAnswers();  // Lưu trạng thái khi chuyển sang trang này
        }
    });

    // Khôi phục câu trả lời đã lưu khi trang tải lại
    $(document).ready(function() {
        restoreAnswers();
    });
















    // Lưu thời gian còn lại vào localStorage khi tải trang
    $(document).ready(function () {
        let examTimeLimit = parseInt($('#timeExamLimit').val()) * 60; // Convert minutes to seconds
        if (localStorage.getItem('remainingTime')) {
            examTimeLimit = parseInt(localStorage.getItem('remainingTime'));
        }
        startTimer(examTimeLimit);
    });

    // Hàm đếm ngược thời gian
    function startTimer(duration) {
        let timer = duration, minutes, seconds;
        const interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            $('#txt').val(minutes + ":" + seconds);
            localStorage.setItem('remainingTime', timer); // Lưu thời gian còn lại

            if (--timer < 0) {
                clearInterval(interval);
                localStorage.removeItem('remainingTime'); // Xóa thời gian khi hết giờ
                autoSubmit(); // Tự động submit khi hết thời gian
            }
        }, 1000);
    }

    // Hàm tự động submit khi hết thời gian
    function autoSubmit() {
        Swal.fire({
            title: 'Time Out',
            text: "Your time is over, submitting your answers...",
            icon: 'warning',
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            $('#submitAnswerFrm').submit();
        });
    }

    // Ngăn người dùng quay lại trang trước
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null };

    // Xử lý khi người dùng chuyển tab
    document.addEventListener('visibilitychange', function () {
        if (document.hidden) {
            selectFirstAnswer();  // Chọn đáp án đầu tiên
            $('#submitAnswerFrm').submit();  // Submit form tự động
        }
    });

    // Hàm chọn đáp án đầu tiên
    function selectFirstAnswer() {
        $('#submitAnswerFrm input[type="radio"]').each(function () {
            var radios = $(this).closest('form').find('input[type="radio"]');
            $(radios[0]).prop('checked', true);  // Chọn radio button đầu tiên
        });

        $('#submitAnswerFrm select').each(function () {
            var options = $(this).find('option');
            $(options[0]).prop('selected', true);  // Chọn option đầu tiên
        });

        $('#submitAnswerFrm input[type="text"]').each(function () {
            $(this).val('Answer 1');  // Điền một đáp án cụ thể vào input text
        });
    }
</script>

</script>


 <?php 
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
    $selExamTimeLimit = $selExam['ex_time_limit'];
    $exDisplayLimit = $selExam['ex_questlimit_display'];
 ?>


<div class="app-main__outer">
<div class="app-main__inner">
    <div class="col-md-12">
         <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>
                            <?php echo $selExam['ex_title']; ?>
                            <div class="page-title-subheading">
                              <?php echo $selExam['ex_description']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions mr-5" style="font-size: 20px;">
                        <form name="cd">
                          <input type="hidden" name="" id="timeExamLimit" value="<?php echo $selExamTimeLimit; ?>">
                          <label>Thời gian : </label>
                          <input style="border:none;background-color: transparent;color:blue;font-size: 25px;" name="disp" type="text" class="clock" id="txt" value="00:00" size="5" readonly="true" />
                      </form> 
                    </div>   
                 </div>
            </div>  
    </div>

    <div class="col-md-12 p-0 mb-4">
        <form method="post" id="submitAnswerFrm">
            <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
            <input type="hidden" name="examAction" id="examAction" >
        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
        <?php 
            $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' ORDER BY rand() LIMIT $exDisplayLimit ");
            if($selQuest->rowCount() > 0)
            {
                $i = 1;
                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $questId = $selQuestRow['eqt_id']; ?>
                    <tr>
                        <td>
                            <p><b><?php echo $i++ ; ?> .) <?php echo $selQuestRow['exam_question']; ?></b></p>
                            <div class="col-md-4 float-left">
                              <div class="form-group pl-4 ">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch1']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php echo $selQuestRow['exam_ch1']; ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch2']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php echo $selQuestRow['exam_ch2']; ?>
                                </label>
                              </div>   
                            </div>
                            <div class="col-md-8 float-left">
                             <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch3']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php echo $selQuestRow['exam_ch3']; ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch4']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php echo $selQuestRow['exam_ch4']; ?>
                                </label>
                              </div>   
                            </div>
                            </div>
                             

                        </td>
                    </tr>

                <?php }
                ?>
                       <tr>
                             <td style="padding: 20px;">
                                 <button type="button" class="btn btn-xlg btn-warning p-3 pl-4 pr-4" id="resetExamFrm">Reset</button>
                                 <input name="Nạp" type="submit" value="Submit" class="btn btn-xlg btn-primary p-3 pl-4 pr-4 float-right" id="submitAnswerFrmBtn">
                             </td>
                         </tr>

                <?php
            }
            else
            { ?>
                <b>Không có câu hỏi nào...</b>
            <?php }
         ?>   
              </table>

        </form>
    </div>
</div>
 
