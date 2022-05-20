$(".page_food_nova_score_title").text(language.page_food_nova_score_title);
$(".page_food_nova_score_picture").text(language.page_food_nova_score_picture);
$(".page_food_nova_score_code").text(language.page_food_nova_score_code);
$(".page_food_nova_score_name").text(language.page_food_nova_score_name);
$(".page_food_nova_score_color").text(language.page_food_nova_score_color);
$(".page_food_nova_score_status").text(language.page_food_nova_score_status);
$(".page_food_nova_score_action").text(language.page_food_nova_score_action);
$(".page_food_nova_score_add_title").text(language.page_food_nova_score_add_title);
$(".page_food_nova_score_update_title").text(language.page_food_nova_score_update_title);
$(".page_food_nova_score_delete_title").text(language.page_food_nova_score_delete_title);
$(".page_food_nova_score_restore_title").text(language.page_food_nova_score_restore_title);

$(".page_all_close").text(language.page_all_close);
$(".page_all_add").text(language.page_all_add);
$(".page_all_view").text(language.page_all_view);
$(".page_all_delete").text(language.page_all_delete);
$(".page_all_restore").text(language.page_all_restore);
$(".page_all_change_picture").text(language.page_all_change_picture);

$.ajax({
  url : 'Controllers/Food/ScoreNova/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    $.map(data.ListScoresNova, function(val, key) {
      if(val.status == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.status == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      $('#listNovaScoresTbody').append(
        '<tr>'+
        ' <td><img style="width:30px; border-radius:10%;" src="'+val.linkToPicture+'"/></td>'+
        ' <td>'+val.number+'</td>'+
        ' <td>'+
        '   <div class="progress" style="height:40px;"><div class="progress-bar" role="progressbar" style="width: 100%; background-color:'+val.color+';" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>'+
        ' </td>'+      
        ' <td>'+val.description+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewNovaScore"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddNovaScore"      onclick="ViewNovaScore(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleNovaScore '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelNovaScore"      onclick="DelNovaScore(\''+val.id+'\', \''+val.number+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restorer " class="btn btn-info       btn-rounded btn-icon btnRestNovaScore '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestNovaScore"     onclick="RestNovaScore(\''+val.id+'\', \''+val.number+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });
  },
  error : function(data) {
    console.log(data);
  }
}); 

$(".AddNewNovaScore").on('click', function() {
  $(".btnSave").html(language.page_food_nova_score_add_title);
});

$("#btnAddNovaScore").on('click', function() {
  var errorData   = "";
  var code        = $('#InputNovaScoreCode').val();
  var description = $('#InputNovaScoreName').val();
  if (code != "" || description != ""){
    $.ajax({
      url : 'Controllers/Food/ScoreNova/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddNovaScore').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./foodNovaScoreList.php";}, 2000);
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

$("#btnDelNovaScore").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/ScoreNova/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelNovaScore').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodNovaScoreList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestNovaScore").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/ScoreNova/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestNovaScore').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodNovaScoreList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewNovaScore(id){
  $.ajax({
    url : 'Controllers/Food/ScoreNova/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".btnSave").html(language.page_food_nova_score_update_title);
      
      $('.AddNovaScoreFormIdNovaScore').val(id);
      $('.AddNovaScoreFormCode').val(data.ViewNovaScore.number);
      $('.AddNovaScoreFormName').val(data.ViewNovaScore.description);
      $('.AddNovaScoreFormColor').val(data.ViewNovaScore.color);
      $(".InfoNovaScorePicture").attr("src", data.ViewNovaScore.linkToPicture);
      $('.AddNovaScoreFormTimestamp').val(data.ViewNovaScore.timestamp);
      $('.AddNovaScoreFormStatut').val(data.ViewNovaScore.status);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelNovaScore(id, name){
  $('.DelNovaScoreFormIdNovaScore').val(id);
  $('.DelNovaScoreTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestNovaScore(id, name){
  $('.RestNovaScoreFormIdNovaScore').val(id);
  $('.RestNovaScoreTxt').html(confirm_restore+' <b>'+name+'</b>');
}