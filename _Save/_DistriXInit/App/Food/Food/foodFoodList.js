datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : 'Controllers/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListFoods));

    $.map(data.ListBrands, function(val, key) {
      $('#listBrands').append('<option value="'+val.id+'">'+val.name+'</option>');
    });

    $.map(data.ListEcoScores, function(val, key) {
      $('#listEcoScores').append('<option value="'+val.id+'">'+val.letter+'</option>');
    });

    $.map(data.ListNovaScores, function(val, key) {
      $('#listNovaScores').append('<option value="'+val.id+'">'+val.number+'</option>');
    });

    $.map(data.ListNutriScores, function(val, key) {
      $('#listNutriScores').append('<option value="'+val.id+'">'+val.letter+'</option>');
    });

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
  ListFood(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListFood(0);
});

$(".AddNewFood").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $(".infoFoodName").html('');
  $('.AddFoodFormIdFood').val(0);
  $('.AddFoodFormCode').val('');
  $('.AddFoodFormName').val('');
  $(".avatar-brand").attr("src", '');
  $('.AddFoodFormTimestamp').val(0);
  $('.AddFoodFormStatut').val(0);
});

$(".btnAddFood").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  
  var name = $('.AddFoodFormName').val();
  if (name != ""){
    var data = $('#FormAddFood').serializeArray(); // convert form to array
    data.push({name: "name", value: name});
    
    $.ajax({
      url : 'Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodFoodList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddFood").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddFoodFormName').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddFoodFormName").removeClass("form-control-danger");
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
        setTimeout(function() {window.location.href = "./foodFoodList.php";}, 800);
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
        setTimeout(function() {window.location.href = "./foodFoodList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListFood(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    ' <td style="padding:1rem;">'+val.name+'</br><span style="font-size:13px; color:#90a4ae;">'+val.code+'</span></td>'+
                    ' <td><img style="max-height:40px; max-width:40px;" src="'+val.pictureBrand+'"/></td>'+
                    ' <td><img style="max-height:40px; max-width:40px;" src="'+val.pictureScoreNutri+'"/></td>'+
                    ' <td><img style="max-height:40px; max-width:40px;" src="'+val.pictureScoreNova+'"/></td>'+
                    ' <td><img style="max-height:40px; max-width:40px;" src="'+val.pictureScoreEco+'"/></td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                                                                          onclick="ViewDetailFood(\''+val.id+'\');"             href="#"><i class="dw dw-analytics-5"></i> D??tail</a>'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddFood"     onclick="ViewFood(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelFood(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestFood(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewDetailFood(id, name){
  localStorage.setItem("idFood", id);
  window.location.href = 'foodFoodDetail.php';
  window.location.href = '../FoodDetail/foodDetail.php';
}

function ViewFood(id, name){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
      
      $(".infoFoodName").html(name);

      $('#listBrands').val(data.ViewFood.idBrand);
      $('#select2-listBrands-container').html(data.ViewFood.nameBrand);
      
      $('#listEcoScores').val(data.ViewFood.idScoreEco);
      $('#select2-listEcoScores-container').html(data.ViewFood.nameScoreEco);
      
      $('#listNovaScores').val(data.ViewFood.idScoreNova);
      $('#select2-listNovaScores-container').html(data.ViewFood.nameScoreNova);
      
      $('#listNutriScores').val(data.ViewFood.idScoreNutri);
      $('#select2-listNutriScores-container').html(data.ViewFood.nameScoreNutri);

      $('.AddFoodFormIdFood').val(id);
      $('.AddFoodFormCode').val(data.ViewFood.code);
      $('.AddFoodFormName').val(data.ViewFood.name);
      $('.AddFoodFormTimestamp').val(data.ViewFood.timestamp);
      $('.AddFoodFormStatut').val(data.ViewFood.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelFood(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestFood(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}