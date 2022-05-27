ListNovaScore(0);

$(".btn-warning").on('click', function() {
  $(".btn-success").removeClass("disabled");
  $(".dw-success").removeClass("dw-checked").addClass("dw-ban");
  
  $(".btn-warning").addClass("disabled");
  $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");
  ListNovaScore(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");
  ListNovaScore(0);
});

$(".AddNewNovaScore").on('click', function() {
  $(".page_food_nova_score_add_title").html(language.page_food_nova_score_add_title);
      
  $('.AddNovaScoreFormIdNovaScore').val(0);
  $('.AddNovaScoreFormCode').val('');
  $('.AddNovaScoreFormName').val('');
  $(".avatar-nova_score").attr("src", '');
  $('.AddNovaScoreFormTimestamp').val(0);
  $('.AddNovaScoreFormStatut').val(0);
});

$(".btnAddNovaScore").on('click', function() {
  var name = $('.AddNovaScoreFormName').val();
  if (name != ""){
    var data = $('#FormAddNovaScore').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : 'Controllers/Food/ScoreNova/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNovaScoreList.php";}, 500);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  } else {
    if (name == ''){
      $('.AddNovaScoreFormName').addClass("form-control-danger");
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
    url : 'Controllers/Food/ScoreNova/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNovaScoreList.php";}, 500);
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
    url : 'Controllers/Food/ScoreNova/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNovaScoreList.php";}, 500);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListNovaScore(statut){
  $('#listNovaScoresTbody').empty();

  $.ajax({
    url : 'Controllers/Food/ScoreNova/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'statut': statut},
    success : function(data) {
      $.map(data.ListScoresNova, function(val, key) {
        if(val.statut == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.statut == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listNovaScoresTbody').append(
          '<tr>'+
          ' <td><img style="max-height:60px; max-width:60px;" src="'+val.linkToPicture+'"/></td>'+
          ' <td>'+
          '   <div class="progress" style="height:35px;"><div class="progress-bar" role="progressbar" style="width: 100%; background-color:'+val.color+';" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>'+
          ' </td>'+    
          ' <td>'+val.number+'</td>'+
          ' <td>'+
          '   <div class="dropdown">'+
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
          '       <i class="dw dw-more"></i>'+
          '     </a>'+
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
          '       <a class="dropdown-item btnViewNovaScore"                      data-toggle="modal" data-target="#modalAddNovaScore" onclick="ViewNovaScore(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
          '       <a class="dropdown-item btnDeleNovaScore '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelNovaScore(\''+val.id+'\', \''+val.number+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
          '       <a class="dropdown-item btnRestNovaScore '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestNovaScore(\''+val.id+'\', \''+val.number+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
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

function ViewNovaScore(id){
  $.ajax({
    url : 'Controllers/Food/ScoreNova/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".page_food_nova_score_add_title").html(language.page_food_nova_score_update_title);
      
      $('.AddNovaScoreFormIdNovaScore').val(id);
      $('.AddNovaScoreFormName').val(data.ViewNovaScore.number);
      $('.AddNovaScoreFormColor').val(data.ViewNovaScore.color);
      $(".avatar-nova_score").attr("src", data.ViewNovaScore.linkToPicture);
      $('.AddNovaScoreFormTimestamp').val(data.ViewNovaScore.timestamp);
      $('.AddNovaScoreFormStatut').val(data.ViewNovaScore.statut);
      $('.showPicture').removeClass("d-none");
      
      $('.asColorPicker-trigger span').attr("style", 'background:'+data.ViewNovaScore.color);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelNovaScore(id, number){
  $('.DelFormId').val(id);
  $('.DelTxt').html(confirm_delete+' <b>'+number+'</b> ?');
}

function RestNovaScore(id, number){
  $('.RestFormId').val(id);
  $('.RestTxt').html(confirm_restore+' <b>'+number+'</b> ?');
}