<?php
include("CodeGeneratorPrepare.php");
session_start();

print_r($_POST);
$goto = $table = $tablename = "";
$field = array(); $fieldInd = 0;
$tempFieldUp = array(); $tempFieldUpInd = 0;
$posbegintable = 0;

/*
$orderlistedecroissant = false; $statutliste = "";
$newdetail = false; $liste = false;
$fieldsearch = ""; $fieldsearchtype = "";
$phpname = "";
$fieldliste = array(); $fieldlistemin = 0; $fieldlistemax = 0; $fieldunique = ""; $fielduniquetype = "";
$fieldtri = ""; $fieldtritype = "";
*/

if (isset($_SESSION["sess_LstField"])) $field = $_SESSION["sess_LstField"];
$fieldInd = sizeof($field);
if (isset($_SESSION["sess_Table"])) $table = $_POST["sess_Table"];

if (@$_POST["table"]) $table = $_POST["table"];
if (@$_POST["tablename"]) $tablename = $_POST["tablename"];
if (@$_POST["fieldUp"]) $tempFieldUp = explode("\r\n", $_POST["fieldUp"]);
if (@$_POST["fieldUpDb"]) $tempFieldUp = explode("\r\n", $_POST["fieldUpDb"]);
$tempFieldUpInd = sizeof($tempFieldUp);
for ($indt=0; $indt < $tempFieldUpInd; $indt++) { 
  if(strlen($tempFieldUp[$indt]) > 0 && $tempFieldUp[$indt] != "\r\n")
    $field[$indt]["up"] = $tempFieldUp[$indt];
}

