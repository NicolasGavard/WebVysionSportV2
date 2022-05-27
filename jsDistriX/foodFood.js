$(".page_food_food_title").text(language.page_food_food_title);
$(".page_food_food_name").text(language.page_food_food_name);
$(".page_food_food_brand").text(language.page_food_food_brand);
$(".page_food_food_labels").text(language.page_food_food_labels);
$(".page_food_food_categories").text(language.page_food_food_categories);
$(".page_food_food_nutritionals").text(language.page_food_food_nutritionals);
$(".page_food_food_weight").text(language.page_food_food_weight);
$(".page_food_food_weight_type").text(language.page_food_food_weight_type);
$(".page_food_food_weights").text(language.page_food_food_weights);
$(".page_food_food_score_nutri").text(language.page_food_food_score_nutri);
$(".page_food_food_score_nova").text(language.page_food_food_score_nova);
$(".page_food_food_score_eco").text(language.page_food_food_score_eco);
$(".page_food_food_picture").text(language.page_food_food_picture);
$(".page_food_food_statut").text(language.page_food_food_statut);
$(".page_food_food_action").text(language.page_food_food_action);
$(".page_food_food_add_title").text(language.page_food_food_add_title);
$(".page_food_food_update_title").text(language.page_food_food_update_title);
$(".page_food_food_delete_title").text(language.page_food_food_delete_title);
$(".page_food_food_restore_title").text(language.page_food_food_restore_title);

$(".page_food_food_add_labels").text(language.page_food_food_add_labels);
$(".page_food_food_update_labels").text(language.page_food_food_update_labels);
$(".page_food_food_delete_labels").text(language.page_food_food_delete_labels);
$(".page_food_food_add_categories").text(language.page_food_food_add_categories);
$(".page_food_food_update_categories").text(language.page_food_food_update_categories);
$(".page_food_food_delete_categories").text(language.page_food_food_delete_categories);
$(".page_food_food_add_nutritionals").text(language.page_food_food_add_nutritionals);
$(".page_food_food_update_nutritionals").text(language.page_food_food_update_nutritionals);
$(".page_food_food_delete_nutritionals").text(language.page_food_food_delete_nutritionals);
$(".page_food_food_add_weight").text(language.page_food_food_add_weight);
$(".page_food_food_update_weight").text(language.page_food_food_update_weight);
$(".page_food_food_delete_weight").text(language.page_food_food_delete_weight);

$(".page_all_close").text(language.page_all_close);
$(".page_all_add").text(language.page_all_add);
$(".page_all_view").text(language.page_all_view);
$(".page_all_delete").text(language.page_all_delete);
$(".page_all_restore").text(language.page_all_restore);
$(".page_all_change_picture").text(language.page_all_change_picture);

showListFood(0, 0, 0, 0, 0);

$("#listBrandsFilter").on('change', function() {
  $('#InputFilterFoodByIdBrand').val(this.value);
  var idBrand       = $('#InputFilterFoodByIdBrand').val();
  var idScoreNutri  = $('#InputFilterFoodByIdScoreNutri').val();
  var idScoreNova   = $('#InputFilterFoodByIdScoreNova').val();
  var idScoreEco    = $('#InputFilterFoodByIdScoreEco').val();
  showListFood(idBrand, 0, idScoreNutri, idScoreNova, idScoreEco);
});
$("#listScoreNutriFilter").on('change', function() {
  $('#InputFilterFoodByIdScoreNutri').val(this.value);
  var idBrand       = $('#InputFilterFoodByIdBrand').val();
  var idScoreNutri  = $('#InputFilterFoodByIdScoreNutri').val();
  var idScoreNova   = $('#InputFilterFoodByIdScoreNova').val();
  var idScoreEco    = $('#InputFilterFoodByIdScoreEco').val();
  showListFood(idBrand, 0, idScoreNutri, idScoreNova, idScoreEco);
});
$("#listScoreNovaFilter").on('change', function() {
  $('#InputFilterFoodByIdScoreNova').val(this.value);
  var idBrand       = $('#InputFilterFoodByIdBrand').val();
  var idScoreNutri  = $('#InputFilterFoodByIdScoreNutri').val();
  var idScoreNova   = $('#InputFilterFoodByIdScoreNova').val();
  var idScoreEco    = $('#InputFilterFoodByIdScoreEco').val();
  showListFood(idBrand, 0, idScoreNutri, idScoreNova, idScoreEco);
});
$("#listScoreEcoFilter").on('change', function() {
  $('#InputFilterFoodByIdScoreEco').val(this.value);
  var idBrand       = $('#InputFilterFoodByIdBrand').val();
  var idScoreNutri  = $('#InputFilterFoodByIdScoreNutri').val();
  var idScoreNova   = $('#InputFilterFoodByIdScoreNova').val();
  var idScoreEco    = $('#InputFilterFoodByIdScoreEco').val();
  showListFood(idBrand, 0, idScoreNutri, idScoreNova, idScoreEco);
});

