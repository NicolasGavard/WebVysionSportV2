datatable = $('#datatable').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}});
$.ajax({
  url : '../../Controllers/Food/NutriScore/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListNutriScores));
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
  ListNutriScore(1);
});

$(".btn-success").on('click', function() {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
  
  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear();
  ListNutriScore(0);
});

$(".AddNewNutriScore").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddNutriScoreFormIdNutriScore').val(0);
  $('.AddNutriScoreFormCode').val('');
  $('.AddNutriScoreFormName').val('');
  $('.AddNutriScoreFormColor').val('');
  $(".avatar-NutriScore").attr("src", '');
  $('.AddNutriScoreFormTimestamp').val(0);
  $('.AddNutriScoreFormStatut').val(0);
});

$(".btnAddNutriScore").on('click', function() {
  var name  = $('.AddNutriScoreFormName').val();
  var color = $('.AddNutriScoreFormColor').val();
  if (name != "" || color != ""){
    var data = $('#FormAddNutriScore').serializeArray(); // convert form to array
    data.push({name: "letter", value: name});
    data.push({name: "color", value: color});
    
    $.ajax({
      url : '../../Controllers/Food/NutriScore/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $.param(data),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNutriScoreList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddNutriScore").attr("data-dismiss", "modal");
  } else {
    if (name == ''){
      $('.AddNutriScoreFormName').addClass("form-control-danger");
      $('.danger-name').removeClass("d-none");

      setTimeout( () => { 
        $(".AddNutriScoreFormName").removeClass("form-control-danger");
        $('.danger-name').addClass("d-none");
      }, 3000 );
    }
    if (color == ''){
      $('.AddNutriScoreFormColor').addClass("form-control-danger");
      $('.danger-color').removeClass("d-none");

      setTimeout( () => { 
        $(".AddNutriScoreFormColor").removeClass("form-control-danger");
        $('.danger-color').addClass("d-none");
      }, 3000 );
    }
  } 
});

$("#btnDel").on('click', function() {
  $.ajax({
    url : '../../Controllers/Food/NutriScore/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.ConfirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNutriScoreList.php";}, 800);
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
    url : '../../Controllers/Food/NutriScore/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.ConfirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./foodNutriScoreList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ListNutriScore(elemState){
  var dataTableData = JSON.parse(localStorage.getItem('dataTable'));
  $.map(dataTableData, function(val, key) {
    if(val.elemState == elemState){
      if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      const line =  '<tr>'+
                    ' <td style="padding:1rem;"><img style="max-height:40px; max-width:40px;" src="'+val.linkToPicture+'"/></td>'+
                    ' <td><div class="progress" style="height:40px;"><div class="progress-bar" role="progressbar" style="width: 100%; background-color:'+val.color+';" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+ 
                    ' <td>'+val.letter+'</td>'+
                    ' <td>'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddNutriScore" onclick="ViewNutriScore(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelNutriScore(\''+val.id+'\', \''+val.letter+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestNutriScore(\''+val.id+'\', \''+val.letter+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewNutriScore(id){
  $.ajax({
    url : '../../Controllers/Food/NutriScore/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $('.AddNutriScoreFormIdNutriScore').val(id);
      $('.AddNutriScoreFormCode').val(data.ViewNutriScore.code);
      $('.AddNutriScoreFormName').val(data.ViewNutriScore.letter);
      $('.AddNutriScoreFormColor').val(data.ViewNutriScore.color);
      $('.asColorPicker-trigger span').attr('style',  'background-color:'+data.ViewNutriScore.color);

      $(".avatar-NutriScore").attr("src", data.ViewNutriScore.linktopicture);
      $('.AddNutriScoreFormTimestamp').val(data.ViewNutriScore.timestamp);
      $('.AddNutriScoreFormStatut').val(data.ViewNutriScore.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelNutriScore(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestNutriScore(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}