datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : 'Controllers/list.php',
  type : 'POST',
  dataType : 'JSON',
  data: {'idUserCoach': localStorage.getItem("idUser")},
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListMyRecipes));
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
  ListMyRecipe(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListMyRecipe(0);
});

$(".AddNewMyRecipe").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddMyRecipeFormIdMyRecipe').val(0);
  $('.AddMyRecipeFormCode').val('');
  $('.AddMyRecipeFormName').val('');
  $('.AddMyRecipeFormRating').val('');
  $(".AddMyRecipePicture").attr("src", '');
  $('.AddMyRecipeFormTimestamp').val(0);
  $('.AddMyRecipeFormStatut').val(0);
});

$(".btnAddMyRecipe").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  
  var name = $('.AddMyRecipeFormName').val();
  if (name != ""){
    var data = $('#FormAddMyRecipe').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : 'Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        if (data.ConfirmSave){
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./nutritionMyRecipesList.php";}, 800);
        } else {
          $('#sa-error-distrix').trigger('click');
        }
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddMyRecipe").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddMyRecipeFormName').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddMyRecipeFormName").removeClass("form-control-danger");
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
        setTimeout(function() {window.location.href = "./nutritionMyRecipesList.php";}, 800);
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
        setTimeout(function() {window.location.href = "./nutritionMyRecipesList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function encodeImgtoBase64(element) {
  var file = element.files[0];
  var reader = new FileReader();
  reader.onloadend = function() {
    $("#linkToPictureBase64").val(reader.result);
    $(".AddMyRecipePicture").attr("src", reader.result);
  }
  reader.readAsDataURL(file);
}

function ListMyRecipe(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    '  <td style="padding:1rem;"><img style="max-height:100px; max-width:100px;" src="'+val.linkToPicture+'"/></td>'+
                    '  <td>'+val.name+'</td>'+
                    '  <td>'+
                    '    <div class="row">'+
                    '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-flash"></span> '+val.calorie+'</div>'+
                    '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-orange"></span> '+val.proetin+'</div>'+
                    '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-chip"></span> '+val.glucide+'</div>'+
                    '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-flame"></span> '+val.lipid+'</div>'+
                    '    </div>'+
                    '  </td>'+
                    '  <td>'+val.rating+'</td>'+
                    '  <td>'+
                    '    <div class="dropdown">'+
                    '      <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '      </a>'+
                    '      <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '        <a class="dropdown-item"                                                                               onclick="ViewMyRecipeFood(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-harvest"></i> Aliments</a>'+
                    '        <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMyRecipe"      onclick="ViewMyRecipe(\''+val.id+'\', \''+val.name+'\');"     href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '        <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"              onclick="DelMyRecipe(\''+val.id+'\', \''+val.name+'\');"      href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '        <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"             onclick="RestMyRecipe(\''+val.id+'\', \''+val.name+'\');"     href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '      </div>'+
                    '    </div>'+
                    '  </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewMyRecipeFood(id, name){
  localStorage.setItem("idRecipe", id);
  window.location.href = 'nutritionMyRecipeFoodList.php';
}

function ViewMyRecipe(id, name){
  $(".InfoSuppTitle").html(name);
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $('.AddMyRecipeFormId').val(id);
      $('.AddMyRecipeFormIdUserCoatch').val(data.ViewMyRecipe.idusercoach);
      $('.AddMyRecipeFormCode').val(data.ViewMyRecipe.code);
      $('.AddMyRecipeFormName').val(data.ViewMyRecipe.name);
      $('.AddMyRecipeFormRating').val(data.ViewMyRecipe.rating);
      $(".AddMyRecipePicture").attr("src", data.ViewMyRecipe.linktopicture);
      $('.AddMyRecipeFormTimestamp').val(data.ViewMyRecipe.timestamp);
      $('.AddMyRecipeFormStatut').val(data.ViewMyRecipe.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyRecipe(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestMyRecipe(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}