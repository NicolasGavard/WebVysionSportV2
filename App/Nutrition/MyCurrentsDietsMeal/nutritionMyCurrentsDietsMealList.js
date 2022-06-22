var myCurrentDietMealsSelectedData = null;
var myCurrentDietMealsTableLanguagesData = "";
$(function() {
  var myCurrentDietMealsTableData = "";
  var myCurrentDietMealsTable = $('#MyCurrentDietMealsTable').DataTable({
    columnDefs: [
      { orderable: false, targets: 6 }
    ],
    language: {
      url: '../../i18/FR/DataTableFrench.json'
    }
  });

  $.ajax({
    url : '../MyCurrentsDiets/Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': localStorage.getItem("idDiet")},
    success : function(data) {
      $(".infoDietName").html(data.ViewMyCurrentDiet.name);
    },
    error : function(data) {
      console.log(data);
    }
  });

  $.ajax({
    url : 'Controllers/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idDiet': localStorage.getItem("idDiet")},
    success : function(data) {
      myCurrentDietMealsTableData = data.ListMyCurrentsDietMeals
      ListMyCurrentDietMeal(0);
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

    myCurrentDietMealsTable.clear();
    ListMyCurrentDietMeal(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    myCurrentDietMealsTable.clear();
    ListMyCurrentDietMeal(0);
  });

  $(".AddNewMyCurrentDietMeal").on('click', function() {
    $(".add_title").removeClass("d-none");
    $(".update_title").addClass("d-none");

    $('.AddMyCurrentDietMealFormIdMyCurrentDietMeal').val(0);
    $('.AddMyCurrentDietMealFormCode').val('');
    $('.AddMyCurrentDietMealFormName').val('');
    $(".avatar-brand").attr("src", '');
    $('.AddMyCurrentDietMealFormTimestamp').val(0);
    $('.AddMyCurrentDietMealFormStatut').val(0);
  });

  $(".btnAddMyCurrentDietMeal").on('click', function() {
    $(".page_food_brand_update_title").removeClass("d-none");
    $('.AddMyCurrentsDietsFormIdUserCoatch').val(localStorage.getItem("idUser"));
    
    var template        = $('.listMyTemplates').val();
    var student         = $('.listStudents').val();
    var dateStart       = $('.dateStart').val();
    var dateStartSplit  = $(".dateStart").val().split("/")
    // var dateStartDb     = dateStartSplit[2]+''+dateStartSplit[1]+''+dateStartSplit[0];

    if (template != 0 && student != 0 && dateStart != '' ){
      $.ajax({
        url : 'Controllers/save.php',
        type : 'POST',
        dataType : 'JSON',
        // data: $.param(data),
        data: $('#FormAddMyCurrentDietMeal').serialize(),
        success : function(data) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsList.php";}, 800);
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddMyCurrentDietMeal").attr("data-dismiss", "modal");
    } else {
      if (template == 0){
        $('.danger-template').removeClass("d-none");
        setTimeout( () => { 
          $('.danger-template').addClass("d-none");
        }, 3000 );
      }
      if (student == 0){
        $('.danger-student').removeClass("d-none");
        setTimeout( () => { 
          $('.danger-student').addClass("d-none");
        }, 3000 );
      }
      if (dateStart == ''){
        $('.dateStart').addClass("form-control-danger");
        $('.danger-dateStart').removeClass("d-none");

        setTimeout( () => { 
          $(".dateStart").removeClass("form-control-danger");
          $('.danger-dateStart').addClass("d-none");
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
        if (data.confirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsList.php";}, 800);
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
        if (data.confirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsList.php";}, 800);
        } else {
          $('#sa-error-distrix').trigger('click');
        }
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  });

  function ListMyCurrentDietMeal(elemState){
    const dataTableData = myCurrentDietMealsTableData;
    $.map(dataTableData, function(val, key) {
      if(val.elemState == elemState){
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        const line =  '<tr>'+
                      ' <td style="padding:1rem;">'+val.dayNumber+'</td>'+
                      '  <td>'+val.nameMealType+'</td>'+
                      '  <td>'+val.nameMealType+'</td>'+
                      '  <td>'+val.nameMealType+'</td>'+
                      // '  <td>'+
                      // '    <div class="row">'+
                      // '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-flash"></span> '+val.calorie+'</div>'+
                      // '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-orange"></span> '+val.proetin+'</div>'+
                      // '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-chip"></span> '+val.glucide+'</div>'+
                      // '      <div class="col-md-3 col-sm-3"><span class="micon dw dw-flame"></span> '+val.lipid+'</div>'+
                      // '    </div>'+
                      // '  </td>'+
                      ' <td>'+
                      '   <div class="dropdown">'+
                      '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                      '       <i class="dw dw-more"></i>'+
                      '     </a>'+
                      '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                      '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMyCurrentDietMeal"  onclick="ViewMyCurrentDietMeal(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                      '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"                   onclick="DelMyCurrentDietMeal(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                      '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"                  onclick="RestMyCurrentDietMeal(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                      '     </div>'+
                      '   </div>'+
                      ' </td>'+
                      '</tr>';
        myCurrentDietMealsTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewMyCurrentDietMeal(id){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");

      $('.AddMyCurrentDietMealFormIdMyCurrentDietMeal').val(id);
      $('.AddMyCurrentsDietsFormIdUserCoatch').val(data.ViewMyCurrentDietMeal.idUserCoach);
            
      $('.listMyTemplates option[value="'+data.ViewMyCurrentDietMeal.idDietTemplate+'"]').prop('selected', true);
      nameTemplate = $('.listMyTemplates option[value="'+data.ViewMyCurrentDietMeal.idDietTemplate+'"]').text();
      $('#select2-listMyTemplates-container').html(nameTemplate);
      
      $('.listStudents option[value="'+data.ViewMyCurrentDietMeal.idUserStudent+'"]').prop('selected', true);
      nameStudent = $('.listStudents option[value="'+data.ViewMyCurrentDietMeal.idUserStudent+'"]').text();
      $('#select2-listStudents-container').html(nameStudent);
      
      var date    = String(data.ViewMyCurrentDietMeal.dateStart);
      var year    = date.substr(0, 4);
      var month   = date.substr(4, 2);
      var day     = date.substr(6, 2);
      var dateFr  = day+'/'+month+'/'+year;
      $('.dateStart').val(dateFr);

      $('.AddMyCurrentDietMealFormTimestamp').val(data.ViewMyCurrentDietMeal.timestamp);
      $('.AddMyCurrentDietMealFormStatut').val(data.ViewMyCurrentDietMeal.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyCurrentDietMeal(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestMyCurrentDietMeal(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}