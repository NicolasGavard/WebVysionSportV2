$(document).ready(function() {
  showData(0, 0);
  
  $('#listFunctionalitiesFilterIdApplication').on('change', function(){
    var idStyApplication  = this.value;
    var idStyModule       = $("#listFunctionalitiesFilterIdModule option:selected").val();
    $('#listFunctionalitiesFilterIdApplication').empty();
    $('#listFunctionalitiesFilterIdModule').empty();
    $('#AddFunctionalityIdApplication').empty();
    $('#AddFunctionalityIdModule').empty();
    $('#listFunctionalitiesTbody').empty();
    showData(idStyApplication, idStyModule);
  });
  
  $('#listFunctionalitiesFilterIdModule').on('change', function(){
    var idStyApplication  = $("#listFunctionalitiesFilterIdApplication option:selected").val();
    var idStyModule       = this.value;
    $('#listFunctionalitiesFilterIdApplication').empty();
    $('#listFunctionalitiesFilterIdModule').empty();
    $('#AddFunctionalityIdApplication').empty();
    $('#AddFunctionalityIdModule').empty();
    $('#listFunctionalitiesTbody').empty();
    showData(idStyApplication, idStyModule);
  });
  
  $("#btnAddFunctionality").click(function() {
    var errorData   = "";
    var code        = $('#InputFunctionalityCode').val();
    var idStyModule = $('#AddFunctionalityIdModule').val();
      
    if(idStyModule == '' || idStyModule == '0'){
      errorData += ' - The functionality must be linked to a module !!<br/>'
    } else {
      if (code != ""){
        $.ajax({
          url : 'Controllers/Security/Functionality/save.php',
          type : 'POST',
          dataType : 'JSON',
          data: $('#FormAddFunctionality').serialize(),
          success : function(data) {
            $(".alert-success").show("slow").delay(1500).hide("slow");
            setTimeout(function() {window.location.href = "./adminFunctionalityList.php";}, 2000);
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

function showData(idStyApplication, idStyModule){
  $.ajax({
    url : 'Controllers/Security/Functionality/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idStyApplication': idStyApplication, 'idStyModule': idStyModule},
    success : function(data) {
      $.map(data.ListApplications, function(val, key) {
        activeSelected = false;
        if (val.id == idStyApplication)  var activeSelected = true;
        
        $('#listFunctionalitiesFilterIdApplication').append($('<option>', {
          value: val.id,
          text: val.code,
          selected: activeSelected
        }));

        $('#AddFunctionalityIdApplication').append($('<option>', {
          value: val.id,
          text: val.code,
          selected: activeSelected
        }));
      });

      if(idStyApplication > 0){
        $.map(data.ListModules, function(val, key) {
          activeSelected = false;
          if (val.id == idStyModule)  var activeSelected = true;
          
          $('#listFunctionalitiesFilterIdModule').append($('<option>', {
            value: val.id,
            text: val.code,
            selected: activeSelected
          }));
  
          $('#AddFunctionalityIdModule').append($('<option>', {
            value: val.id,
            text: val.code,
            selected: activeSelected
          }));
        });
      }
      
      $.map(data.ListFunctionalities, function(val, key) {
        if (val.elemState == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if (val.elemState == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listFunctionalitiesTbody').append(
          '<tr>'+
          ' <td>'+val.codeStyApplication+'</td>'+
          ' <td>'+val.codeStyModule+'</td>'+
          ' <td>'+val.code+'</td>'+
          ' <td>'+val.description+'</td>'+
          ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1"></div></div></td>'+
          ' <td>'+
          '   <button type="button" title="View functionality"    class="btn btn-primary  btn-rounded btn-icon btnViewFunctionality"                      data-bs-toggle="modal" data-bs-target="#modalAddFunctionality"  onclick="ViewFunctionality(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
          '   <button type="button" title="Delete functionality"  class="btn btn-danger   btn-rounded btn-icon btnDeleFunctionality '+actionBtnDelete+'"" data-bs-toggle="modal" data-bs-target="#modalDelFunctionality"  onclick="DelFunctionality(\''+val.id+'\', \''+val.code+'\');"><i class="ti-trash"></i></button>'+
          '   <button type="button" title="Restore functionality" class="btn btn-info     btn-rounded btn-icon btnRestFunctionality '+actionBtnRestore+'" data-bs-toggle="modal" data-bs-target="#modalRestFunctionality" onclick="RestFunctionality(\''+val.id+'\', \''+val.code+'\');"><i class="ti-share-alt"></i></button>'+
          ' </td>'+
          '</tr>')
      });
    },
    error : function(data) {
      console.log(data);
    }
  });

  $("#btnDelFunctionality").click(function() {
    $.ajax({
      url : 'Controllers/Security/Functionality/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDelFunctionality').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminFunctionalityList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });

  $("#btnRestFunctionality").click(function() {
    $.ajax({
      url : 'Controllers/Security/Functionality/restore.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormRestFunctionality').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminFunctionalityList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });
} 

function ViewFunctionality(id){
  $.ajax({
    url : 'Controllers/Security/Functionality/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $('#AddFunctionalityIdModule option[value="'+data.ViewFunctionality.idStyModule+'"]').prop('selected', true);
      
      $('.btnSave').html('Update functionality');
      $('.AddFunctionalityFormId').val(id);
      $('.AddFunctionalityFormCode').val(data.ViewFunctionality.code);
      $('.AddFunctionalityFormDescription').val(data.ViewFunctionality.description);
      $('.AddFunctionalityFormStatut').val(data.ViewFunctionality.elemState);
      $('.AddFunctionalityFormTimestamp').val(data.ViewFunctionality.timestamp);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelFunctionality(id, code){
  $('.DelFunctionalityFormIdFunctionality').val(id);
  $('.DelFunctionalityTxt').html('Confirm the deletion for the functionality <b>'+code+'</b>');
}

function RestFunctionality(id, code){
  $('.RestFunctionalityFormIdFunctionality').val(id);
  $('.RestFunctionalityTxt').html('Confirm the restoration for the functionality <b>'+code+'</b>');
}