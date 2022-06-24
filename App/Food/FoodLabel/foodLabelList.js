var foodLabelSelectedData = null;
var foodLabelTableData    = "";
var foodLabelTable = $('#FoodLabelTable').DataTable({
  columnDefs: [
    { orderable: false, targets: 2 }
  ],
  language: {
    url: '../../i18/FR/DataTableFrench.json'
  }
});

$(function() {
  $.ajax({
    url : '../FoodLabel/Controllers/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idFood': localStorage.getItem("idFood")},
    success : function(data) {
      foodLabelTableData = data.ListFoodLabels;

      $.map(data.ListNotApplyLabels, function(val, key) {
        $('#listLabelsNotApply').append('<option value="'+val.id+'">'+val.name+'</option>');
      });

      ListFoodLabel(0);
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

    foodLabelTable.clear();
    ListFoodLabel(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    foodLabelTable.clear();
    ListFoodLabel(0);
  });

  $(".btnAddFood").on('click', function() {
    $(".page_food_brand_update_title").removeClass("d-none");
    
    $.ajax({
      url : '../FoodLabel/Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddFood').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodDetail.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddFood").attr("data-dismiss", "modal");
  });

  $("#btnDel").on('click', function() {
    $.ajax({
      url : '../FoodLabel/Controllers/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDel').serialize(),
      success : function(data) {
        if (data.ConfirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./foodDetail.php";}, 800);
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
      url : '../FoodLabel/Controllers/restore.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormRest').serialize(),
      success : function(data) {
        if (data.ConfirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./foodDetail.php";}, 800);
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

function ListFoodLabel(elemState){
  const dataTableData = foodLabelTableData;
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
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"   onclick="DelFoodLabel(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"  onclick="RestFoodLabel(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      foodLabelTable.row.add($(line)).draw();
    }
  });
}

function DelFoodLabel(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestFoodLabel(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}