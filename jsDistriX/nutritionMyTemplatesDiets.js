datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : 'Controllers/Nutrition/MyCurrentsDiets/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListMyCurrentsDiets));
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
  ListMyCurrentDiet(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListMyCurrentDiet(0);
});

$(".AddNewMyCurrentDiet").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddMyCurrentDietFormIdMyCurrentDiet').val(0);
  $('.AddMyCurrentDietFormCode').val('');
  $('.AddMyCurrentDietFormName').val('');
  $(".avatar-brand").attr("src", '');
  $('.AddMyCurrentDietFormTimestamp').val(0);
  $('.AddMyCurrentDietFormStatut').val(0);
});

$(".btnAddMyCurrentDiet").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  
  var name = $('.AddMyCurrentDietFormName').val();
  if (name != ""){
    var data = $('#FormAddMyCurrentDiet').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : 'Controllers/Nutrition/MyCurrentsDiets/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDiets.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddMyCurrentDiet").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddMyCurrentDietFormName').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddMyCurrentDietFormName").removeClass("form-control-danger");
        $('.danger-name').addClass("d-none");
      }, 3000 );
    }
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
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDiets.php";}, 800);
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
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDiets.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListMyCurrentDiet(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      if (val.advancement >= 0 && val.advancement <= 25) {
        progressColor = "danger";
      } else if (val.advancement >= 25 && val.advancement <= 50) {
        progressColor = "warning";
      } else if (val.advancement >= 50 && val.advancement <= 75) {
        progressColor = "info";
      } else if (val.advancement >= 75 && val.advancement <= 100) {
        progressColor = "success";
      }

      const line =  '<tr>'+
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
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMyCurrentDiet"   onclick="ViewMyCurrentDiet(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"        onclick="DelMyCurrentDiet(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"       onclick="RestMyCurrentDiet(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewMyCurrentDiet(id){
  $.ajax({
    url : 'Controllers/Nutrition/MyCurrentsDiets/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $('.AddMyCurrentDietFormIdMyCurrentDiet').val(id);
      $('.AddMyCurrentDietFormCode').val(data.ViewMyCurrentDiet.code);
      $('.AddMyCurrentDietFormName').val(data.ViewMyCurrentDiet.name);
      $(".avatar-brand").attr("src", data.ViewMyCurrentDiet.linktopicture);
      $('.AddMyCurrentDietFormTimestamp').val(data.ViewMyCurrentDiet.timestamp);
      $('.AddMyCurrentDietFormStatut').val(data.ViewMyCurrentDiet.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyCurrentDiet(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestMyCurrentDiet(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}