<?php session_start();
// Needed to encode in UTF8 ààéàé //
?>
<style>
</style>
</p>
<div class="row">
  <div class="col-sm-1 col-md-1 dbLabel">
    <B>Encoding key</B>
  </div>
  <div class="col-sm-4 col-md-4">
    <input class="form-control" type="text" id="encodingKey" value="c1c2c3c4c5c6c7c8d1d2d3d4d5d6d7d8c1c2c3c4c5c6c7c8d1d2d3d4d5d6d7d8">
  </div>
</div>
</p>
<div class="row">
  <div class="col-sm-1 col-md-1 dbLabel">
    <B>Decoded String</B>
  </div>
  <div class="col-sm-4 col-md-4">
    <input class="form-control" type="text" id="encodeData">
  </div>
  <div class="col-sm-1 col-md-1 text-center">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 dbLabel">
        <input class="form-control" type="button" id="genEncode" disabled value="Encode">
      </div>
    </div>
  </div>
</div>
</p>
<div class="row">
  <div class="col-sm-1 col-md-1 dbLabel">
    <B>Encoded String</B>
  </div>
  <div class="col-sm-4 col-md-4">
    <input class="form-control" type="text" id="decodeData">
  </div>
  <div class="col-sm-1 col-md-1 text-center">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 dbLabel">
        <input class="form-control" type="button" id="genDecode" disabled value="Decode">
      </div>
    </div>
  </div>
</div>
</p>
<script>
  $("#encodeData").on("change paste keyup", function() {
    var encodeData = $("#encodeData").val();
    $("#genEncode").prop("disabled", ($(this).val().length == 0 || encodeData.length == 0));
  });
  $("#decodeData").on("change paste keyup", function() {
    var decodeData = $("#decodeData").val();
    $("#genDecode").prop("disabled", ($(this).val().length == 0 || decodeData.length == 0));
  });
  $("#genEncode").click(function() {
    var encodingKey = $("#encodingKey").val();
    var encodeData = $("#encodeData").val();
    $.ajax({
      async: false,
      url: "CodeGeneratorEncodeDecode.php",
      type: "POST",
      data: {
        encode: "encode",
        key: encodingKey,
        data: encodeData,
      },
      complete: function(msg) {
        response = jQuery.parseJSON(msg.responseText);
        if (response.data != undefined) {
          $("#decodeData").val(response.data);
        }
      }
    });
  });
  $("#genDecode").click(function() {
    var encodingKey = $("#encodingKey").val();
    var decodeData = $("#decodeData").val();
    $.ajax({
      async: false,
      url: "CodeGeneratorEncodeDecode.php",
      type: "POST",
      data: {
        decode: "decode",
        key: encodingKey,
        data: decodeData,
      },
      complete: function(msg) {
        response = jQuery.parseJSON(msg.responseText);
        if (response.data != undefined) {
          $("#encodeData").val(response.data);
        }
      }
    });
  });
</script>