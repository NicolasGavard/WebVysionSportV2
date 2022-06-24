var foodNutritionalSelectedData = null;
var foodNutritionalTableData    = "";
var foodNutritionalTable = $('#FoodNutritionalTable').DataTable({
  columnDefs: [
    { orderable: false, targets: 2 }
  ],
  language: {
    url: '../../i18/FR/DataTableFrench.json'
  }
});

$(function() {
  $.ajax({
    url : '../FoodNutritional/Controllers/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idFood': localStorage.getItem("idFood")},
    success : function(data) {
      foodNutritionalTableData = data.ListFoodNutritionals;

      $.map(data.ListNotApplyNutritionals, function(val, key) {
        $('#listNutritionalsNotApply').append('<option value="'+val.id+'">'+val.name+'</option>');
      });

      ListFoodNutritional(0);
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

    foodNutritionalTable.clear();
    ListFoodNutritional(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    foodNutritionalTable.clear();
    ListFoodNutritional(0);
  });

  $(".btnAddFood").on('click', function() {
    $(".page_food_brand_update_title").removeClass("d-none");
    
    $.ajax({
      url : '../FoodNutritional/Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddFood').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodFoodList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddFood").attr("data-dismiss", "modal");
  });

  $("#btnDel").on('click', function() {
    $.ajax({
      url : '../FoodNutritional/Controllers/delete.php',
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
      url : '../FoodNutritional/Controllers/restore.php',
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
});

function ListFoodNutritional(elemState){
  const dataTableData = foodNutritionalTableData;
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    ' <td style="padding:1rem;"><img style="max-height:40px; max-width:40px;" src="'+val.linkToPicture+'"/></td>'+
                    ' <td>'+val.name+'</td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddFood"     onclick="ViewFood(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"   onclick="DelFoodNutritional(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"  onclick="RestFoodNutritional(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      foodNutritionalTable.row.add($(line)).draw();
    }
  });
}

function ViewFood(id, name){
  $.ajax({
    url : '../FoodNutritional/Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
      
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

function DelFoodNutritional(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestFoodNutritional(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}