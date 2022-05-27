
$.ajax({
  url : 'Controllers/CodeTables/Nutritional/list.php',
  type : 'POST',
  dataType : 'JSON',
  success : function(data) {
    var idLanguage = 1;
    $.map(data.ListNutritional, function(val, key) {
      idLanguage = val.idLanguage;
      if (val.elemState == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
      if (val.elemState == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
      
      $('#listNutritionalsTbody').append(
        '<tr>'+
        ' <td>'+val.code+'</td>'+
        ' <td>'+val.name+'</td>'+
        ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
        ' <td>'+
        '   <button type="button" title="Voir"      class="btn btn-primary    btn-rounded btn-icon btnViewNutritional"                       data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalAddNutritional"      onclick="ViewNutritional(\''+val.id+'\', \''+val.idNutritional+'\', \''+val.idLanguage+'\');"><i class="ti-eye"></i></button>'+
        '   <button type="button" title="Supprimer" class="btn btn-danger     btn-rounded btn-icon btnDeleNutritional '+actionBtnDelete+'"   data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalDelNutritional"      onclick="DelNutritional(\''+val.id+'\', \''+val.name+'\');"><i class="ti-trash"></i></button>'+
        '   <button type="button" title="Restorer " class="btn btn-info       btn-rounded btn-icon btnRestNutritional '+actionBtnRestore+'"  data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#modalRestNutritional"     onclick="RestNutritional(\''+val.id+'\', \''+val.name+'\');"><i class="ti-share-alt"></i></button>'+
        ' </td>'+
        '</tr>')
    });

    $('.AddNutritionalFormLanguage').append("");
    $.map(data.ListLanguages, function(val, key) {
      var  activeSelected = false;
      if (val.id == idLanguage) {
        activeSelected = true;
      }
      
      $('.AddNutritionalFormLanguage').append($('<option>', {
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

$(".AddNewNutritional").on('click', function() {
  $(".btnSave").html(language.page_codeTables_nutritional_add_title);
});

$("#btnAddNutritional").on('click', function() {
  var errorData     = "";
  var code          = $('#InputNutritionalCode').val();
  var description   = $('#InputNutritionalName').val();
  var abbreviation  = $('#InputNutritionalAbbreviation').val();
  if (code != "" || description != "" || abbreviation != ""){
    $.ajax({
      url : 'Controllers/CodeTables/Nutritional/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddNutritional').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./codeTableNutritionalList.php";}, 2000);
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

$("#btnDelNutritional").on('click', function() {
  $.ajax({
    url : 'Controllers/CodeTables/Nutritional/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelNutritional').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableNutritionalList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestNutritional").on('click', function() {
  $.ajax({
    url : 'Controllers/CodeTables/Nutritional/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestNutritional').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./codeTableNutritionalList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function ViewNutritional(id, idNutritional,idLanguage){
  $('.AddNutritionalFormLanguage').append('');
  
  $.ajax({
    url : 'Controllers/CodeTables/Nutritional/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id, 'idNutritional': idNutritional},
    success : function(data) {
      $(".btnSave").html(language.page_codeTables_nutritional_update_title);
      
      $('.AddNutritionalFormIdNutritional').val(id);
      $('.AddNutritionalFormIdNutritionalName').val(idNutritional);
      
      $('.AddNutritionalFormCode').val(data.ViewNutritional.code);
      $('.AddNutritionalFormName').val(data.ViewNutritional.name);
      $('.AddNutritionalFormDescription').val(data.ViewNutritional.description);
      $('.AddNutritionalFormAbbreviation').val(data.ViewNutritional.abbreviation);
      
      $('.AddNutritionalFormIsSolid').prop('checked', false);
      $('.AddNutritionalFormIsLiquid').prop('checked', false);
      $('.AddNutritionalFormIsOther').prop('checked', false);

      if (data.ViewNutritional.isSolid == 1) {$('.AddNutritionalFormIsSolid').prop('checked', true);}
      if (data.ViewNutritional.isLiquid == 1){$('.AddNutritionalFormIsLiquid').prop('checked', true);}
      if (data.ViewNutritional.isOther == 1) {$('.AddNutritionalFormIsOther').prop('checked', true);}

      $('.AddNutritionalFormTimestamp').val(data.ViewNutritional.timestamp);
      $('.AddNutritionalFormStatut').val(data.ViewNutritional.elemState);

      $.map(data.ListLanguages, function(val, key) {
        var  activeSelected = false;
        if (val.id == idLanguage) {
          activeSelected = true;
        }
        
        $('.AddNutritionalFormLanguage').append($('<option>', {
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

function DelNutritional(id, name){
  $('.DelNutritionalFormIdNutritional').val(id);
  $('.DelNutritionalTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestNutritional(id, name){
  $('.RestNutritionalFormIdNutritional').val(id);
  $('.RestNutritionalTxt').html(confirm_restore+' <b>'+name+'</b>');
}