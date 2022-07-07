datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : 'Controllers/list.php',
  type : 'POST',
  dataType : 'JSON',
  data: {'idUserCoach': localStorage.getItem("idUser")},
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListMyExercises));

    $.map(data.ListMyExercisesTypes, function(val, key) {
      $('.AddMyExerciseFormNameExercicesTypes').append('<option value="'+val .id+'">'+val.name+'</option>');
    });

    $.map(data.ListMyExercisesMuscles, function(val, key) {
      $('.AddMyExerciseFormMuscles').append('<optgroup label="'+val.name+'">');
      $.map(val.muscles, function(valMuscles, key) {
        $('.AddMyExerciseFormMuscles').append('<option value="'+valMuscles.id+'">'+valMuscles.name+'</option>');
      });
      $('.AddMyExerciseFormMuscles').append('</optgroup>');
    });

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
  ListMyExercise(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListMyExercise(0);
});

$(".AddNewMyExercise").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddMyExerciseFormId').val(0);
  $('.AddMyExerciseFormIdUserCoatch').val(localStorage.getItem("idUser"));
  $('.AddMyExerciseFormName').val('');
  $('.AddMyExerciseFormDecription').val('');
  $('.AddMyExerciseFormTimestamp').val(0);
  $('.AddMyExerciseFormStatut').val(0);
});

$(".btnAddMyExercise").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  $('.AddMyExercisesFormIdUserCoatch').val(localStorage.getItem("idUser"));
  
  var template        = $('.listMyTemplates').val();
  var student         = $('.listStudents').val();
  var dateStart       = $('.dateStart').val();
  var dateStartSplit  = $(".dateStart").val().split("/")
  
  if (template != 0 && student != 0 && dateStart != '' ){
    $.ajax({
      url : 'Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddMyExercise').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./sportMyExercisesList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddMyExercise").attr("data-dismiss", "modal");
  } else {
    if (template == 0){
      $('.danger-template').removeClass("d-none");
      setTimeo( () => { 
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
      if (data.ConfirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./sportMyExercisesList.php";}, 800);
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
        setTimeout(function() {window.location.href = "./sportMyExercisesList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListMyExercise(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      var listMuscles = '';
      $.map(val.exerciseMuscles, function(valExerciseMuscles, key) {
        listMuscles = listMuscles +''+ valExerciseMuscles.nameBodyMuscle +', <br>';
      });
      listMuscles = listMuscles.substring(0, listMuscles.length - 6); // To delete the last 6 characters NG 06-07-22
      
      if (listMuscles == ''){
        listMuscles = '-';
      }

      const line =  '<tr>'+
                    ' <td style="padding:1rem;">&nbsp;&nbsp;'+val.name+'</td>'+
                    ' <td>'+listMuscles+'</td>'+
                    // ' <td>'+val.firstNameUserStudent+' '+val.nameUserStudent+'</td>'+
                    ' <td>'+val.nameExerciseType+'</td>'+
                    ' <td>'+val.description+'</td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMyExercise"    onclick="ViewMyExercise(\''+val.id+'\', \''+val.name+'\');"      href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"              onclick="DelMyExercise(\''+val.id+'\', \''+val.name+'\');"       href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"             onclick="RestMyExercise(\''+val.id+'\', \''+val.name+'\');"      href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewMyExercise(id, name){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");

      $('.AddMyExerciseFormId').val(data.ViewMyExercise.id);
      $('.AddMyExerciseFormIdUserCoatch').val(data.ViewMyExercise.idUserCoach);
      $('.AddMyExerciseFormName').val(data.ViewMyExercise.name);
      $('.AddMyExerciseFormDecription').val(data.ViewMyExercise.description);
      $('.AddMyExerciseFormTimestamp').val(data.ViewMyExercise.timestamp);
      $('.AddMyExerciseFormStatut').val(data.ViewMyExercise.elemState);

      $.map(data.ViewMyExercise.exerciseMuscles, function(val, key) {
        $('.AddMyExerciseFormMuscles option[value="'+val.idBodyMuscle+'"]').prop('selected', true);
        nameBodyMuscle = $('.AddMyExerciseFormMuscles option[value="'+val.nameBodyMuscle+'"]').text();
        $('#select2-listMuscles-container').html(nameBodyMuscle);
      });

      $.map(data.ListMyExercisesTypes, function(val, key) {
        if (val.id == data.ViewMyExercise.idExerciseType) {
          $('.AddMyExerciseFormNameExercicesTypes option[value="'+data.ViewMyExercise.idExerciseType+'"]').prop('selected', true);
          nameExerciseType = $('.AddMyExerciseFormNameExercicesTypes option[value="'+data.ViewMyExercise.idExerciseType+'"]').text();
          $('#select2-listExercisesTypes-container').html(nameExerciseType);
        }
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelMyExercise(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestMyExercise(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}