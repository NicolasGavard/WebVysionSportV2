$.ajax({
  url : '../../Controllers/CodeTables/FoodType/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    var idLanguage = 1;
    $.map(data.ListFoodTypes, function(val, key) {
      idLanguage = val.idLanguage;
      if (val.elemState == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if (val.elemState == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      $('#listFoodTypesTbody').append(
        '<tr>'+
        ' <td>'+val.code+'</td>'+
        ' <td>'+val.name+'</td>'+
        ' <td>'+val.nbLanguages+'/'+val.nbLanguagesTotal+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewFoodType"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddFoodType"      onclick="ViewFoodType(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleFoodType '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelFoodType"      onclick="DelFoodType(\''+val.id+'\', \''+val.name+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restaurer " class="btn btn-info       btn-rounded btn-icon btnRestFoodType '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestFoodType"     onclick="RestFoodType(\''+val.id+'\', \''+val.name+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });

    $('.AddFoodTypeFormLanguage').append("");
    $.map(data.ListLanguages, function(val, key) {
      var  activeSelected = false;
      if (val.id == idLanguage) {
        activeSelected = true;
      }
      
      $('.AddFoodTypeFormLanguage').append($('<option>', {
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

$(".AddNewFoodType").on('click', function() {
  $(".btnSave").html(language.page_codeTables_food_category_add_title);
});

$("#btnAddFoodType").on('click', function() {
  var errorData     = "";
  var code          = $('#InputFoodTypeCode').val();
  var description   = $('#InputFoodTypeName').val();
  var abbreviation  = $('#InputFoodTypeAbbreviation').val();
  if (code != "" || description != "" || abbreviation != ""){
    $.ajax({
      url : '../../Controllers/CodeTables/FoodType/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddFoodType').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./codeTableFoodTypeList.php";}, 2000);
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

$("#btnDelFoodType").on('click', function() {
  $.ajax({
    url : '../../Controllers/CodeTables/FoodType/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelFoodType').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableFoodTypeList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestFoodType").on('click', function() {
  $.ajax({
    url : '../../Controllers/CodeTables/FoodType/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestFoodType').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableFoodTypeList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewFoodType(id, idCategory,idLanguage){
  $('.AddFoodTypeFormLanguage').append('');
  
  $.ajax({
    url : '../../Controllers/CodeTables/FoodType/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id, 'idCategory': idCategory},
    success : function(data) {
      $(".btnSave").html(language.page_codeTables_food_category_update_title);
      
      $('.AddFoodTypeFormIdFoodType').val(id);
      $('.AddFoodTypeFormIdFoodTypeName').val(idCategory);
      
      $('.AddFoodTypeFormCode').val(data.ViewFoodType.code);
      $('.AddFoodTypeFormName').val(data.ViewFoodType.name);
      $('.AddFoodTypeFormDescription').val(data.ViewFoodType.description);
      $('.AddFoodTypeFormAbbreviation').val(data.ViewFoodType.abbreviation);
      
      $('.AddFoodTypeFormIsSolid').prop('checked', false);
      $('.AddFoodTypeFormIsLiquid').prop('checked', false);
      $('.AddFoodTypeFormIsOther').prop('checked', false);

      if (data.ViewFoodType.isSolid == 1) {$('.AddFoodTypeFormIsSolid').prop('checked', true);}
      if (data.ViewFoodType.isLiquid == 1){$('.AddFoodTypeFormIsLiquid').prop('checked', true);}
      if (data.ViewFoodType.isOther == 1) {$('.AddFoodTypeFormIsOther').prop('checked', true);}

      $('.AddFoodTypeFormTimestamp').val(data.ViewFoodType.timestamp);
      $('.AddFoodTypeFormStatut').val(data.ViewFoodType.elemState);

      $.map(data.ListLanguages, function(val, key) {
        var  activeSelected = false;
        if (val.id == idLanguage) {
          activeSelected = true;
        }
        
        $('.AddFoodTypeFormLanguage').append($('<option>', {
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
}

function DelFoodType(id, name){
  $('.DelFoodTypeFormIdFoodType').val(id);
  $('.DelFoodTypeTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestFoodType(id, name){
  $('.RestFoodTypeFormIdFoodType').val(id);
  $('.RestFoodTypeTxt').html(confirm_restore+' <b>'+name+'</b>');
}