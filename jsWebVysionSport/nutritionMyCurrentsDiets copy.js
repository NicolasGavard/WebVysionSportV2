
ListMyCurrentsDiets(0);

$(".btn-warning").on('click', function() {
  $(".btn-success").removeClass("disabled");
  $(".dw-success").removeClass("dw-checked").addClass("dw-ban");
  
  $(".btn-warning").addClass("disabled");
  $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");
  ListMyCurrentsDiets(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");
  ListMyCurrentsDiets(0);
});

$(".AddNewMyCurrentsDiets").on('click', function() {
  $(".page_nutrition_my_diet_add_title").html(language.page_nutrition_my_diet_add_title);
  $('.AddMyCurrentsDietsFormId').val(0);
  $('.AddMyCurrentsDietsFormTimestamp').val(0);
  $('.AddMyCurrentsDietsFormStatut').val(0);
});

$(".btnAddMyCurrentsDiets").on('click', function() {
  var errorData     = "";
  var assignedUsers = $('.InfoMyCurrentsDietsFormListStudents').val();
  var duration      = $('.InfoMyCurrentsDietsFormDuration').val();
  var date_start    = $('.page_nutrition_my_diet_add_date_begin').val();
  
  assignedUsers = 1;
  if (assignedUsers != 0 || duration != 0 || date_start != ""){
    $.ajax({
      url : 'Controllers/Nutrition/MyCurrentsDiets/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddMyCurrentsDiets').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDiets.php";}, 200);
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

$("#btnDel").on('click', function() {
  $.ajax({
    url : 'Controllers/Nutrition/MyCurrentsDiets/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDiets.php";}, 200);
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
    url : 'Controllers/Nutrition/MyCurrentsDiets/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDiets.php";}, 200);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListMyCurrentsDiets(elemState){
  $('#listMyCurrentsDietsTbody').empty();
  $('.InfoMyCurrentsDietsFormListMyTemplates').empty();

  $.ajax({
    url : 'Controllers/Nutrition/MyCurrentsDiets/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'elemState': elemState, 'idUser': localStorage.getItem("idUser")},
    success : function(data) {
      
      $.map(data.ListMyTemplatesDiets, function(val, key) {
        $('.InfoMyCurrentsDietsFormListMyTemplates').append('<option value="'+val.id+'">'+val.name+'</option>');
      });
      
      $.map(data.ListMyCurrentsDiets, function(val, key) {
        var assignedUsersList = '';
        var progressColor = 'primary';
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        var nbStudent = 0;
        $.map(val.assignedUsers, function(valUsers, keyUsers) {
          assignedUsersList = assignedUsersList + valUsers.firstNameUser+' '+valUsers.nameUser+'<br>';
          nbStudent++;
        });
        
        var spanListUserAssigned = '';
        if (nbStudent < 2) {
          spanListUserAssigned = '<span class="page_nutrition_my_diet_list_assigned_for_one"> Elève</span>';
        } else {
          spanListUserAssigned = '<span class="page_nutrition_my_diet_list_assigned_for_plur"> Elèves</span>';
        }

        if (val.advancement >= 0 && val.advancement <= 25) {
          progressColor = "danger";
        } else if (val.advancement >= 25 && val.advancement <= 50) {
          progressColor = "warning";
        } else if (val.advancement >= 50 && val.advancement <= 75) {
          progressColor = "info";
        } else if (val.advancement >= 75 && val.advancement <= 100) {
          progressColor = "success";
        }

        $('#listMyCurrentsDietsModal').append(
          '<div class="modal fade bs-example-modal-lg" id="modalViewUserListDiet_'+val.id+'" tabindex="-1" role="dialog" aria-hidden="true">'+
          ' <div class="modal-dialog modal-lg modal-dialog-centered" role="document">'+
          '  <div class="modal-content">'+
          '    <div class="modal-body text-center font-18">'+
          '      <h4 class="padding-top-30 mb-30 weight-500">'+nbStudent+' '+spanListUserAssigned+'</h4>'+
          '    </div>'+
          '    <div class="row">'+
          '      <div class="col-md-12 col-sm-12" style="text-align:center">'+
          '       '+assignedUsersList+
          '      </div>'+
          '    </div>'+
          '    <div class="padding-bottom-30 padding-top-30 row" style="max-width: 170px; margin: 0 auto;">'+
          '      <div class="col-6">'+
          '        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>'+
          '        <span class="page_all_close"></span>'+
          '      </div>'+
          '    </div>'+
          '  </div>'+
          '</div>'
        );

        $('#listMyCurrentsDietsTbody').append(
          '<tr>'+
          ' <td>'+val.name+'</td>'+
          ' <td>'+
          '  <button type="button" style="margin-right: 0px;" class="btn btn-info AddViewUserListDiet_'+val.id+'" data-toggle="modal" data-target="#modalViewUserListDiet_'+val.id+'">'+
          '    <span class="micon dw dw-user-1"></span> '+
          '    '+nbStudent+' '+
          '    '+spanListUserAssigned+' '+
          '  </button>'+
          ' </td>'+
          ' <td>'+val.duration+' jours</td>'+
          ' <td>'+ConvertIntToDateFr(val.dateStart)+'</td>'+
          ' <td>'+val.tags+'</td>'+
          ' <td><div class="progress mb-20"><div class="progress-bar progress-bar-striped bg-'+progressColor+'" role="progressbar" style="width: '+val.advancement+'%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">'+val.advancement+'%</div></div></td>'+
          ' <td>'+
          '   <div class="dropdown">'+
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
          '       <i class="dw dw-more"></i>'+
          '     </a>'+
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
          '       <a class="dropdown-item btnViewMyCurrentsDiets"                      data-toggle="modal" data-target="#modalAddMyCurrentsDiets" onclick="ViewMyCurrentsDiets(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
          '       <a class="dropdown-item btnDeleMyCurrentsDiets '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"                onclick="DelMyCurrentsDiets(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
          '       <a class="dropdown-item btnRestMyCurrentsDiets '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"               onclick="RestMyCurrentsDiets(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
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

function ViewMyCurrentsDiets(id){
  $.ajax({
    url : 'Controllers/Nutrition/MyCurrentsDiets/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".page_nutrition_my_diet_add_title").html(language.page_nutrition_my_diet_update_title);
      
      $('.AddMyCurrentsDietsFormIdMyCurrentsDiets').val(id);
      $('.AddMyCurrentsDietsFormCode').val(data.ViewMyCurrentsDiets.code);
      $('.AddMyCurrentsDietsFormName').val(data.ViewMyCurrentsDiets.name);
      $(".avatar-my_diet").attr("src", data.ViewMyCurrentsDiets.linkToPicture);
      $('.AddMyCurrentsDietsFormTimestamp').val(data.ViewMyCurrentsDiets.timestamp);
      $('.AddMyCurrentsDietsFormStatut').val(data.ViewMyCurrentsDiets.elemState);
      $('.showPicture').removeClass("d-none");
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyCurrentsDiets(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(confirm_delete+' <b>'+name+'</b> ?');
}

function RestMyCurrentsDiets(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(confirm_restore+' <b>'+name+'</b> ?');
}