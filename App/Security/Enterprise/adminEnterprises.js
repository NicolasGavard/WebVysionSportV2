var enterpriseSelectedData = null;
var enterpriseTableEntreprisesData=[];
$(function() {
  var enterpriseTableData = "";
  var enterpriseTable = $('#EnterpriseListTable').DataTable({
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
      enterpriseTableData = data.ListEnterprises;
      enterpriseTableEntreprisesData = data.ListEnterprises;
      ListEnterprise(0);
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
    enterpriseTable.clear().draw();
    ListEnterprise(1);
  });

  $(".btn-success").on('click', function() {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");
    
    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    enterpriseTable.clear().draw();
    ListEnterprise(0);
  });

  $("#btnDel").on('click', function() {
    $.ajax({
      url : 'Controllers/delete.php',
      type : 'POST',
      dataType : 'JSON',
      data: $('#FormDel').serialize(),
      success : function(data) {
        if (data.confirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./adminEnterpriseList.php";}, 800);
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
        if (data.confirmSave) {
          $('#sa-success-distrix').trigger('click');
          setTimeout(function() {window.location.href = "./adminEnterpriseList.php";}, 800);
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

  function ListEnterprise(elemState){
    const dataTableData = enterpriseTableData;
    $.map(dataTableData, function(val, key) {
      if(val.statut == elemState){
        if(val.statut == 1) {actionBtnDelete = 'd-none'; actionBtnRestore = '';}
        if(val.statut == 0) {actionBtnDelete = '';       actionBtnRestore = 'd-none';}

        let line =  '<tr>'+
                    ' <td style="padding:1rem;"><img style="max-height:100px; max-width:100px;"<img src="'+val.linkToPicture+'"/></td>'+
                    ' <td>'+
                    '   '+val.firstName+' '+val.name+''+
                    '   <br/><br/>'+
                    '   '+val.nameEnterprise+''+
                    ' </td>'+
                    ' </td>'+
                    ' <td>'+
                    '   Mail : <a href="mailto:'+val.email+'">'+val.email+'</a>'+
                    '   <br/><br/>'+
                    '   Phone : <a href="callto:'+val.phone+'">'+val.phone+'</a>'+
                    ' </td>'+
                    ' <td width="10%">'+
                    '   <div class="dropdown">'+
                    '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">'+
                    '       <i class="dw dw-more"></i>'+
                    '     </a>'+
                    '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">'+
                    '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddEnterprise"   onclick="ViewEnterprise(\''+val.id+'\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>'+
                    '       <a class="dropdown-item '+actionBtnDelete+'"  data-toggle="modal" data-target="#modalDel"        onclick="DelEnterprise(\''+val.id+'\', \''+val.name+'\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>'+
                    '       <a class="dropdown-item '+actionBtnRestore+'" data-toggle="modal" data-target="#modalRest"       onclick="RestEnterprise(\''+val.id+'\', \''+val.name+'\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>'+
                    '     </div>'+
                    '   </div>'+
                    ' </td>'+
                    '</tr>';
        enterpriseTable.row.add($(line)).draw();
      }
    });
  }
});

function DelEnterprise(id, name){
  $('.DelFormId').val(id);
  $('.DelTxt').html(' <b>'+name+'</b> ?');
}

function RestEnterprise(id, name){
  $('.RestFormId').val(id);
  $('.RestTxt').html(' <b>'+name+'</b> ?');
}

