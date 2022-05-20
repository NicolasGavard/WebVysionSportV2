$(".page_codeTables_food_category_title").text(language.page_codeTables_food_category_title);
$(".page_codeTables_food_category_code").text(language.page_codeTables_food_category_code);
$(".page_codeTables_food_category_name").text(language.page_codeTables_food_category_name);
$(".page_codeTables_food_category_abbreviation").text(language.page_codeTables_food_category_abbreviation);
$(".page_codeTables_food_category_language").text(language.page_codeTables_food_category_language);
$(".page_codeTables_food_category_description").text(language.page_codeTables_food_category_description);
$(".page_codeTables_food_category_type").text(language.page_codeTables_food_category_type);
$(".page_codeTables_food_category_status").text(language.page_codeTables_food_category_status);
$(".page_codeTables_food_category_action").text(language.page_codeTables_food_category_action);
$(".page_codeTables_food_category_add_title").text(language.page_codeTables_food_category_add_title);
$(".page_codeTables_food_category_update_title").text(language.page_codeTables_food_category_update_title);
$(".page_codeTables_food_category_delete_title").text(language.page_codeTables_food_category_delete_title);
$(".page_codeTables_food_category_restore_title").text(language.page_codeTables_food_category_restore_title);
$(".page_codeTables_food_category_solid_title").text(language.page_codeTables_food_category_solid_title);
$(".page_codeTables_food_category_liquid_title").text(language.page_codeTables_food_category_liquid_title);
$(".page_codeTables_food_category_other_title").text(language.page_codeTables_food_category_other_title);

$(".AddFoodCategoryFormCode").attr("placeholder", language.page_codeTables_food_category_code);
$(".AddFoodCategoryFormName").attr("placeholder", language.page_codeTables_food_category_name);
$(".AddFoodCategoryFormDescription").attr("placeholder", language.page_codeTables_food_category_description);
$(".AddFoodCategoryFormAbbreviation").attr("placeholder", language.page_codeTables_food_category_abbreviation);

$(".page_all_close").text(language.page_all_close);
$(".page_all_add").text(language.page_all_add);
$(".page_all_view").text(language.page_all_view);
$(".page_all_delete").text(language.page_all_delete);
$(".page_all_restore").text(language.page_all_restore);

$.ajax({
  url : 'Controllers/CodeTables/FoodCategory/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    var idLanguage = 1;
    $.map(data.ListFoodCategory, function(val, key) {
      idLanguage = val.idLanguage;
      if (val.status == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if (val.status == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      $('#listFoodCategorysTbody').append(
        '<tr>'+
        ' <td>'+val.code+'</td>'+
        ' <td>'+val.name+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewFoodCategory"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddFoodCategory"      onclick="ViewFoodCategory(\''+val.id+'\', \''+val.idCategory+'\', \''+val.idLanguage+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleFoodCategory '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelFoodCategory"      onclick="DelFoodCategory(\''+val.id+'\', \''+val.name+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restorer " class="btn btn-info       btn-rounded btn-icon btnRestFoodCategory '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestFoodCategory"     onclick="RestFoodCategory(\''+val.id+'\', \''+val.name+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });

    $('.AddFoodCategoryFormLanguage').append("");
    $.map(data.ListLanguages, function(val, key) {
      var  activeSelected = false;
      if (val.id == idLanguage) {
        activeSelected = true;
      }
      
      $('.AddFoodCategoryFormLanguage').append($('<option>', {
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

$(".AddNewFoodCategory").on('click', function() {
  $(".btnSave").html(language.page_codeTables_food_category_add_title);
});

$("#btnAddFoodCategory").on('click', function() {
  var errorData     = "";
  var code          = $('#InputFoodCategoryCode').val();
  var description   = $('#InputFoodCategoryName').val();
  var abbreviation  = $('#InputFoodCategoryAbbreviation').val();
  if (code != "" || description != "" || abbreviation != ""){
    $.ajax({
      url : 'Controllers/CodeTables/FoodCategory/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddFoodCategory').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./codeTableFoodCategoryList.php";}, 2000);
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

$("#btnDelFoodCategory").on('click', function() {
  $.ajax({
    url : 'Controllers/CodeTables/FoodCategory/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelFoodCategory').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableFoodCategoryList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestFoodCategory").on('click', function() {
  $.ajax({
    url : 'Controllers/CodeTables/FoodCategory/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestFoodCategory').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableFoodCategoryList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewFoodCategory(id, idCategory,idLanguage){
  $('.AddFoodCategoryFormLanguage').append('');
  
  $.ajax({
    url : 'Controllers/CodeTables/FoodCategory/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id, 'idCategory': idCategory},
    success : function(data) {
      $(".btnSave").html(language.page_codeTables_food_category_update_title);
      
      $('.AddFoodCategoryFormIdFoodCategory').val(id);
      $('.AddFoodCategoryFormIdFoodCategoryName').val(idCategory);
      
      $('.AddFoodCategoryFormCode').val(data.ViewFoodCategory.code);
      $('.AddFoodCategoryFormName').val(data.ViewFoodCategory.name);
      $('.AddFoodCategoryFormDescription').val(data.ViewFoodCategory.description);
      $('.AddFoodCategoryFormAbbreviation').val(data.ViewFoodCategory.abbreviation);
      
      $('.AddFoodCategoryFormIsSolid').prop('checked', false);
      $('.AddFoodCategoryFormIsLiquid').prop('checked', false);
      $('.AddFoodCategoryFormIsOther').prop('checked', false);

      if (data.ViewFoodCategory.isSolid == 1) {$('.AddFoodCategoryFormIsSolid').prop('checked', true);}
      if (data.ViewFoodCategory.isLiquid == 1){$('.AddFoodCategoryFormIsLiquid').prop('checked', true);}
      if (data.ViewFoodCategory.isOther == 1) {$('.AddFoodCategoryFormIsOther').prop('checked', true);}

      $('.AddFoodCategoryFormTimestamp').val(data.ViewFoodCategory.timestamp);
      $('.AddFoodCategoryFormStatut').val(data.ViewFoodCategory.status);

      $.map(data.ListLanguages, function(val, key) {
        var  activeSelected = false;
        if (val.id == idLanguage) {
          activeSelected = true;
        }
        
        $('.AddFoodCategoryFormLanguage').append($('<option>', {
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

function DelFoodCategory(id, name){
  $('.DelFoodCategoryFormIdFoodCategory').val(id);
  $('.DelFoodCategoryTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestFoodCategory(id, name){
  $('.RestFoodCategoryFormIdFoodCategory').val(id);
  $('.RestFoodCategoryTxt').html(confirm_restore+' <b>'+name+'</b>');
}