$(".AddNewFood").on('click', function() {
  $(".btnSave").html(language.page_food_food_add_title);
});

$("#btnAddFood").on('click', function() {
  var errorData   = "";
  var code        = $('#InputFoodCode').val();
  var description = $('#InputFoodName').val();
  if (code != "" || description != ""){
    $.ajax({
      url : 'Controllers/Food/Food/save.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddFood').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./foodFoodList.php";}, 2000);
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
  } 
  if (errorData !== ''){
    $('.alert-danger').show("slow").delay(5000).hide("slow");
    $('.alert-danger p').html(errorData);
  }
});

$("#btnAddWeightFood").on('click', function() {
  var errorData = "";
  var weight    = $('#InputWeightFoodWeight').val();
  if (weight != ""){
    $.ajax({
      url : 'Controllers/Food/Food/saveFoodWeight.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormAddWeightFood').serialize(),
      success : function(data) {
        if (data.confirmSave){
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./foodFoodList.php";}, 2000);
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
    errorData += ' - '+errorData_txt_weight+'<br/>'
  } 
  if (errorData !== ''){
    $('.alert-danger').show("slow").delay(5000).hide("slow");
    $('.alert-danger p').html(errorData);
  }
});

$("#btnDelFood").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/Food/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelFood').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodFoodList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnDelFoodWeight").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/Food/deleteFoodWeight.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDelFoodWeight').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodFoodList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

$("#btnRestFood").on('click', function() {
  $.ajax({
    url : 'Controllers/Food/Food/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRestFood').serialize(),
    success : function(data) {
      setTimeout(function() {window.location.href = "./foodFoodList.php";}, 200);
    },
    error : function(data) {
      errorData += ' - '+errorData_ko+'<br/>'
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});

function showListFood(idBrand, idLabel, idScoreNutri, idScoreNova, idScoreEco){
  $('#listBrandsFilter').empty();
  $('#listLabelsFilter').empty();
  $('#listScoreEcoFilter').empty();
  $('#listScoreNutriFilter').empty();
  $('#listScoreNovaFilter').empty();
  
  $('#listFoodsTbody').empty();
  
  $('#listBrandsFilter').append('<option value="0">Tous</option>');
  $('#listLabelsFilter').append('<option value="0">Tous</option>');
  $('#listScoreEcoFilter').append('<option value="0">Tous</option>');
  $('#listScoreNutriFilter').append('<option value="0">Tous</option>');
  $('#listScoreNovaFilter').append('<option value="0">Tous</option>');

  $.ajax({
    url : 'Controllers/Food/Food/list.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idBrand': idBrand, 'idLabel': idLabel, 'idScoreEco': idScoreEco, 'idScoreNutri': idScoreNutri, 'idScoreNova': idScoreNova },
    success : function(data) {
      $.map(data.ListBrands, function(val, key) {
        activeSelected = false;
        if (val.id === idBrand) {activeSelected = true;}
        $('#listBrandsFilter').append($('<option>', {
          value: val.id,
          text: val.name,
          selected: activeSelected
        }));
      });
  
      $.map(data.ListLabels, function(val, key) {
        activeSelected = "";
        if (val.id === idLabel) {activeSelected = "selected";}
        $('#listLabelsFilter').append($('<option>', {
          value: val.id,
          text: val.name,
          selected: activeSelected
        }));
      });
      
      var color = '';
      $.map(data.ListScoresEco, function(val, key) {
        activeSelected  = "";
        color           = val.color;
        if (val.id === idScoreEco) {activeSelected = "selected";}
        $('#listScoreEcoFilter').append('<option value="'+val.id+'" id="ScoresEco_'+val.id+'" '+activeSelected+'>'+val.letter+'</option>');
        $('#ScoresEco_'+val.id+'').html(val.letter);
        $('#ScoresEco_'+val.id+'').attr('style', 'background-color: '+color+'; color: #fff;');
      });
      
      var color = '';
      $.map(data.ListScoresNutri, function(val, key) {
        activeSelected  = "";
        color           = val.color;
        if (val.id === idScoreNutri) {activeSelected = "selected";}
        $('#listScoreNutriFilter').append('<option value="'+val.id+'" id="ScoresNutri_'+val.id+'" '+activeSelected+'>'+val.letter+'</option>');
        $('#ScoresNutri_'+val.id+'').html(val.letter);
        $('#ScoresNutri_'+val.id+'').attr('style', 'background-color:'+color+'; color: #fff;');
      });
      
      var color = '';
      $.map(data.ListScoresNova, function(val, key) {
        activeSelected  = "";
        color           = val.color;
        if (val.id === idScoreNova) {activeSelected = "selected";}
        $('#listScoreNovaFilter').append('<option value="'+val.id+'" id="ScoresNova_'+val.id+'" '+activeSelected+'>'+val.number+'</option>');
        $('#ScoresNova_'+val.id+'').html(val.number);
        $('#ScoresNova_'+val.id+'').attr('style', 'background-color:'+color+'; color: #fff;');
      });
      
      $.map(data.ListFoods, function(val, key) {
        if(val.statut == 1) {progressBarColor = 'danger';   actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.statut == 0) {progressBarColor = 'success';  actionBtnDelete = '';       actionBtnRestore = 'd-none';}
        
        var weights = '';
        $.map(val.foodWeights, function(valWeights, key) {
          weights += '<button type="button" class="btn btn-danger btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalDelFoodWeight" style="margin-bottom: 2px; margin-left: 2px" onclick="DelFoodWeight(\''+valWeights.id+'\', \''+val.name +' '+ valWeights.weight +' '+ valWeights.nameWeightType +'\');"><i class="ti-trash"></i></button>';
          weights += '<button type="button" class="btn btn-primary btn-icon-text AddNewFoodWeight" data-bs-toggle="modal" data-bs-target="#modalAddWeightFood" style="margin-bottom: 2px; margin-left: 2px" onclick="ViewFoodWeight(\''+valWeights.id+'\', \''+valWeights.idFood+'\', \''+valWeights.idWeightType+'\', \''+valWeights.weight+'\', \''+valWeights.linkToPicture+'\');"><i class="ti-eye"></i></button>';
          weights += ' <img style="width:auto; border-radius:10%;" src="'+valWeights.linkToPicture+'"/> '+valWeights.weight+' '+valWeights.nameWeightType;
          weights += '</br>';
        });
        weights += '<button type="button" class="btn btn-primary btn-icon-text AddNewFoodWeight" data-bs-toggle="modal" data-bs-target="#modalAddWeightFood" style="margin-bottom: 2px; margin-left: 2px" onclick="ViewFoodWeight(0, \''+val.id+'\', 0, 0, 0);"><i class="menu-icon mdi mdi-plus"></i><span class="page_food_food_add_weight"></span></button>';
        
        var labels = '';
        $.map(val.foodLabels, function(valLabels, key) {
          labels += '<button type="button" class="btn btn-danger btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalDelFoodLabel" style="margin-bottom: 2px; margin-left: 2px"><i class="ti-trash"></i><span class="page_food_food_add_title"></span></button>';
          labels += ' <img style="width:auto; border-radius:10%;" src="'+valLabels.linkToPicture+'"/> '+valLabels.name+' ';
          labels += '</br>';
        });
        labels += '<button type="button" class="btn btn-primary btn-icon-text AddNewFoodLabel" data-bs-toggle="modal" data-bs-target="#modalAddFoodLabel" style="margin-bottom: 2px; margin-left: 2px"><i class="menu-icon mdi mdi-plus"></i><span class="page_food_food_add_labels"></span></button>';
        
        var nutritionals = '';
        $.map(val.foodNutritionals, function(valNutritional, key) {
          nutritionals += '<button type="button" class="btn btn-danger btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddFood" style="margin-bottom: 2px; margin-left: 2px"><i class="ti-trash"></i><span class="page_food_food_add_title"></span></button>';
          nutritionals += '<button type="button" class="btn btn-primary btn-icon-text AddNewFoodNUtritional" data-bs-toggle="modal" data-bs-target="#modalAddFood" style="margin-bottom: 2px; margin-left: 2px"><i class="ti-eye"></i><span class="page_food_food_add_title"></span></button>';
          nutritionals += ' <u>'+valNutritional.nameNutritional+'</u> : '+valNutritional.nutritional+' '+valNutritional.nameWeightType;
          nutritionals += '</br>';
        });
        nutritionals += '<button type="button" class="btn btn-primary btn-icon-text AddNewFoodNutritional" data-bs-toggle="modal" data-bs-target="#modalAddFood" style="margin-bottom: 2px; margin-left: 2px"><i class="menu-icon mdi mdi-plus"></i><span class="page_food_food_add_nutritionals"></span></button>';
  
        $('#listFoodsTbody').append(
          '<tr>'+
          ' <td>'+val.name+'</td>'+
          ' <td><img style="width:45px; border-radius:10%;" src="'+val.pictureBrand+'"/> '+val.nameBrand+'</td>'+
          ' <td><img style="width:75px; border-radius:10%;" src="'+val.pictureScoreNutri+'"/></td>'+
          ' <td><img style="width:30px; border-radius:10%;" src="'+val.pictureScoreNova+'"/></td>'+
          ' <td><img style="width:75px; border-radius:10%;" src="'+val.pictureScoreEco+'"/></td>'+
          ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-'+progressBarColor+'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
          ' <td>'+
          '   <button type="button" title="Info"      class="btn btn-info  btn-rounded btn-icon"                                                                                              onclick="ViewDetailFood(\''+val.id+'\');"><i class="btnInfoFood ti-arrow-down"></i></button>'+
          '   <button type="button" title="Voir"      class="btn btn-primary  btn-rounded btn-icon btnViewFood"                       data-bs-toggle="modal" data-bs-target="#modalAddFood"   onclick="ViewFood(\''+val.id+'\');"><i class="ti-eye"></i></button>'+
          '   <button type="button" title="Supprimer" class="btn btn-danger   btn-rounded btn-icon btnDeleFood '+actionBtnDelete+'"   data-bs-toggle="modal" data-bs-target="#modalDelFood"   onclick="DelFood(\''+val.id+'\', \''+val.name+'\');"><i class="ti-trash"></i></button>'+
          '   <button type="button" title="Restorer " class="btn btn-warning  btn-rounded btn-icon btnRestFood '+actionBtnRestore+'"  data-bs-toggle="modal" data-bs-target="#modalRestFood"  onclick="RestFood(\''+val.id+'\', \''+val.name+'\');"><i class="ti-share-alt"></i></button>'+
          ' </td>'+
          '</tr>'+
          
          '<tr id="foodInfo_'+val.id+'">'+
          '  <td colspan="7">'+
          '    <div class="row">'+
          '      <div class="col-md-4">'+
          '        <p class="page_food_food_weights"></p>'+
          '        <p id="foodWeights">'+weights+'</p>'+
          '      </div>'+
          '      <div class="col-md-3">'+
          '        <p class="page_food_food_labels"></p>'+
          '        <p id="foodLabels">'+labels+'</p>'+
          '      </div>'+
          '      <div class="col-md-5">'+
          '        <p class="page_food_food_nutritionals"></p>'+
          '        <p id="foodNutritionals">'+nutritionals+'</p>'+
          '      </div>'+
          '    </div>'+
          '  </td>'+
          '</tr>'
        );
        $("#foodInfo_"+val.id+"").hide();
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function ViewDetailFood(id){
  if ($("#foodInfo_"+id+"").is(":visible")) {
    $("#foodInfo_"+id+"").hide(100);
    $(".btnInfoFood").removeClass("ti-arrow-up");
    $(".btnInfoFood").addClass("ti-arrow-down");
  } else {
    $("#foodInfo_"+id+"").show(800);
    $(".btnInfoFood").removeClass("ti-arrow-down");
    $(".btnInfoFood").addClass("ti-arrow-up");
  }
}

function ViewFood(id){
  $.ajax({
    url : 'Controllers/Food/Food/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".btnSave").html(language.page_food_food_update_title);
      
      $('.AddFoodFormIdFood').val(id);
      $('.AddFoodFormCode').val(data.ViewFood.name);
      $('.AddFoodFormName').val(data.ViewFood.description);
      $('.AddFoodFormColor').val(data.ViewFood.color);
      $(".InfoFoodPicture").attr("src", data.ViewFood.linkToPicture);
      $('.AddFoodFormTimestamp').val(data.ViewFood.timestamp);
      $('.AddFoodFormStatut').val(data.ViewFood.statut);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function ViewFoodWeight(id, idFood, idWeightType, weight, linkToPicture){
  $('#InputWeightFoodWeightType').empty();

  $.ajax({
    url : 'Controllers/CodeTables/WeightType/list.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {
      $.map(data.ListWeightType, function(val, key) {
        activeSelected = false;
        if(idWeightType == val.id){
          activeSelected = true;
        }
        $('#InputWeightFoodWeightType').append($('<option>', {
          value: val.id,
          text: val.name +'('+val.abbreviation+')',
          selected: activeSelected
        }));
      });
    },
    error : function(data) {
      console.log(data);
    }
  }); 
  
  $('.AddWeightFoodFormId').val(id);
  $('.AddWeightFoodFormIdFood').val(idFood);
  if (id > 0){
    $(".btnSave").html(language.page_food_food_update_weight);
    $('.AddWeightFoodFormIdWeightType').val(idWeightType);
    $('.AddWeightFoodFormWeight').val(weight);
    $(".InfoFoodPicture").attr("src", linkToPicture);
  }
}

function DelFoodWeight(id, name){
  $('.DelFoodWeightFormIdFoodWeight').val(id);
  $('.DelFoodWeightTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function DelFoodLabel(id, name){
  $('.DelFoodLabelFormIdFood').val(id);
  $('.DelFoodLabelTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function ViewFoodNutritional(id, idFood, idWeightType, weight, linkToPicture){
  $(".btnSave").html(language.page_food_food_update_weight);
  $('.AddWeightFoodFormId').val(id);
  $('.AddWeightFoodFormIdFood').val(idFood);
  $('.AddWeightFoodFormIdWeightType').val(idWeightType);
  $('.AddWeightFoodFormWeight').val(weight);
  $(".InfoFoodPicture").attr("src", linkToPicture);
}

function DelFoodNutritional(id, name){
  $('.DelFoodNutritionalFormIdFood').val(id);
  $('.DelFoodNutritionalTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function DelFood(id, name){
  $('.DelFoodFormIdFood').val(id);
  $('.DelFoodTxt').html(confirm_delete+' <b>'+name+'</b>');
}

function RestFood(id, name){
  $('.RestFoodFormIdFood').val(id);
  $('.RestFoodTxt').html(confirm_restore+' <b>'+name+'</b>');
}