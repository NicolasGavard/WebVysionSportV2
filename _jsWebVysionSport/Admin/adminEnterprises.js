$(document).ready(function() {
  $.ajax({
    url : '../../Controllers/Security/Enterprise/list.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {    
      $.map(data.ListEnterprises, function(val, key) {
        $('#listEnterprisesTbody').append(
          '<tr>'+
          ' <td><img src="'+val.logoImageHtmlName+'"/></td>'+
          ' <td>'+val.name+'</td>'+
          ' <td>Mail : <a href="mailto:'+val.email+'">'+val.email+'</a><br/><br/>Phone : <a href="callto:'+val.phone+'">'+val.phone+'</a><br/><br/>Mobile : <a href="callto:'+val.mobile+'">'+val.mobile+'</a></td>'+
          ' <td>'+val.street+'<br>'+val.zipCode+' '+val.city+'</td>'+
          ' <td><div class="progress" style="width:15px; height:15px;"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>'+
          ' <td>'+
          '   <button type="button" class="btn btn-primary btn-rounded btn-icon"><i class="ti-eye"></i></button>'+
          '   <button type="button" class="btn btn-danger btn-rounded btn-icon"><i class="ti-trash"></i></button>'+
          ' </td>'+
          '</tr>')
      });
    },
    error : function(data) {
      console.log(data);
    }
  });
  
  $("#btnAddStyEnterprise").click(function() {
    var errorData   = "";
    
    var validEmail        = ValidateEmail($('#InputEmail').val());
    if (validEmail){
      $.ajax({
        url : '../../Controllers/Security/Enterprise/save.php',
        type : 'POST',
        dataType : 'JSON',
        data: $('#FormAddStyEnterprise').serialize(),
        success : function(data) {
          $(".alert-success").show("slow").delay(2500).hide("slow");
        },
        error : function(data) {
          errorData += ' - An internal error has occurred !!<br/>'
          $('.alert-danger').show("slow").delay(5000).hide("slow");
          $('.alert-danger p').html(errorData);
        }
      });
    } else {
      if (validEmail == false){
        errorData += ' - the email address is not a valid email address !!<br/>'
      } 
    }

    if (errorData !== ''){
      $('.alert-danger').show("slow").delay(5000).hide("slow");
      $('.alert-danger p').html(errorData);
    }
  });
});