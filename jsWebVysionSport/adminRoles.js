$(document).ready(function() {
  $.ajax({
    url : 'Controllers/Security/Role/list.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {    
      $.map(data.ListRoles, function(val) {
        $('#listRolesTbody').append(
          '<tr>'+
          ' <td>'+val.code+'</td>'+
          ' <td>'+val.name+'</td>'+
          ' <td>'+val.description+'</td>'+
          ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
          ' <td>'+
          '   <button type="button" title="View"    class="btn btn-primary    btn-rounded btn-icon"><i class="ti-eye"></i></button>'+
          '   <button type="button" title="Rights"  class="btn btn-secondary  btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modalDetailRightsRole" onclick="ViewAllRightsByRole(\''+val.id+'\', \''+val.name+'\', 0, 0, 0);"><i class="ti-briefcase"></i></button>'+
          '   <button type="button" title="Delete"  class="btn btn-danger     btn-rounded btn-icon"><i class="ti-trash"></i></button>'+
          ' </td>'+
          '</tr>')
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
 
  $("#btnAddRole").click(function() {
    var errorData   = "";
    var code      = $('#InputRoleCode').val();
    var name      = $('#InputRoleName').val();
    
    if (code != "" || name != ""){
      $.ajax({
        url : 'Controllers/Security/Role/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: $('#FormAddRole').serialize(),
        success : function(data) {
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./adminRoleList.php";}, 2000);
        },
        error : function(data) {
          errorData += ' - An internal error has occurred !!<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(errorData);
        }
      });
    } else {
      if (code == "") { errorData += ' - Code empty !!<br/>'; }
      if (name == "") { errorData += ' - Name empty !!<br>'; }
    }

    if (errorData !== ''){
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });

  $('#listApplications').on('change', function(){
    $('.ViewRoleFormIdApplication').val(this.value);
    var idRole          = $('.ViewRoleFormIdRole').val();
    var nameRole        = $('.ViewRoleFormNameRole').val();
    var idApplication   = $('.ViewRoleFormIdApplication').val();
    var idModule        = $('.ViewRoleFormIdModule').val();
    var idFunctionality = $('.ViewRoleFormIdFunctionality').val();
    ViewAllRightsByRole(idRole, nameRole, idApplication, idModule, idFunctionality);
  });

  $('#listModules').on('change', function(){
    $('.ViewRoleFormIdModule').val(this.value);
    var idRole          = $('.ViewRoleFormIdRole').val();
    var nameRole        = $('.ViewRoleFormNameRole').val();
    var idApplication   = $('.ViewRoleFormIdApplication').val();
    var idModule        = $('.ViewRoleFormIdModule').val();
    var idFunctionality = $('.ViewRoleFormIdFunctionality').val();
    ViewAllRightsByRole(idRole, nameRole, idApplication, idModule, idFunctionality);
  });

  $("#btnDuplicateNewRightForAllRoleNo").click(function() {
    var idStyRole          = $('.ViewRoleFormIdRole').val();
    var idStyApplication   = $('.ViewRoleFormIdApplication').val();
    var idStyModule        = $('.ViewRoleFormIdModule').val();
    var idStyFunctionality = $('.ViewRoleFormIdFunctionality').val();
    var sumOfRights        = $('.ViewRoleFormSumOfRights').val();
    
    $.ajax({
      url : 'Controllers/Security/RoleRight/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: {'idStyRole': idStyRole, 'idStyApplication': idStyApplication, 'idStyModule': idStyModule, 'idStyFunctionality': idStyFunctionality, 'sumOfRights': sumOfRights},
      success : function(data) {
        $(".alert-success").show("slow").delay(1500).hide("slow");
        setTimeout(function() {window.location.href = "./adminRoleList.php";}, 2000);
      },
      error : function(data) {
          errorData += ' - An internal error has occurred !!<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });

  $("#btnDuplicateNewRightForAllRoleYes").click(function() {
    var idStyRole           = $('.ViewRoleFormIdRole').val();
    var idStyApplication    = $('.ViewRoleFormIdApplication').val();
    var idStyModule         = $('.ViewRoleFormIdModule').val();
    var idStyFunctionality  = $('.ViewRoleFormIdFunctionality').val();
    var sumOfRights         = $('.ViewRoleFormSumOfRights').val();
    var saveRole            = false;

    $.ajax({
      url : 'Controllers/Security/RoleRight/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: {'idStyRole': idStyRole, 'idStyApplication': idStyApplication, 'idStyModule': idStyModule, 'idStyFunctionality': idStyFunctionality, 'sumOfRights': sumOfRights},
      success : function(data) {
        saveRole = true;
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });

    if(saveRole){
      $.ajax({
        url : 'Controllers/Security/UserRight/saveRightAllUser.php',
        type : 'POST',
        dataType : 'JSON',
        data: {'idStyRole': idStyRole, 'idStyApplication': idStyApplication, 'idStyModule': idStyModule, 'idStyFunctionality': idStyFunctionality, 'sumOfRights': sumOfRights},
        success : function(data) {
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./adminRoleList.php";}, 2000);
        },
        error : function(data) {
          errorData += ' - An internal error has occurred !!<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(errorData);
        }
      });
    }
  });
});

function updateData(codeRight, idFunctionality){
  $('.ViewRoleFormIdFunctionality').val(idFunctionality);
  $('.ViewRoleFormCodeRight').val(codeRight);
}

function AddRightForRole(){
  $(".confirmDuplicateNewRightForAllRole").show();
}

function ViewAllRightsByRole(idRole, nameRole, idApplication, idModule, idFunctionality){
  $(".confirmDuplicateNewRightForAllRole").hide();

  $("#modalAddRoleLabel").html('Details of all the rights in '+nameRole);

  $('#listApplications').empty().append('<option value="0">All</option>');
  $('#listModules').empty().append('<option value="0">All</option>');
  $('#listFunctionalities').empty().append('<option value="0">All</option>');
  $('#listRoleByApplicationModuleFunctionality').empty().append();

  $('.ViewRoleFormIdRole').val(idRole);
  $('.ViewRoleFormNameRole').val(nameRole);
  $('.ViewRoleFormIdApplication').val(idApplication);
  $('.ViewRoleFormIdModule').val(idModule);
  $('.ViewRoleFormIdFunctionality').val(idFunctionality);
  
  $.ajax({
    url : 'Controllers/Security/Role/viewFull.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDetailRole').serialize(),
    success : function(data) {
      $.map(data.ListApplications, function(val) {
        $('#listApplications').append($('<option>', {
          value: val.id,
          text: val.code,
        }));
      });
      $('#listApplications option[value="'+idApplication+'"]').prop('selected', true);
      
      if(idApplication > 0){
        $.map(data.ListModules, function(val) {
          $('#listModules').append($('<option>', {
            value: val.id,
            text: val.code,
          }));
        });
      }
      $('#listModules option[value="'+idModule+'"]').prop('selected', true);
      
      if(idModule > 0){
        $.map(data.ListFunctionalities, function(val) {
          $('#listFunctionalities').append($('<option>', {
            value: val.id,
            text: val.code,
          }));
        });
      }
      $('#listFunctionalities option[value="'+idFunctionality+'"]').prop('selected', true);

      if(idModule > 0){
        $.map(data.ListModulesByRole.styApplications, function(valData) {
          $('#listRoleByApplicationModuleFunctionality').append('<table class="table table-striped" width=100%>');
          $('#listRoleByApplicationModuleFunctionality').append('  <thead>');
          $('#listRoleByApplicationModuleFunctionality').append('    <tr>');
          $('#listRoleByApplicationModuleFunctionality').append('      <th width=30%>Functionalities</th>');
          $('#listRoleByApplicationModuleFunctionality').append('      <th width=15%></th>');
          $('#listRoleByApplicationModuleFunctionality').append('      <th width=30%>Rights</th>');
          $('#listRoleByApplicationModuleFunctionality').append('      <th width=15%></th>');
          $('#listRoleByApplicationModuleFunctionality').append('      <th width=30%>Actions</th>');
          $('#listRoleByApplicationModuleFunctionality').append('    </tr>');
          $('#listRoleByApplicationModuleFunctionality').append('  </thead>');
          $('#listRoleByApplicationModuleFunctionality').append('  <tbody>');
          
          $.map(data.ListFunctionalities, function(val) {
            actions = '<button type="button" title="Add right" class="btn btn-sm btn-success btn-rounded btn-icon" Onclick="AddRightForRole();"><i class="ti-plus"></i></button>';
            $.map(valData.styModules, function(valModules) {
              
              listRights     = '<select class="form-control" class="listRights" onChange="updateData(this.options[this.selectedIndex].value, \''+val.id+'\')">';
              listRights    += '<option value="0">None</option>';
              $.map(data.ListRights, function(valListRights) {
                listRights  += '<option value="'+valListRights.code+'">'+valListRights.name+'</option>';
              });
              listRights    += '</select>';
              
              $.map(valModules.styFunctionalities, function(valFunctionalities) {
                if(val.id == valFunctionalities.id){
                  actions     = '<button type="button" title="Delete right" class="btn btn-danger btn-rounded btn-icon" Onclick="DeleteRightForRole();""><i class="ti-minus"></i></button>';
                  listRights  = '<select class="form-control" class="listRights" onChange="updateData(this.options[this.selectedIndex].value, \''+val.id+'\')">';
                  listRights += '<option value="0">None</option>';
                  $.map(data.ListRights, function(valListRights) {
                    selected  = "";
                    $.map(valFunctionalities.styRights, function(valRights) {
                      if (parseInt(valRights.code) == parseInt(valListRights.code)){
                        selected = "selected";
                      }
                    });
                    listRights  += '<option value="'+valListRights.code+'" '+selected+'>'+valListRights.name+'</option>';
                  });
                  listRights    += '</select>';
                  return false; // breaks
                }
              });
            });
            $('#listRoleByApplicationModuleFunctionality').append('<tr><td>'+val.code+'</td><td>&nbsp;</td><td>'+listRights+'</td><td>&nbsp;</td><td>'+actions+'</td></tr>');
          });
          
          $('#listRoleByApplicationModuleFunctionality').append('  </tbody>');
          $('#listRoleByApplicationModuleFunctionality').append('</table>'); 
        });
      }
    }
  });
}