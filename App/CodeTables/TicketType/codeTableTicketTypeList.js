var ticketTypeSelectedData = null;
var ticketTypeTableLanguagesData = "";
$(function() {
  var ticketTypeTableData = "";
  var ticketTypeTable = $('#TicketTypeTable').DataTable({
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
      ticketTypeTableData = data.ListTicketTypes;
      ticketTypeTableLanguagesData = data.ListLanguages;
      ListTicketType(0);
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

    ticketTypeTable.clear();
    ListTicketType(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    ticketTypeTable.clear();
    ListTicketType(0);
  });

  $(".AddNewTicketType").on('click', function() {
    $(".add_title").removeClass("d-none");
    $("#btnAddTicketType").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateTicketType").addClass("d-none");
    
    ticketTypeSelectedData = null;
    $('.AddTicketTypeFormCode').val('');
    $('.AddTicketTypeFormName').val('');
    $('#ticketTypeLanguages').html("");

    const languages = ticketTypeTableLanguagesData;
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
      html += '        <input class="form-control AddTicketTypeFormLanguageName" type="text" name="ticketTypeLanguageName'+language.id+'" placeholder="'+nameTranslatedTxt+'">';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      
      $('#ticketTypeLanguages').append(html);
    });
  });

  $("#btnAddTicketType, #btnUpdateTicketType").on('click', function() {
    var code = $('#AddTicketTypeFormCode').val();
    var name = $('#AddTicketTypeFormName').val();
    if (code == "" || name == '') {
      if (code == '') {
        $('.AddTicketTypeFormCode').addClass("form-control-danger");
        $('.danger-code').removeClass("d-none");

        setTimeout( () => { 
          $(".AddTicketTypeFormCode").removeClass("form-control-danger");
          $('.danger-code').addClass("d-none");
        }, 3000 );
      }
      if (name == '') {
        $('.AddTicketTypeFormName').addClass("form-control-danger");
        $('.danger-name').removeClass("d-none");

        setTimeout( () => { 
          $(".AddTicketTypeFormName").removeClass("form-control-danger");
          $('.danger-name').addClass("d-none");
        }, 3000 );
      }
    } else {
      var ticketTypeNames = [];
      $('input[name^="ticketTypeLanguageName"]').each(function() {
        var idNameLanguage = this.name.substr("ticketTypeLanguageName".length);
        var idName=0; var idTicketType=0; var timestampName=0; var elemStateName=0;
        if (ticketTypeSelectedData != null) {
          $.map(ticketTypeSelectedData.names, function(nameData, nameDataKey) {
            if (nameData.idLanguage == idNameLanguage) { 
              idName=nameData.id;
              idTicketType=nameData.idTicketType;
              timestampName=nameData.timestamp;
              elemStateName=nameData.elemState;
            }
          });
        }  
        let ticketTypeName = {
          "id": idName,
          "idTicketType": idTicketType,
          "idLanguage": idNameLanguage,
          "elemState": elemStateName,
          "timestamp": timestampName,
          "name": this.value
        }
        ticketTypeNames.push(ticketTypeName);
      });
      var id=0; var timestamp=0; var elemState=0;
      if (ticketTypeSelectedData != null) {
        id=ticketTypeSelectedData.id;
        timestamp=ticketTypeSelectedData.timestamp;
        elemState=ticketTypeSelectedData.elemState;
      }
      $.ajax({
        url : 'Controllers/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: {id,code,name,elemState,timestamp, "names":ticketTypeNames},
        success : function(data) {
          if (data.ConfirmSave) {
            $('#sa-success-distrix').trigger('click');
            setTimeout(function() {window.location.href = "./codeTableTicketTypeList.php";}, 800);        
          } else {
            $('#sa-error-distrix').trigger('click');
            $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
          }
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddTicketType").attr("data-dismiss", "modal");
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
          setTimeout(function() {window.location.href = "./codeTableTicketTypeList.php";}, 800);
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
          setTimeout(function() {window.location.href = "./codeTableTicketTypeList.php";}, 800);
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

  function ListTicketType(elemState){
    const dataTableData = ticketTypeTableData;
    $.map(dataTableData, function(val, key) {
      if(val.elemState == elemState){
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        let line =  '<tr>'+
                      '  <td style="padding:1rem;">'+val.code+'</td>'+
                      '  <td>'+val.name+'</td>'+
                      '  <td>'+val.nbLanguages+'/'+val.nbLanguagesTotal;
        if (val.nbLanguages < val.nbLanguagesTotal) {
          const languages = ticketTypeTableLanguagesData;
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
                '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddTicketType" onclick="ViewTicketType(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelTicketType(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestTicketType(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                '     </div>'+
                '   </div>'+
                ' </td>'+
                '</tr>';
        ticketTypeTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewTicketType(id){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      ticketTypeSelectedData = data.ViewTicketType;

      $(".add_title").addClass("d-none");
      $("#btnAddTicketType").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateTicketType").removeClass("d-none");
  
      $('.AddTicketTypeFormCode').val(data.ViewTicketType.code);
      $('.AddTicketTypeFormName').val(data.ViewTicketType.name);
      $('#ticketTypeLanguages').html("");

      const languages = ticketTypeTableLanguagesData;
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
        $.map(data.ViewTicketType.names, function(nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) { updateName=nameData.name; className = "form-control-success";}
        });
        html += '        <input class="form-control '+className+' AddTicketTypeFormLanguageName" type="text" name="ticketTypeLanguageName'+language.id+'" value="'+updateName+'" placeholder="'+nameTranslatedTxt+'">';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        
        $('#ticketTypeLanguages').append(html);
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelTicketType(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestTicketType(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

