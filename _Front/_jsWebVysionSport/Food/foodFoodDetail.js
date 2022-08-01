$(function() {
  $.ajax({
    url : '../../Controllers/Food/Food/view.php',
    type : 'POST',
    dataType : 'JSON',
    data: {'idFood': localStorage.getItem("idFood")},
    success : function(data) {
      $(".infoFoodName").html(data.ViewFood.name);
    },
    error : function(data) {
      console.log(data);
    }
  });
});