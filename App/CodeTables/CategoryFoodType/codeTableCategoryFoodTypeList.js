var categoryFoodTypeSelectedData = null;
var categoryFoodTypeTableLanguagesData = "";
$(function() {
  var categoryFoodTypeTableData = "";
  var categoryFoodTypeTable = $('#CategoryFoodTypeTable').DataTable({
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
      categoryFoodTypeTableData = data.ListCategoryFoodTypes;
      categoryFoodTypeTableLanguagesData = data.ListLanguages;
      ListCategoryFoodType(0);
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

    categoryFoodTypeTable.clear();
    ListCategoryFoodType(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    categoryFoodTypeTable.clear();
    ListCategoryFoodType(0);
  });

  $(".AddNewCategoryFoodType").on('click', function() {
    $(".add_title").removeClass("d-none");
    $("#btnAddCategoryFoodType").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateCategoryFoodType").addClass("d-none");
    
    categoryFoodTypeSelectedData = null;
    $('.AddCategoryFoodTypeFormCode').val('');
    $('.AddCategoryFoodTypeFormName').val('');
    $('#categoryFoodTypeLanguages').html("");

    const languages = categoryFoodTypeTableLanguagesData;
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
      html += '        <input class="form-control AddCategoryFoodTypeFormLanguageName" type="text" name="categoryFoodTypeLanguageName'+language.id+'" placeholder="'+nameTranslatedTxt+'">';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      
      $('#categoryFoodTypeLanguages').append(html);
    });
  });

  $("#btnAddCategoryFoodType, #btnUpdateCategoryFoodType").on('click', function() {
    var code = $('#AddCategoryFoodTypeFormCode').val();
    var name = $('#AddCategoryFoodTypeFormName').val();
    if (code == "" || name == '') {
      if (code == '') {
        $('.AddCategoryFoodTypeFormCode').addClass("form-control-danger");
        $('.danger-code').removeClass("d-none");

        setTimeout( () => { 
          $(".AddCategoryFoodTypeFormCode").removeClass("form-control-danger");
          $('.danger-code').addClass("d-none");
        }, 3000 );
      }
      if (name == '') {
        $('.AddCategoryFoodTypeFormName').addClass("form-control-danger");
        $('.danger-name').removeClass("d-none");

        setTimeout( () => { 
          $(".AddCategoryFoodTypeFormName").removeClass("form-control-danger");
          $('.danger-name').addClass("d-none");
        }, 3000 );
      }
    } else {
      var categoryFoodTypeNames = [];
      $('input[name^="categoryFoodTypeLanguageName"]').each(function() {
        var idNameLanguage = this.name.substr("categoryFoodTypeLanguageName".length);
        var idName=0; var idCategoryFoodType=0; var timestampName=0; var elemStateName=0;
        if (categoryFoodTypeSelectedData != null) {
          $.map(categoryFoodTypeSelectedData.names, function(nameData, nameDataKey) {
            if (nameData.idLanguage == idNameLanguage) { 
              idName=nameData.id;
              idCategoryFoodType=nameData.idCategoryFoodType;
              timestampName=nameData.timestamp;
              elemStateName=nameData.elemState;
            }
          });
        }  
        let categoryFoodTypeName = {
          "id": idName,
          "idCategoryFoodType": idCategoryFoodType,
          "idLanguage": idNameLanguage,
          "elemState": elemStateName,
          "timestamp": timestampName,
          "name": this.value
        }
        categoryFoodTypeNames.push(categoryFoodTypeName);
      });
      var id=0; var timestamp=0; var elemState=0;
      if (categoryFoodTypeSelectedData != null) {
        id=categoryFoodTypeSelectedData.id;
        timestamp=categoryFoodTypeSelectedData.timestamp;
        elemState=categoryFoodTypeSelectedData.elemState;
      }
      $.ajax({
        url : 'Controllers/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: {id,code,name,elemState,timestamp, "names":categoryFoodTypeNames},
        success : function(data) {
          if (data.ConfirmSave) {
            $('#sa-success-distrix').trigger('click');
            setTimeout(function() {window.location.href = "./codeTableCategoryFoodTypeList.php";}, 800);        
          } else {
            $('#sa-error-distrix').trigger('click');
            $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.Error.text+'</ul>');
          }
        },
        error : function(data) {
          $('#sa-error-distrix').trigger('click');
        }
      });
      $(".btnAddCategoryFoodType").attr("data-dismiss", "modal");
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
          setTimeout(function() {window.location.href = "./codeTableCategoryFoodTypeList.php";}, 800);
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
          setTimeout(function() {window.location.href = "./codeTableCategoryFoodTypeList.php";}, 800);
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

  function ListCategoryFoodType(elemState){
    const dataTableData = categoryFoodTypeTableData;
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
          const lpàp0/ = categoryFoodTypeTableLanguagesData;
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
                '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddCategoryFoodType" onclick="ViewCategoryFoodType(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"         onclick="DelCategoryFoodType(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"        onclick="RestCategoryFoodType(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                '     </div>'+
                '   </div>'+
                ' </td>'+
                '</tr>';
        categoryFoodTypeTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewCategoryFoodType(id){
  $.ajax({
    url : 'Controllers/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      categoryFoodTypeSelectedData = data.ViewCategoryFoodType;

      $(".add_title").addClass("d-none");
      $("#btnAddCategoryFoodType").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateCategoryFoodType").removeClass("d-none");
  
      $('.AddCategoryFoodTypeFormCode').val(data.ViewCategoryFoodType.code);
      $('.AddCategoryFoodTypeFormName').val(data.ViewCategoryFoodType.name);
      $('#categoryFoodTypeLanguages').html("");

      const languages = categoryFoodTypeTableLanguagesData;
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
        $.map(data.ViewCategoryFoodType.names, function(nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) { updateName=nameData.name; className = "form-control-success";}
        });
        html += '        <input class="form-control '+className+' AddCategoryFoodTypeFormLanguageName" type="text" name="categoryFoodTypeLanguageName'+language.id+'" value="'+updateName+'" placeholder="'+nameTranslatedTxt+'">';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        
        $('#categoryFoodTypeLanguages').append(html);
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelCategoryFoodType(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestCategoryFoodType(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

