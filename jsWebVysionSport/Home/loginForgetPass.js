$(document).ready(function() {    
  $("#btnFormForgetPassword").click(function() {
    var errorData   = "";
    var canForgetPass = true;
   
    if ($('#inputEmail').val() == '' && $('#inputEmailBackup').val() == ''){
      canForgetPass = false;
      $("#inputEmail").css({"borderColor": "#dc3545"});
      $("#inputEmailBackup").css({"borderColor": "#dc3545"});
      errorData += '<li>User email or User email backup is empty !</li>';
    }

    if (canForgetPass) {
      $.ajax({ 
        url: '../../Controllers/Login/forgetPassword.php',
        data: $('#FormForgetPassword').serialize(),
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
    } else {
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html('<ul>'+errorData+'</ul>');
    }
  });
});