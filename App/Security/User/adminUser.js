var userSelectedData = null;
var userTableEntreprisesData=[];
$(function() {
  var userTableData = "";
  var userTable = $('#UserListTable').DataTable({
    columnDefs: [
      // { orderable: false, targets: 0 },
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
      userTableData = data.ListUsers;
      userTableEntreprisesData = data.ListEnterprises;
      ListUser(0);
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
    userTable.clear().draw();
    ListUser(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    userTable.clear().draw();
    ListUser(0);
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
          setTimeout(function() {window.location.href = "./adminUserList.php";}, 800);
        } else {
          $('#sa-error-distrix').trigger('click');
          $('#swal2-content').html('<ul class="list-group list-group-flush">'+data.errorData.text+'</ul>');
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
          setTimeout(function() {window.location.href = "./adminUserList.php";}, 800);
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

  function ListUser(elemState){
    const dataTableData = userTableData;
    $.map(dataTableData, function(val, key) {
      if(val.statut == elemState){
        if(val.statut == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.statut == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}

        let line =  '<tr>'+
                    ' <td style="padding:1rem;"><img style="max-height:60px; max-width:60px;"<img src="'+val.linkToPicture+'"/></td>'+
                    ' <td>'+
                    '   '+val.firstName+' '+val.name+''+
                    '   <br/><br/>'+
                    '   '+val.nameEnterprise+''+
                    ' </td>'+
                    ' <td>'+
                    '   Mail : <a href="mailto:'+val.email+'">'+val.email+'</a>'+
                    '   <br/>'+
                    '   Phone : <a href="callto:'+val.phone+'">'+val.phone+'</a>'+
                    ' </td>'+
                    ' <td width="10%">'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddUser"   onclick="ViewUser(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"        onclick="DelUser(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"       onclick="RestUser(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
        userTable.row.add($(line)).draw();
      }
    });
  }
});

function DelUser(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestUser(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

