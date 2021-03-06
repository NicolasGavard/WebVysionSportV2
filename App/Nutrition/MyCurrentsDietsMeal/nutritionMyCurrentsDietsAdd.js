$( "#dateStart" ).datepicker({
  altField: "#dateStart",
  closeText: 'Fermer',
  prevText: 'Précédent',
  nextText: 'Suivant',
  currentText: 'Aujourd\'hui',
  monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
  monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
  dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
  dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
  dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
  weekHeader: 'Sem.',
  dateFormat: 'dd/mm/yyyy'
});

datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : 'Controllers/list.php',
  type : 'POST',
  dataType : 'JSON',
  data: {'idUserCoach': localStorage.getItem("idUser")},
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListMyCurrentsDiets));

    $.map(data.ListMyTemplatesDiets, function(val, key) {
      $('.listMyTemplates').append('<option value="'+val.id+'">'+val.name+'</option>');
    });
    
    $.map(data.ListMyStudents, function(val, key) {
      $('.listStudents').append('<option value="'+val.id+'">'+val.firstName+' '+val.name+'</option>');
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
  $('.AddMyCurrentsDietsFormIdUserCoatch').val(localStorage.getItem("idUser"));
  
  var template        = $('.listMyTemplates').val();
  var student         = $('.listStudents').val();
  var dateStart       = $('.dateStart').val();
  var dateStartSplit  = $(".dateStart").val().split("/")
  
  if (template != 0 && student != 0 && dateStart != '' ){
    $.ajax({
      url : 'Controllers/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddMyCurrentDiet').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        if ($('.AddMyCurrentsDietsFormId').val() == 0) {
          setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsAdd.php";}, 800);
        } else {
          setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsList.php";}, 800);
        }
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddMyCurrentDiet").attr("data-dismiss", "modal");
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
      if (data.ConfirmSave) {
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
      if (data.ConfirmSave) {
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

      var date    = String(val.dateStart);
      var year    = date.substr(0, 4);
      var month   = date.substr(4, 2);
      var day     = date.substr(6, 2);
      var dateFr  = day+'/'+month+'/'+year;

      const line =  '<tr>'+
                    ' <td style="padding:1rem;">&nbsp;&nbsp;'+val.name+'</td>'+
                    ' <td>'+val.firstNameUserStudent+' '+val.nameUserStudent+'</td>'+
                    ' <td>'+val.duration+' jours</td>'+
                    ' <td>'+dateFr+'</td>'+
                    ' <td>'+val.tags+'</td>'+
                    ' <td><div class="progress mb-20"><div class="progress-bar progress-bar-striped bg-'+progressColor+'" role="progressbar" style="width: '+val.advancement+'%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">'+val.advancement+'%</div></div></td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMealCurrentDiet"  onclick="ViewMealMyCurrentDiet(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-harvest"></i> Repas</a>'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddMyCurrentDiet"    onclick="ViewMyCurrentDiet(\''+val.id+'\', \''+val.name+'\');"      href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"                 onclick="DelMyCurrentDiet(\''+val.id+'\', \''+val.name+'\');"       href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"                onclick="RestMyCurrentDiet(\''+val.id+'\', \''+val.name+'\');"      href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewMealMyCurrentDiet(id, name){
  localStorage.setItem("idDiet", id);
  window.location.href = '../MyCurrentsDietsMeal/nutritionMyCurrentsDietsMealList.php';
}

function ViewMyCurrentDiet(id, name){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");

      $('.AddMyCurrentDietFormIdMyCurrentDiet').val(id);
      $('.AddMyCurrentsDietsFormIdUserCoatch').val(data.ViewMyCurrentDiet.idUserCoach);
            
      $('.listMyTemplates option[value="'+data.ViewMyCurrentDiet.idDietTemplate+'"]').prop('selected', true);
      nameTemplate = $('.listMyTemplates option[value="'+data.ViewMyCurrentDiet.idDietTemplate+'"]').text();
      $('#select2-listMyTemplates-container').html(nameTemplate);
      
      $('.listStudents option[value="'+data.ViewMyCurrentDiet.idUserStudent+'"]').prop('selected', true);
      nameStudent = $('.listStudents option[value="'+data.ViewMyCurrentDiet.idUserStudent+'"]').text();
      $('#select2-listStudents-container').html(nameStudent);
      
      var date    = String(data.ViewMyCurrentDiet.dateStart);
      var year    = date.substr(0, 4);
      var month   = date.substr(4, 2);
      var day     = date.substr(6, 2);
      var dateFr  = day+'/'+month+'/'+year;
      $('.dateStart').val(dateFr);

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