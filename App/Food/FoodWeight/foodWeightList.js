var foodWeightSelectedData = null;
var foodWeightTableData    = "";
var foodWeightTable = $('#FoodWeightTable').DataTable({
  columnDefs: [
    { orderable: false, targets: 2 }
  ],
  language: {
    url: '../../i18/FR/DataTableFrench.json'
  }
});

$(function() {
  $.ajax({
    url : '../FoodWeight/Controllers/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idFood': localStorage.getItem("idFood")},
    success : function(data) {
      foodWeightTableData = data.ListFoodWeights;

      $.map(data.ListNotApplyWeights, function(val, key) {
        $('#listWeightsNotApply').append('<option value="'+val.id+'">'+val.name+'</option>');
      });

      ListFoodWeight(0);
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

    foodWeightTable.clear();
    ListFoodWeight(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    foodWeightTable.clear();
    ListFoodWeight(0);
  });

  $(".AddNewFoodWeight").on('click', function() {
    $(".add_title").removeClass("d-none");
    $(".update_title").addClass("d-none");
    
    $('.AddFoodWeightFormId').val('');
    $('.AddFoodWeightFormIdFood').val('');
    $('.AddFoodWeightFormWeight').val('');
    $('.AddFoodWeightFormWeightType').val('');

    $(".dropzoneImage").addClass("d-none");
    $(".dropzoneNoImage").removeClass("d-none");
    $(".avatar-foodWeight").attr("src", '');
    $('.AddFoodWeightFormTimestamp').val('');
    $('.AddFoodWeightFormStatus').val('');
  });

  function encodeImgtoBase64(element) {
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
      $("#linkToPictureBase64").val(reader.result);
      $(".avatar-foodWeight").attr("src", reader.result);
    }
    reader.readAsDataURL(file);
  }

  $(".btnAddFoodWeight").on('click', function() {
    $.ajax({
      url : '../FoodWeight/Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddFoodWeight').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodDetail.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".AddNewFoodWeight").attr("data-dismiss", "modal");
  });

  $("#btnDel").on('click', function() {
    if ($('.DelFormType').val() == 'FoodWeight') {
      $.ajax({
        url : '../FoodWeight/Controllers/delete.php',
        type : 'POST',
        dataType : 'JSON',
        data: $('#FormDel').serialize(),
        success : function(data) {
          if (data.ConfirmSave) {
            $('.DelFormType').val('');
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
    }
  });

  $("#btnRest").on('click', function() {
    if ($('.DelFormType').val() == 'FoodWeight') {
      $.ajax({
        url : '../FoodWeight/Controllers/restore.php',
        type : 'POST',
        dataType : 'JSON',
        data: $('#FormRest').serialize(),
        success : function(data) {
          if (data.ConfirmSave) {
            $('.RestFormType').val('');
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
    }
  });
});

function ListFoodWeight(elemState){
  const dataTableData = foodWeightTableData;
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    ' <td style="padding:1rem;"><img style="max-height:40px; max-width:40px;" src="'+val.linkToPicture+'"/></td>'+
                    ' <td>'+val.weight+'</td>'+
                    ' <td>'+val.nameWeightType+'</td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddFoodWeight" onclick="ViewFoodWeight(\''+val.id+'\', \''+val.name+'\');"                           href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"           onclick="DelFoodWeight(\''+val.id+'\', \''+val.weight+' '+val.nameWeightType+'\');"   href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"          onclick="RestFoodWeight(\''+val.id+'\', \''+val.weight+' '+val.nameWeightType+'\');"  href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      foodWeightTable.row.add($(line)).draw();
    }
  });
}

function ViewFoodWeight(id, name){
  $.ajax({
    url : '../FoodWeight/Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
      
      $('.AddFoodWeightFormId').val(id);
      $('.AddFoodWeightFormIdFood').val(data.FoodWeight.idFood);
      $('.AddFoodWeightFormWeight').val(data.FoodWeight.weight);
      $('.AddFoodWeightFormWeightType').val(data.FoodWeight.idWeightType);

      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");
      $(".avatar-foodWeight").attr("src", data.FoodWeight.linkToPicture);

      $('#listWeightsNotApply').empty();
      $.map(data.ListWeights, function(val, key) {
        $('#listWeightsNotApply').append('<option value="'+val.id+'">'+val.name+'</option>');
        if (val.id == data.FoodWeight.idWeightType){
          $('#select2-listWeightsNotApply-container').html(val.name);
        }
      });

      $('.AddFoodWeightFormTimestamp').val(data.FoodWeight.timestamp);
      $('.AddFoodWeightFormStatus').val(data.FoodWeight.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelFoodWeight(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
  $('.DelFormType').val('FoodWeight');
}

function RestFoodWeight(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
  $('.RestFormType').val('FoodWeight');
}