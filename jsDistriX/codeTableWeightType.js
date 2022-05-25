
$.ajax({
  url : 'Controllers/CodeTables/WeightType/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    var idLanguage = 1;
    $.map(data.ListWeightType, function(val, key) {
      idLanguage = val.idLanguage;
      
      if (val.status == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if (val.status == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      var weightTypeType  = '<i class="menu-icon mdi mdi-weight"></i> '+language.page_codeTables_weight_type_solid_title;
      if (val.isSolid == 1)  {weightTypeType  = '<i class="menu-icon mdi mdi-weight"></i> '+language.page_codeTables_weight_type_solid_title;}
      if (val.isLiquid == 1) {weightTypeType  = '<i class="menu-icon mdi mdi-water"></i> '+language.page_codeTables_weight_type_liquid_title;}
      if (val.isOther == 1)  {weightTypeType  = '<i class="menu-icon mdi mdi-food-fork-drink"></i> '+language.page_codeTables_weight_type_other_title;}

      $('#listWeightTypesTbody').append(
        '<tr>'+
        ' <td>'+val.code+'</td>'+
        ' <td>'+val.abbreviation+'</td>'+
        ' <td>'+weightTypeType+'</td>'+
        ' <td>'+val.name+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewWeightType"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddWeightType"      onclick="ViewWeightType(\''+val.id+'\', \''+val.idWeightType+'\', \''+val.idLanguage+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleWeightType '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelWeightType"      onclick="DelWeightType(\''+val.id+'\', \''+val.name+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restorer " class="btn btn-info       btn-rounded btn-icon btnRestWeightType '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestWeightType"     onclick="RestWeightType(\''+val.id+'\', \''+val.name+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });

    $('.AddWeightTypeFormLanguage').append("");
    $.map(data.ListLanguages, function(val, key) {
      var  activeSelected = false;
      if (val.id == idLanguage) {
        activeSelected = true;
      }
      
      $('.AddWeightTypeFormLanguage').append($('<option>', {
        value: val.id,
        text: val.code+' - '+val.description,
        selected: activeSelected
      }));
    });
  },
  error : function(data) {
    console.log(data);
  }
}); 

$(".AddNewWeightType").on('click', function() {
  $(".btnSave").html(language.page_codeTables_weight_type_add_title);
});

$("#btnAddWeightType").on('click', function() {
  var errorData     = "";
  var code          = $('#InputWeightTypeCode').val();
  var description   = $('#InputWeightTypeName').val();
  var abbreviation  = $('#InputWeightTypeAbbreviation').val();
  if (code != "" || description != "" || abbreviation != ""){
    $.ajax({
      url : 'Controllers/CodeTables/WeightType/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddWeightType').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./codeTableWeightTypeList.php";}, 2000);
        } else {
          errorData += ' - '+errorData_ko+'<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(errorData);
        }
      },
      error : function(data) {
        errorData += ' - '+errorData_ko+'<br/>'
        $('.alert-danger').show("slow").delay(5000).hide("slow");
        $('.alert-danger p').html(errorData);
      }
    });
  } else {
    if (code == ""){
      errorData += ' - '+errorData_txt_code+'<br/>'
    } 
    if (description == ''){
      errorData += ' - '+errorData_txt_description+'<br/>'
    }
    if (abbreviation == ''){
      errorData += ' - '+errorData_txt_abbreviation+'<br/>'
    }
  } 
  if (errorData !== ''){
    $('.alert-danger').show("slow").delay(5000).hide("slow");
    $('.alert-danger p').html(errorData);
  }
});

$("#btnDelWeightType").on('click', function() {
  $.ajax({
    url : 'Controllers/CodeTables/WeightType/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelWeightType').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableWeightTypeList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestWeightType").on('click', function() {
  $.ajax({
    url : 'Controllers/CodeTables/WeightType/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestWeightType').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableWeightTypeList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewWeightType(id, idWeightType,idLanguage){
  $('.AddWeightTypeFormLanguage').append('');
  
  $.ajax({
    url : 'Controllers/CodeTables/WeightType/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id, 'idWeightType': idWeightType},
    success : function(data) {
      $(".btnSave").html(language.page_codeTables_weight_type_update_title);
      
      $('.AddWeightTypeFormIdWeightType').val(id);
      $('.AddWeightTypeFormIdWeightTypeName').val(idWeightType);
      
      $('.AddWeightTypeFormCode').val(data.ViewWeightType.code);
      $('.AddWeightTypeFormName').val(data.ViewWeightType.name);
      $('.AddWeightTypeFormDescription').val(data.ViewWeightType.description);
      $('.AddWeightTypeFormAbbreviation').val(data.ViewWeightType.abbreviation);
      
      $('.AddWeightTypeFormIsSolid').prop('checked', false);
      $('.AddWeightTypeFormIsLiquid').prop('checked', false);
      $('.AddWeightTypeFormIsOther').prop('checked', false);

      if (data.ViewWeightType.isSolid == 1) {$('.AddWeightTypeFormIsSolid').prop('checked', true);}
      if (data.ViewWeightType.isLiquid == 1){$('.AddWeightTypeFormIsLiquid').prop('checked', true);}
      if (data.ViewWeightType.isOther == 1) {$('.AddWeightTypeFormIsOther').prop('checked', true);}

      $('.AddWeightTypeFormTimestamp').val(data.ViewWeightType.timestamp);
      $('.AddWeightTypeFormStatut').val(data.ViewWeightType.status);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelWeightType(id, name){
  $('.DelWeightTypeFormIdWeightType').val(id);
  $('.DelWeightTypeTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestWeightType(id, name){
  $('.RestWeightTypeFormIdWeightType').val(id);
  $('.RestWeightTypeTxt').html(confirm_restore+' <b>'+name+'</b>');
}