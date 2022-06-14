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
    url : '../../Controllers/Food/FoodLabel/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idFood': localStorage.getItem("idFood")},
    success : function(data) {
      foodLabelTableData = data.ListFoodLabels;
      ListFoodLabel(0);
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

  $(".AddNewFood").on('click', function() {
    $(".add_title").removeClass("d-none");
    $(".update_title").addClass("d-none");

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
        url : '../../Controllers/Food/Food/save.php',
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
      url : '../../Controllers/Food/Food/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDel').serialize(),
      success : function(data) {
        if (data.confirmSave) {
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
      url : '../../Controllers/Food/Food/restore.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormRest').serialize(),
      success : function(data) {
        if (data.confirmSave) {
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


function ViewFoodLabel(id){
  $.ajax({
    url : '../../Controllers/Food/Foodlabel/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");

      $('.AddFoodLabelFormIdFoodLabel').val(id);
      $('.AddFoodLabelFormCode').val(data.ViewFoodLabel.code);
      $('.AddFoodLabelFormName').val(data.ViewFoodLabel.name);
      $('.AddFoodLabelFormTimestamp').val(data.ViewFoodLabel.timestamp);
      $('.AddFoodLabelFormStatut').val(data.ViewFoodLabel.elemState);
    },
    error : function(data) {
      console.log(data);
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