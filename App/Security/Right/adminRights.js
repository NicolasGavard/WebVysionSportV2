$(document).ready(function() {
  $.ajax({
    url : '../../Controllers/Security/Right/list.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {    
      $.map(data.ListRights, function(val, key) {
        $('#listRightsTbody').append(
          '<tr>'+
          ' <td>'+val.code+'</td>'+
          ' <td>'+val.name+'</td>'+
          ' <td>'+val.description+'</td>'+
          ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-success" right="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
          ' <td>'+
          '   <button type="button" class="btn btn-primary btn-rounded btn-icon"><i class="ti-eye"></i></button>'+
          '   <button type="button" class="btn btn-danger btn-rounded btn-icon"><i class="ti-trash"></i></button>'+
          ' </td>'+
          '</tr>')
      });
    },
    error : function(data) {
      consight.log(data);
    }
  });
 
  $("#btnAddRight").click(function() {
    var errorData   = "";
    var code      = $('#InputRightCode').val();
    var name      = $('#InputRightName').val();
    
    if (code != "" || name != ""){
      $.ajax({
        url : '../../Controllers/Security/Right/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: $('#FormAddRight').serialize(),
        success : function(data) {
          $(".alert-success").show("slow").delay(1500).hide("slow");
          setTimeout(function() {window.location.href = "./adminRightList.php";}, 2000);
        },
        error : function(data) {
          errorData += ' - An internal error has occurred !!<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(errorData);
        }
      });
    } else {
      if (code == "") { errorData += ' - Code empty !!<br/>'; }
      if (name == "") { errorData += ' - Name empty !!<br>'; }
    }

    if (errorData !== ''){
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});