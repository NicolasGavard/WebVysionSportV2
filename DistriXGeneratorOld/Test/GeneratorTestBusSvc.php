<?php // Needed to encode in UTF8 ààéàé //
if (session_status() == PHP_SESSION_NONE) { session_start(); }

include_once("_util.php");

// Data
include("data/ManIngredientListViewData.php");
include("data/ManIngredientListDataData.php");
include("data/ManIngredientCreateViewData.php");
include("data/ManIngredientDetailDataData.php");
include("data/ManIngredientFindViewData.php");
include("data/GenIdData.php");

// Layer
include("layer/DataSvcCall.php");
include("layer/LayerData.php");

$error = "";
$outputok = false;
$respBus = $json_result = array();
$layerBusData = new LayerData();
$inLocalMode = false;
$busMethodName = "";
$busParameters = array();
$dataSvcCall = new DataSvcCall();

$busMethodName = "Find";

if (! isset($this)) { // In Global Call Mode
  if(@$_POST["met"]) $busMethodName = $_POST["met"];
  else if(@$_GET["met"]) $busMethodName = $_GET["met"];

  if(@$_POST["lds"]) $layerBusData = unserialize($_POST["lds"]);
  else if(@$_GET["lds"]) $layerBusData = unserialize($_GET["lds"]);
}
else {
  $inLocalMode = true;
  $busMethodName = $this->getMethodName();
  $busParameters = $this->getParameters();
  $layerBusData = unserialize($busParameters["lds"]);
}


// Added for testing
//$layerBusData->setIduser(2);
// end Added...


$dataSvcCall->setServiceName("GeneratorTestDataSvc.php");
$dataSvcCall->setKindOfCallLocal();
$dataSvcCall->setMethodName($busMethodName);
$dataSvcCall->addParameter("lds", serialize($layerBusData));

