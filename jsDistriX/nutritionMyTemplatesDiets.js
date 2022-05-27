
ListMyTemplatesDiets(0);

$(".btn-warning").on('click', function() {
  $(".btn-success").removeClass("disabled");
  $(".dw-success").removeClass("dw-checked").addClass("dw-ban");
  
  $(".btn-warning").addClass("disabled");
  $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");
  ListMyTemplatesDiets(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");
  ListMyTemplatesDiets(0);
});

$(".AddNewMyTemplatesDiets").on('click', function() {
  $(".page_nutrition_my_template_diet_add_title").html(language.page_nutrition_my_template_diet_add_title);
  $('.AddMyTemplatesDietsFormId').val(0);
  $('.AddMyTemplatesDietsFormTimestamp').val(0);
  $('.AddMyTemplatesDietsFormStatut').val(0);
});

$(".btnAddMyTemplatesDiets").on('click', function() {
  var errorData     = "";
  var assignedUsers = $('.InfoMyTemplatesDietsFormListStudents').val();
  var duration      = $('.InfoMyTemplatesDietsFormDuration').val();
  var date_start    = $('.page_nutrition_my_template_diet_add_date_begin').val();
  
  assignedUsers = 1;
  if (assignedUsers != 0 || duration != 0 || date_start != ""){
    $.ajax({
      url : 'Controllers/Nutrition/MyTemplatesDiets/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddMyTemplatesDiets').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyTemplatesDiets.php";}, 200);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  } else {
    if (assignedUsers == '0'){
      errorData += '<li class="list-group-item">'+errorData_txt_assignedUsers+'</li>'; 
    }
    if (duration == '0'){
      errorData += '<li class="list-group-item">'+errorData_txt_duration+'</li>'; 
    }
    if (date_start == ''){
      errorData+= '<li class="list-group-item">'+errorData_txt_date_start+'</li>'; 
    }
  } 

  if (errorData !== ''){
    $('#sa-error-distrix').trigger('click');
    $('#swal2-content').html('<ul class="list-group list-group-flush">'+errorData+'</ul>');
  }
});

$("#btnDelMyTemplatesDiets").on('click', function() {
  $.ajax({
    url : 'Controllers/Nutrition/MyTemplatesDiets/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelMyTemplatesDiets').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyTemplatesDiets.php";}, 200);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

$("#btnRestMyTemplatesDiets").on('click', function() {
  $.ajax({
    url : 'Controllers/Nutrition/MyTemplatesDiets/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestMyTemplatesDiets').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyTemplatesDiets.php";}, 200);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListMyTemplatesDiets(elemState){
  $('#listMyTemplatesDietsTbody').empty();

  $.ajax({
    url : 'Controllers/Nutrition/MyTemplatesDiets/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'elemState': elemState, 'idUser': localStorage.getItem("idUser")},
    success : function(data) {
      $.map(data.ListMyTemplatesDiets, function(val, key) {
        var assignedUsersList = '';
        var progressColor = 'primary';
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listMyTemplatesDietsTbody').append(
          '<tr>'+
          ' <td>'+val.name+'</td>'+
          ' <td>'+val.nbStudentAssigned+'</td>'+
          ' <td>'+val.duration+' jours</td>'+
          ' <td>'+val.tags+'</td>'+
          ' <td>'+
          '   <div class="dropdown">'+
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
          '       <i class="dw dw-more"></i>'+
          '     </a>'+
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
          '       <a class="dropdown-item btnViewMyTemplatesDiets"                      data-toggle="modal" data-target="#modalAddMyTemplatesDiets"  onclick="ViewMyTemplatesDiets(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
          '       <a class="dropdown-item btnDeleMyTemplatesDiets '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDelMyTemplatesDiets"  onclick="DelMyTemplatesDiets(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
          '       <a class="dropdown-item btnRestMyTemplatesDiets '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRestMyTemplatesDiets" onclick="RestMyTemplatesDiets(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
          '     </div>'+
          '   </div>'+
          ' </td>'+
          '</tr>'
          );
      });
    },
    error : function(data) {
      console.log(data);
    }
  }); 
}

function ViewMyTemplatesDiets(id){
  $.ajax({
    url : 'Controllers/Nutrition/MyTemplatesDiets/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".page_nutrition_my_template_diet_add_title").html(language.page_nutrition_my_template_diet_update_title);
      
      $('.AddMyTemplatesDietsFormIdMyTemplatesDiets').val(id);
      $('.AddMyTemplatesDietsFormCode').val(data.ViewMyTemplatesDiets.code);
      $('.AddMyTemplatesDietsFormName').val(data.ViewMyTemplatesDiets.name);
      $(".avatar-my_template_diet").attr("src", data.ViewMyTemplatesDiets.linkToPicture);
      $('.AddMyTemplatesDietsFormTimestamp').val(data.ViewMyTemplatesDiets.timestamp);
      $('.AddMyTemplatesDietsFormStatut').val(data.ViewMyTemplatesDiets.elemState);
      $('.showPicture').removeClass("d-none");
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyTemplatesDiets(id, name){
  $('.DelMyTemplatesDietsFormIdMyTemplatesDiets').val(id);
  $('.DelMyTemplatesDietsTxt').html(confirm_delete+' <b>'+name+'</b> ?');
}

function RestMyTemplatesDiets(id, name){
  $('.RestMyTemplatesDietsFormIdMyTemplatesDiets').val(id);
  $('.RestMyTemplatesDietsTxt').html(confirm_restore+' <b>'+name+'</b> ?');
}