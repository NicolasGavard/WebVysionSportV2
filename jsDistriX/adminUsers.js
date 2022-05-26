$(document).ready(function() {
  showData(0);
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
  
  $('#listUsersFilterIdStyEnterprise').on('change', function(){
    var idStyEnterprise = this.value;
    $('#listUsersAddAccountIdStyEnterprise').empty();
    $('#listUsersFilterIdStyEnterprise').empty();
    $('#listUsersTbody').empty();
    showData(idStyEnterprise);
  }); 

  $("#btnAddProfil").click(function() {
    var errorData   = "";
    var pass        = $('#InputUserPass').val();
    var confirmPass = $('#InputUserConfirmPass').val();
    var idStyEnterprise= $('#listUsersAddAccountIdStyEnterprise').val();
    
    if(idStyEnterprise == ''){
      errorData += ' - The user account must be linked to a enterprise !!<br/>'
    } else {
      if (pass != "" || confirmPass != ""){
        var validEmail        = ValidateEmail($('#InputEmail').val());
        var validEmailBackup  = ValidateEmail($('#InputEmailBackup').val());
        
        if (pass == confirmPass && (validEmail || validEmailBackup)){
          $.ajax({
            url : 'Controllers/Security/User/save.php',
            type : 'POST',
            dataType : 'JSON',
            data: $('#FormAddProfil').serialize(),
            success : function(data) {
              $(".alert-success").show("slow").delay(1500).hide("slow");
              setTimeout(function() {window.location.href = "./adminUserList.php";}, 2000);
            },
            error : function(data) {
              errorData += ' - An internal error has occurred !!<br/>'
              $('.alert-danger').show("slow").delay(5000).hide("slow");
              $('.alert-danger p').html(errorData);
            }
          });
        } else {
          if (validEmail == false){
            errorData += ' - the email address is not a valid email address !!<br/>'
          } 
          if (validEmailBackup == false){
            errorData += ' - the backup email address is not a valid email address!!<br/>'
          }
          if (validEmail != false && validEmailBackup != false){
            errorData += ' - The password does not match the confirmation !!<br/>'
          }
        } 
      } else {
        if (pass == "")       { errorData += ' - Pass empty !!<br/>'; }
        if (confirmPass == ""){ errorData += ' - Confirm Pass empty !!<br>'; }
      }
    }

    if (errorData !== ''){
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
  
  $("#btnInitProfil").click(function() {
    $.ajax({
      url : 'Controllers/Security/User/initPass.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormInitProfil').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminUserList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });

  $("#btnDelProfil").click(function() {
    $.ajax({
      url : 'Controllers/Security/User/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDelProfil').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminUserList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });

  $("#btnRestProfil").click(function() {
    $.ajax({
      url : 'Controllers/Security/User/restore.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormRestProfil').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminUserList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });
});

function showData(idStyEnterprise){
  $.ajax({
    url : 'Controllers/Security/User/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idStyEnterprise': idStyEnterprise},
    success : function(data) {
      $.map(data.ListEnterprises, function(val, key) {
        activeSelected = false;
        if (val.id == idStyEnterprise)  var activeSelected = true;
        
        $('#listUsersAddAccountIdStyEnterprise').append($('<option>', {
          value: val.id,
          text: val.name,
          selected: activeSelected
        }));

        $('#listUsersFilterIdStyEnterprise').append($('<option>', {
          value: val.id,
          text: val.name,
          selected: activeSelected
        }));
      });
      
      $.map(data.ListUsers, function(val, key) {
        if(val.statut == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.statut == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listUsersTbody').append(
          '<tr>'+
          ' <td><img src="'+val.linkToPicture+'"/></td>'+
          ' <td>'+
          '   '+val.firstName+' '+val.name+''+
          '   <br/><br/>'+
          '   '+val.nameEnterprise+''+
          ' </td>'+
          ' </td>'+
          ' <td>'+
          '   Mail : <a href="mailto:'+val.email+'">'+val.email+'</a>'+
          '   <br/><br/>'+
          '   Phone : <a href="callto:'+val.phone+'">'+val.phone+'</a>'+
          ' </td>'+
          ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
          ' <td>'+
          '   <button type="button" title="View"          class="btn btn-primary    btn-rounded btn-icon btnViewUser"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddUser"      onclick="ViewUser(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
          '   <button type="button" title="Right"         class="btn btn-secondary  btn-rounded btn-icon btnRightUser"                      data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddUserRight" onclick="ViewAllRightsByIdUser(\''+val.id+'\', \''+val.firstName+' '+val.name+'\', 0, 0, 0, 0);"><i class="ti-briefcase"></i></button>'+
          '   <button type="button" title="Init Password" class="btn btn-warning    btn-rounded btn-icon btnInitUser"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalInitUser"     onclick="InitUser(\''+val.id+'\', \''+val.firstName+' '+val.name+'\');"><i class="ti-key"></i></button>'+
          '   <button type="button" title="Delete user"   class="btn btn-danger     btn-rounded btn-icon btnDeleUser '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelUser"      onclick="DelUser(\''+val.id+'\', \''+val.firstName+' '+val.name+'\');"><i class="ti-trash"></i></button>'+
          '   <button type="button" title="Resrtore user" class="btn btn-info       btn-rounded btn-icon btnRestUser '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestUser"     onclick="RestUser(\''+val.id+'\', \''+val.firstName+' '+val.name+'\');"><i class="ti-share-alt"></i></button>'+
          ' </td>'+
          '</tr>')
      });
    },
    error : function(data) {
      console.log(data);
    }
  });

  $('#listApplications').on('change', function(){
    $('.ViewUserRightFormIdApplication').val(this.value);
    var idUser          = $('.ViewUserRightFormId').val();
    var nameUser        = $('.ViewUserRightFormNameUser').val();
    var idApplication   = $('.ViewUserRightFormIdApplication').val();
    var idModule        = $('.ViewUserRightFormIdModule').val();
    var idFunctionality = $('.ViewUserRightFormIdFunctionality').val();
    var idRole          = $('.ViewUserRightFormIdRole').val();
    ViewAllRightsByIdUser(idUser, nameUser, idApplication, idModule, idFunctionality, idRole);
  });

  $('#listModules').on('change', function(){
    $('.ViewUserRightFormIdModule').val(this.value);
    var idUser          = $('.ViewUserRightFormId').val();
    var nameUser        = $('.ViewUserRightFormNameUser').val();
    var idApplication   = $('.ViewUserRightFormIdApplication').val();
    var idModule        = $('.ViewUserRightFormIdModule').val();
    var idFunctionality = $('.ViewUserRightFormIdFunctionality').val();
    var idRole          = $('.ViewUserRightFormIdRole').val();
    ViewAllRightsByIdUser(idUser, nameUser, idApplication, idModule, idFunctionality, idRole);
  });
  
  $('#listFunctionalities').on('change', function(){
    $('.ViewUserRightFormIdFunctionality').val(this.value);
    var idUser          = $('.ViewUserRightFormId').val();
    var nameUser        = $('.ViewUserRightFormNameUser').val();
    var idApplication   = $('.ViewUserRightFormIdApplication').val();
    var idModule        = $('.ViewUserRightFormIdModule').val();
    var idFunctionality = $('.ViewUserRightFormIdFunctionality').val();
    var idRole          = $('.ViewUserRightFormIdRole').val();
    ViewAllRightsByIdUser(idUser, nameUser, idApplication, idModule, idFunctionality, idRole);
  });

  $('#listRights').on('change', function(){
    $('.ViewUserRightFormIdRole').val(this.value);
    var idUser          = $('.ViewUserRightFormId').val();
    var nameUser        = $('.ViewUserRightFormNameUser').val();
    var idApplication   = $('.ViewUserRightFormIdApplication').val();
    var idModule        = $('.ViewUserRightFormIdModule').val();
    var idFunctionality = $('.ViewUserRightFormIdFunctionality').val();
    var idRole          = $('.ViewUserRightFormIdRole').val();
    ViewAllRightsByIdUser(idUser, nameUser, idApplication, idModule, idFunctionality, idRole);
  });
}

function ViewUser(id){
  $.ajax({
    url : 'Controllers/Security/User/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $('.btnSave').html('Update user account');
      $('.sectionPassword').hide();
      
      $('.AddProfilFormIdUser').val(id);
      $('.AddProfilFormLogin').val(data.ViewUser.login);
      $('.AddProfilFormFirstName').val(data.ViewUser.firstName);
      $('.AddProfilFormName').val(data.ViewUser.name);
      $('.AddProfilFormLinkToPicture').val('');
      $('.AddProfilFormPass').val(data.ViewUser.pass);
      $('.AddProfilFormEmail').val(data.ViewUser.email);
      $('.AddProfilFormEmailBackup').val(data.ViewUser.emailBackup);
      $('.AddProfilFormPhone').val(data.ViewUser.phone);
      $('.AddProfilFormMobile').val(data.ViewUser.mobile);
      $('.AddProfilFormInitPass').val(data.ViewUser.initPass);
      $('.AddProfilFormIdLanguage').val(data.ViewUser.idLanguage);
      $("#listUsersAddAccountIdStyEnterprise").val(data.ViewUser.idStyEnterprise);
      $('.AddProfilFormStatut').val(data.ViewUser.statut);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function InitUser(id, name){
  $('.InitProfilFormIdUser').val(id);
  $('.InitProfilTxt').html('Confirm the initializing password for the user <b>'+name+'</b>');
}

function DelUser(id, name){
  $('.DelProfilFormIdUser').val(id);
  $('.DelProfilTxt').html('Confirm the deletion for the user <b>'+name+'</b>');
}

function RestUser(id, name){
  $('.RestProfilFormIdUser').val(id);
  $('.RestProfilTxt').html('Confirm the restoration for the user <b>'+name+'</b>');
}

function ViewAllRightsByIdUser(idUser, nameUser, idApplication, idModule, idFunctionality, idRole){
  $("#modalAddRightUserLabel").html("list of "+nameUser+"'s role and rights");
    
  $('.ViewUserRightFormId').val(idUser);
  $('.ViewUserRightFormNameUser').val(nameUser);
  $('.ViewUserRightFormIdApplication').val(idApplication);
  $('.ViewUserRightFormIdModule').val(idModule);
  $('.ViewUserRightFormIdFunctionality').val(idFunctionality);
  $('.ViewUserRightFormIdRole').val(idRole);
  
  $('#listApplications').append();
  $('#listModules').append();
  $('#listidFunctionalities').append();
  $('#listRoleByApplicationModuleFunctionalityRole').append();

  $.ajax({
    url : 'Controllers/Security/UserRole/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idUser': idUser},
    success : function(data) {
      $('#listRoles').append();
      $.map(data.ListRoles, function(val, key) {
        $('#listRoles').append($('<option>', {
          value: val.id,
          text: val.code+' '+val.name,
        }));
      });
      $('#listRoles option[value="'+data.ViewUserRole.idStyRole+'"]').prop('selected', true);
      $('.ViewUserRightFormIdUserRole').val(data.ViewUserRole.idStyRole);

    }
  });

  $.ajax({
    url : 'Controllers/Security/Role/viewFull.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDetailUserRight').serialize(),
    success : function(data) {
      $.map(data.ListApplications, function(val, key) {
        $('#listApplications').append($('<option>', {
          value: val.id,
          text: val.code,
        }));
      });
      
      if(idApplication > 0){
        $.map(data.ListModules, function(val, key) {
          $('#listModules').append($('<option>', {
            value: val.id,
            text: val.code,
          }));
        });
      }

      if(idModule > 0){
        $.map(data.ListFunctionalities, function(val, key) {
          $('#listFunctionalities').append($('<option>', {
            value: val.id,
            text: val.code,
          }));
        });
      }
    }
  });
  
  var idUser = $('.ViewUserRightFormId').val();
  $.ajax({
    url : 'Controllers/Security/UserRight/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idStyUser': idUser},
    success : function(data) {
      $.map(data.ListRolesRights.styApplications, function(val, key) {
        $('#listRightsByRole').append('  <label for="'+val.code+'">Application : <b>'+val.code+'</b></label>');
        $('#listRightsByRole').append('  <table class="table table-striped"">');
        $('#listRightsByRole').append('    <thead>');
        $('#listRightsByRole').append('      <tr>');
        $('#listRightsByRole').append('        <th width=20%>Modules</th>');
        $('#listRightsByRole').append('        <th width=15%>Functionalities</th>');
        $('#listRightsByRole').append('        <th width=65%>Rights</th>');
        $('#listRightsByRole').append('      </tr>');
        $('#listRightsByRole').append('    </thead>');
        $('#listRightsByRole').append('    <tbody>');
        $.map(val.styModules, function(val2, key2) {
          $.map(val2.styFunctionalities, function(val3, key3) {
            var listRights = '';
            $.map(val3.styRights, function(val4, key4) {
              listRights += val4.name+', ';
            });
            $('#listRightsByRole').append('<tr><td>'+val2.code+'</td><td>'+val3.code+'</td><td>'+listRights+'</td></tr>');
          });
        });
        $('#listRightsByRole').append('    </tbody>');
        $('#listRightsByRole').append('  </table></br>');       
      });
    }
  });
  // var idStyRole = $('.ViewUserRightFormIdUserRole').val();
  // $.ajax({
  //   url : 'Controllers/Security/RoleRight/list.php',
  //   type : 'POST',
  //   dataType : 'JSON',
  //   data: {'idStyRole': idStyRole},
  //   success : function(data) {
  //     $.map(data.ListRolesRights.styApplications, function(val, key) {
  //       $('#listRightsByRole').append('  <label for="'+val.code+'">Application : <b>'+val.code+'</b></label>');
  //       $('#listRightsByRole').append('  <table class="table table-striped"">');
  //       $('#listRightsByRole').append('    <thead>');
  //       $('#listRightsByRole').append('      <tr>');
  //       $('#listRightsByRole').append('        <th width=20%>Modules</th>');
  //       $('#listRightsByRole').append('        <th width=15%>Functionalities</th>');
  //       $('#listRightsByRole').append('        <th width=65%>Rights</th>');
  //       $('#listRightsByRole').append('      </tr>');
  //       $('#listRightsByRole').append('    </thead>');
  //       $('#listRightsByRole').append('    <tbody>');
  //       $.map(val.styModules, function(val2, key2) {
  //         $.map(val2.styFunctionalities, function(val3, key3) {
  //           var listRights = '';
  //           $.map(val3.styRights, function(val4, key4) {
  //             listRights += val4.name+', ';
  //           });
  //           $('#listRightsByRole').append('<tr><td>'+val2.code+'</td><td>'+val3.code+'</td><td>'+listRights+'</td></tr>');
  //         });
  //       });
  //       $('#listRightsByRole').append('    </tbody>');
  //       $('#listRightsByRole').append('  </table></br>');       
  //     });
  //   }
  // });
}