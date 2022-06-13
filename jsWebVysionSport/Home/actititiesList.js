$( "#dateStart" ).datepicker({
  altField: "#dateStart",
  closeText: 'Fermer',
  prevText: 'Précédent',
  nextText: 'Suivant',
  currentText: 'Aujourd\'hui',
  monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
  monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
  dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
  dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
  dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
  weekHeader: 'Sem.',
  dateFormat: 'dd/mm/yyyy'
});

$.ajax({
  url : '../../Controllers/Ticket/Ticket/list.php',
  type : 'POST',
  dataType : 'JSON',
  data: {'idUser': localStorage.getItem("idUser")},
  success : function(data) {
    $.map(data.ListTickets, function(val, key) {
      var date    = String(val.date);
      var year    = date.substr(0, 4);
      var month   = date.substr(4, 2);
      var day     = date.substr(6, 2);
      var dateFr  = day+'/'+month+'/'+year;
      
      var time    = String(val.time);
      var hour    = time.substr(0, 2);
      var minuts  = time.substr(2, 2);
      if (hour > 10) {
        var hour    = time.substr(0, 1);
        var minuts  = time.substr(1, 2);
      }
      var timeFr  = hour+':'+minuts;
      
      var $titleTicket    = "";
      if (val.idUserCreate == val.idUserAssign){
        $titleTicket = 'Créé et assigné par '+val.firstNameUserCreate+' '+val.nameUserCreate;
      } else {
        $titleTicket = 'Créé par '+val.firstNameUserCreate+' '+val.nameUserCreate+' et assigné par '+val.firstNameUserAssign+' '+val.nameUserAssign;
      }

      if (val.elemState == 0) {
        $('#SeeActivitiesOpened').append( '<li>'+
                                          '  <div class="row">'+
                                          '    <div class="col-md-2 col-sm-2">'+
                                          '      <button type="button" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"> '+val.nameTicketType+'</button>'+
                                          '      <button type="button" class="btn btn-primary"><i class="dw dw-search"></i></button>'+
                                          '      <button type="button" class="btn btn-info"><i class="dw dw-chat"></i></button>'+
                                          '    </div>'+
                                          '    <div class="col-md-10 col-sm-10">'+
                                          '      <div class="task-type">'+val.title+'</div>'+
                                          '      '+val.descMessage+''+
                                          '      <div class="task-assign">'+$titleTicket+' <div class="due-date"><span>'+dateFr+' - '+timeFr+'</span></div>'+
                                          '    </div>'+
                                          '  </div>'+
                                          '</li>');
      } else if (val.elemState == 1) {
        $('#SeeActivitiesClosed').append( '<li>'+
                                          '  <div class="row">'+
                                          '    <div class="col-md-2 col-sm-2">'+
                                          '      <button type="button" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"> '+val.nameTicketType+'</button>'+
                                          '      <button type="button" class="btn btn-primary"><i class="dw dw-search"></i></button>'+
                                          '      <button type="button" class="btn btn-info"><i class="dw dw-chat"></i></button>'+
                                          '    </div>'+
                                          '    <div class="col-md-10 col-sm-10">'+
                                          '      <div class="task-type">'+val.title+'</div>'+
                                          '      '+val.descMessage+''+
                                          '      <div class="task-assign">'+$titleTicket+' <div class="due-date"><span>'+dateFr+' - '+timeFr+'</span></div>'+
                                          '    </div>'+
                                          '  </div>'+
                                          '</li>');
      }
    });
  },
  error : function(data) {
    console.log(data);
  }
});

$(".AddNewTicket").on('click', function() {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $('.AddTicketFormIdTicket').val(0);
  $('.AddTicketFormCode').val('');
  $('.AddTicketFormName').val('');
  $(".avatar-brand").attr("src", '');
  $('.AddTicketFormTimestamp').val(0);
  $('.AddTicketFormStatut').val(0);
});

