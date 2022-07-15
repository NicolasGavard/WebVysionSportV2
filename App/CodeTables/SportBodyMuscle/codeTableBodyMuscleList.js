var bodyMuscleSelectedData = null;
var bodyMuscleTableLanguagesData = "";
$(function() {
  var bodyMuscleTableData = "";
  var bodyMuscleTable = $('#BodyMuscleTable').DataTable({
    columnDefs: [
      { orderable: false, targets: 3 },
      { orderable: false, targets: 4 }
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
      bodyMuscleTableData = data.ListBodyMuscles;
      bodyMuscleTableLanguagesData = data.ListLanguages;

      $.map(data.ListBodyMembers, function(val, key) {
        $("#listBodyMuscleMembers").append('<option value="'+val.id+'">'+val.names[0].name+'</option>');
      });

      ListBodyMuscle(0);
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

    bodyMuscleTable.clear();
    ListBodyMuscle(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    bodyMuscleTable.clear();
    ListBodyMuscle(0);
  });

  $(".AddNewBodyMuscle").on('click', function() {
    $(".add_title").removeClass("d-none");
    $("#btnAddBodyMuscle").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateBodyMuscle").addClass("d-none");
    
    bodyMuscleSelectedData = null;
    $('.AddBodyMuscleFormCode').val('');
    $('.AddBodyMuscleFormName').val('');
    $('#bodyMuscleLanguages').html("");
    $('#listBodyMuscleMembers').val(0).change();
        
    const languages = bodyMuscleTableLanguagesData;
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
      html += '        <input class="form-control AddBodyMuscleFormLanguageName" type="text" name="bodyMuscleLanguageName'+language.id+'" placeholder="'+nameTranslatedTxt+'">';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      
      $('#bodyMuscleLanguages').append(html);
    });
  });

  $("#btnAddBodyMuscle, #btnUpdateBodyMuscle").on('click', function() {
    let noError = true;
    var code = $('#AddBodyMuscleFormCode').val();
    var name = $('#AddBodyMuscleFormName').val();
    const idBodyMember = $('#listBodyMuscleMembers option:selected').val();
    if (code == "" || name == '' || idBodyMember == 0) {
      noError = false;
      if (code == '') {
        $('.AddBodyMuscleFormCode').addClass("form-control-danger");
        $('.danger-code').removeClass("d-none");

        setTimeout( () => { 
          $(".AddBodyMuscleFormCode").removeClass("form-control-danger");
          $('.danger-code').addClass("d-none");
        }, 3000 );
      }
      if (name == '') {
        $('.AddBodyMuscleFormName').addClass("form-control-danger");
        $('.danger-name').removeClass("d-none");

        setTimeout( () => { 
          $(".AddBodyMuscleFormName").removeClass("form-control-danger");
          $('.danger-name').addClass("d-none");
        }, 3000 );
      }
      if (idBodyMember == 0) {
        $('.AddBodyMuscleMember').addClass("form-control-danger");
        $('.danger-member').removeClass("d-none");

        setTimeout( () => { 
          $(".AddBodyMuscleMember").removeClass("form-control-danger");
          $('.danger-member').addClass("d-none");
        }, 3000 );
      }
    }
    if (noError) {
      var bodyMuscleNames = [];
      $('input[name^="bodyMuscleLanguageName"]').each(function() {
        var idNameLanguage = this.name.substr("bodyMuscleLanguageName".length);
        var idName=0; var idBodyMuscle=0; var timestampName=0; var elemStateName=0;
        if (bodyMuscleSelectedData != null) {
          $.map(bodyMuscleSelectedData.names, function(nameData, nameDataKey) {
            if (nameData.idLanguage == idNameLanguage) { 
              idName=nameData.id;
              idBodyMuscle=nameData.idBodyMuscle;
              timestampName=nameData.timestamp;
              elemStateName=nameData.elemState;
            }
          });
        }  
        let bodyMuscleName = {
          "id": idName,
          "idBodyMuscle": idBodyMuscle,
          "idLanguage": idNameLanguage,
          "elemState": elemStateName,
          "timestamp": timestampName,
          "name": this.value
        }
        bodyMuscleNames.push(bodyMuscleName);
      });
      var id=0; var timestamp=0; var elemState=0;
      if (bodyMuscleSelectedData != null) {
        id=bodyMuscleSelectedData.id;
        timestamp=bodyMuscleSelectedData.timestamp;
        elemState=bodyMuscleSelectedData.elemState;
      }
      $.ajax({
        url : 'Controllers/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: {id,code,name,idBodyMember,elemState,timestamp, "names":bodyMuscleNames},
        success : function(data) {
          if (data.ConfirmSave) {
            $('#sa-success-distrix').trigger('click');
            setTimeout(function() {window.location.href = "./codeTableBodyMuscleList.php";}, 800);        
          } else {
            $('#sa-error-distrix').trigger('click');
            $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
          }
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddBodyMuscle").attr("data-dismiss", "modal");
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
          setTimeout(function() {window.location.href = "./codeTableBodyMuscleList.php";}, 800);
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
          setTimeout(function() {window.location.href = "./codeTableBodyMuscleList.php";}, 800);
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

  function ListBodyMuscle(elemState){
    const dataTableData = bodyMuscleTableData;
    $.map(dataTableData, function(val, key) {
      if(val.elemState == elemState){
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        var infoLanguage = '<i class="icon-copy dw dw-checked mr-2" data-color="#FF9900" style="color: rgb(255,153,0);"></i>';
        if (val.nbLanguages == val.nbLanguagesTotal) {
          var infoLanguage = '<i class="icon-copy dw dw-checked mr-2" data-color="#006600" style="color: rgb(0,102,0);"></i>';
        }

        let line =  '<tr>'+
                      '  <td style="padding:1rem;">&nbsp;&nbsp;'+val.code+'</td>'+
                      '  <td>'+val.name+'</td>'+
                      '  <td>'+val.bodyMemberName+'</td>'+
                      '  <td>'+infoLanguage+' '+val.nbLanguages+'/'+val.nbLanguagesTotal;
        if (val.nbLanguages < val.nbLanguagesTotal) {
          const languages = bodyMuscleTableLanguagesData;
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
                '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddBodyMuscle" onclick="ViewBodyMuscle(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelBodyMuscle(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestBodyMuscle(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                '     </div>'+
                '   </div>'+
                ' </td>'+
                '</tr>';
        bodyMuscleTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewBodyMuscle(id){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      bodyMuscleSelectedData = data.ViewBodyMuscle;

      $(".add_title").addClass("d-none");
      $("#btnAddBodyMuscle").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateBodyMuscle").removeClass("d-none");
  
      $('.AddBodyMuscleFormCode').val(data.ViewBodyMuscle.code);
      $('.AddBodyMuscleFormName').val(data.ViewBodyMuscle.name);
      $('#listBodyMuscleMembers').val(data.ViewBodyMuscle.idBodyMember).change();
      $('#bodyMuscleLanguages').html("");

      const languages = bodyMuscleTableLanguagesData;
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
        $.map(data.ViewBodyMuscle.names, function(nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) { updateName=nameData.name; className = "form-control-success";}
        });
        html += '        <input class="form-control '+className+' AddBodyMuscleFormLanguageName" type="text" name="bodyMuscleLanguageName'+language.id+'" value="'+updateName+'" placeholder="'+nameTranslatedTxt+'">';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        
        $('#bodyMuscleLanguages').append(html);
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelBodyMuscle(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestBodyMuscle(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

