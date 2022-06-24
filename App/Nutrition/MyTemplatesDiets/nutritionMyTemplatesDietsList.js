datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : 'Controllers/list.php',
  type : 'POST',
  dataType : 'JSON',
  data: {'idUserCoach': localStorage.getItem("idUser")},
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListMyTemplatesDiets));
    $('.btn-success').trigger('click');
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

  datatable.clear();
  ListMyTemplateDiet(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListMyTemplateDiet(0);
});

$(".AddNewMyTemplateDiet").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddMyTemplatesDietsFormId').val(0);
  $('.AddMyTemplatesDietsFormName').val('');
  $('.AddMyTemplatesDietsFormDuration').val(0);
  $('.AddMyTemplatesDietsFormTags').val('');
  $('.AddMyTemplatesDietsFormTimestamp').val(0);
  $('.AddMyTemplatesDietsFormStatut').val(0);
});

$(".btnAddMyTemplateDiet").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  
  var name      = $('.AddMyTemplatesDietsFormName').val();
  var duration  = $('.AddMyTemplatesDietsFormDuration').val();
  var tags      = $('.AddMyTemplatesDietsFormTags').val();
  if (name != "" && duration != "" && tags != ""){   
    $.ajax({
      url : 'Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddMyTemplateDiet').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyTemplatesDietsList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddMyTemplateDiet").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddMyTemplatesDietsFormName').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddMyTemplatesDietsFormName").removeClass("form-control-danger");
        $('.danger-name').addClass("d-none");
      }, 3000 );
    }
    if (duration == ''){
      $('.AddMyTemplatesDietsFormDuration').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddMyTemplatesDietsFormDuration").removeClass("form-control-danger");
        $('.danger-name').addClass("d-none");
      }, 3000 );
    }
    if (name == ''){
      $('.AddMyTemplatesDietsFormTags').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddMyTemplatesDietsFormTags").removeClass("form-control-danger");
        $('.danger-name').addClass("d-none");
      }, 3000 );
    }
  } 
});

$("#btnDel").on('click', function() {
  $.ajax({
    url : 'Controllers/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.ConfirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyTemplatesDietsList.php";}, 800);
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
    url : 'Controllers/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.ConfirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyTemplatesDietsList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListMyTemplateDiet(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    '  <td style="padding:1rem;">'+val.name+'</td>'+
                    '  <td>'+val.nbStudentAssigned+'</td>'+
                    '  <td>'+val.duration+' jours</td>'+
                    '  <td>'+val.tags+'</td>'+
                    '  <td>'+
                    '    <div class="dropdown">'+
                    '      <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '        <i class="dw dw-more"></i>'+
                    '      </a>'+
                    '      <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '        <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMyTemplateDiet"  onclick="ViewMyTemplateDiet(\''+val.id+'\', \''+val.name+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '        <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"                onclick="DelMyTemplateDiet(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '        <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"               onclick="RestMyTemplateDiet(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '      </div>'+
                    '    </div>'+
                    '  </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewMyTemplateDiet(id, name){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".infoNameTemplateDiet").html(name);

      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $('.AddMyTemplatesDietsFormId').val(id);
      $('.AddMyTemplatesDietsFormIdUserCoatch').val(data.ViewMyTemplateDiet.idUserCoach);
      $('.AddMyTemplatesDietsFormName').val(data.ViewMyTemplateDiet.name);
      $('.AddMyTemplatesDietsFormDuration').val(data.ViewMyTemplateDiet.duration);
      $('.AddMyTemplatesDietsFormTags').val(data.ViewMyTemplateDiet.tags);
      $('.AddMyTemplatesDietsFormTimestamp').val(data.ViewMyTemplateDiet.timestamp);
      $('.AddMyTemplatesDietsFormStatut').val(data.ViewMyTemplateDiet.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyTemplateDiet(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestMyTemplateDiet(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}