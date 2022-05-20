$(".page_food_brand_title").text(language.page_food_brand_title);
$(".page_food_brand_picture").text(language.page_food_brand_picture);
$(".page_food_brand_code").text(language.page_food_brand_code);
$(".page_food_brand_name").text(language.page_food_brand_name);
$(".page_food_brand_status").text(language.page_food_brand_status);
$(".page_food_brand_action").text(language.page_food_brand_action);
$(".page_food_brand_add_title").text(language.page_food_brand_add_title);
$(".page_food_brand_update_title").text(language.page_food_brand_update_title);
$(".page_food_brand_delete_title").text(language.page_food_brand_delete_title);
$(".page_food_brand_restore_title").text(language.page_food_brand_restore_title);

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

ListBrand(0);

$(".btn-warning").on('click', function() {
  $(".btn-success").removeClass("disabled");
  $(".dw-success").removeClass("dw-checked").addClass("dw-ban");
  
  $(".btn-warning").addClass("disabled");
  $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");
  ListBrand(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");
  ListBrand(0);
});

$(".AddNewBrand").on('click', function() {
  $(".page_food_brand_add_title").html(language.page_food_brand_add_title);
      
  $('.AddBrandFormIdBrand').val(0);
  $('.AddBrandFormCode').val('');
  $('.AddBrandFormName').val('');
  $(".avatar-brand").attr("src", '');
  $('.AddBrandFormTimestamp').val(0);
  $('.AddBrandFormStatut').val(0);
});

$(".btnAddBrand").on('click', function() {
  var name = $('.AddBrandFormName').val();
  if (name != ""){
    var data = $('#FormAddBrand').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : 'Controllers/Food/Brand/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodBrandList.php";}, 500);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  } else {
    if (name == ''){
      $('.AddBrandFormName').addClass("form-control-danger");
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
    url : 'Controllers/Food/Brand/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodBrandList.php";}, 500);
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
    url : 'Controllers/Food/Brand/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodBrandList.php";}, 500);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListBrand(status){
  $('#listBrandsTbody').empty();

  $.ajax({
    url : 'Controllers/Food/Brand/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'status': status},
    success : function(data) {
      $.map(data.ListBrands, function(val, key) {
        if(val.status == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.status == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listBrandsTbody').append(
          '<tr>'+
          ' <td><img style="max-width:20%;" src="'+val.linkToPicture+'"/></td>'+
          ' <td>'+val.name+'</td>'+
          ' <td>'+
          '   <div class="dropdown">'+
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
          '       <i class="dw dw-more"></i>'+
          '     </a>'+
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
          '       <a class="dropdown-item btnViewBrand"                      data-toggle="modal" data-target="#modalAddBrand"   onclick="ViewBrand(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
          '       <a class="dropdown-item btnDeleBrand '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"        onclick="DelBrand(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
          '       <a class="dropdown-item btnRestBrand '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"       onclick="RestBrand(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
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

function ViewBrand(id){
  $.ajax({
    url : 'Controllers/Food/Brand/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".page_food_brand_add_title").html(language.page_food_brand_update_title);
      
      $('.AddBrandFormIdBrand').val(id);
      $('.AddBrandFormCode').val(data.ViewBrand.code);
      $('.AddBrandFormName').val(data.ViewBrand.name);
      $(".avatar-brand").attr("src", data.ViewBrand.linkToPicture);
      $('.AddBrandFormTimestamp').val(data.ViewBrand.timestamp);
      $('.AddBrandFormStatut').val(data.ViewBrand.status);
      $('.showPicture').removeClass("d-none");
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelBrand(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(confirm_delete+' <b>'+name+'</b> ?');
}

function RestBrand(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(confirm_restore+' <b>'+name+'</b> ?');
}