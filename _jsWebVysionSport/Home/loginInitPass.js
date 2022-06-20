$(document).ready(function() {    
  $("#btnInitPassword").click(function() {
    var errorData   = "";
    var canInitPass = true;
   
    if($('#inputOldPassword').val() == ''){
      canInitPass = false;
      $("#inputOldPassword").css({"borderColor": "#dc3545"});
      errorData += '<li>Old password is empty !</li>';
    }

    if($('#inputNewPassword').val() == ''){
      canInitPass = false;
      $("#inputNewPassword").css({"borderColor": "#dc3545"});
      errorData += '<li>New password is empty !</li>';
    }

    if($('#inputConfirmNewPassword').val() == ''){
      canInitPass = false;
      $("#inputConfirmNewPassword").css({"borderColor": "#dc3545"});
      errorData += '<li>Confirm new password is empty !</li>';
    }

    if (canInitPass) {
      if ($('#inputNewPassword').val().length > 3){
        if ($('#inputNewPassword').val() == $('#inputConfirmNewPassword').val()) {
          $('#inputIdUser').val(localStorage.getItem("idUser"));
          $.ajax({ 
            url: '../../Controllers/Login/initPassword.php',
            data: $('#FormInitPassword').serialize(),
            type: 'post',
            dataType: "json",
            success : function(data) {
              if(data.confirmSave){
                $(".alert-success").show("slow").delay(1500).hide("slow");
                setTimeout(function() {window.location.href = "./index.html";}, 2000);
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
          errorData += '<li>The password and confirmation do not match !</li>';
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html('<ul>'+errorData+'</ul>');
        }
      } else {
        errorData += '<li>The password is too short !</li>';
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html('<ul>'+errorData+'</ul>');
      }
    } else {
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html('<ul>'+errorData+'</ul>');
    }
  });
});