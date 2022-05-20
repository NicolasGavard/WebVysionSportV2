$(".page_food_label_title").text(language.page_food_label_title);
$(".page_food_label_picture").text(language.page_food_label_picture);
$(".page_food_label_code").text(language.page_food_label_code);
$(".page_food_label_name").text(language.page_food_label_name);
$(".page_food_label_status").text(language.page_food_label_status);
$(".page_food_label_action").text(language.page_food_label_action);
$(".page_food_label_add_title").text(language.page_food_label_add_title);
$(".page_food_label_update_title").text(language.page_food_label_update_title);
$(".page_food_label_delete_title").text(language.page_food_label_delete_title);
$(".page_food_label_restore_title").text(language.page_food_label_restore_title);

$(".page_all_close").text(language.page_all_close);
$(".page_all_add").text(language.page_all_add);
$(".page_all_view").text(language.page_all_view);
$(".page_all_delete").text(language.page_all_delete);
$(".page_all_restore").text(language.page_all_restore);
$(".page_all_change_picture").text(language.page_all_change_picture);

$(".errorData_ok").text(language.errorData_ok);
$(".errorData_ok_txt").text(language.errorData_ok_txt);
$(".errorData_ko").text(language.errorData_ko);
$(".errorData_ko_txt").text(language.errorData_ko_txt);

var confirm_delete  = language.confirm_delete;
var confirm_restore = language.confirm_restore;

$.ajax({
  url : 'Controllers/Food/Label/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    $.map(data.ListLabels, function(val, key) {
      if(val.status == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.status == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      $('#listLabelsTbody').append(
        '<tr>'+
        ' <td><img src="'+val.linkToPicture+'"/></td>'+
        ' <td>'+val.code+'</td>'+
        ' <td>'+val.name+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewLabel"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddLabel"      onclick="ViewLabel(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleLabel '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelLabel"      onclick="DelLabel(\''+val.id+'\', \''+val.code+' '+val.name+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restorer " class="btn btn-info       btn-rounded btn-icon btnRestLabel '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestLabel"     onclick="RestLabel(\''+val.id+'\', \''+val.code+' '+val.name+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });
  },
  error : function(data) {
    console.log(data);
  }
}); 

$(".AddNewLabel").on('click', function() {
  $(".btnSave").html(language.page_food_label_add_title);
});

$("#btnAddLabel").on('click', function() {
  var errorData   = "";
  var code        = $('#InputLabelCode').val();
  var name        = $('#InputLabelName').val();
  
  if (code != "" || name != ""){
    $.ajax({
      url : 'Controllers/Food/Label/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddLabel').serialize(),
      success : function(data) {
        $(".alert-success").show("slow").delay(1500).hide("slow");
        setTimeout(function() {window.location.href = "./foodLabelList.php";}, 2000);
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
    if (name == ''){
      errorData += ' - '+errorData_txt_name+'<br/>'
    }
  } 

  if (errorData !== ''){
    $('.alert-danger').show("slow").delay(5000).hide("slow");
    $('.alert-danger p').html(errorData);
  }
});

$("#btnDelLabel").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/Label/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelLabel').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodLabelList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestLabel").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/Label/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestLabel').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodLabelList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewLabel(id){
  $.ajax({
    url : 'Controllers/Food/Label/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".btnSave").html(language.page_food_label_update_title);
      
      $('.AddLabelFormIdLabel').val(id);
      $('.AddLabelFormCode').val(data.ViewLabel.code);
      $('.AddLabelFormName').val(data.ViewLabel.name);
      $(".InfoLabelPicture").attr("src", data.ViewLabel.linkToPicture);
      $('.AddLabelFormTimestamp').val(data.ViewLabel.timestamp);
      $('.AddLabelFormStatut').val(data.ViewLabel.status);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelLabel(id, name){
  $('.DelLabelFormIdLabel').val(id);
  $('.DelLabelTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestLabel(id, name){
  $('.RestLabelFormIdLabel').val(id);
  $('.RestLabelTxt').html(confirm_restore+' <b>'+name+'</b>');
}