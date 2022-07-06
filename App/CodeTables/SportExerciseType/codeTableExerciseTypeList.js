var exerciseTypeSelectedData = null;
var exerciseTypeTableLanguagesData = "";
$(function() {
  var exerciseTypeTableData = "";
  var exerciseTypeTable = $('#ExerciseTypeTable').DataTable({
    columnDefs: [
      { orderable: false, targets: 2 },
      { orderable: false, targets: 3 }
    ],
    language: {
      url: '../../i18/FR/DataTableFrench.json'
    }
  });

  $.ajax({
    url : 'Controllers/list.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {
      exerciseTypeTableData = data.ListExerciseTypes;
      exerciseTypeTableLanguagesData = data.ListLanguages;
      ListExerciseType(0);
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

    exerciseTypeTable.clear();
    ListExerciseType(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    exerciseTypeTable.clear();
    ListExerciseType(0);
  });

  $(".AddNewExerciseType").on('click', function() {
    $(".add_title").removeClass("d-none");
    $("#btnAddExerciseType").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateExerciseType").addClass("d-none");
    
    exerciseTypeSelectedData = null;
    $('.AddExerciseTypeFormCode').val('');
    $('.AddExerciseTypeFormName').val('');
    $('#exerciseTypeLanguages').html("");

    const languages = exerciseTypeTableLanguagesData;
    $.map(languages, function(language, languageKey) {
      var html = "";
      html += '  <div class="row">';
      html += '    <div class="col-md-4 col-sm-12">';
      html += '      <div class="form-group">';
      html += '        <input class="form-control" type="text" disabled value="'+language.name+'">';
      html += '      </div>';
      html += '    </div>';
      html += '    <div class="col-md-8 col-sm-12">';
      html += '      <div class="form-group">';
      html += '        <input class="form-control AddExerciseTypeFormLanguageName" type="text" name="exerciseTypeLanguageName'+language.id+'" placeholder="'+nameTranslatedTxt+'">';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      
      $('#exerciseTypeLanguages').append(html);
    });
  });

  $("#btnAddExerciseType, #btnUpdateExerciseType").on('click', function() {
    var code = $('#AddExerciseTypeFormCode').val();
    var name = $('#AddExerciseTypeFormName').val();
    if (code == "" || name == '') {
      if (code == '') {
        $('.AddExerciseTypeFormCode').addClass("form-control-danger");
        $('.danger-code').removeClass("d-none");

        setTimeout( () => { 
          $(".AddExerciseTypeFormCode").removeClass("form-control-danger");
          $('.danger-code').addClass("d-none");
        }, 3000 );
      }
      if (name == '') {
        $('.AddExerciseTypeFormName').addClass("form-control-danger");
        $('.danger-name').removeClass("d-none");

        setTimeout( () => { 
          $(".AddExerciseTypeFormName").removeClass("form-control-danger");
          $('.danger-name').addClass("d-none");
        }, 3000 );
      }
    } else {
      var exerciseTypeNames = [];
      $('input[name^="exerciseTypeLanguageName"]').each(function() {
        var idNameLanguage = this.name.substr("exerciseTypeLanguageName".length);
        var idName=0; var idExerciseType=0; var timestampName=0; var elemStateName=0;
        if (exerciseTypeSelectedData != null) {
          $.map(exerciseTypeSelectedData.names, function(nameData, nameDataKey) {
            if (nameData.idLanguage == idNameLanguage) { 
              idName=nameData.id;
              idExerciseType=nameData.idExerciseType;
              timestampName=nameData.timestamp;
              elemStateName=nameData.elemState;
            }
          });
        }  
        let exerciseTypeName = {
          "id": idName,
          "idExerciseType": idExerciseType,
          "idLanguage": idNameLanguage,
          "elemState": elemStateName,
          "timestamp": timestampName,
          "name": this.value
        }
        exerciseTypeNames.push(exerciseTypeName);
      });
      var id=0; var timestamp=0; var elemState=0;
      if (exerciseTypeSelectedData != null) {
        id=exerciseTypeSelectedData.id;
        timestamp=exerciseTypeSelectedData.timestamp;
        elemState=exerciseTypeSelectedData.elemState;
      }
      $.ajax({
        url : 'Controllers/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: {id,code,name,elemState,timestamp, "names":exerciseTypeNames},
        success : function(data) {
          if (data.ConfirmSave) {
            $('#sa-success-distrix').trigger('click');
            setTimeout(function() {window.location.href = "./codeTableExerciseTypeList.php";}, 800);        
          } else {
            $('#sa-error-distrix').trigger('click');
            $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
          }
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddExerciseType").attr("data-dismiss", "modal");
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
          setTimeout(function() {window.location.href = "./codeTableExerciseTypeList.php";}, 800);
        } else {
          $('#sa-error-distrix').trigger('click');
          $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
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
          setTimeout(function() {window.location.href = "./codeTableExerciseTypeList.php";}, 800);
        } else {
          $('#sa-error-distrix').trigger('click');
          $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
        }
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  });

  function ListExerciseType(elemState){
    const dataTableData = exerciseTypeTableData;
    $.map(dataTableData, function(val, key) {
      if(val.elemState == elemState){
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        var infoLanguage = '<i class="icon-copy dw dw-checked mr-2" data-color="#FF9900" style="color: rgb(255,153,0);"></i>';
        if (val.nbLanguages == val.nbLanguagesTotal) {
          var infoLanguage = '<i class="icon-copy dw dw-checked mr-2" data-color="#006600" style="color: rgb(0,102,0);"></i>';
        }

        let line =  '<tr>'+
                      '  <td style="padding:1rem;">'+val.code+'</td>'+
                      '  <td>'+val.name+'</td>'+
                      '  <td>'+infoLanguage+' '+val.nbLanguages+'/'+val.nbLanguagesTotal;
        if (val.nbLanguages < val.nbLanguagesTotal) {
          const languages = exerciseTypeTableLanguagesData;
          $.map(languages, function(language, languageKey) {
            var notFound = true;
            if (val.names.length > 0) {
              $.map(val.names, function(name, nameKey) {
                if (name.idLanguage == language.id) {
                  notFound = false;
                }
              });
            }
            if (notFound) {
              line += '<br/><span style="color:red;"><i class="dw dw-warning-1"></i> '+language.name+'</span>';
            }
          });
        }
        line += '</td>'+
                ' <td width="10%">'+
                '   <div class="dropdown">'+
                '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                '       <i class="dw dw-more"></i>'+
                '     </a>'+
                '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddExerciseType" onclick="ViewExerciseType(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelExerciseType(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestExerciseType(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                '     </div>'+
                '   </div>'+
                ' </td>'+
                '</tr>';
        exerciseTypeTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewExerciseType(id){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      exerciseTypeSelectedData = data.ViewExerciseType;

      $(".add_title").addClass("d-none");
      $("#btnAddExerciseType").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateExerciseType").removeClass("d-none");
  
      $('.AddExerciseTypeFormCode').val(data.ViewExerciseType.code);
      $('.AddExerciseTypeFormName').val(data.ViewExerciseType.name);
      $('#exerciseTypeLanguages').html("");

      const languages = exerciseTypeTableLanguagesData;
      $.map(languages, function(language, languageKey) {
        var html = "";
        html += '  <div class="row">';
        html += '    <div class="col-md-4 col-sm-12">';
        html += '      <div class="form-group">';
        html += '        <input class="form-control" type="text" disabled value="'+language.name+'">';
        html += '      </div>';
        html += '    </div>';
        html += '    <div class="col-md-8 col-sm-12">';
        html += '      <div class="form-group">';
        var updateName  = "";
        var className   = "form-control-danger";
        $.map(data.ViewExerciseType.names, function(nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) { updateName=nameData.name; className = "form-control-success";}
        });
        html += '        <input class="form-control '+className+' AddExerciseTypeFormLanguageName" type="text" name="exerciseTypeLanguageName'+language.id+'" value="'+updateName+'" placeholder="'+nameTranslatedTxt+'">';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        
        $('#exerciseTypeLanguages').append(html);
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelExerciseType(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestExerciseType(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

