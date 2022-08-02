<?php session_start();
// Needed to encode in UTF8 ààéàé //
$table = $tablename = $msgerreur = $primaryKey = "";
$field = $uniqueIndexes = $indexes = [];
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

  if (isset($_SESSION["sess_Table"])) {
    $table = $_SESSION["sess_Table"];
    unset($_SESSION["sess_Table"]);
  }
  if (isset($_SESSION["sess_Tablename"])) {
    $tablename = $_SESSION["sess_Tablename"];
  }
}
if (isset($_SESSION["sess_PrimaryKey"])) {
  $primaryKey = $_SESSION["sess_PrimaryKey"];
}
if (isset($_SESSION["sess_UniqueIndexes"])) {
  $uniqueIndexes = $_SESSION["sess_UniqueIndexes"];
}
if (isset($_SESSION["sess_Indexes"])) {
  $indexes = $_SESSION["sess_Indexes"];
}

$genTableName = $tablename;
include("TypesPos.php");
foreach ($typesPos as $typePos) {
  $found = strpos($genTableName, $typePos);
  $ID_POS = 2; // 2 stands for fields starting with id which have already been processed. 11-11-20
  if ($found !== FALSE && $found >= $ID_POS) $genTableName[$found] = strtoupper($genTableName[$found]);
}
$endsBy[] = "app";
$endsBy[] = "ten";
$endsBy[] = "to";
foreach ($endsBy as $endBy) {
  $found = strpos($genTableName, $endBy);
  $length = strlen($genTableName);
  if ($found !== FALSE && ($found + strlen($endBy)) == $length) $genTableName[$found] = strtoupper($genTableName[$found]);
}
$nb = count($uniqueIndexes);
for ($indUI = 0; $indUI < $nb; $indUI++) {
  foreach ($typesPos as $typePos) {
    $found = strpos($uniqueIndexes[$indUI]["name"], $typePos);
    if ($found !== FALSE) {
      $newName  = substr($uniqueIndexes[$indUI]["name"], 0, $found);
      $newName .= strtoupper($uniqueIndexes[$indUI]["name"][$found]);
      $newName .= substr($uniqueIndexes[$indUI]["name"], $found + 1);
      $uniqueIndexes[$indUI]["name"] = $newName;
    }
  }
}
$nb = count($indexes);
for ($indUI = 0; $indUI < $nb; $indUI++) {
  foreach ($typesPos as $typePos) {
    $found = strpos($indexes[$indUI]["name"], $typePos);
    if ($found !== FALSE) {
      $newName  = substr($indexes[$indUI]["name"], 0, $found);
      $newName .= strtoupper($indexes[$indUI]["name"][$found]);
      $newName .= substr($indexes[$indUI]["name"], $found + 1);
      $indexes[$indUI]["name"] = $newName;
    }
  }
}
?>
<style>
</style>
</p>
<form action="CodeGenerator_db.php" method="post" name="gendata">
  <div class="row">
    <div class="col-sm-4 col-md-4">
      <div class="row">
        <div class="col-sm-3 col-md-3">
          <B>Field names</B>
        </div>
        <?php
        if ($fieldInd > 0) {
        ?>
          <div class="col-sm-9 col-md-9">
            <textarea class="form-control" NAME="fieldUpDb" ROWS=14><?php
                                                                    for ($j = 0; $j < $fieldInd; $j += 1) {
                                                                      echo $field[$j]["up"] . "\r\n";
                                                                    } ?></textarea>
          </div>
        <?php
        }
        ?>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-12 col-md-12 text-center">
          <B>Indexes</B>
        </div>
      </div>
      </p>
      <?php
      $nb = count($uniqueIndexes);
      for ($indUI = 0; $indUI < $nb; $indUI++) {
      ?>
        <div class="row">
          <div class="col-sm-8 col-md-8 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;padding-right:0px;">
                  <input class="form-control" type="checkbox" checked name="cbUnique<?php echo $indUI; ?>" style="margin-top:-6px;">
                </div>
                <div class="col-sm-11 col-md-11">
                  <div class="row">
                    <div class="col-sm-2 col-md-2 dbLabel">
                      <?php echo 'findBy'; ?>
                    </div>
                    <div class="col-sm-9 col-md-9">
                      <input class="form-control" type="text" name="unique<?php echo $indUI; ?>" value="<?php echo $uniqueIndexes[$indUI]["name"]; ?>">
                    </div>
                  </div>
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <?php
            for ($indF = 0; $indF < 250; $indF++) {
            ?>
              <?php
              if (isset($uniqueIndexes[$indUI]["field" . $indF])) {
              ?>
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <?php
                    echo $uniqueIndexes[$indUI]["field" . $indF] . "<br/>";
                    ?>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
        </p>
      <?php
      }
      $nb = count($indexes);
      for ($indI = 0; $indI < $nb; $indI++) {
      ?>
        <div class="row">
          <div class="col-sm-8 col-md-8 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;padding-right:0px;">
                  <input class="form-control" type="checkbox" checked name="cbIndex<?php echo $indI; ?>" style="margin-top:-6px;">
                </div>
                <div class="col-sm-11 col-md-11">
                  <div class="row">
                    <div class="col-sm-2 col-md-2 dbLabel">
                      <?php echo 'findBy'; ?>
                    </div>
                    <div class="col-sm-9 col-md-9">
                      <input class="form-control" type="text" name="index<?php echo $indI; ?>" value="<?php echo $indexes[$indI]["name"]; ?>">
                    </div>
                  </div>
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <?php
            for ($indF = 0; $indF < 250; $indF++) {
            ?>
              <?php
              if (isset($indexes[$indI]["field" . $indF])) {
              ?>
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <?php
                    echo $indexes[$indI]["field" . $indF] . "<br/>";
                    ?>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
        </p>
      <?php
      }
      ?>
      <br />
    </div>
    <div class="col-sm-8 col-md-8" style="border-left: 1px solid gray;">
      <div class="row">
        <div class="col-sm-2 col-md-2 dbLabel">
          <B>Table name</B>
        </div>
        <div class="col-sm-4 col-md-4">
          <input class="form-control" type="text" name="tablename" value="<?php echo $tablename; ?>">
        </div>
        <div class="col-sm-2 col-md-2 dbLabel">
          <B>Direct Access Key</B>
        </div>
        <div class="col-sm-4 col-md-4">
          <select class="form-control" name="uniquekey">
            <option value="-1">&nbsp;</option>
            <?php
            for ($j = 0; $j < $fieldInd; $j += 1) {
              echo '<option value="' . $j . '"';
              if ($field[$j]["nom"] == $primaryKey) echo " selected ";
              echo '">' . $field[$j]["nom"] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-2 col-md-2 dbLabel">
          <B>List Sorted by</B>
        </div>
        <div class="col-sm-4 col-md-4">
          <select class="form-control" name="listsortedby">
            <option value="-1">&nbsp;</option>
            <?php
            for ($j = 0; $j < $fieldInd; $j += 1) {
              echo '<option value="' . $j . '">' . $field[$j]["nom"] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-sm-2 col-md-2 dbLabel">
          <B>Timestamp Field</B>
        </div>
        <div class="col-sm-4 col-md-4">
          <select class="form-control" name="timestamp">
            <option value="-1">&nbsp;</option>
            <?php
            for ($j = 0; $j < $fieldInd; $j += 1) {
              echo '<option value="' . $j . '"';
              if ($field[$j]["nom"] == "timestamp") echo " selected ";
              echo '">' . $field[$j]["nom"] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-2 col-md-2 dbLabel">
          <div class="row">
            <label style="font-weight: normal; display: inline;">
              <div class="col-sm-2 col-md-2" style="margin-top:0px;padding-right:0px;">
                <input class="form-control" type="checkbox" checked name="cbDbData" style="margin-top:-6px;">
              </div>
              <div class="col-sm-8 col-md-8">
                <B>Data Object</B>
              </div>
            </label>
          </div>
        </div>
        <div class="col-sm-2 col-md-2 dbLabel">
          <B>Name</B>
        </div>
        <div class="col-sm-8 col-md-8">
          <input class="form-control" type="text" name="dbDataObjectName" value="<?php echo ucfirst($genTableName); ?>StorData">
        </div>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-sm-2 col-md-2" style="margin-top:5px;">
          <B>Directory</B>
        </div>
        <div class="col-sm-8 col-md-8">
          <input class="form-control" type="text" name="DbDataDirectory">
        </div>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-2 col-md-2 dbLabel">
          <div class="row">
            <label style="font-weight: normal; display: inline;">
              <div class="col-sm-2 col-md-2" style="margin-top:0px;padding-right:0px;">
                <input class="form-control" type="checkbox" checked name="cbDbStor" style="margin-top:-6px;">
              </div>
              <div class="col-sm-8 col-md8">
                <B>Storage Object</B>
              </div>
            </label>
          </div>
        </div>
        <div class="col-sm-2 col-md-2 dbLabel">
          <B>Name</B>
        </div>
        <div class="col-sm-8 col-md-8">
          <input class="form-control" type="text" name="dbDbObjectName" id="dbDbObjectName" value="<?php echo ucfirst($genTableName); ?>Stor">
        </div>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-sm-2 col-md-2" style="margin-top:5px;">
          <B>Directory</B>
        </div>
        <div class="col-sm-8 col-md-8">
          <input class="form-control" type="text" name="dbAccessDirectory" id="dbAccessDirectory">
        </div>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-2 col-md-2 dbLabel"><B>Generation for</B></div>
        <div class="col-sm-2 col-md-2 dbLabel">
          <div class="row">
            <label style="font-weight: normal; display: inline;">
              <div class="col-sm-2 col-md-2" style="margin-top:0px;padding-right:0px;">
                <input class="form-control" type="radio" name="rbGenFor" value="P" id="genP" checked style="margin-top:-6px;">
              </div>
              <div class="col-sm-7 col-md-7">
                DistriX
              </div>
            </label>
          </div>
        </div>
        <div class="col-sm-2 col-md-2 dbLabel">
          <div class="row">
            <label style="font-weight: normal; display: inline;">
              <div class="col-sm-2 col-md-2" style="margin-top:0px;padding-right:0px;">
                <input class="form-control" type="radio" name="rbGenFor" value="D" id="genD" style="margin-top:-6px;">
              </div>
              <div class="col-sm-7 col-md-7">
                DjangoSvc
              </div>
            </label>
          </div>
        </div>
      </div>
      </p>
      <div class="row">
        <div class="col-sm-12 col-md-12 text-center">
          <input class="form-control" type="Submit" name="GenDb" value="Generate Database Access Objects">
        </div>
      </div>
      <?php
      if ((count($uniqueIndexes) + count($indexes)) > 0) {
      ?>
        <br />
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <input class="form-control" type="button" id="GetIndexMethods" disabled value="Find Existing Indexes Methods">
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  </div>
</form>
<script>
  $("#GetIndexMethods").click(function(e) {
    e.preventDefault();
    var dir = $("#dbAccessDirectory").val(),
      name = $("#dbDbObjectName").val();
    $.ajax({
      async: false,
      url: "CodeGeneratorDbFindIndexMethods.php",
      type: "POST",
      data: {
        dir: dir,
        name: name,
      },
      complete: function(msg) {
        response = jQuery.parseJSON(msg.responseText);
        if (response.names != undefined) {
          alert(response.names);
        }
      }
    });
  });
  $("#dbAccessDirectory").on("change paste keyup", function() {
    var valName = $("#dbAccessDirectory").val();
    $("#GetIndexMethods").prop("disabled", ($(this).val().length == 0 || valName.length == 0));
  });
</script>