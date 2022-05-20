$(document).ready(function() {
  showData(0);
  
  $('#listModulesFilterIdApplication').on('change', function(){
    var idStyApplication = this.value;
    $('#listModulesFilterIdApplication').empty();
    $('#AddModuleIdApplication').empty();
    $('#listModulesTbody').empty();
    showData(idStyApplication);
  });
  
  $("#btnAddModule").click(function() {
    var errorData       = "";
    var code            = $('#InputModuleCode').val();
    var idStyApplication= $('#AddModuleIdApplication').val();
      
    if(idStyApplication == '' || idStyApplication == '0'){
      errorData += ' - The module must be linked to a application !!<br/>'
    } else {
      if (code != ""){
        $.ajax({
          url : 'Controllers/Security/Module/save.php',
          type : 'POST',
          dataType : 'JSON',
          data: $('#FormAddModule').serialize(),
          success : function(data) {
            $(".alert-success").show("slow").delay(1500).hide("slow");
            setTimeout(function() {window.location.href = "./adminModuleList.php";}, 2000);
          },
          error : function(data) {
            errorData += ' - An internal error has occurred !!<br/>'
            $('.alert-danger').show("slow").delay(5000).hide("slow");
            $('.alert-danger p').html(errorData);
          }
        });
      } else {
        if (code == "") { errorData += ' - Code empty !!<br/>'; }
      }
    }

    if (errorData !== ''){
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function showData(idStyApplication){
  $.ajax({
    url : 'Controllers/Security/Module/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idStyApplication': idStyApplication},
    success : function(data) {
      $.map(data.ListApplications, function(val, key) {
        activeSelected = false;
        if (val.id == idStyApplication)  var activeSelected = true;
        
        $('#listModulesFilterIdApplication').append($('<option>', {
          value: val.id,
          text: val.code,
          selected: activeSelected
        }));

        $('#AddModuleIdApplication').append($('<option>', {
          value: val.id,
          text: val.code,
          selected: activeSelected
        }));
      });
      
      $.map(data.ListModules, function(val, key) {
        if (val.status == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if (val.status == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listModulesTbody').append(
          '<tr>'+
          ' <td>'+val.codeStyApplication+'</td>'+
          ' <td>'+val.code+'</td>'+
          ' <td>'+val.description+'</td>'+
          ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1"></div></div></td>'+
          ' <td>'+
          '   <button type="button" title="View module"    class="btn btn-primary  btn-rounded btn-icon btnViewModule"                      data-bs-toggle="modal" data-bs-target="#modalAddModule"  onclick="ViewModule(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
          '   <button type="button" title="Delete module"  class="btn btn-danger   btn-rounded btn-icon btnDeleModule '+actionBtnDelete+'"" data-bs-toggle="modal" data-bs-target="#modalDelModule"  onclick="DelModule(\''+val.id+'\', \''+val.code+'\');"><i class="ti-trash"></i></button>'+
          '   <button type="button" title="Restore module" class="btn btn-info     btn-rounded btn-icon btnRestModule '+actionBtnRestore+'" data-bs-toggle="modal" data-bs-target="#modalRestModule" onclick="RestModule(\''+val.id+'\', \''+val.code+'\');"><i class="ti-share-alt"></i></button>'+
          ' </td>'+
          '</tr>')
      });
    },
    error : function(data) {
      console.log(data);
    }
  });

  $("#btnDelModule").click(function() {
    $.ajax({
      url : 'Controllers/Security/Module/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDelModule').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminModuleList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });

  $("#btnRestModule").click(function() {
    $.ajax({
      url : 'Controllers/Security/Module/restore.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormRestModule').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminModuleList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });
} 

function ViewModule(id){
  $.ajax({
    url : 'Controllers/Security/Module/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $('#AddModuleIdApplication option[value="'+data.ViewModule.idStyApplication+'"]').prop('selected', true);
      
      $('.btnSave').html('Update module');
      $('.AddModuleFormId').val(id);
      $('.AddModuleFormCode').val(data.ViewModule.code);
      $('.AddModuleFormDescription').val(data.ViewModule.description);
      $('.AddModuleFormStatus').val(data.ViewModule.status);
      $('.AddModuleFormTimestamp').val(data.ViewModule.timestamp);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelModule(id, code){
  $('.DelModuleFormIdModule').val(id);
  $('.DelModuleTxt').html('Confirm the deletion for the module <b>'+code+'</b>');
}

function RestModule(id, code){
  $('.RestModuleFormIdModule').val(id);
  $('.RestModuleTxt').html('Confirm the restoration for the module <b>'+code+'</b>');
}