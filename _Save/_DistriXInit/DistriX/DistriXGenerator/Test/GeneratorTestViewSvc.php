<?php // Needed to encode in UTF8 ààéàé //
if (session_status() == PHP_SESSION_NONE) { session_start(); }

include_once("_util.php");

// Data
include("data/ManIngredientListViewData.php");
include("data/ManIngredientCreateViewData.php");
include("data/GenIdData.php");
include("data/ManIngredientFindViewData.php");

// Layer
include("layer/BusSvcCall.php");
include("layer/LayerData.php");

$error = "";
$outputok = false;
$respView = $json_result = array();
$layerViewData = new LayerData();
$inLocalMode = false;
$viewMethodName = "";
$viewParameters = array();
$busSvcCall = new BusSvcCall();

$viewMethodName = "Find";

if (! isset($this)) { // In Global Call Mode
  if(@$_POST["met"]) $viewMethodName = $_POST["met"];
  else if(@$_GET["met"]) $viewMethodName = $_GET["met"];

  if(@$_POST["lds"]) $layerViewData = unserialize($_POST["lds"]);
  else if(@$_GET["lds"]) $layerViewData = unserialize($_GET["lds"]);
}
else {
  $inLocalMode = true;
  $viewMethodName = $this->getMethodName();
  $viewParameters = $this->getParameters();
  $layerViewData = unserialize($viewParameters["lds"]);
}
$ingredients = array(); $ingredientsInd = 0;
$suppliers = array(); $suppliersInd = 0;
$all = false;


// Added for testing
$layerViewData->setIdUser(3);
// end Added...

$busSvcCall->setServiceName("GeneratorTestBusSvc.php");
$busSvcCall->setKindOfCallLocal();
$busSvcCall->setMethodName($viewMethodName);
$busSvcCall->addParameter("lds", serialize($layerViewData));


if ($viewMethodName == "List") {
  $ingredientsSer = serialize(array()); $ingredientsSerInd = 0;
  list($outputok, $output, $json_result, $error) = $busSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $ingredientsSer = $json_result["ingredients"];
    $ingredientsSerInd = $json_result["nbingredient"];
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else { print_r($output);
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  $respView = array("ingredients" => $ingredientsSer, "nbingredient" => $ingredientsSerInd, 
                    "outputok" => $outputok, "error" => $error);
}

//--------  View Service  --------
if ($viewMethodName == "Create") {
  $manIngredientCreateViewData = serialize(new ManIngredientCreateViewData());
  if (@$_POST["Data"]) $manIngredientCreateViewData = $_POST["Data"];

/*
// Added for testing
  $manIngredientCreateViewData = unserialize($manIngredientCreateViewData);
  $manIngredientCreateViewData->setIdSupplier(1);
  $manIngredientCreateViewData->setName("Test Svc View");
  $manIngredientCreateViewData = serialize($manIngredientCreateViewData);
// end Added...
*/

  $busSvcCall->addParameter("Data", $manIngredientCreateViewData);
  $ingredientSer = $manIngredientCreateViewData;
  list($outputok, $output, $json_result, $error) = $busSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $ingredientSer = $json_result["ingredient"];
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else {
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  $respView = array("ingredient" => $ingredientSer,
                    "outputok" => $outputok, "error" => $error);
}

//--------  View Service  --------
if ($viewMethodName == "Remove" || $viewMethodName == "Restore") {
  $genIdData = serialize(new GenIdData());
  if (@$_POST["Data"]) $genIdData = $_POST["Data"];
/*
// Added for testing
  $genIdData = unserialize($genIdData);
  $genIdData->setId(1);
  $genIdData = serialize($genIdData);
// end Added...
*/
  $busSvcCall->addParameter("Data", $genIdData);
  $ingredientSer = serialize(new ManIngredientListViewData());
  list($outputok, $output, $json_result, $error) = $busSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $ingredientSer = $json_result["ingredient"];
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else { 
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  if ($inLocalMode) $error = "in Local Mode";
  $respView = array("ingredient" => $ingredientSer,
                    "outputok" => $outputok, "error" => $error);
}
//--------  View Service  --------
if ($viewMethodName == "Find") {
  $genIdData = serialize(new GenIdData());
  if (@$_POST["Data"]) $genIdData = $_POST["Data"];
  if ($inLocalMode && isset($viewParameters["Data"])) {
    $genIdData = $viewParameters["Data"];
  }
/*
// Added for testing
  $genIdData = unserialize($genIdData);
  $genIdData->setId(1);
  $genIdData = serialize($genIdData);
// end Added...
*/
  $busSvcCall->addParameter("Data", $genIdData);
  $ingredientSer = serialize(new ManIngredientFindViewData());
  list($outputok, $output, $json_result, $error) = $busSvcCall->call();
  if ($outputok && sizeof($json_result) > 0) {
    $ingredientSer = $json_result["ingredient"];
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  else {
    if (isset($json_result["error"])) $error = $json_result["error"];
  }
  $respView = array("ingredient" => $ingredientSer,
                    "outputok" => $outputok, "error" => $error);
}




if ($inLocalMode) return json_encode($respView);
else echo json_encode($respView);
?>