//--------  Bus Service  --------
if ($busMethodName == "List") {
  $ingredientsInd = 0;
  $ingredientsView = array(); $ingredientsViewInd = 0;
  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $ingredientsInd = $json_result["nbingredient"];
    for ($indg=0; $indg<$ingredientsInd; $indg+=1) {
      $ingredient = unserialize($json_result["ingredients"][$indg]);
      $manIngredientListViewData = new ManIngredientListViewData();
      $manIngredientListViewData->setId($ingredient->getId());
      $manIngredientListViewData->setName($ingredient->getName());
      $manIngredientListViewData->setSupplierName($ingredient->getSupplierName());
      $manIngredientListViewData->setStatus($ingredient->getStatus());
      $manIngredientListViewData->setAvailableValue($ingredient->getAvailableValue());
      $manIngredientListViewData->setUnavailableValue($ingredient->getUnavailableValue());
      $ingredientsView[$ingredientsViewInd] = $manIngredientListViewData;
      $ingredientsViewInd++;
    }
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else { echo "coucou error output = ";print_r($output);echo "<br/> json_result = ";print_r($json_result);echo "<br/>";
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  $ingredientsSer = array();
  for ($indLst=0;$indLst<$ingredientsViewInd;$indLst+=1) {
    $ingredientsSer[$indLst] = serialize($ingredientsView[$indLst]);
  }
  $respBus = array("ingredients" => $ingredientsSer, "nbingredient" => $indLst,
                   "outputok" => $outputok, "error" => $error);
}

//--------  Bus Service  --------
if ($busMethodName == "Create") {
  $manIngredientCreateViewData = new ManIngredientCreateViewData();
  if (@$_POST["Data"]) $manIngredientCreateViewData = unserialize($_POST["Data"]);

/*
// Added for testing
  $manIngredientCreateViewData->setIdSupplier(1);
  $manIngredientCreateViewData->setName("Test Svc Bus");
// end Added...
*/

  $manIngredientDetailDataData = new ManIngredientDetailDataData();
  $manIngredientDetailDataData->setId($manIngredientCreateViewData->getId());
  $manIngredientDetailDataData->setIdSupplier($manIngredientCreateViewData->getIdSupplier());
  $manIngredientDetailDataData->setName($manIngredientCreateViewData->getName());
  $dataSvcCall->addParameter("Data", serialize($manIngredientDetailDataData));
  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $manIngredientDetailDataData = unserialize($json_result["ingredient"]);
    $manIngredientCreateViewData->setId($manIngredientDetailDataData->getId());
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else {
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  $ingredientSer = serialize($manIngredientCreateViewData);
  $respBus = array("ingredient" => $ingredientSer,
                    "outputok" => $outputok, "error" => $error);
}

//--------  Bus Service  --------
if ($busMethodName == "Remove" || $busMethodName == "Restore") {
  $manIngredientListViewData = new ManIngredientListViewData();
  $genIdData = serialize(new GenIdData());
  if(@$_POST["Data"]) $genIdData = $_POST["Data"];

/*
// Added for testing
  $genIdData = unserialize($genIdData);
  $genIdData->setId(1);
  $genIdData = serialize($genIdData);
// end Added...
*/

  $dataSvcCall->addParameter("Data", $genIdData);
  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $manIngredientListDataData = unserialize($json_result["ingredient"]);
    $manIngredientListViewData->setId($manIngredientListDataData->getId());
    $manIngredientListViewData->setStatus($manIngredientListDataData->getStatus());
    $manIngredientListViewData->setAvailableValue($manIngredientListDataData->getAvailableValue());
    $manIngredientListViewData->setUnavailableValue($manIngredientListDataData->getUnavailableValue());
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else {
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  $ingredientSer = serialize($manIngredientListViewData);
  $respBus = array("ingredient" => $ingredientSer,
                   "outputok" => $outputok, "error" => $error);
}
//--------  Bus Service  --------
if ($busMethodName == "Find") {
  $manIngredientFindViewData = new ManIngredientFindViewData();
  $genIdData = serialize(new GenIdData());
  if(@$_POST["Data"]) $genIdData = $_POST["Data"];
  if ($inLocalMode && isset($busParameters["Data"])) {
    $genIdData = $busParameters["Data"];
  }
/*
// Added for testing
  $genIdData = unserialize($genIdData);
  $genIdData->setId(1);
  $genIdData = serialize($genIdData);
// end Added...
*/
  $dataSvcCall->addParameter("Data", $genIdData);
  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $manIngredientDetailDataData = unserialize($json_result["ingredient"]);
    $manIngredientFindViewData->setId($manIngredientDetailDataData->getId());
    $manIngredientFindViewData->setIdSupplier($manIngredientDetailDataData->getIdSupplier());
    $manIngredientFindViewData->setName($manIngredientDetailDataData->getName());
    $manIngredientFindViewData->setIdConditionningType($manIngredientDetailDataData->getIdConditionningType());
    $manIngredientFindViewData->setContentLeft($manIngredientDetailDataData->getContentLeft());
    $manIngredientFindViewData->setContentRight($manIngredientDetailDataData->getContentRight());
    $manIngredientFindViewData->setIdUnitType($manIngredientDetailDataData->getIdUnitType());
    $manIngredientFindViewData->setIdContainingType($manIngredientDetailDataData->getIdContainingType());
    $manIngredientFindViewData->setQuantity($manIngredientDetailDataData->getQuantity());
    $manIngredientFindViewData->setIdUnitTypeFormat($manIngredientDetailDataData->getIdUnitTypeFormat());
    $manIngredientFindViewData->setIdCaliberType($manIngredientDetailDataData->getIdCaliberType());
    $manIngredientFindViewData->setItemLength($manIngredientDetailDataData->getItemLength());
    $manIngredientFindViewData->setItemWidth($manIngredientDetailDataData->getItemWidth());
    $manIngredientFindViewData->setItemThickness($manIngredientDetailDataData->getItemThickness());
    $manIngredientFindViewData->setDensity($manIngredientDetailDataData->getDensity());
    $manIngredientFindViewData->setWeightTrayTen($manIngredientDetailDataData->getWeightTrayTen());
    $manIngredientFindViewData->setWeightTrayFifty($manIngredientDetailDataData->getWeightTrayFifty());
    $manIngredientFindViewData->setIdStateType($manIngredientDetailDataData->getIdStateType());
    $manIngredientFindViewData->setUseByDate($manIngredientDetailDataData->getUseByDate());
    $manIngredientFindViewData->setUseBeforeDate($manIngredientDetailDataData->getUseBeforeDate());
    $manIngredientFindViewData->setWasteTreatment($manIngredientDetailDataData->getWasteTreatment());
    $manIngredientFindViewData->setDelay($manIngredientDetailDataData->getDelay());
    $manIngredientFindViewData->setFreeOfChargeLimit($manIngredientDetailDataData->getFreeOfChargeLimit());
    $manIngredientFindViewData->setShippingCosts($manIngredientDetailDataData->getShippingCosts());
    $manIngredientFindViewData->setOrderMinimumWeight($manIngredientDetailDataData->getOrderMinimumWeight());
    $manIngredientFindViewData->setStatus($manIngredientDetailDataData->getStatus());
    $manIngredientFindViewData->setAvailableValue($manIngredientDetailDataData->getAvailableValue());
    $manIngredientFindViewData->setUnavailableValue($manIngredientDetailDataData->getUnavailableValue());
    $manIngredientFindViewData->setIdUserCreate($manIngredientDetailDataData->getIdUserCreate());
    $manIngredientFindViewData->setDateCreate($manIngredientDetailDataData->getDateCreate());
    $manIngredientFindViewData->setTimeCreate($manIngredientDetailDataData->getTimeCreate());
    $manIngredientFindViewData->setIdUserModif($manIngredientDetailDataData->getIdUserModif());
    $manIngredientFindViewData->setDateModif($manIngredientDetailDataData->getDateModif());
    $manIngredientFindViewData->setTimeModif($manIngredientDetailDataData->getTimeModif());
    $manIngredientFindViewData->setIdUserDelete($manIngredientDetailDataData->getIdUserDelete());
    $manIngredientFindViewData->setDateDelete($manIngredientDetailDataData->getDateDelete());
    $manIngredientFindViewData->setTimeDelete($manIngredientDetailDataData->getTimeDelete());
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else {
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  $ingredientSer = serialize($manIngredientFindViewData);
  $respBus = array("ingredient" => $ingredientSer,
                   "outputok" => $outputok, "error" => $error);
}


if ($inLocalMode) return json_encode($respBus);
else echo json_encode($respBus);
?>
