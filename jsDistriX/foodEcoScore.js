$(".page_food_eco_score_title").text(language.page_food_eco_score_title);
$(".page_food_eco_score_picture").text(language.page_food_eco_score_picture);
$(".page_food_eco_score_code").text(language.page_food_eco_score_code);
$(".page_food_eco_score_name").text(language.page_food_eco_score_name);
$(".page_food_eco_score_color").text(language.page_food_eco_score_color);
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

$.ajax({
  url : 'Controllers/Food/ScoreEco/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    $.map(data.ListScoresEco, function(val, key) {
      if(val.status == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.status == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      $('#listEcoScoresTbody').append(
        '<tr>'+
        ' <td><img style="width:70px; border-radius:10%;" src="'+val.linkToPicture+'"/></td>'+
        ' <td>'+val.letter+'</td>'+
        ' <td>'+
        '   <div class="progress" style="height:40px;"><div class="progress-bar" role="progressbar" style="width: 100%; background-color:'+val.color+';" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>'+
        ' </td>'+      
        ' <td>'+val.description+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewEcoScore"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddEcoScore"      onclick="ViewEcoScore(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleEcoScore '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelEcoScore"      onclick="DelEcoScore(\''+val.id+'\', \''+val.letter+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restorer " class="btn btn-info       btn-rounded btn-icon btnRestEcoScore '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestEcoScore"     onclick="RestEcoScore(\''+val.id+'\', \''+val.letter+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });
  },
  error : function(data) {
    console.log(data);
  }
}); 

$(".AddNewEcoScore").on('click', function() {
  $(".btnSave").html(language.page_food_eco_score_add_title);
});

$("#btnAddEcoScore").on('click', function() {
  var errorData   = "";
  var code        = $('#InputEcoScoreCode').val();
  var description = $('#InputEcoScoreName').val();
  if (code != "" || description != ""){
    $.ajax({
      url : 'Controllers/Food/ScoreEco/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddEcoScore').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./foodEcoScoreList.php";}, 2000);
        } else {
          errorData += ' - '+errorData_ko+'<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(errorData);
        }
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

$("#btnDelEcoScore").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/ScoreEco/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelEcoScore').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodEcoScoreList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestEcoScore").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/ScoreEco/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestEcoScore').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodEcoScoreList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewEcoScore(id){
  $.ajax({
    url : 'Controllers/Food/ScoreEco/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".btnSave").html(language.page_food_eco_score_update_title);
      
      $('.AddEcoScoreFormIdEcoScore').val(id);
      $('.AddEcoScoreFormCode').val(data.ViewEcoScore.letter);
      $('.AddEcoScoreFormName').val(data.ViewEcoScore.description);
      $('.AddEcoScoreFormColor').val(data.ViewEcoScore.color);
      $(".InfoEcoScorePicture").attr("src", data.ViewEcoScore.linkToPicture);
      $('.AddEcoScoreFormTimestamp').val(data.ViewEcoScore.timestamp);
      $('.AddEcoScoreFormStatut').val(data.ViewEcoScore.status);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelEcoScore(id, name){
  $('.DelEcoScoreFormIdEcoScore').val(id);
  $('.DelEcoScoreTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestEcoScore(id, name){
  $('.RestEcoScoreFormIdEcoScore').val(id);
  $('.RestEcoScoreTxt').html(confirm_restore+' <b>'+name+'</b>');
}