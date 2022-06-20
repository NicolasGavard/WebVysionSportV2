datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : '../../Controllers/CodeTables/Nutritional/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    var dataTableFoodType           = JSON.stringify(data.ListNutritionals);
    var dataTableFoodTypeLanguages  = JSON.stringify(data.ListNutritionals);
    
    localStorage.setItem("dataTable", JSON.stringify(data.ListNutritionals));
    localStorage.setItem("FoodTypeLanguages", JSON.stringify(data.ListLanguages));
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
  ListNutritional(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListNutritional(0);
});

$(".AddNewNutritional").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddNutritionalFormIdNutritional').val(0);
  $('.AddNutritionalFormCode').val('');
  $('.AddNutritionalFormName').val('');
  $('.AddNutritionalFormTimestamp').val(0);
  $('.AddNutritionalFormStatut').val(0);
});

$(".btnAddNutritional").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  
  var name = $('.AddNutritionalFormName').val();
  var code = $('.AddNutritionalFormCode').val();
  if (name != "" || code != ""){
    $.ajax({
      url : '../../Controllers/CodeTables/Nutritional/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddNutritional').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNutritionalList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddNutritional").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddNutritionalFormName').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddNutritionalFormName").removeClass("form-control-danger");
        $('.danger-name').addClass("d-none");
      }, 3000 );
    }
    if (code == ''){
      $('.AddNutritionalFormCode').addClass("form-control-danger");
      $('.danger-code').removeClass("d-none");

      setTimeout( () => { 
        $(".AddNutritionalFormCode").removeClass("form-control-danger");
        $('.danger-code').addClass("d-none");
      }, 3000 );
    }
  } 
});

$("#btnDel").on('click', function() {
  $.ajax({
    url : '../../Controllers/CodeTables/Nutritional/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNutritionalList.php";}, 800);
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
    url : '../../Controllers/CodeTables/Nutritional/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNutritionalList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListNutritional(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      nutritionalType = '';
      if(val.isCalorie == 1)  {nutritionalType = '<span class="micon dw dw-flash"> Calorie';}
      if(val.isProetin == 1)  {nutritionalType = '<span class="micon dw dw-orange"> Protéine';}
      if(val.isGlucide == 1)  {nutritionalType = '<span class="micon dw dw-chip"> Glucide';}
      if(val.isLipid == 1)    {nutritionalType = '<span class="micon dw dw-flame"> Lipide';}
      
      const line =  '<tr>'+
                    ' <td style="padding:1rem;">'+val.code+'</td>'+
                    ' <td>'+val.name+'</td>'+
                    ' <td>'+
                    '    <div class="row">'+
                    '      <div class="col-md-12 col-sm-12">'+nutritionalType+'</div>'+
                    '    </div>'+
                    '</td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddNutritional"   onclick="ViewNutritional(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"        onclick="DelNutritional(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"       onclick="RestNutritional(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewNutritional(id){
  $.ajax({
    url : '../../Controllers/CodeTables/Nutritional/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $('.AddNutritionalFormIdNutritional').val(id);
      $('.AddNutritionalFormCode').val(data.ViewNutritional.code);
      $('.AddNutritionalFormName').val(data.ViewNutritional.name);
      $('.AddNutritionalFormTimestamp').val(data.ViewNutritional.timestamp);
      $('.AddNutritionalFormStatut').val(data.ViewNutritional.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelNutritional(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestNutritional(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}