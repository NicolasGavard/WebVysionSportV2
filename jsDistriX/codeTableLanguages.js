
$.ajax({
  url : 'Controllers/Security/Language/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    $.map(data.ListLanguages, function(val, key) {
      if(val.statut == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.statut == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      $('#listLanguagesTbody').append(
        '<tr>'+
        ' <td><img src="'+val.linkToPicture+'"/></td>'+
        ' <td>'+val.code+'</td>'+
        ' <td>'+val.description+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewLanguage"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddLanguage"      onclick="ViewLanguage(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleLanguage '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelLanguage"      onclick="DelLanguage(\''+val.id+'\', \''+val.code+' '+val.description+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restorer " class="btn btn-info       btn-rounded btn-icon btnRestLanguage '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestLanguage"     onclick="RestLanguage(\''+val.id+'\', \''+val.code+' '+val.description+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });
  },
  error : function(data) {
    console.log(data);
  }
}); 

$(".AddNewLanguage").on('click', function() {
  $(".btnSave").html(language.page_codeTables_language_add_title);
});

$("#btnAddLanguage").on('click', function() {
  var errorData   = "";
  var code        = $('#InputLanguageCode').val();
  var description = $('#InputLanguageName').val();
  
  if (code != "" || description != ""){
    $.ajax({
      url : 'Controllers/Security/Language/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddLanguage').serialize(),
      success : function(data) {
        $(".alert-success").show("slow").delay(1500).hide("slow");
        setTimeout(function() {window.location.href = "./codeTableLanguageList.php";}, 2000);
      },
      error : function(data) {
        errorData += ' - '+errorData_ko+'<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  } else {
    if (code == ""){
      errorData += ' - '+errorData_txt_code+'<br/>'
    } 
    if (description == ''){
      errorData += ' - '+errorData_txt_description+'<br/>'
    }
  } 

  if (errorData !== ''){
    $('.alert-danger').show("slow").delay(5000).hide("slow");
    $('.alert-danger p').html(errorData);
  }
});

$("#btnDelLanguage").on('click', function() {
  $.ajax({
    url : 'Controllers/Security/Language/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelLanguage').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableLanguageList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestLanguage").on('click', function() {
  $.ajax({
    url : 'Controllers/Security/Language/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestLanguage').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableLanguageList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewLanguage(id){
  $.ajax({
    url : 'Controllers/Security/Language/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".btnSave").html(language.page_codeTables_language_update_title);
      
      $('.AddLanguageFormIdLanguage').val(id);
      $('.AddLanguageFormCode').val(data.ViewLanguage.code);
      $('.AddLanguageFormName').val(data.ViewLanguage.description);
      $(".InfoLanguagePicture").attr("src", data.ViewLanguage.linkToPicture);
      $('.AddLanguageFormTimestamp').val(data.ViewLanguage.timestamp);
      $('.AddLanguageFormStatut').val(data.ViewLanguage.statut);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelLanguage(id, name){
  $('.DelLanguageFormIdLanguage').val(id);
  $('.DelLanguageTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestLanguage(id, name){
  $('.RestLanguageFormIdLanguage').val(id);
  $('.RestLanguageTxt').html(confirm_restore+' <b>'+name+'</b>');
}