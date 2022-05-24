$(".page_food_eco_score_title").text(language.page_food_eco_score_title);
$(".page_food_eco_score_picture").text(language.page_food_eco_score_picture);
$(".page_food_eco_score_code").text(language.page_food_eco_score_code);
$(".page_food_eco_score_color").text(language.page_food_eco_score_color);
$(".page_food_eco_score_name").text(language.page_food_eco_score_name);
$(".page_food_eco_score_status").text(language.page_food_eco_score_status);
$(".page_food_eco_score_action").text(language.page_food_eco_score_action);
$(".page_food_eco_score_add_title").text(language.page_food_eco_score_add_title);
$(".page_food_eco_score_update_title").text(language.page_food_eco_score_update_title);
$(".page_food_eco_score_delete_title").text(language.page_food_eco_score_delete_title);
$(".page_food_eco_score_restore_title").text(language.page_food_eco_score_restore_title);

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

var errorData_txt_code  = language.errorData_txt_code;
var errorData_txt_name  = language.errorData_txt_name;
var confirm_delete      = language.confirm_delete;
var confirm_restore     = language.confirm_restore;
var page_all_add        = language.page_all_add;
var page_all_update     = language.page_all_update;
var page_all_delete     = language.page_all_delete;
var page_all_restore    = language.page_all_restore;

ListEcoScore(0);

$(".btn-warning").on('click', function() {
  $(".btn-success").removeClass("disabled");
  $(".dw-success").removeClass("dw-checked").addClass("dw-ban");
  
  $(".btn-warning").addClass("disabled");
  $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");
  ListEcoScore(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");
  ListEcoScore(0);
});

$(".AddNewEcoScore").on('click', function() {
  $(".page_food_eco_score_add_title").html(language.page_food_eco_score_add_title);
      
  $('.AddEcoScoreFormIdEcoScore').val(0);
  $('.AddEcoScoreFormCode').val('');
  $('.AddEcoScoreFormName').val('');
  $(".avatar-eco_score").attr("src", '');
  $('.AddEcoScoreFormTimestamp').val(0);
  $('.AddEcoScoreFormStatut').val(0);
});

$(".btnAddEcoScore").on('click', function() {
  var name = $('.AddEcoScoreFormName').val();
  if (name != ""){
    var data = $('#FormAddEcoScore').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : 'Controllers/Food/ScoreEco/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodEcoScoreList.php";}, 500);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  } else {
    if (name == ''){
      $('.AddEcoScoreFormName').addClass("form-control-danger");
      $('#danger-name').html(errorData_txt_code);
    }
  } 

  if (errorData !== ''){
    $('.alert-danger').show("slow").delay(5000).hide("slow");
    $('.alert-danger p').html(errorData);
  }
});

$("#btnDel").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/ScoreEco/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodEcoScoreList.php";}, 500);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

$("#btnRest").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/ScoreEco/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodEcoScoreList.php";}, 500);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListEcoScore(status){
  $('#listEcoScoresTbody').empty();

  $.ajax({
    url : 'Controllers/Food/ScoreEco/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'status': status},
    success : function(data) {
      $.map(data.ListScoresEco, function(val, key) {
        if(val.status == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.status == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listEcoScoresTbody').append(
          '<tr>'+
          ' <td><img style="max-height:60px; max-width:60px;" src="'+val.linkToPicture+'"/></td>'+
          ' <td>'+
          '   <div class="progress" style="height:40px;"><div class="progress-bar" role="progressbar" style="width: 100%; background-color:'+val.color+';" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>'+
          ' </td>'+    
          ' <td>'+val.letter+'</td>'+
          ' <td>'+
          '   <div class="dropdown">'+
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
          '       <i class="dw dw-more"></i>'+
          '     </a>'+
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
          '       <a class="dropdown-item btnViewEcoScore"                      data-toggle="modal" data-target="#modalAddEcoScore" onclick="ViewEcoScore(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
          '       <a class="dropdown-item btnDeleEcoScore '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelEcoScore(\''+val.id+'\', \''+val.letter+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
          '       <a class="dropdown-item btnRestEcoScore '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestEcoScore(\''+val.id+'\', \''+val.letter+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
          '     </div>'+
          '   </div>'+
          ' </td>'+
          '</tr>')
      });
    },
    error : function(data) {
      console.log(data);
    }
  }); 
}

function ViewEcoScore(id){
  $.ajax({
    url : 'Controllers/Food/ScoreEco/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".page_food_eco_score_add_title").html(language.page_food_eco_score_update_title);
      
      $('.AddEcoScoreFormIdEcoScore').val(id);
      $('.AddEcoScoreFormName').val(data.ViewEcoScore.letter);
      $('.AddEcoScoreFormColor').val(data.ViewEcoScore.color);
      $(".avatar-eco_score").attr("src", data.ViewEcoScore.linkToPicture);
      $('.AddEcoScoreFormTimestamp').val(data.ViewEcoScore.timestamp);
      $('.AddEcoScoreFormStatut').val(data.ViewEcoScore.status);
      $('.showPicture').removeClass("d-none");
      
      $('.asColorPicker-trigger span').attr("style", 'background:'+data.ViewEcoScore.color);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelEcoScore(id, letter){
  $('.DelFormId').val(id);
  $('.DelTxt').html(confirm_delete+' <b>'+letter+'</b> ?');
}

function RestEcoScore(id, letter){
  $('.RestFormId').val(id);
  $('.RestTxt').html(confirm_restore+' <b>'+letter+'</b> ?');
}