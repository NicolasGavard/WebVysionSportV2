datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : 'Controllers/Food/Brand/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListBrands));
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
  ListBrand(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListBrand(0);
});

$(".AddNewBrand").on('click', function() {
  $('.AddBrandFormIdBrand').val(0);
  $('.AddBrandFormCode').val('');
  $('.AddBrandFormName').val('');
  $(".avatar-brand").attr("src", '');
  $('.AddBrandFormTimestamp').val(0);
  $('.AddBrandFormStatut').val(0);
});

$(".btnAddBrand").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  
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
    $(".btnAddBrand").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddBrandFormName').addClass("form-control-danger");
      $('#danger-name').removeClass("d-none");
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
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.status == status){
      if(val.status == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.status == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    ' <td><img style="max-width:20%;" src="'+val.linkToPicture+'"/></td>'+
                    ' <td>'+val.name+'</td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddBrand"   onclick="ViewBrand(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> '+page_all_update+'</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"        onclick="DelBrand(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> '+page_all_delete+'</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"       onclick="RestBrand(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> '+page_all_restore+'</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
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
      // $(".page_food_brand_add_title").html(language.page_food_brand_update_title);
      
      $(".page_food_brand_add_title").removeClass("d-none");

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
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestBrand(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}