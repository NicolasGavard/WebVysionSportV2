$(document).ready(function() {    
  $("#btnAddAccount").click(function() {
    var errorData                 = "";
    var canAddUserAccount         = true;
   
    if($('#InputEnterpriseName').val() == ''){
      canAddUserAccount = false;
      $("#InputEnterpriseName").css({"borderColor": "#dc3545"});
      errorData += '<li>Enterprise name is empty !</li>';
    } else {
      $("#InputEnterpriseName").css({"borderColor": "#198754"});
    }

    if($('#InputEnterpriseEmail').val() == ''){
      canAddUserAccount = false;
      $("#InputEnterpriseEmail").css({"borderColor": "#dc3545"});
      errorData += '<li>Enterprise email is empty !</li>';
    } else {
      $("#InputEnterpriseEmail").css({"borderColor": "#198754"});
    }

    if($('#InputUserLogin').val() == ''){
      canAddUserAccount = false;
      $("#InputUserLogin").css({"borderColor": "#dc3545"});
      errorData += '<li>User login is empty !</li>';
    } else {
      $("#InputUserLogin").css({"borderColor": "#198754"});
    }

    if($('#InputUserPassword').val() == ''){
      canAddUserAccount = false;
      $("#InputUserPassword").css({"borderColor": "#dc3545"});
      errorData += '<li>User password is empty !</li>';
    } else {
      $("#InputUserPassword").css({"borderColor": "#198754"});
    }

    if($('#InputUserName').val() == ''){
      canAddUserAccount = false;
      $("#InputUserName").css({"borderColor": "#dc3545"});
      errorData += '<li>User name is empty !</li>';
    } else {
      $("#InputUserName").css({"borderColor": "#198754"});
    }

    if($('#InputUserFirstName').val() == ''){
      canAddUserAccount = false;
      $("#InputUserFirstName").css({"borderColor": "#dc3545"});
      errorData += '<li>User first name is empty !</li>';
    } else {
      $("#InputUserFirstName").css({"borderColor": "#198754"});
    }

    if($('#InputUserEmail').val() == ''){
      canAddUserAccount = false;
      $("#InputUserEmail").css({"borderColor": "#dc3545"});
      errorData += '<li>User email is empty !</li>';
    } else {
      $("#InputUserEmail").css({"borderColor": "#198754"});
    }

    if($('#InputUserPhone').val() == ''){
      canAddUserAccount = false;
      $("#InputUserPhone").css({"borderColor": "#dc3545"});
      errorData += '<li>User phone number is empty !</li>';
    } else {
      $("#InputUserPhone").css({"borderColor": "#198754"});
    }

    if (canAddUserAccount) {
      $.ajax({ 
        url: '../../Controllers/Login/register.php',
        data: $('#FormRegister').serialize(),
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
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html('<ul>'+errorData+'</ul>');
    }
  });
});