//echo $table;
if (isset($_POST['Prepare']))
{
  $fieldUpPre = array(); $fieldUpPreInd = 0;
  $pre = new CodeGeneratorPrepare();
  list($tablename, $field, $fieldInd, $errorT, $errorR) = $pre->prepare($table);

  $_SESSION["sess_Table"] = $table;
  if ($fieldInd > 0)
  {
    $_SESSION["sess_Tablename"] = $tablename;
    $_SESSION["sess_LstField"]  = $field;
  }
  else
  {
    $_SESSION[$errorT] = "true";
    $_SESSION[$errorR] = "true";
  }
  $goto = "Location: index.php";
}
else
{
  if(strlen($tablename) > 0) $_SESSION["sess_Tablename"] = $tablename;

  if (isset($_POST['PrepData']) || isset($_POST['PrepDataDb']))
  {
    $_SESSION["sess_LstField"] = $field;
    $goto = "Location: index.php";
  }
  if (isset($_POST['GenData']))
  {
    $infosData = $baseData = $viewData = $busData = $dataData = false;
    $infosDataName = $dataDirectory = "";
    $uniqueKey = $listField1 = $listField2 = $listField3 = $listSortedBy = -1;
    foreach ($_POST as $key => $value) // used to get field with 0 values
    {
      if (strcmp($key, "uniquekey") == 0) $uniqueKey = $value;
      if (strcmp($key, "listefield1") == 0) $listField1 = $value;
      if (strcmp($key, "listefield2") == 0) $listField2 = $value;
      if (strcmp($key, "listefield3") == 0) $listField3 = $value;
      if (strcmp($key, "listsortedby") == 0) $listSortedBy = $value;
    }
    if (@$_POST["cbInfosData"]) $infosData = true;
    if (@$_POST["InfosDataName"]) $infosDataName = $_POST["InfosDataName"];
    if (@$_POST["cbBaseData"]) $baseData = true;
    if (@$_POST["cbViewData"]) $viewData = true;
    if (@$_POST["cbBusData"]) $busData = true;
    if (@$_POST["cbDataData"]) $dataData = true;
    if (@$_POST["InfosDataDirectory"]) $dataDirectory = $_POST["InfosDataDirectory"];

    include("CodeGeneratorData.php");

    $done = false;
    $errorT = "T"; $errorR = "R";
    $genData = new CodeGeneratorData();
    list($done, $errorT, $errorR) = $genData->generateDataData($tablename, $field, $fieldInd, $uniqueKey, $dataDirectory);
    if (!$done)
    {
      $goto = "Location: index.php";
      $_SESSION[$errorT] = "true";
      $_SESSION[$errorR] = "true";
    }
    if ($fieldInd > 0)
    {
      if (isset($_POST['cbStorage']))
      {
        include("CodeGeneratorDb.php");

        $db = new CodeGeneratorDb();
        list($done, $errorT, $errorR) = $db->generate($tablename, $field, $fieldInd, $uniqueKey, $storagedirectory);
        if (!$done)
        {
          $goto = "Location: index.php";
          $_SESSION[$errorT] = "true";
          $_SESSION[$errorR] = "true";
        }
      }
      if (isset($_POST['cbListe']))
      {
        if (@$_POST["nomfichier"]) $nomfichier = $_POST["nomfichier"];
      }
    }
echo "<br/><br/>**  Code Generation End  **  ".date("H:i:s")."<br/><br/>";
  }
  if (isset($_POST['GenDb'])) {
    $dbListObjectName = $dbDataObjectName = $dataDirectory = $storName = $storDirectory = "";
    $isGenList = $isGenData = $isGenStor = false;
    $uniqueKey = $listField1 = $listField2 = $listField3 = $listField4 = $listField5 = $listField6 = $listSortedBy = -1;
    foreach ($_POST as $key => $value) // used to get field with 0 values
    {
      if (strcmp($key, "uniquekey") == 0) $uniqueKey = $value;
      if (strcmp($key, "listefield1") == 0) $listField1 = $value;
      if (strcmp($key, "listefield2") == 0) $listField2 = $value;
      if (strcmp($key, "listefield3") == 0) $listField3 = $value;
      if (strcmp($key, "listefield4") == 0) $listField4 = $value;
      if (strcmp($key, "listefield5") == 0) $listField5 = $value;
      if (strcmp($key, "listefield6") == 0) $listField6 = $value;
      if (strcmp($key, "listsortedby") == 0) $listSortedBy = $value;
    }
    if (@$_POST["cbDbList"]) $isGenList = true;
    if (@$_POST["dbListObjectName"]) $dbListObjectName = $_POST["dbListObjectName"];
    if (@$_POST["dbListObjectOtherName"]) $dbListObjectOtherName = $_POST["dbListObjectOtherName"];
    if (@$_POST["cbDbData"]) $isGenData = true;
    if (@$_POST["dbDataObjectName"]) $dbDataObjectName = $_POST["dbDataObjectName"];
    if (@$_POST["DbDataDirectory"]) $dataDirectory = $_POST["DbDataDirectory"];
    if (@$_POST["cbDbStor"] || @$_POST["cbDbAccess"]) $isGenStor = true;
    if (@$_POST["dbDbObjectName"]) $storName = $_POST["dbDbObjectName"];
    if (@$_POST["dbAccessDirectory"]) $storDirectory = $_POST["dbAccessDirectory"];



    include("CodeGeneratorData.php");

    $done = false;
    $errorT = "T"; $errorR = "R";
    $genData = new CodeGeneratorData();
    if ($isGenData)
    {
      list($done, $errorT, $errorR) = $genData->generateDataData($tablename, $dbDataObjectName, $field, $fieldInd, $uniqueKey, $dataDirectory);
      if (!$done)
      {
        $goto = "Location: index.php";
        $_SESSION[$errorT] = "true";
        $_SESSION[$errorR] = "true";
      }
    }
    if ($isGenList)
    {
      list($done, $errorT, $errorR) = $genData->generateListData($dbListObjectName, $dbDataObjectName, $dbListObjectOtherName, $dataDirectory);
      if (!$done)
      {
        $goto = "Location: index.php";
        $_SESSION[$errorT] = "true";
        $_SESSION[$errorR] = "true";
      }
    }

    if ($fieldInd > 0)
    {
      if ($isGenStor)
      {
        include("CodeGeneratorDb.php");

        $db = new CodeGeneratorDb();
        list($done, $errorT, $errorR) = $db->generate($tablename, $storName, $field, $fieldInd, $uniqueKey, $dbListObjectName, $dbDataObjectName, $storDirectory, $listSortedBy, $listField1, $listField2, $listField3, $listField4, $listField5, $listField6);
        if (!$done)
        {
          $goto = "Location: index.php";
          $_SESSION[$errorT] = "true";
          $_SESSION[$errorR] = "true";
        }
      }
echo "<br/><br/>**  Code Generation End  **  ".date("H:i:s")."<br/><br/>";
    }
  }
  else if (strlen($goto) == 0) exit(0);
}
echo "***---$goto---***";
header($goto);

?>
