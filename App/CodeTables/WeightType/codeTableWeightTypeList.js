var weightTypeSelectedData = null;
var weightTypeTableLanguagesData = "";
$(function() {
  var weightTypeTableData = "";
  var weightTypeTable = $('#WeightTypeTable').DataTable({
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
      weightTypeTableData = data.ListWeightTypes;
      weightTypeTableLanguagesData = data.ListLanguages;
      ListWeightType(0);
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

    weightTypeTable.clear();
    ListWeightType(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    weightTypeTable.clear();
    ListWeightType(0);
  });

  $(".AddNewWeightType").on('click', function() {
    $(".add_title").removeClass("d-none");
    $("#btnAddWeightType").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateWeightType").addClass("d-none");
    
    weightTypeSelectedData = null;
    $('.AddWeightTypeFormCode').val('');
    $('.AddWeightTypeFormName').val('');
    $('#weightTypeLanguages').html("");

    const languages = weightTypeTableLanguagesData;
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
      html += '        <input class="form-control AddWeightTypeFormLanguageName" type="text" name="weightTypeLanguageName'+language.id+'" placeholder="'+nameTranslatedTxt+'">';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      
      $('#weightTypeLanguages').append(html);
    });
  });

  $("#btnAddWeightType, #btnUpdateWeightType").on('click', function() {
    var code = $('#AddWeightTypeFormCode').val();
    var name = $('#AddWeightTypeFormName').val();
    if (code == "" || name == '') {
      if (code == '') {
        $('.AddWeightTypeFormCode').addClass("form-control-danger");
        $('.danger-code').removeClass("d-none");

        setTimeout( () => { 
          $(".AddWeightTypeFormCode").removeClass("form-control-danger");
          $('.danger-code').addClass("d-none");
        }, 3000 );
      }
      if (name == '') {
        $('.AddWeightTypeFormName').addClass("form-control-danger");
        $('.danger-name').removeClass("d-none");

        setTimeout( () => { 
          $(".AddWeightTypeFormName").removeClass("form-control-danger");
          $('.danger-name').addClass("d-none");
        }, 3000 );
      }
    } else {
      var weightTypeNames = [];
      $('input[name^="weightTypeLanguageName"]').each(function() {
        var idNameLanguage = this.name.substr("weightTypeLanguageName".length);
        var idName=0; var idWeightType=0; var timestampName=0; var elemStateName=0;
        if (weightTypeSelectedData != null) {
          $.map(weightTypeSelectedData.names, function(nameData, nameDataKey) {
            if (nameData.idLanguage == idNameLanguage) { 
              idName=nameData.id;
              idWeightType=nameData.idWeightType;
              timestampName=nameData.timestamp;
              elemStateName=nameData.elemState;
            }
          });
        }  
        let weightTypeName = {
          "id": idName,
          "idWeightType": idWeightType,
          "idLanguage": idNameLanguage,
          "elemState": elemStateName,
          "timestamp": timestampName,
          "name": this.value
        }
        weightTypeNames.push(weightTypeName);
      });
      var id=0; var timestamp=0; var elemState=0;
      if (weightTypeSelectedData != null) {
        id=weightTypeSelectedData.id;
        timestamp=weightTypeSelectedData.timestamp;
        elemState=weightTypeSelectedData.elemState;
      }
      $.ajax({
        url : 'Controllers/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: {id,code,name,elemState,timestamp, "names":weightTypeNames},
        success : function(data) {
          if (data.ConfirmSave) {
            $('#sa-success-distrix').trigger('click');
            setTimeout(function() {window.location.href = "./codeTableWeightTypeList.php";}, 800);        
          } else {
            $('#sa-error-distrix').trigger('click');
            $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
          }
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddWeightType").attr("data-dismiss", "modal");
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
          setTimeout(function() {window.location.href = "./codeTableWeightTypeList.php";}, 800);
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
          setTimeout(function() {window.location.href = "./codeTableWeightTypeList.php";}, 800);
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

  function ListWeightType(elemState){
    const dataTableData = weightTypeTableData;
    $.map(dataTableData, function(val, key) {
      if(val.elemState == elemState){
        if(val.elemState == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.elemState == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        var weightTypeType  = '';
        if (val.isSolid == 1)  {weightTypeType  = '<div class="row"><div class="col-md-12 col-sm-12"><span class="micon dw dw-pyramid-chart"></span> '+weightTypeType_solid+'</div>';}
        if (val.isLiquid == 1) {weightTypeType  = '<div class="row"><div class="col-md-12 col-sm-12"><span class="micon dw dw-drop"></span> '+weightTypeType_liquid+'</div>';}
        if (val.isOther == 1)  {weightTypeType  = '<div class="row"><div class="col-md-12 col-sm-12"><span class="micon dw dw-question"></span> '+weightTypeType_other+'</div>';}

        var infoLanguage = '<i class="icon-copy dw dw-checked mr-2" data-color="#FF9900" style="color: rgb(255,153,0);"></i>';
        if (val.nbLanguages == val.nbLanguagesTotal) {
          var infoLanguage = '<i class="icon-copy dw dw-checked mr-2" data-color="#006600" style="color: rgb(0,102,0);"></i>';
        }
        
        let line =  '<tr>'+
                    '  <td style="padding:1rem;">&nbsp;&nbsp;'+val.code+'</td>'+
                    '  <td>'+val.name+'</td>'+
                    '  <td>'+val.abbreviation+'</td>'+
                    '  <td>'+weightTypeType+'</td>'+
                    '  <td>'+infoLanguage+' '+val.nbLanguages+'/'+val.nbLanguagesTotal;
        if (val.nbLanguages < val.nbLanguagesTotal) {
          const languages = weightTypeTableLanguagesData;
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
                '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddWeightType" onclick="ViewWeightType(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"           onclick="DelWeightType(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"          onclick="RestWeightType(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                '     </div>'+
                '   </div>'+
                ' </td>'+
                '</tr>';
        weightTypeTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewWeightType(id){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      weightTypeSelectedData = data.ViewWeightType;

      $(".add_title").addClass("d-none");
      $("#btnAddWeightType").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateWeightType").removeClass("d-none");
  
      $('.AddWeightTypeFormCode').val(data.ViewWeightType.code);
      $('.AddWeightTypeFormName').val(data.ViewWeightType.name);
      $('#weightTypeLanguages').html("");

      const languages = weightTypeTableLanguagesData;
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
        $.map(data.ViewWeightType.names, function(nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) { updateName=nameData.name; className = "form-control-success";}
        });
        html += '        <input class="form-control '+className+' AddWeightTypeFormLanguageName" type="text" name="weightTypeLanguageName'+language.id+'" value="'+updateName+'" placeholder="'+nameTranslatedTxt+'">';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        
        $('#weightTypeLanguages').append(html);
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelWeightType(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestWeightType(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

