var nutritionalSelectedData = null;
var nutritionalTableLanguagesData = "";
$(function() {
  var nutritionalTableData = "";
  var nutritionalTable = $('#NutritionalTable').DataTable({
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
      nutritionalTableData = data.ListNutritionals;
      nutritionalTableLanguagesData = data.ListLanguages;
      ListNutritional(0);
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

    nutritionalTable.clear();
    ListNutritional(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    nutritionalTable.clear();
    ListNutritional(0);
  });

    $(".AddNewNutritional").on('click', function() {
    $(".add_title").removeClass("d-none");
    $("#btnAddNutritional").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateNutritional").addClass("d-none");
    
    nutritionalSelectedData = null;
    $('.AddNutritionalFormCode').val('');
    $('.AddNutritionalFormName').val('');
    $('#nutritionalLanguages').html("");

    const languages = nutritionalTableLanguagesData;
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
      html += '        <input class="form-control AddNutritionalFormLanguageName" type="text" name="nutritionalLanguageName'+language.id+'" placeholder="'+nameTranslatedTxt+'">';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      
      $('#nutritionalLanguages').append(html);
    });
  });

  $("#btnAddNutritional, #btnUpdateNutritional").on('click', function() {
    var code = $('#AddNutritionalFormCode').val();
    var name = $('#AddNutritionalFormName').val();
    if (code == "" || name == '') {
      if (code == '') {
        $('.AddNutritionalFormCode').addClass("form-control-danger");
        $('.danger-code').removeClass("d-none");

        setTimeout( () => { 
          $(".AddNutritionalFormCode").removeClass("form-control-danger");
          $('.danger-code').addClass("d-none");
        }, 3000 );
      }
      if (name == '') {
        $('.AddNutritionalFormName').addClass("form-control-danger");
        $('.danger-name').removeClass("d-none");

        setTimeout( () => { 
          $(".AddNutritionalFormName").removeClass("form-control-danger");
          $('.danger-name').addClass("d-none");
        }, 3000 );
      }
    } else {
      var nutritionalNames = [];
      $('input[name^="nutritionalLanguageName"]').each(function() {
        var idNameLanguage = this.name.substr("nutritionalLanguageName".length);
        var idName=0; var idNutritional=0; var timestampName=0; var elemStateName=0;
        if (nutritionalSelectedData != null) {
          $.map(nutritionalSelectedData.names, function(nameData, nameDataKey) {
            if (nameData.idLanguage == idNameLanguage) { 
              idName=nameData.id;
              idNutritional=nameData.idNutritional;
              timestampName=nameData.timestamp;
              elemStateName=nameData.elemState;
            }
          });
        }  
        let nutritionalName = {
          "id": idName,
          "idNutritional": idNutritional,
          "idLanguage": idNameLanguage,
          "elemState": elemStateName,
          "timestamp": timestampName,
          "name": this.value
        }
        nutritionalNames.push(nutritionalName);
      });
      var id=0; var timestamp=0; var elemState=0;
      if (nutritionalSelectedData != null) {
        id=nutritionalSelectedData.id;
        timestamp=nutritionalSelectedData.timestamp;
        elemState=nutritionalSelectedData.elemState;
      }
      $.ajax({
        url : 'Controllers/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: {id,code,name,elemState,timestamp, "names":nutritionalNames},
        success : function(data) {
          if (data.ConfirmSave) {
            $('#sa-success-distrix').trigger('click');
            setTimeout(function() {window.location.href = "./codeTableNutritionalList.php";}, 800);        
          } else {
            $('#sa-error-distrix').trigger('click');
            $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
          }
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddNutritional").attr("data-dismiss", "modal");
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
          setTimeout(function() {window.location.href = "./codeTableNutritionalList.php";}, 800);
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
          setTimeout(function() {window.location.href = "./codeTableNutritionalList.php";}, 800);
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

  function ListNutritional(elemState){
    const dataTableData = nutritionalTableData;
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
                      '  <td>'+infoLanguage+' '+val.nbLanguages+'/'+val.nbLanguagesTotal;
        if (val.nbLanguages < val.nbLanguagesTotal) {
          const languages = nutritionalTableLanguagesData;
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
                '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddNutritional" onclick="ViewNutritional(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelNutritional(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestNutritional(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                '     </div>'+
                '   </div>'+
                ' </td>'+
                '</tr>';
        nutritionalTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewNutritional(id){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      nutritionalSelectedData = data.ViewNutritional;

      $(".add_title").addClass("d-none");
      $("#btnAddNutritional").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateNutritional").removeClass("d-none");
  
      $('.AddNutritionalFormCode').val(data.ViewNutritional.code);
      $('.AddNutritionalFormName').val(data.ViewNutritional.name);
      $('#nutritionalLanguages').html("");

      const languages = nutritionalTableLanguagesData;
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
        $.map(data.ViewNutritional.names, function(nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) { updateName=nameData.name; className = "form-control-success";}
        });
        html += '        <input class="form-control '+className+' AddNutritionalFormLanguageName" type="text" name="nutritionalLanguageName'+language.id+'" value="'+updateName+'" placeholder="'+nameTranslatedTxt+'">';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        
        $('#nutritionalLanguages').append(html);
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelNutritional(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestNutritional(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

