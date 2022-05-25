// Load Info Page
$.ajax({ 
  url: 'Controllers/Security/User/view.php',
  data: {'id': localStorage.getItem("idUser")},
  type: 'post',
  dataType: "json",
  success: function(data) {
    if (data) {
      $(".InfoProfilFormIdUser").val(data.ViewUser.id);
      $(".InfoProfilFormIdStyUserType").val(data.ViewUser.idStyUserType);
      $(".InfoProfilFormName").val(data.ViewUser.name);
      $(".InfoProfilFormFirstName").val(data.ViewUser.firstName);
      $(".InfoProfilFormLinkToPicture").val(data.ViewUser.linkToPicture);
      $(".InfoProfilPicture").attr("src", data.ViewUser.linkToPicture);
      $(".InfoProfilFormEmail").val(data.ViewUser.email);
      $(".InfoProfilFormEmail").html(data.ViewUser.email);
      $(".InfoProfilFormEmailBackup").val(data.ViewUser.emailBackup);
      $(".InfoProfilFormIdStyEnterprise").val(data.ViewUser.idStyEnterprise);
      $(".InfoProfilFormIdLanguage").val(data.ViewUser.idLanguage);
      $(".InfoProfilFormLogin").val(data.ViewUser.login);
      $(".InfoProfilFormLoginTxt").val(data.ViewUser.login);
      $(".InfoProfilFormRoleTxt").val(data.ViewUser.roles.name);
      $(".InfoProfilFormMobile").val(data.ViewUser.mobile);
      $(".InfoProfilFormMobile").html(data.ViewUser.mobile);
      $(".InfoProfilFormPhone").val(data.ViewUser.phone);
      $(".InfoProfilFormPhone").html(data.ViewUser.phone);
      $(".InfoProfilFormAddress").html('');
      
      $.map(data.ListLanguages, function(val, key) {
        var  activeSelected = false;
        if (val.id == data.ViewUser.idLanguage) {
          activeSelected = true;
        }
        
        $('.InfoProfilFormIdLanguage').append($('<option>', {
          value: val.id,
          text: val.code+' - '+val.description,
          selected: activeSelected
        }));
      });

    } else {
      $('.alert-danger p').text(data['errorData']['text']);
      $('.alert-danger').show("slow").delay(5000).hide("slow");
    }
  },
  error: function (e) {
    console.log(e);
  }
});

// Change Language
$(".InfoProfilFormIdLanguage").change(function() {
  $.ajax({
    url : 'Controllers/Security/Language/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': this.value},
    success : function(data) {
      setLanguage = data.ViewLanguage.code;
      $.ajax({ 
        url:  'jsLanguage/' +  setLanguage + '.json', 
        dataType: 'json', 
        async: false, 
        success : function (lang) {
          $(".page_profil_title").text(lang.page_profil_title);
          $(".page_profil_title_2").text(lang.page_profil_title_2);
          
          $(".page_profil_login").text(lang.page_profil_login);
          $(".page_profil_login").attr("placeholder", lang.page_profil_login);
          $(".page_profil_role").text(lang.page_profil_role);
          $(".page_profil_role").attr("placeholder", lang.page_profil_role);
          $(".page_profil_name").text(lang.page_profil_name);
          $(".page_profil_name").attr("placeholder", lang.page_profil_name);
          $(".page_profil_firstname").text(lang.page_profil_firstname);
          $(".page_profil_firstname").attr("placeholder", lang.page_profil_firstname);
          $(".page_profil_email").text(lang.page_profil_email);
          $(".page_profil_email").attr("placeholder", lang.page_profil_email);
          $(".page_profil_emailBackup").text(lang.page_profil_emailBackup);
          $(".page_profil_emailBackup").attr("placeholder", lang.page_profil_emailBackup);
          $(".page_profil_phone").text(lang.page_profil_phone);
          $(".page_profil_phone").attr("placeholder", lang.page_profil_phone);
          $(".page_profil_mobile").text(lang.page_profil_mobile);
          $(".page_profil_mobile").attr("placeholder", lang.page_profil_mobile);
          $(".page_profil_langue").text(lang.page_profil_langue);
          
          $(".page_profil_old_pass").text(lang.page_profil_old_pass);
          $(".page_profil_old_pass").attr("placeholder", lang.page_profil_old_pass);
          $(".page_profil_new_pass").text(lang.page_profil_new_pass);
          $(".page_profil_new_pass").attr("placeholder", lang.page_profil_new_pass);
          $(".page_profil_confirm_pass").text(lang.page_profil_confirm_pass);
          $(".page_profil_confirm_pass").attr("placeholder", lang.page_profil_confirm_pass);
          
          $(".page_profil_update_title").text(lang.page_profil_update_title);
          $(".page_profil_change_pass_title").text(lang.page_profil_change_pass_title);
       
          $(".page_all_change_picture").text(lang.page_all_change_picture);
          
          $(".errorData_ok").text(lang.errorData_ok);
          $(".errorData_ok_txt").text(lang.errorData_ok_txt);
          $(".errorData_ko").text(lang.errorData_ko);
          $(".errorData_ko_txt").text(lang.errorData_ko_txt);

          errorData_ok                  = lang.errorData_ok;
          errorData_ok_txt              = lang.errorData_ok_txt;
          errorData_ko                  = lang.errorData_ko;
          errorData_ko_txt              = lang.errorData_ko_txt;
          errorData_ko_txt_code         = lang.errorData_ko_txt_code;
          errorData_ko_txt_description  = lang.errorData_ko_txt_description;
        }
      });
    }
  });
});

