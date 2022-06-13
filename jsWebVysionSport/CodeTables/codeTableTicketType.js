$(function() {
  var ticketStatusTableData = "";
  var ticketStatusTableLanguagesData = "";
  var ticketStatusTable = $('#TicketStatusTable').DataTable({
    columnDefs: [
      { orderable: false, targets: 2 },
      { orderable: false, targets: 3 }
    ],
    language: {
      url: '../../i18/FR/DataTableFrench.json'
    }
  });

  $.ajax({
    url : '../../Controllers/CodeTables/TicketStatus/list.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {
      ticketStatusTableData = data.ListTicketStatuss;
      ticketStatusTableLanguagesData = data.ListLanguages;
      ListTicketStatus(0);
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

    ticketStatusTable.clear().draw();
    ListTicketStatus(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    ticketStatusTable.clear().draw();
    ListTicketStatus(0);
  });

  $(".AddNewTicketStatus").on('click', function() {
    $(".add_title").removeClass("d-none");
    $("#btnAddTicketStatus").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateTicketStatus").addClass("d-none");

    $('.AddTicketStatusFormIdTicketStatus').val(0);
    $('.AddTicketStatusFormCode').val('');
    $('.AddTicketStatusFormName').val('');
    $('.AddTicketStatusFormTimestamp').val(0);
    $('.AddTicketStatusFormStatut').val(0);
    
    $('#ticketStatusLanguages').html();
    const languages = ticketStatusTableLanguagesData;
    $.map(languages, function(language, languageKey) {
      var html = "";
      html += '  <div class="row">';
      html += '    <div class="col-md-6 col-sm-12">';
      html += '      <div class="form-group">';
      html += '        <input class="form-control" type="text" disabled value="'+language.name+'">';
      html += '      </div>';
      html += '    </div>';
      html += '    <div class="col-md-6 col-sm-12">';
      html += '      <div class="form-group">';
      html += '        <input class="form-control AddTicketStatusFormLanguageName" type="text" name="ticketStatusLanguageName'+language.id+'" placeholder="'+nameTranslatedTxt+'">';
      html += '        <div class="form-control-feed back danger-name has-danger d-none" style="font-size: 14px;">'+errorNameTxt+'';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      
      $('#ticketStatusLanguages').append(html);
    });
  });

  $(".btnAddTicketStatus").on('click', function() {
    $(".page_food_food_category_update_title").removeClass("d-none");
    
    var name = $('.AddTicketStatusFormName').val();
    if (name != ""){
      var data = $('#FormAddTicketStatus').serializeArray(); // convert form to array
      data.push({name: "name", value: name});
      
      $.ajax({
        url : '../../Controllers/CodeTables/TicketStatus/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: $.param(data),
        success : function(data) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./codeTableTicketStatusList.php";}, 800);
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddTicketStatus").attr("data-dismiss", "modal");
    } else {
      if (name == ''){
        $('.AddTicketStatusFormName').addClass("form-control-danger");
        $('.danger-name').removeClass("d-none");

        setTimeout( () => { 
          $(".AddTicketStatusFormName").removeClass("form-control-danger");
          $('.danger-name').addClass("d-none");
        }, 3000 );
      }
    } 
  });

  $("#btnDel").on('click', function() {
    $.ajax({
      url : '../../Controllers/CodeTables/TicketStatus/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDel').serialize(),
      success : function(data) {
        if (data.confirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./codeTableTicketStatusList.php";}, 800);
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
      url : '../../Controllers/CodeTables/TicketStatus/restore.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormRest').serialize(),
      success : function(data) {
        if (data.confirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./codeTableTicketStatusList.php";}, 800);
        } else {
          $('#sa-error-distrix').trigger('click');
        }
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
  });

  function ListTicketStatus(elemState){
    const dataTableData = ticketStatusTableData;
    $.map(dataTableData, function(val, key) {
      if(val.elemState == elemState){
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        let line =  '<tr>'+
                      '  <td style="padding:1rem;">'+val.code+'</td>'+
                      '  <td>'+val.name+'</td>'+
                      '  <td>'+val.nbLanguages+'/'+val.nbLanguagesTotal;
        if (val.nbLanguages < val.nbLanguagesTotal) {
          const languages = ticketStatusTableLanguagesData;
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
                '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddTicketStatus"   onclick="ViewTicketStatus(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"        onclick="DelTicketStatus(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"       onclick="RestTicketStatus(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                '     </div>'+
                '   </div>'+
                ' </td>'+
                '</tr>';
        ticketStatusTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewTicketStatus(id){
  $.ajax({
    url : '../../Controllers/CodeTables/TicketStatus/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");
    
      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $('.AddTicketStatusFormIdTicketStatus').val(id);
      $('.AddTicketStatusFormCode').val(data.ViewTicketStatus.codeshort);
      $('.AddTicketStatusFormName').val(data.ViewTicketStatus.name);
      $(".avatar-food_category").attr("src", data.ViewTicketStatus.linktopicture);
      $('.AddTicketStatusFormTimestamp').val(data.ViewTicketStatus.timestamp);
      $('.AddTicketStatusFormStatut').val(data.ViewTicketStatus.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelTicketStatus(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestTicketStatus(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

