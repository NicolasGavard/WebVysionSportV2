$(document).ready(function() {
  $.ajax({
    url : 'Controllers/Security/Application/list.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {    
      if (data.errorData.text == "") {
        $.map(data.ListApplications, function(val, key) {
          if (val.elemState == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
          if (val.elemState == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
          
          $('#listApplicationsTbody').append(
            '<tr>'+
            ' <td>'+val.code+'</td>'+
            ' <td>'+val.description+'</td>'+
            ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1"></div></div></td>'+
            ' <td>'+
            '   <button type="button" title="View application"    class="btn btn-primary  btn-rounded btn-icon btnViewApplication"                      data-bs-toggle="modal" data-bs-target="#modalAddApplication"  onclick="ViewApplication(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
            '   <button type="button" title="Delete application"  class="btn btn-danger   btn-rounded btn-icon btnDeleApplication '+actionBtnDelete+'"" data-bs-toggle="modal" data-bs-target="#modalDelApplication"  onclick="DelApplication(\''+val.id+'\', \''+val.code+'\');"><i class="ti-trash"></i></button>'+
            '   <button type="button" title="Restore application" class="btn btn-info     btn-rounded btn-icon btnRestApplication '+actionBtnRestore+'" data-bs-toggle="modal" data-bs-target="#modalRestApplication" onclick="RestApplication(\''+val.id+'\', \''+val.code+'\');"><i class="ti-share-alt"></i></button>'+
            ' </td>'+
            '</tr>')
        });
      } else {
        $('.alert-dangerNoRight').show("slow").delay(5000).hide("slow");
        $('.alert-dangerNoRight p').html(data.errorData.text);
      }
    },
    error : function(data) {
      console.log(data);
    }
  });
 
  $("#btnAddApplication").click(function() {
    var errorData   = "";
    var code        = $('#InputApplicationCode').val();
    
    if (code != ""){
      $.ajax({
        url : 'Controllers/Security/Application/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: $('#FormAddApplication').serialize(),
        success : function(data) {
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./adminApplicationList.php";}, 2000);
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

    if (errorData !== ''){
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });

  $("#btnDelApplication").click(function() {
    $.ajax({
      url : 'Controllers/Security/Application/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDelApplication').serialize(),
      success : function(data) {
        if (data.confirm) {
          setTimeout(function() {window.location.href = "./adminApplicationList.php";}, 200);
        } else {
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(data.errorData.text);
        }
      },
      error : function(data) {
        errorData = ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });

  $("#btnRestApplication").click(function() {
    $.ajax({
      url : 'Controllers/Security/Application/restore.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormRestApplication').serialize(),
      success : function(data) {
        setTimeout(function() {window.location.href = "./adminApplicationList.php";}, 200);
      },
      error : function(data) {
        errorData += ' - An internal error has occurred !!<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  });
});

function ViewApplication(id){
  $.ajax({
    url : 'Controllers/Security/Application/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $('.AddApplicationFormId').val(id);
      $('.AddApplicationFormCode').val(data.ViewApplication.code);
      $('.AddApplicationFormDescription').val(data.ViewApplication.description);
      $('.AddApplicationFormStatut').val(data.ViewApplication.elemState);
      $('.AddApplicationFormTimestamp').val(data.ViewApplication.timestamp);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelApplication(id, code){
  $('.DelApplicationFormIdApplication').val(id);
  $('.DelApplicationTxt').html('Confirm the deletion for the application <b>'+code+'</b>');
}

function RestApplication(id, code){
  $('.RestApplicationFormIdApplication').val(id);
  $('.RestApplicationTxt').html('Confirm the restoration for the application <b>'+code+'</b>');
}