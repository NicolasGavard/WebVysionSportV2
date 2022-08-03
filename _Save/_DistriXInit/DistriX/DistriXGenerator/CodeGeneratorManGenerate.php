<?php session_start();
//print_r($_POST);

$svcFields = array(); $svcFieldsInd = 0;
$tempSvcFields = array(); $tempSvcFieldsInd = 0;
$serviceName = $appAcronym = $serviceElementName = $serviceViewDataDirectory = $serviceDataDataDirectory = "";
$listData = $detailData = 0;
$resp = array();
$statusField = "status";
$statusFieldBis = "statut";
$hasStatusField = false;

if (@$_POST["elemName"]) $elemName = $_POST["elemName"];

// if (@$_POST["fi"]) $tempSvcFields = explode("\n", $_POST["fi"]);
// $tempSvcFieldsInd = sizeof($tempSvcFields);
// for ($indt=0; $indt < $tempSvcFieldsInd; $indt++) { 
//   if(strlen($tempSvcFields[$indt]) > 0 && $tempSvcFields[$indt] != "\n")
//     $svcFields[$indt]["up"] = lcfirst($tempSvcFields[$indt]);
// }
// $svcFieldsInd = sizeof($svcFields);


for ($i=0; $i < $svcFieldsInd; $i++) {
  if (strtoupper($svcFields[$i]["up"]) == strtoupper($statusField)
   || strtoupper($svcFields[$i]["up"]) == strtoupper($statusFieldBis)) {
    $hasStatusField = true;
    $svcFields[$i]["up"] = $statusField;
    break;
  }
}

if ($svcFieldsInd > 0) {
  if  (strlen($serviceViewDataDirectory) > 0) {
    if (substr($serviceViewDataDirectory, strlen($serviceViewDataDirectory) -1) != '\\') $serviceViewDataDirectory .= '\\';
    $className = $appAcronym.ucfirst($serviceElementName).$serviceName."ViewData";
    $filename = $serviceViewDataDirectory.$className.".php";
    createDataObject($filename, $className, $svcFields, $svcFieldsInd, $hasStatusField);
  }
  if  (strlen($serviceDataDataDirectory) > 0) {
    if (substr($serviceDataDataDirectory, strlen($serviceDataDataDirectory) -1) != '\\') $serviceDataDataDirectory .= '\\';
    if ($listData > 0) {
      $className = $appAcronym.ucfirst($serviceElementName)."ListDataData";
      $filename = $serviceDataDataDirectory.$className.".php";
      createDataObject($filename, $className, $svcFields, $svcFieldsInd, $hasStatusField);
    }
    if ($detailData > 0) {
      $className = $appAcronym.ucfirst($serviceElementName)."DetailDataData";
      $filename = $serviceDataDataDirectory.$className.".php";
      createDataObject($filename, $className, $svcFields, $svcFieldsInd, $hasStatusField);
    }
  }
  $globalNameUp = ucfirst($appAcronym).ucfirst($serviceElementName).ucfirst($serviceName);
  $nameForDataData = ucfirst($appAcronym).ucfirst($serviceElementName);

  include("CodeGeneratorManGeneratePhp.php");

  $resp = array("responseText" => "it's allright !");
}
else {
  $resp = array("error" => "no field");
}
echo json_encode($resp);
?>
