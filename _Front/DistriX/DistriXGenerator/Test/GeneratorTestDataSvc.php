<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

include_once("_util.php");

// Data
include("data/IngredientStorData.php");
include("data/IngredientListStorData.php");
include("data/ManIngredientListDataData.php");
include("data/SupplierListStorData.php");
include("data/ManIngredientDetailDataData.php");
include("data/GenIdData.php");

// Storage
include("storage/StorPDOConnection.php");
include("storage/IngredientStor.php");
// Layer
include("layer/LayerData.php");


$error = "";
$respData = array();
$idpos = $platform = $idlanguage = $idcountry = 0;
$layerData = new LayerData();
$inLocalMode = false;
$dataMethodName = "";
$dataParameters = array();

$dataMethodName = "Find";

if (! isset($this)) { // In Global Call Mode
  if(@$_POST["met"]) $dataMethodName = $_POST["met"];
  else if(@$_GET["met"]) $dataMethodName = $_GET["met"];

  if(@$_POST["lds"]) $layerData = unserialize($_POST["lds"]);
  else if(@$_GET["lds"]) $layerData = unserialize($_GET["lds"]);
}
else {
  $inLocalMode = true;
  $dataMethodName = $this->getMethodName();
  $dataParameters = $this->getParameters();
  $layerData = unserialize($dataParameters["lds"]);
}


//--------  Data Service  --------
if ($dataMethodName == "List") {
  $databasefile = "db/Infodbent.php";
  $dbConnection = null;
  $errortxt = "";
  $error = false;
  $ingredients = array(); $ingredientsInd = 0;
  $ingredientsData = array(); $ingredientsDataInd = 0;

  $connect = new StorPDOConnection($databasefile);
  list($dbConnection, $error, $errortxt) = $connect->openConnection();
  if ($dbConnection != null) {
    $stor = new IngredientStor($databasefile);
    list($ingredients, $ingredientsInd) = $stor->getList(true, $dbConnection);

    for ($indg=0; $indg < $ingredientsInd; $indg++) { 
    //for ($indg=0; $indg < 0; $indg++) { 
      $manIngredientListDataData = new ManIngredientListDataData();
      $manIngredientListDataData->setId($ingredients[$indg]->getIngredientStorData()->getId());
      $manIngredientListDataData->setName($ingredients[$indg]->getIngredientStorData()->getName());
      $manIngredientListDataData->setSupplierName($ingredients[$indg]->getSupplierListStorData()->getName());
      $manIngredientListDataData->setStatus($ingredients[$indg]->getIngredientStorData()->getStatus());
      $manIngredientListDataData->setAvailableValue($ingredients[$indg]->getIngredientStorData()->getAvailableValue());
      $manIngredientListDataData->setUnavailableValue($ingredients[$indg]->getIngredientStorData()->getUnavailableValue());
      $ingredientsData[$ingredientsDataInd] = $manIngredientListDataData;
      $ingredientsDataInd++;
    }
    $ingredientsSer = array();
    for ($indLst=0;$indLst<$ingredientsDataInd;$indLst+=1) {
      $ingredientsSer[$indLst] = serialize($ingredientsData[$indLst]);
    }
    $respData = array("ingredients" => $ingredientsSer, "nbingredient" => $indLst);
  }
}