$(".btnAddTicket").on('click', function() {
  $(".page_food_brand_update_title").removeClass("d-none");
  $('.AddMyCurrentsDietsFormIdUserCoatch').val(localStorage.getItem("idUser"));
  
  var template        = $('.listMyTemplates').val();
  var student         = $('.listStudents').val();
  var dateStart       = $('.dateStart').val();
  var dateStartSplit  = $(".dateStart").val().split("/")
  // var dateStartDb     = dateStartSplit[2]+''+dateStartSplit[1]+''+dateStartSplit[0];

  if (template != 0 && student != 0 && dateStart != '' ){
    $.ajax({
      url : '../../Controllers/Nutrition/MyCurrentsDiets/save.php',
      type : 'POST',
      dataType : 'JSON',
      // data: $.param(data),
      data: $('#FormAddTicket').serialize(),
      success : function(data) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsList.php";}, 800);
      },
      error : function(data) {
        $('#sa-error-distrix').trigger('click');
      }
    });
    $(".btnAddTicket").attr("data-dismiss", "modal");
  } else {
    if (template == 0){
      $('.danger-template').removeClass("d-none");
      setTimeout( () => { 
        $('.danger-template').addClass("d-none");
      }, 3000 );
    }
    if (student == 0){
      $('.danger-student').removeClass("d-none");
      setTimeout( () => { 
        $('.danger-student').addClass("d-none");
      }, 3000 );
    }
    if (dateStart == ''){
      $('.dateStart').addClass("form-control-danger");
      $('.danger-dateStart').removeClass("d-none");

      setTimeout( () => { 
        $(".dateStart").removeClass("form-control-danger");
        $('.danger-dateStart').addClass("d-none");
      }, 3000 );
    }
  } 
});

$("#btnDel").on('click', function() {
  $.ajax({
    url : '../../Controllers/Nutrition/MyCurrentsDiets/delete.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormDel').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsList.php";}, 800);
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
    url : '../../Controllers/Nutrition/MyCurrentsDiets/restore.php',
    type : 'POST',
    dataType : 'JSON',
    data: $('#FormRest').serialize(),
    success : function(data) {
      if (data.confirmSave) {
        $('#sa-success-distrix').trigger('click');
        setTimeout(function() {window.location.href = "./nutritionMyCurrentsDietsList.php";}, 800);
      } else {
        $('#sa-error-distrix').trigger('click');
      }
    },
    error : function(data) {
      $('#sa-error-distrix').trigger('click');
    }
  });
});

function ViewTicket(id){
  $.ajax({
    url : '../../Controllers/Nutrition/MyCurrentsDiets/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'id': id},
    success : function(data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");

      $('.AddTicketFormIdTicket').val(id);
      $('.AddMyCurrentsDietsFormIdUserCoatch').val(data.ViewTicket.idUserCoach);
            
      $('.listMyTemplates option[value="'+data.ViewTicket.idDietTemplate+'"]').prop('selected', true);
      nameTemplate = $('.listMyTemplates option[value="'+data.ViewTicket.idDietTemplate+'"]').text();
      $('#select2-listMyTemplates-container').html(nameTemplate);
      
      $('.listStudents option[value="'+data.ViewTicket.idUserStudent+'"]').prop('selected', true);
      nameStudent = $('.listStudents option[value="'+data.ViewTicket.idUserStudent+'"]').text();
      $('#select2-listStudents-container').html(nameStudent);
      
      var date    = String(data.ViewTicket.dateStart);
      var year    = date.substr(0, 4);
      var month   = date.substr(4, 2);
      var day     = date.substr(6, 2);
      var dateFr  = day+'/'+month+'/'+year;
      $('.dateStart').val(dateFr);

      $('.AddTicketFormTimestamp').val(data.ViewTicket.timestamp);
      $('.AddTicketFormStatut').val(data.ViewTicket.elemState);
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function DelTicket(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestTicket(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}