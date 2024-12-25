<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $examData['exam']['ex_title']; ?></title>
    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function() { null; };
    </script>
</head>
<body>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-md-12">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>
                                <?php echo $examData['exam']['ex_title']; ?>
                                <div class="page-title-subheading">
                                    <?php echo $examData['exam']['ex_description']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="page-title-actions mr-5" style="font-size: 20px;">
                            <form name="cd">
                                <input type="hidden" id="timeExamLimit" value="<?php echo $examData['exam']['ex_time_limit']; ?>">
                                <label>Remaining Time: </label>
                                <input style="border:none;background-color:transparent;color:blue;font-size:25px;" name="disp" type="text" class="clock" id="txt" value="00:00" size="5" readonly="true" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 p-0 mb-4">
                <form method="post" id="submitAnswerFrm">
                    <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="examAction" id="examAction">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                        <?php 
                        if (!empty($examData['questions'])) {
                            $i = 1;
                            foreach ($examData['questions'] as $question) {
                                $questId = $question['eqt_id']; ?>
                                <tr>
                                    <td>
                                        <p><b><?php echo $i++; ?>.) <?php echo $question['exam_question']; ?></b></p>
                                        <div class="col-md-4 float-left">
                                            <div class="form-group pl-4">
                                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $question['exam_ch1']; ?>" class="form-check-input" type="radio" required>
                                                <label class="form-check-label"><?php echo $question['exam_ch1']; ?></label>
                                            </div>
                                            <div class="form-group pl-4">
                                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $question['exam_ch2']; ?>" class="form-check-input" type="radio" required>
                                                <label class="form-check-label"><?php echo $question['exam_ch2']; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 float-left">
                                            <div class="form-group pl-4">
                                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $question['exam_ch3']; ?>" class="form-check-input" type="radio" required>
                                                <label class="form-check-label"><?php echo $question['exam_ch3']; ?></label>
                                            </div>
                                            <div class="form-group pl-4">
                                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $question['exam_ch4']; ?>" class="form-check-input" type="radio" required>
                                                <label class="form-check-label"><?php echo $question['exam_ch4']; ?></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td style="padding: 20px;">
                                    <button type="button" class="btn btn-warning p-3" id="resetExamFrm">Reset</button>
                                    <input name="submit" type="submit" value="Submit" class="btn btn-primary p-3 float-right" id="submitAnswerFrmBtn">
                                </td>
                            </tr>
                        <?php } else { ?>
                            <b>No question at this moment</b>
                        <?php } ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">


    // Biến đếm số lần chuyển tab
    var visibilityChangeCount = 0;

    // Ngăn người dùng quay lại trang trước
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() { null };

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



</script>
</html>
