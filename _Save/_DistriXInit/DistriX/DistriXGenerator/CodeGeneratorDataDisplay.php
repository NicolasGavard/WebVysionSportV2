<?php session_start();
// Needed to encode in UTF8 ààéàé //

// Global
// Storage
// Data
// Security

$table = $tablename = $msgerreur = "";
$field = array();
$fieldInd = 0;

if (isset($_SESSION["sess_ErreurTable"])) {
  $msgerreur = "Erreur avec le générateur.";
  if (isset($_SESSION["sess_Table"])) {
    $table = $_SESSION["sess_Table"];
    unset($_SESSION["sess_Table"]);
  }

  unset($_SESSION["sess_ErreurTable"]);
  if (isset($_SESSION["sess_ErreurNoField"])) {
    unset($_SESSION["sess_ErreurNoField"]);
    $msgerreur .= "<br/>&nbsp;- Aucun champ n'a été trouvé.";
  }
  if (isset($_SESSION["sess_ErreurNomTable"])) {
    unset($_SESSION["sess_ErreurNomTable"]);
    $msgerreur .= "<br/>&nbsp;- Le nom de la table n'a pas été trouvé.";
  }
  if (isset($_SESSION["sess_ErreurNoTable"])) {
    unset($_SESSION["sess_ErreurNoTable"]);
    $msgerreur .= "<br/>&nbsp;- Merci de fournir le code SQL de la création de la table.";
  }
}

if (isset($_SESSION["sess_LstField"])) {
  $field = $_SESSION["sess_LstField"];
  $fieldInd = sizeof($field);

  if (isset($_SESSION["sess_Tablename"])) {
    $tablename = $_SESSION["sess_Tablename"];
  }
}
?>
<style>
</style>
</p>
<div class="row">
  <div class="col-sm-7 col-md-7">
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        <B>Data Object Name</B>
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" id="dataObjectName">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        <B>Data Object Directory</B>
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" id="dataObjectDirectory">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-7 col-md-7 text-center">
        <div class="row"><B>
            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1" id="dataObjectGenRes">
            </div>
          </B>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel"><B>Generation for</B></div>
      <div class="col-sm-4 col-md-4 dbLabel">
        <div class="row">
          <label style="font-weight: normal; display: inline;">
            <div class="col-sm-1 col-md-1" style="margin-top:0px;padding-right:0px;">
              <input class="form-control" type="radio" name="rbGenFor" value="P" id="genP" checked style="margin-top:-6px;">
            </div>
            <div class="col-sm-9 col-md-9">
              PHP_D
            </div>
          </label>
        </div>
      </div>
      <div class="col-sm-4 col-md-4 dbLabel">
        <div class="row">
          <label style="font-weight: normal; display: inline;">
            <div class="col-sm-1 col-md-1" style="margin-top:0px;padding-right:0px;">
              <input class="form-control" type="radio" name="rbGenFor" value="D" id="genD" style="margin-top:-6px;">
            </div>
            <div class="col-sm-5 col-md-5">
              DjangoSvc
            </div>
          </label>
          <label style="font-weight: normal; display: inline;">
            <div class="col-sm-1 col-md-1" style="margin-top:0px;padding-right:0px;">
              <input class="form-control" type="checkbox" name="cbHasArray" style="margin-top:-6px;">
            </div>
            <div class="col-sm-4 col-md-4">
              HAS_ARRAY
            </div>
          </label>
        </div>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-sm-6 col-md-6 text-center"><B>Fields</B></div>
      <div class="col-sm-6 col-md-6"><B>Types</B> (array, boolean, float, integer, object, string)</div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-6 col-md-6">
        <?php
        for ($indF = 0; $indF < 70; $indF++) {
        ?>
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
              <input class="form-control" type="text" id="dataFieldName<?php echo $indF; ?>">
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <div class="col-sm-6 col-md-6">
        <?php
        for ($indF = 0; $indF < 70; $indF++) {
        ?>
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
              <select id="dataFieldType<?php echo $indF; ?>" style="height:34px;">
                <option value="array">array</option>
                <option value="bool">boolean</option>
                <option value="float">float</option>
                <option value="int">integer</option>
                <option value="object">object</option>
                <option value="string">string</option>
              </select>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <div class="col-sm-3 col-md-3 text-center">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 dbLabel">
        <input class="form-control" type="button" id="genDataObject" value="Generate Data Object">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 dbLabel">
        <input class="form-control" type="button" id="loadDataObject" disabled value="Load Data Object">
      </div>
    </div>
  </div>
</div>
</p>

<script>
  $("#genDataObject").click(function() {
    var dataFieldNames = [];
    var dataFieldTypes = [];
    <?php
    for ($indF = 0; $indF < 70; $indF++) {
    ?>
      dataFieldNames.push($("#dataFieldName<?php echo $indF; ?>").val());
      dataFieldTypes.push($("#dataFieldType<?php echo $indF; ?>").val());
    <?php
    }
    ?>
    var don = $("#dataObjectName").val(),
      dod = $("#dataObjectDirectory").val(),
      gfor = $('input[name=rbGenFor]:checked').val(),
      hasA = $('input[name=cbHasArray]:checked').val();

    $.ajax({
      async: false,
      url: "CodeGeneratorDataGenerate.php",
      type: "POST",
      data: {
        gfor: gfor,
        hasA: hasA,
        don: don,
        dod: dod,
        df: dataFieldNames,
        dt: dataFieldTypes,
      },
      complete: function(msg) {
        response = jQuery.parseJSON(msg.responseText);
        $("#dataObjectGenRes").html("");
        if (response.filename != undefined) $("#dataObjectGenRes").html(response.filename);
        if (response.error != undefined) $("#dataObjectGenRes").html(response.error);
        if (response.errorfile != undefined) $("#dataObjectGenRes").html(response.errorfile);
      }
    });
  });
  $("#dataObjectName").on("change paste keyup", function() {
    var valDirectory = $("#dataObjectDirectory").val();
    $("#loadDataObject").prop("disabled", ($(this).val().length == 0 || valDirectory.length == 0));
  });
  $("#dataObjectDirectory").on("change paste keyup", function() {
    var valName = $("#dataObjectName").val();
    $("#loadDataObject").prop("disabled", ($(this).val().length == 0 || valName.length == 0));
  });
  $("#loadDataObject").click(function() {
    var don = $("#dataObjectName").val(),
      dod = $("#dataObjectDirectory").val();
    $.ajax({
      async: false,
      url: "CodeGeneratorDataLoad.php",
      type: "POST",
      data: {
        don: don,
        dod: dod,
      },
      complete: function(msg) {
        response = jQuery.parseJSON(msg.responseText);
        if (response.fields != undefined) {
          var nbFields = response.fields.length;
          for (let indF = 0; indF < nbFields; indF++) {
            var fieldName = "dataFieldName" + indF;
            $("#" + fieldName).val(response.fields[indF]);
          }
        }
        if (response.types != undefined) {
          var nbTypes = response.types.length;
          for (let indT = 0; indT < nbTypes; indT++) {
            var typeName = "#dataFieldType" + indT;
            $(typeName + ' option[value=' + response.types[indT] + ']').attr('selected', 'selected');
            // $('.id_100 option[value=val2]').attr('selected', 'selected');
          }
        }
        $("#dataObjectGenRes").html("");
        if (response.error != undefined) $("#dataObjectGenRes").html(response.error);
      }
    });
  });
</script>