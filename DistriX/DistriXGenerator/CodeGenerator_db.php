<?php
session_start();
include("CodeGeneratorPrepare.php");
include("CodeGeneratorPrepareIndex.php");

// print_r($_POST);
$goto = $table = $tablename = $index = "";
$field = [];
$fieldInd = 0;
$tempFieldUp = [];
$tempFieldUpInd = 0;
$primaryKey = $uniqueIndexes = $indexes = [];

if (isset($_SESSION["sess_LstField"])) $field = $_SESSION["sess_LstField"];
$fieldInd = sizeof($field);
if (isset($_SESSION["sess_Table"])) $table = $_SESSION["sess_Table"];
if (isset($_SESSION["sess_Index"])) $index = $_SESSION["sess_Index"];
if (isset($_SESSION["sess_PrimaryKey"])) $primaryKey = $_SESSION["sess_PrimaryKey"];
if (isset($_SESSION["sess_UniqueIndexes"])) $uniqueIndexes = $_SESSION["sess_UniqueIndexes"];
if (isset($_SESSION["sess_Indexes"])) $indexes = $_SESSION["sess_Indexes"];

if (@$_POST["table"]) $table = $_POST["table"];
if (@$_POST["tablename"]) $tablename = $_POST["tablename"];
if (@$_POST["index"]) $index = $_POST["index"];
if (@$_POST["fieldUp"]) $tempFieldUp = explode("\r\n", $_POST["fieldUp"]);
if (@$_POST["fieldUpDb"]) $tempFieldUp = explode("\r\n", $_POST["fieldUpDb"]);
$tempFieldUpInd = sizeof($tempFieldUp);
for ($indt = 0; $indt < $tempFieldUpInd; $indt++) {
  if (strlen($tempFieldUp[$indt]) > 0 && $tempFieldUp[$indt] != "\r\n")
    $field[$indt]["up"] = $tempFieldUp[$indt];
}

//echo $table;
if (isset($_POST['Prepare'])) {
  $fieldUpPre = [];
  $fieldUpPreInd = 0;
  $pre = new CodeGeneratorPrepare();
  list($tablename, $field, $fieldInd, $errorT, $errorR) = $pre->prepare($table);
  $preIndex = new CodeGeneratorPrepareIndex();
  list($primaryKey, $uniqueIndexes, $indexes, $errorIndexT, $errorIndexR) = $preIndex->prepare($index);

  $_SESSION["sess_Table"] = $table;
  if ($fieldInd > 0) {
    $_SESSION["sess_Tablename"] = $tablename;
    $_SESSION["sess_LstField"]  = $field;
  } else {
    $_SESSION[$errorT] = "true";
    $_SESSION[$errorR] = "true";
  }
  $_SESSION["sess_Index"] = $index;
  $_SESSION["sess_PrimaryKey"] = $primaryKey;
  $_SESSION["sess_UniqueIndexes"] = $uniqueIndexes;
  $_SESSION["sess_Indexes"] = $indexes;

  $goto = "Location: index.php";
} else {
  if (strlen($tablename) > 0) $_SESSION["sess_Tablename"] = $tablename;

  if (isset($_POST['PrepData']) || isset($_POST['PrepDataDb'])) {
    $_SESSION["sess_LstField"] = $field;
    $goto = "Location: index.php";
  }
  if (isset($_POST['GenDb'])) {
    $dbDataObjectName = $dataDirectory = $storName = $storDirectory = "";
    $generateFor = "P";
    $isGenData = $isGenStor = false;
    $uniqueKey = $listSortedBy = $timestamp = -1;
    $uniqueToGenerate = [];
    $uniqueToGenerateInd = 0;
    $indexToGenerate = [];
    $indexToGenerateInd = 0;
    foreach ($_POST as $key => $value) // used to get field with 0 values
    {
      if (strcmp($key, "uniquekey") == 0) $uniqueKey = $value;
      if (strcmp($key, "timestamp") == 0) $timestamp = $value;
      if (strcmp($key, "listsortedby") == 0) $listSortedBy = $value;
      if (stripos($key, "cbUnique") !== false) {
        $number = substr($key, strlen("cbUnique"));
        $uniqueToGenerate[$uniqueToGenerateInd]["number"] = $number;
        $uniqueToGenerate[$uniqueToGenerateInd++]["name"] = $_POST["unique" . $number];
      }
      if (stripos($key, "cbIndex") !== false) {
        $number = substr($key, strlen("cbIndex"));
        $indexToGenerate[$indexToGenerateInd]["number"] = $number;
        $indexToGenerate[$indexToGenerateInd++]["name"] = $_POST["index" . $number];
      }
    }
    // var_dump($uniqueIndexes);
    // var_dump($indexes);
    if ($timestamp == -1) {
      if (@$_POST["timestamp"]) $timestamp = $_POST["timestamp"];
    }
    if (@$_POST["rbGenFor"]) $generateFor = $_POST["rbGenFor"];
    if (@$_POST["cbDbData"]) $isGenData = true;
    if (@$_POST["dbDataObjectName"]) $dbDataObjectName = $_POST["dbDataObjectName"];
    if (@$_POST["DbDataDirectory"]) $dataDirectory = $_POST["DbDataDirectory"];
    if (@$_POST["cbDbStor"]) $isGenStor = true;
    if (@$_POST["dbDbObjectName"]) $storName = $_POST["dbDbObjectName"];
    if (@$_POST["dbAccessDirectory"]) $storDirectory = $_POST["dbAccessDirectory"];

    include("CodeGeneratorData.php");

    $done = false;
    $errorT = "T";
    $errorR = "R";
    $genData = new CodeGeneratorData();
    if ($isGenData) {
      list($done, $errorT, $errorR) = $genData->generateDataData($tablename, $dbDataObjectName, $field, $fieldInd, $uniqueKey, $dataDirectory);
      if (!$done) {
        $goto = "Location: index.php";
        $_SESSION[$errorT] = "true";
        $_SESSION[$errorR] = "true";
      }
    }
    if ($fieldInd > 0) {
      if ($isGenStor) {
        include("CodeGeneratorDb.php");

        $db = new CodeGeneratorDb();
        list($done, $errorT, $errorR) =
          $db->generate($tablename, $storName, $field, $fieldInd, $uniqueKey, $dbDataObjectName, $storDirectory, $listSortedBy, $timestamp, $uniqueIndexes, $indexes, $uniqueToGenerate, $indexToGenerate, $generateFor);
        if (!$done) {
          $goto = "Location: index.php";
          $_SESSION[$errorT] = "true";
          $_SESSION[$errorR] = "true";
        }
      }
      echo "<br/><br/>**  Code Generation End  **  " . date("H:i:s") . "<br/><br/>";
    }
  } else if (strlen($goto) == 0) exit(0);
}
// echo "***---$goto---***";
header($goto);