// SAVE PROFIL
$("#btnSaveProfil").click(function() {
  $.ajax({ 
    url: 'Controllers/Security/User/save.php',
    data: $('#FormSaveProfil').serialize(),
    type: 'post',
    dataType: "json",
    success: function(output) {
      if (output['confirmSave']) {
        // Change Local Storage
        localStorage.setItem("idUser",$('#FormSaveProfil #InputUserName').val());
        localStorage.setItem("login",$('#FormSaveProfil #InputUserLogin').val());
        localStorage.setItem("name",$('#FormSaveProfil #InputUserName').val());
        localStorage.setItem("firstName",$('#FormSaveProfil #InputUserFirstName').val());
        localStorage.setItem("linkToPicture",output['infoProfil']['linkToPicture']);
        localStorage.setItem("email",$('#FormSaveProfil #InputUserEmail').val());
        localStorage.setItem("emailBackup",$('#FormSaveProfil #InputUserEmailBackUp').val());
        
        $(".alert-success").show("slow").delay(1500).hide("slow");
        setTimeout(function() {window.location.href = "./profil.php";}, 2000);
      } else {
        $('.alert-danger p').text(output['errorData']['text']);
        $('.alert-danger').show("slow").delay(5000).hide("slow");
      }
    },
    error: function (e) {
      console.log(e);
    }
  });
});

// CHANGE PASSWORD PROFIL
$("#btnSaveChangePassword").click(function() {
  $.ajax({ 
    url: 'Controllers/Profil/changePassword.php',
    data: $('#FormChangePasswordProfil').serialize(),
    type: 'post',
    dataType: "json",
    success: function(output) {
      if(output == '1'){
        $(".alert-success").show("slow").delay(1500).hide("slow");
        setTimeout(function() {window.location.href = "./profil.php";}, 2000);
      } else {
        $('.alert-danger p').text(output['errorData']['text']);
        $('.alert-danger').show("slow").delay(5000).hide("slow");
      }
    },
    error: function (e) {
      console.log(e);
    }
  });
});

// IMAGE
function encodeImgtoBase64(element) {
  var file = element.files[0];
  var reader = new FileReader();
  reader.onloadend = function() {
    $("#linkToPictureBase64").val(reader.result);
    $("#convertImg").text(reader.result);
    $("#base64Img").attr("src", reader.result);
  }
  reader.readAsDataURL(file);
}

Dropzone.autoDiscover = false;
$(".dropzone").dropzone({         
  addRemoveLinks: true,
  removedfile: function(file) {
    var name = file.name;
    var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  },
  paramName: 'file',
  clickable: true,
  maxFilesize: 1,
  uploadMultiple: false,
  autoProcessQueue: false,
  accept: function(file, done){
      reader = new FileReader();
      reader.onload = handleReaderLoad;
      reader.readAsDataURL(file);
      function handleReaderLoad(evt) {
        document.getElementById("base64Img").setAttribute('value', evt.target.result);
      }
      done();
  },
});