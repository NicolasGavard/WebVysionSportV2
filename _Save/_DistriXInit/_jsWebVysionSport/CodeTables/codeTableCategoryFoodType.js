datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : '../../Controllers/CodeTables/CategoryFoodType/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListCategoryFoodTypes));
    $('.btn-success').trigger('click');
  },
  error : function(data) {
    console.log(data);
  }
});

$(".btnChangeImage").on('click', function() {
  $(".dropzoneImage").addClass("d-none");
  $(".dropzoneNoImage").removeClass("d-none");
});

$(".btnChangeImageCancel").on('click', function() {
  $(".dropzoneImage").removeClass("d-none");
  $(".dropzoneNoImage").addClass("d-none");
});

$(".btn-warning").on('click', function() {
  $(".btn-success").removeClass("disabled");
  $(".dw-success").removeClass("dw-checked").addClass("dw-ban");
  
  $(".btn-warning").addClass("disabled");
  $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");

  datatable.clear();
  ListCategoryFoodType(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListCategoryFoodType(0);
});

$(".AddNewCategoryFoodType").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddCategoryFoodTypeFormIdCategoryFoodType').val(0);
  $('.AddCategoryFoodTypeFormCode').val('');
  $('.AddCategoryFoodTypeFormName').val('');
  $(".avatar-food_category").attr("src", '');
  $('.AddCategoryFoodTypeFormTimestamp').val(0);
  $('.AddCategoryFoodTypeFormStatut').val(0);
});

$(".btnAddCategoryFoodType").on('click', function() {
  $(".page_food_food_category_update_title").removeClass("d-none");
  
  var name = $('.AddCategoryFoodTypeFormName').val();
  if (name != ""){
    var data = $('#FormAddCategoryFoodType').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : '../../Controllers/CodeTables/CategoryFoodType/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodCategoryFoodTypeList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddCategoryFoodType").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddCategoryFoodTypeFormName').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddCategoryFoodTypeFormName").removeClass("form-control-danger");
        $('.danger-name').addClass("d-none");
      }, 3000 );
    }
  } 
});

$("#btnDel").on('click', function() {
  $.ajax({
    url : '../../Controllers/CodeTables/CategoryFoodType/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.ConfirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodCategoryFoodTypeList.php";}, 800);
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
    url : '../../Controllers/CodeTables/CategoryFoodType/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.ConfirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodCategoryFoodTypeList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListCategoryFoodType(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    '  <td style="padding:1rem;">'+val.code+'</td>'+
                    '  <td>'+val.name+'</td>'+
                    '  <td>'+val.nbLanguages+'/'+val.nbLanguagesTotal+'</td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddCategoryFoodType" onclick="ViewCategoryFoodType(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"             onclick="DelCategoryFoodType(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"            onclick="RestCategoryFoodType(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewCategoryFoodType(id){
  $.ajax({
    url : '../../Controllers/CodeTables/CategoryFoodType/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $('.AddCategoryFoodTypeFormIdCategoryFoodType').val(id);
      $('.AddCategoryFoodTypeFormCode').val(data.ViewCategoryFoodType.codeshort);
      $('.AddCategoryFoodTypeFormName').val(data.ViewCategoryFoodType.name);
      $(".avatar-food_category").attr("src", data.ViewCategoryFoodType.linktopicture);
      $('.AddCategoryFoodTypeFormTimestamp').val(data.ViewCategoryFoodType.timestamp);
      $('.AddCategoryFoodTypeFormStatut').val(data.ViewCategoryFoodType.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelCategoryFoodType(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestCategoryFoodType(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}