//--------  Data Service  --------
if ($dataMethodName == "Create") {
  $manIngredientDetailDataData = new ManIngredientDetailDataData();
  if (@$_POST["Data"]) $manIngredientDetailDataData = unserialize($_POST["Data"]);

/*
// Added for testing
  $manIngredientDetailDataData->setIdSupplier(1);
  $manIngredientDetailDataData->setName("Test Svc Data");

  $layerData->setIduser(1);
// end Added...
*/
  $ingredientStorData = new IngredientStorData();
  $ingredientStorData->setId($manIngredientDetailDataData->getId());
  $ingredientStorData->setIdSupplier($manIngredientDetailDataData->getIdSupplier());
  $ingredientStorData->setName($manIngredientDetailDataData->getName());

  $databasefile = "db/Infodbent.php";
  $dbConnection = null;
  $errortxt = "";
  $error = false;

  $connect = new StorPDOConnection($databasefile);
  list($dbConnection, $error, $errortxt) = $connect->openConnection();
  if ($dbConnection != null) {
    if ($dbConnection->beginTransaction()) {
      $ingredientStorData->setAvailable();
      $ingredientStorData->setIdUserCreate($layerData->getIduser());
      $ingredientStorData->setDateCreate(getCurrentNumDate());
      $ingredientStorData->setTimeCreate(getCurrentNumTime());

      $ingredientStor = new IngredientStor($databasefile);
      list($insere, $idingredient) = $ingredientStor->create($ingredientStorData, $dbConnection);
      if ($insere) {
        $manIngredientDetailDataData->setId($idingredient);
        $dbConnection->commit();
        $respData = array('ok' => "ok");
      }
      else { //echo "<br/><br/>rollback.$request..<br/><br/>";
        $dbConnection->rollBack();
        $respData = array('error' => 'Rollback');
      }
    }
    else  {
      $respData = array('error' => 'transaction');
    }
    $connect->closeConnection();
  }
  else {
    $respData = array('error' => 'connection');
  }
  $ingredientSer = serialize($manIngredientDetailDataData);
  $respData["ingredient"] = $ingredientSer;
}
//--------  Data Service  --------
if ($dataMethodName == "Remove" || $dataMethodName == "Restore") {
  $genIdData = new GenIdData();
  if (@$_POST["Data"]) $genIdData = unserialize($_POST["Data"]);

/*
// Added for testing
  $genIdData->setId(1);

  $layerData->setIduser(1);
// end Added...
*/

  $ingredientStorData = new IngredientStorData();
  $ingredientStorData->setId($genIdData->getId());

  $databasefile = "db/Infodbent.php";
  $dbConnection = null;
  $errortxt = "";
  $error = false;

  $connect = new StorPDOConnection($databasefile);
  list($dbConnection, $error, $errortxt) = $connect->openConnection();
  if ($dbConnection != null) {
    if ($dbConnection->beginTransaction()) {
      $ingredientStor = new IngredientStor();
      $ingredientStorData = $ingredientStor->read($ingredientStorData->getId(), $dbConnection);
      $ingredientStorData->setUnavailable(); // Removed
      if ($dataMethodName == "Restore") $ingredientStorData->setAvailable(); // Restored
      $ingredientStorData->setIdUserModif($layerData->getIdUser());
      $ingredientStorData->setDateModif(getCurrentNumDate());
      $ingredientStorData->setTimeModif(getCurrentNumTime());
      $insere = $ingredientStor->update($ingredientStorData, $dbConnection);
      $manIngredientListDataData = new ManIngredientListDataData();
      $manIngredientListDataData->setId($ingredientStorData->getId());
      $manIngredientListDataData->setStatus($ingredientStorData->getStatus());
      $manIngredientListDataData->setAvailableValue($ingredientStorData->getAvailableValue());
      $manIngredientListDataData->setUnavailableValue($ingredientStorData->getUnavailableValue());
      if ($insere) {
        $dbConnection->commit();
        $respData = array('ok' => "ok");
      }
      else { //echo "<br/><br/>rollback.$request..<br/><br/>";
        $dbConnection->rollBack();
        $respData = array('error' => 'Rollback');
      }
    }
    else  {
      $respData = array('error' => 'transaction');
    }
    $connect->closeConnection();
  }
  else {
    $respData = array('error' => 'connection');
  }
  $ingredientSer = serialize($manIngredientListDataData);
  $respData["ingredient"] = $ingredientSer;
}
//--------  Data Service  --------
if ($dataMethodName == "Find") {
  $genIdData = new GenIdData();
  $manIngredientDetailDataData = new ManIngredientDetailDataData();
  if (@$_POST["Data"]) $genIdData = unserialize($_POST["Data"]);
  if ($inLocalMode && isset($dataParameters["Data"])) {
    $genIdData = unserialize($dataParameters["Data"]);
  }

/*
// Added for testing
  $genIdData->setId(1);
// end Added...
*/
  $ingredientStorData = new IngredientStorData();
  $ingredientStorData->setId($genIdData->getId());

  $databasefile = "db/Infodbent.php";
  $dbConnection = null;
  $errortxt = "";
  $error = false;

  $connect = new StorPDOConnection($databasefile);
  list($dbConnection, $error, $errortxt) = $connect->openConnection();
  if ($dbConnection != null) {
    $ingredientStor = new IngredientStor();
    $ingredientStorData = $ingredientStor->read($ingredientStorData->getId(), $dbConnection);
    $manIngredientDetailDataData->setId($ingredientStorData->getId());
    $manIngredientDetailDataData->setIdSupplier($ingredientStorData->getIdSupplier());
    $manIngredientDetailDataData->setName($ingredientStorData->getName());
    $manIngredientDetailDataData->setIdConditionningType($ingredientStorData->getIdConditionningType());
    $manIngredientDetailDataData->setContentLeft($ingredientStorData->getContentLeft());
    $manIngredientDetailDataData->setContentRight($ingredientStorData->getContentRight());
    $manIngredientDetailDataData->setIdUnitType($ingredientStorData->getIdUnitType());
    $manIngredientDetailDataData->setIdContainingType($ingredientStorData->getIdContainingType());
    $manIngredientDetailDataData->setQuantity($ingredientStorData->getQuantity());
    $manIngredientDetailDataData->setIdUnitTypeFormat($ingredientStorData->getIdUnitTypeFormat());
    $manIngredientDetailDataData->setIdCaliberType($ingredientStorData->getIdCaliberType());
    $manIngredientDetailDataData->setItemLength($ingredientStorData->getItemLength());
    $manIngredientDetailDataData->setItemWidth($ingredientStorData->getItemWidth());
    $manIngredientDetailDataData->setItemThickness($ingredientStorData->getItemThickness());
    $manIngredientDetailDataData->setDensity($ingredientStorData->getDensity());
    $manIngredientDetailDataData->setWeightTrayTen($ingredientStorData->getWeightTrayTen());
    $manIngredientDetailDataData->setWeightTrayFifty($ingredientStorData->getWeightTrayFifty());
    $manIngredientDetailDataData->setIdStateType($ingredientStorData->getIdStateType());
    $manIngredientDetailDataData->setUseByDate($ingredientStorData->getUseByDate());
    $manIngredientDetailDataData->setUseBeforeDate($ingredientStorData->getUseBeforeDate());
    $manIngredientDetailDataData->setWasteTreatment($ingredientStorData->getWasteTreatment());
    $manIngredientDetailDataData->setDelay($ingredientStorData->getDelay());
    $manIngredientDetailDataData->setFreeOfChargeLimit($ingredientStorData->getFreeOfChargeLimit());
    $manIngredientDetailDataData->setShippingCosts($ingredientStorData->getShippingCosts());
    $manIngredientDetailDataData->setOrderMinimumWeight($ingredientStorData->getOrderMinimumWeight());
    $manIngredientDetailDataData->setStatus($ingredientStorData->getStatus());
    $manIngredientDetailDataData->setAvailableValue($ingredientStorData->getAvailableValue());
    $manIngredientDetailDataData->setUnavailableValue($ingredientStorData->getUnavailableValue());
    $manIngredientDetailDataData->setIdUserCreate($ingredientStorData->getIdUserCreate());
    $manIngredientDetailDataData->setDateCreate($ingredientStorData->getDateCreate());
    $manIngredientDetailDataData->setTimeCreate($ingredientStorData->getTimeCreate());
    $manIngredientDetailDataData->setIdUserModif($ingredientStorData->getIdUserModif());
    $manIngredientDetailDataData->setDateModif($ingredientStorData->getDateModif());
    $manIngredientDetailDataData->setTimeModif($ingredientStorData->getTimeModif());
    $manIngredientDetailDataData->setIdUserDelete($ingredientStorData->getIdUserDelete());
    $manIngredientDetailDataData->setDateDelete($ingredientStorData->getDateDelete());
    $manIngredientDetailDataData->setTimeDelete($ingredientStorData->getTimeDelete());
    $manIngredientDetailDataData->setAvailableValue($ingredientStorData->getAvailableValue());
    $manIngredientDetailDataData->setUnavailableValue($ingredientStorData->getUnavailableValue());
    $connect->closeConnection();
  }
  else {
    $respData = array('error' => 'connection');
  }
  $ingredientSer = serialize($manIngredientDetailDataData);
  $respData["ingredient"] = $ingredientSer;
}

if ($inLocalMode) return json_encode($respData);
else echo json_encode($respData);
?>
