$(document).ready(function() {    
  if ($('#inputEmail').val() != '' && $('#inputDateEnd').val() != ''){
    $.ajax({ 
      url: '../../Controllers/Login/newPasswordControl.php',
      data: $('#FormNewPassword').serialize(),
      type: 'post',
      dataType: "json",
      success : function(data) {
        if(data.confirmCanChange){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          $('.alert-success p').html('An email allowing you to log in has been sent to you !');
        } else {
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html('Permission has expired, please reapply for a forgotten password');
          $('#btnFormNewPassword').hide();
          $('#divbtnForgetPassword').show();
        }
      },
      error : function(data) {
        errorData = ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      },
      error: function (e) {
        console.log(e);
      }
    });
  }
  
  canNewPass = true;
  if ($('#inputPassword').val() == '' || $('#inputConfirmPassword').val() == ''){
    canNewPass = false;
    $("#inputEmail").css({"borderColor": "#dc3545"});
    errorData += '<li>User password or confirm password is empty !</li>';
  }

  if ($('#inputPassword').val() != $('#inputConfirmPassword').val()){
    canNewPass = false;
    $("#inputEmail").css({"borderColor": "#dc3545"});
    errorData += '<li>The password is different from the confirmation !</li>';
  }

  if (canNewPass) {
    $("#btnFormNewPassword").click(function() {
      $.ajax({ 
        url: '../../Controllers/Login/changePassword.php',
        data: $('#FormNewPassword').serialize(),
        type: 'post',
        dataType: "json",
        success : function(data) {
          if(data.confirmSendMail){
            $(".alert-success").show("slow").delay(1500).hide("slow");
            $('.alert-success p').html('An email allowing you to log in has been sent to you !');
          } else {
            $('.alert-danger').show("slow").delay(5000).hide("slow");
            $('.alert-danger p').html(data.errorData.defaultText);
          }
        },
        error : function(data) {
          errorData = ' - An internal error has occurred !!<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(errorData);
        },
        error: function (e) {
          console.log(e);
        }
      });
    });
  }
});