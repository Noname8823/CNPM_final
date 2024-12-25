// Admin Log in
$(document).on("submit","#examineeLoginFrm", function(){
   $.post("model/loginExe.php", $(this).serialize(), function(data){
      if(data.res == "invalid")
      {
        Swal.fire(
          'Invalid',
          'Please input valid email / password',
          'error'
        )
      }
      else if(data.res == "success")
      {
        $('body').fadeOut();
        window.location.href='home.php';
      }
   },'json');

   return false;
});




// Submit Answer
// Submit Answer
// Submit Answer
$(document).on('submit', '#submitAnswerFrm', function(){
  var examAction = $('#examAction').val();

  // Kiểm tra nếu có hành động examAction (time out)
  if(examAction != "") {
    Swal.fire({
      title: 'Time Out',
      text: "Your time is over, please click ok",
      icon: 'warning',
      showCancelButton: false,
      allowOutsideClick: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK!'
    }).then((result) => {
      if (result.value) {
        // Thực hiện gửi form
        $.post("model/submitAnswerExe.php", $(this).serialize(), function(data){
          handleResponse(data);
        }, 'json');
      }
    });
  } else {
    // Nếu không có examAction (submit bình thường), thực hiện gửi form ngay lập tức
    $.post("model/submitAnswerExe.php", $(this).serialize(), function(data){
      handleResponse(data);
    }, 'json');
  }

  return false;
});

// Hàm xử lý kết quả trả về từ server
function handleResponse(data) {
  if(data.res == "alreadyTaken") {
    Swal.fire(
      'Already Taken',
      "You already took this exam",
      'error'
    );
  } else if(data.res == "success") {
    Swal.fire({
      title: 'Success',
      text: "Your answer was successfully submitted!",
      icon: 'success',
      allowOutsideClick: false,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK!'
    }).then((result) => {
      if (result.value) {
        $('#submitAnswerFrm')[0].reset();
        var exam_id = $('#exam_id').val();
        window.location.href = 'home.php?page=result&id=' + exam_id;
      }
    });
  } else if(data.res == "failed") {
    Swal.fire(
      'Error',
      "Something went wrong",
      'error'
    );
  }
}



// Submit Feedbacks
$(document).on("submit","#addFeebacks", function(){
   $.post("model/submitFeedbacksExe.php", $(this).serialize(), function(data){
      if(data.res == "limit")
      {
        Swal.fire(
          'Error',
          'You reached the 3 limit maximum for feedbacks',
          'error'
        )
      }
      else if(data.res == "success")
      {
        Swal.fire(
          'Success',
          'your feedbacks has been submitted successfully',
          'success'
        )
          $('#addFeebacks')[0].reset();
        
      }
   },'json');

   return false;
});

