datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});

$.ajax({
  url : '../../Controllers/Nutrition/MyRecipeFood/list.php',
  type : 'POST',
  data: {'idRecipe': localStorage.getItem("idRecipe")},
  // dataType : 'JSON',
  success : function(data) {
    $(".infoRecipeName").html(data.InfoMyRecipesFood.name);
    
    $.map(data.ListFood, function(val, key) {
      $('.AddMyRecipeFormFood').append("<option value='"+val.id+"'>"+val.name+"</option>");
    });

    $.map(data.ListWeightType, function(val, key) {
      $('.AddMyRecipeFormWeightType').append("<option value='"+val.id+"'>"+val.name+"</option>");
    });
    
    localStorage.setItem("dataTable", JSON.stringify(data.ListMyRecipesFood));
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

$(".AddNewMyRecipeFood").on('click', function() {
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
      url : '../../Controllers/Nutrition/MyRecipeFood/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        if (data.confirmSave){
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./nutritionMyRecipeFoodList.php";}, 800);
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
    url : '../../Controllers/Nutrition/MyRecipeFood/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyRecipeFoodList.php";}, 800);
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
    url : '../../Controllers/Nutrition/MyRecipeFood/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyRecipeFoodList.php";}, 800);
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
                    '  <td>'+val.nameFood+'</td>'+
                    '  <td>'+val.weight+'</td>'+
                    '  <td>'+val.nameWeightType+'</td>'+
                    '  <td>'+
                    '    <div class="dropdown">'+
                    '      <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '      </a>'+
                    '      <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '        <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMyRecipeFood"  onclick="ViewMyRecipeFood(\''+val.id+'\', \''+val.nameFood+'\');"     href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '        <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"              onclick="DelMyRecipeFood(\''+val.id+'\', \''+val.nameFood+'\');"      href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '        <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"             onclick="RestMyRecipeFood(\''+val.id+'\', \''+val.nameFood+'\');"     href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '      </div>'+
                    '    </div>'+
                    '  </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewMyRecipeFood(id, name){
  $(".InfoSuppTitle").html(name);
  $.ajax({
    url : '../../Controllers/Nutrition/MyRecipeFood/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $('.AddMyRecipeFormId').val(id);
      $('.AddMyRecipeFormIdUserCoatch').val(data.ViewMyRecipe.idusercoach);
      $('.AddMyRecipeFormCode').val(data.ViewMyRecipe.code);
      $('.AddMyRecipeFormName').val(data.ViewMyRecipe.name);
      $('.AddMyRecipeFormRating').val(data.ViewMyRecipe.rating);
      $('.AddMyRecipeFormTimestamp').val(data.ViewMyRecipe.timestamp);
      $('.AddMyRecipeFormStatut').val(data.ViewMyRecipe.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyRecipeFood(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestMyRecipeFood(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}