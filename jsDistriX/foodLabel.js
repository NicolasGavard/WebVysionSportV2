ListLabel(0);

$(".btn-warning").on('click', function() {
  $(".btn-success").removeClass("disabled");
  $(".dw-success").removeClass("dw-checked").addClass("dw-ban");
  
  $(".btn-warning").addClass("disabled");
  $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");
  ListLabel(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");
  ListLabel(0);
});

$(".AddNewLabel").on('click', function() {
  $(".page_food_label_add_title").html(language.page_food_label_add_title);
      
  $('.AddLabelFormIdLabel').val(0);
  $('.AddLabelFormCode').val('');
  $('.AddLabelFormName').val('');
  $(".avatar-label").attr("src", '');
  $('.AddLabelFormTimestamp').val(0);
  $('.AddLabelFormStatut').val(0);
});

$(".btnAddLabel").on('click', function() {
  var name = $('.AddLabelFormName').val();
  if (name != ""){
    var data = $('#FormAddLabel').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : 'Controllers/Food/Label/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodLabelList.php";}, 500);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  } else {
    if (name == ''){
      $('.AddLabelFormName').addClass("form-control-danger");
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
    url : 'Controllers/Food/Label/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodLabelList.php";}, 500);
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
    url : 'Controllers/Food/Label/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodLabelList.php";}, 500);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListLabel(status){
  $('#listLabelsTbody').empty();

  $.ajax({
    url : 'Controllers/Food/Label/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'status': status},
    success : function(data) {
      $.map(data.ListLabels, function(val, key) {
        if(val.status == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.status == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        $('#listLabelsTbody').append(
          '<tr>'+
          ' <td><img style="max-height:50px; max-width:50px;" src="'+val.linkToPicture+'"/></td>'+
          ' <td>'+val.name+'</td>'+
          ' <td>'+
          '   <div class="dropdown">'+
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
          '       <i class="dw dw-more"></i>'+
          '     </a>'+
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
          '       <a class="dropdown-item btnViewLabel"                      data-toggle="modal" data-target="#modalAddLabel" onclick="ViewLabel(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
          '       <a class="dropdown-item btnDeleLabel '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelLabel(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
          '       <a class="dropdown-item btnRestLabel '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestLabel(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
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

function ViewLabel(id){
  $.ajax({
    url : 'Controllers/Food/Label/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".page_food_label_add_title").html(language.page_food_label_update_title);
      
      $('.AddLabelFormIdLabel').val(id);
      $(".avatar-label").attr("src", data.ViewLabel.linkToPicture);
      $('.AddLabelFormTimestamp').val(data.ViewLabel.timestamp);
      $('.AddLabelFormStatut').val(data.ViewLabel.status);
      $('.showPicture').removeClass("d-none");
      
      $('.asColorPicker-trigger span').attr("style", 'background:'+data.ViewLabel.color);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelLabel(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(confirm_delete+' <b>'+name+'</b> ?');
}

function RestLabel(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(confirm_restore+' <b>'+name+'</b> ?');
}