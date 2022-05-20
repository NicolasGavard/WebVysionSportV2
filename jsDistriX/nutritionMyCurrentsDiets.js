$(".page_nutrition_my_diet_title").text(language.page_nutrition_my_diet_title);
$(".page_nutrition_my_diet_name").text(language.page_nutrition_my_diet_name);
$(".page_nutrition_my_diet_assigned_for").text(language.page_nutrition_my_diet_assigned_for);
$(".page_nutrition_my_diet_duration").text(language.page_nutrition_my_diet_duration);
$(".page_nutrition_my_diet_date_begin").text(language.page_nutrition_my_diet_date_begin);
$(".page_nutrition_my_diet_date_end").text(language.page_nutrition_my_diet_date_end);
$(".page_nutrition_my_diet_tags").text(language.page_nutrition_my_diet_tags);
$(".page_nutrition_my_diet_status").text(language.page_nutrition_my_diet_status);
$(".page_nutrition_my_diet_action").text(language.page_nutrition_my_diet_action);
$(".page_nutrition_my_diet_add_title").text(language.page_nutrition_my_diet_add_title);
$(".page_nutrition_my_diet_update_title").text(language.page_nutrition_my_diet_update_title);
$(".page_nutrition_my_diet_delete_title").text(language.page_nutrition_my_diet_delete_title);
$(".page_nutrition_my_diet_restore_title").text(language.page_nutrition_my_diet_restore_title);

$(".page_nutrition_my_diet_add_date_begin").attr("placeholder", language.page_nutrition_my_diet_add_date_begin);
$(".page_nutrition_my_diet_add_tag").attr("placeholder", language.page_nutrition_my_diet_add_tag);

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

var errorData_txt_assignedUsers = language.errorData_txt_assignedUsers;
var errorData_txt_duration      = language.errorData_txt_duration;    
var errorData_txt_date_start    = language.errorData_txt_date_start;

var confirm_delete      = language.confirm_delete;
var confirm_restore     = language.confirm_restore;

var page_all_add        = language.page_all_add;
var page_all_update     = language.page_all_update;
var page_all_delete     = language.page_all_delete;
var page_all_restore    = language.page_all_restore;

ListMyCurrentsDiets(0);

$.ajax({
  url : 'Controllers/Student/MyStudent/list.php',
  type : 'POST',
  dataType : 'JSON',
  data: {'idUser': localStorage.getItem("idUser")},
  success : function(data) {
    $.map(data.ListMyStudents, function(val, key) {
      $('.InfoMyCurrentsDietsFormListStudents').append('<option value="'+val.id+'">'+val.firstNameUser+' - '+val.nameUser+'</option>');
    });
  },
  error : function(data) {
    console.log(data);
  }
}); 

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

$("#btnDelMyCurrentsDiets").on('click', function() {
  $.ajax({
    url : 'Controllers/Nutrition/MyCurrentsDiets/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelMyCurrentsDiets').serialize(),
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

$("#btnRestMyCurrentsDiets").on('click', function() {
  $.ajax({
    url : 'Controllers/Nutrition/MyCurrentsDiets/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestMyCurrentsDiets').serialize(),
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

function ListMyCurrentsDiets(status){
  $('#listMyCurrentsDietsTbody').empty();

  $.ajax({
    url : 'Controllers/Nutrition/MyCurrentsDiets/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'status': status, 'idUser': localStorage.getItem("idUser")},
    success : function(data) {
      $.map(data.ListMyCurrentsDiets, function(val, key) {
        var assignedUsersList = '';
        var progressColor = 'primary';
        var progressWidth = 0;
        if(val.status == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.status == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $.map(val.assignedUsers, function(valUsers, keyUsers) {
          assignedUsersList = assignedUsersList + valUsers.firstNameUser+' '+valUsers.nameUser+'<br>';
        });

        if (val.advancement >= 0 && val.advancement <= 25) {
          progressColor = "danger";
        } else if (val.advancement >= 25 && val.advancement <= 50) {
          progressColor = "warning";
        } else if (val.advancement >= 50 && val.advancement <= 75) {
          progressColor = "info";
        } else if (val.advancement >= 75 && val.advancement <= 100) {
          progressColor = "success";
        }

        $('#listMyCurrentsDietsTbody').append(
          '<tr>'+
          ' <td>'+val.name+'</td>'+
          ' <td>'+assignedUsersList+'</td>'+
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
          '       <a class="dropdown-item btnViewMyCurrentsDiets"                      data-toggle="modal" data-target="#modalAddMyCurrentsDiets"  onclick="ViewMyCurrentsDiets(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
          '       <a class="dropdown-item btnDeleMyCurrentsDiets '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDelMyCurrentsDiets"  onclick="DelMyCurrentsDiets(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
          '       <a class="dropdown-item btnRestMyCurrentsDiets '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRestMyCurrentsDiets" onclick="RestMyCurrentsDiets(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
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
      $('.AddMyCurrentsDietsFormStatut').val(data.ViewMyCurrentsDiets.status);
      $('.showPicture').removeClass("d-none");
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyCurrentsDiets(id, name){
  $('.DelMyCurrentsDietsFormIdMyCurrentsDiets').val(id);
  $('.DelMyCurrentsDietsTxt').html(confirm_delete+' <b>'+name+'</b> ?');
}

function RestMyCurrentsDiets(id, name){
  $('.RestMyCurrentsDietsFormIdMyCurrentsDiets').val(id);
  $('.RestMyCurrentsDietsTxt').html(confirm_restore+' <b>'+name+'</b> ?');
}