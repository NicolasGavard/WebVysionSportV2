<?php session_start();
// Needed to encode in UTF8 ààéàé //
include_once('_util.php');

// Data
include("data/ManIngredientListViewData.php");
include("data/ManIngredientCreateViewData.php");
include("data/ManIngredientFindViewData.php");
include("data/GenIdData.php");
include("data/SupplierListViewData.php");

// Layer
include("layer/ViewSvcCall.php");
include("layer/LayerData.php");
// Security
//include("sec/MikeSecurity.php");

//print_r($_POST);

$insere = false;
$manIngredientCreateViewData = new ManIngredientCreateViewData();
$function = "";
$resp = array();

$function = "f";

$layerData = new LayerData();
/*$layerData->setIdPos(0);
$layerData->setIdPlatform(0);
$layerData->setDataVersion("");
$layerData->setIdLanguage(0);
$layerData->setIdCountry(0);*/
$layerData->setIdUser(1);
$viewSvcCall = new ViewSvcCall();
$viewSvcCall->setServiceName("GeneratorTestViewSvc.php");
$viewSvcCall->setKindOfCallLocal();
$viewSvcCall->addParameter("lds", serialize($layerData));

 // List Ingredient
if ($function == "l") {
  $viewSvcCall->setMethodName("List");
  list($outputok, $output, $json_result, $error) = $viewSvcCall->call();

  if ($outputok && sizeof($json_result) > 0) {
    $ingredientsInd = $json_result["nbingredient"];
    for ($indlst=0; $indlst<$ingredientsInd; $indlst+=1) {
      $ingredients[$indlst] = unserialize($json_result["ingredients"][$indlst]);
    }
    $suppliersInd = 0;
    if (isset($json_result["nbsupplier"])) $suppliersInd = $json_result["nbsupplier"];
    for ($indlst=0; $indlst<$suppliersInd; $indlst+=1) {
      $suppliers[$indlst] = unserialize($json_result["suppliers"][$indlst]);
    }
    $resp = array('ingredient' => $ingredients, "nbingredient" => $ingredientsInd);
  }
  else {
    $resp = array('error' => 'Layer');
  }
}
 // Create Ingredient
if ($function == "c") {
  $viewSvcCall->setMethodName("Create");
  $manIngredientCreateViewData->setId(1);
  $manIngredientCreateViewData->setName("Hello !");
  $manIngredientCreateViewData->setIdSupplier(2);
  $viewSvcCall->addParameter("Data", serialize($manIngredientCreateViewData));
  list($outputok, $output, $json_result, $error) = $viewSvcCall->call();

  if ($outputok && sizeof($json_result) > 0) {
    $manIngredientCreateViewData = unserialize($json_result["ingredient"]);
    if ($manIngredientCreateViewData->getId() > 0) {
      $resp = array('ok' => "ok", "id" => $manIngredientCreateViewData->getId());
    }
    else {
      $resp = array('error' => 'Error');
    }
  }
  else {
    $resp = array('error' => 'Layer');
  }
}
if ($function == "rs" || $function == "rm") // Update Ingredient Status
{
  $manIngredientCreateViewData->setId(1);
  $manIngredientCreateViewData->setName("Hello !");
  $manIngredientCreateViewData->setIdSupplier(2);

  $viewSvcCall->setMethodName("Remove");
  if ($function == "rs") $viewSvcCall->setMethodName("Restore");
  $viewSvcCall->addParameter("lds", serialize($layerData));

  $genIdData = new GenIdData();
  $genIdData->setId($manIngredientCreateViewData->getId());
  $viewSvcCall->addParameter("Data", serialize($genIdData));
  list($outputok, $output, $json_result, $error) = $viewSvcCall->call();

  if ($outputok && sizeof($json_result) > 0) {
    $manIngredientListViewData = unserialize($json_result["ingredient"]);
    if ((($function == "rs" && $manIngredientListViewData->isAvailable())
     || ($function == "rm" && !$manIngredientListViewData->isAvailable()))
     && $manIngredientListViewData->getId() > 0) {
      $resp = array('ok' => "ok");
    }
    else {
      $resp = array('error' => 'Error');
    }
  }
  else {
    $resp = array('error' => 'Layer');
  }
}
if ($function == "f") // Find one element
{
  $manIngredientCreateViewData->setId(1);

  $manIngredientFindViewData = new ManIngredientFindViewData();
  $viewSvcCall->setMethodName("Find");
  $viewSvcCall->addParameter("lds", serialize($layerData));

  $genIdData = new GenIdData();
  $genIdData->setId($manIngredientCreateViewData->getId());
  $viewSvcCall->addParameter("Data", serialize($genIdData));
  list($outputok, $output, $json_result, $error) = $viewSvcCall->call();

  if ($outputok && sizeof($json_result) > 0) {
    $manIngredientFindViewData = unserialize($json_result["ingredient"]);
    print_r($manIngredientFindViewData);
    if ($manIngredientFindViewData->getId() > 0) {
      $resp = array('ok' => "ok", "id" => $manIngredientFindViewData->getId());
    }
    else {
      $resp = array('error' => 'Error');
    }
  }
  else {
    $resp = array('error' => 'Layer');
  }
}

if (sizeof($resp) == 0)
  $resp = array('err' => "f");

//echo json_encode($resp);
print_r($resp);
?>
