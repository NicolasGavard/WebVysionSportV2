<?php
session_start();

function createDataObject($filename, $className, $svcFields, $svcFieldsInd, $hasStatusField) {
  global $statusField, $statusFieldBis;

  $f=fopen($filename, 'w');
  fputs($f,'<?php // Needed to encode in UTF8 ààéàé //'."\r\n");
  fputs($f,'if (! class_exists("'.$className.'", false)) {'."\r\n");
  fputs($f,'  class '.$className.' implements Serializable {'."\r\n");
  for ($i=0; $i < $svcFieldsInd; $i++) {
    fputs($f,'    private $'.$svcFields[$i]["up"].';'."\r\n");
  }
  fputs($f,"\r\n");
  fputs($f,'    public function __construct() {'."\r\n");
  for ($i=0; $i < $svcFieldsInd; $i++) {
    fputs($f,'      $this->'.$svcFields[$i]["up"].' = ');
    $pos = stripos($svcFields[$i]["up"], "id");
    if ($pos === false) $pos = stripos($svcFields[$i]["up"], "date");
    if ($pos === false) $pos = stripos($svcFields[$i]["up"], "time");
    if ($pos === false && $svcFields[$i]["up"] != $statusField && $svcFields[$i]["up"] != $statusFieldBis
     && $svcFields[$i]["up"] != "availableValue" && $svcFields[$i]["up"] != "unavailableValue") {
      fputs($f,'"";');
    } else fputs($f,'0;');
    fputs($f,"\r\n");
  }
  fputs($f,'    }'."\r\n");
  fputs($f,'// Gets'."\r\n");
  for ($i=0; $i < $svcFieldsInd; $i++) {
    fputs($f,'    public function get'.ucfirst($svcFields[$i]["up"]).'() { return $this->'.$svcFields[$i]["up"].'; }'."\r\n");
  }
  if ($hasStatusField) {
    fputs($f,'    public function isAvailable() { return ($this->status == $this->availableValue); }'."\r\n");
  }
  fputs($f,"\r\n");
  fputs($f,'// Sets'."\r\n");
  for ($i=0; $i < $svcFieldsInd; $i++) {
    fputs($f,'    public function set'.ucfirst($svcFields[$i]["up"]).'($'.$svcFields[$i]["up"].')');
    fputs($f,' { $this->'.$svcFields[$i]["up"].' = $'.$svcFields[$i]["up"].'; }'."\r\n");
  }
  fputs($f,"\r\n");
  fputs($f,'// Serialization'."\r\n");
  fputs($f,'    public function serialize() { '."\r\n");
  fputs($f,'      return serialize(array('."\r\n");
  for ($i=0; $i < $svcFieldsInd-1; $i++) {
    fputs($f,'        $this->'.$svcFields[$i]["up"].','."\r\n");
  }
  fputs($f,'        $this->'.$svcFields[$i]["up"]."\r\n");
  fputs($f,'      ));'."\r\n");
  fputs($f,'    }'."\r\n");


  fputs($f,'    public function unserialize($data) { '."\r\n");
  fputs($f,'      list('."\r\n");
  for ($i=0; $i < $svcFieldsInd-1; $i++) {
    fputs($f,'        $this->'.$svcFields[$i]["up"].','."\r\n");
  }
  fputs($f,'        $this->'.$svcFields[$i]["up"]."\r\n");
  fputs($f,'      ) = unserialize($data);'."\r\n");
  fputs($f,'    }'."\r\n");
  fputs($f,'  }'."\r\n");
  fputs($f,'  // End of class'."\r\n");
  fputs($f,'}'."\r\n");
  fputs($f,'// class_exists'."\r\n");
  fputs($f,'?>'."\r\n");
  fclose($f);
}

//print_r($_POST);

$svcFields = array(); $svcFieldsInd = 0;
$tempSvcFields = array(); $tempSvcFieldsInd = 0;
$serviceName = $appAcronym = $serviceElementName = $serviceViewDataDirectory = $serviceDataDataDirectory = "";
$listData = $detailData = 0;
$resp = array();
$statusField = "status";
$statusFieldBis = "statut";
$hasStatusField = false;

if (@$_POST["na"]) $serviceName = $_POST["na"];
if (@$_POST["ac"]) $appAcronym = $_POST["ac"];
if (@$_POST["el"]) $serviceElementName = $_POST["el"];
if (@$_POST["vd"]) $serviceViewDataDirectory  = $_POST["vd"];
if (@$_POST["cl"]) $listData = $_POST["cl"];
if (@$_POST["cd"]) $detailData = $_POST["cd"];
if (@$_POST["dd"]) $serviceDataDataDirectory = $_POST["dd"];
if (@$_POST["fi"]) $tempSvcFields = explode("\n", $_POST["fi"]);
$tempSvcFieldsInd = sizeof($tempSvcFields);
for ($indt=0; $indt < $tempSvcFieldsInd; $indt++) { 
  if(strlen($tempSvcFields[$indt]) > 0 && $tempSvcFields[$indt] != "\n")
    $svcFields[$indt]["up"] = lcfirst($tempSvcFields[$indt]);
}
$svcFieldsInd = sizeof($svcFields);


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

  $calls = "";
  $calls .= '--------  Call the View Service  --------'."\r\n";
  $calls .= '$viewSvcCall->setMethodName("'.$serviceName.'");'."\r\n";
  $calls .= '$viewSvcCall->setKindOfCallLocal();'."\r\n";
  $calls .= '$viewSvcCall->setServiceName("'.$appAcronym.ucfirst($serviceElementName).'ViewSvc.php");'."\r\n";
  $calls .= '$viewSvcCall->addParameter("lds", serialize($layerData));'."\r\n";
  $calls .= 'list($outputok, $output, $json_result, $error) = $viewSvcCall->call();'."\r\n";
  $calls .= '--------  Call the Bus Service  --------'."\r\n";
  $calls .= '$busSvcCall->setServiceName("'.$appAcronym.ucfirst($serviceElementName).'BusSvc.php");'."\r\n";
  $calls .= '$busSvcCall->setKindOfCallLocal();'."\r\n";
  $calls .= '$busSvcCall->setMethodName($viewMethodName);'."\r\n";
  $calls .= '$busSvcCall->addParameter("lds", serialize($layerViewData));'."\r\n";
  $calls .= '--------  Call the Data Service  --------'."\r\n";
  $calls .= '$dataSvcCall->setServiceName("'.$appAcronym.ucfirst($serviceElementName).'DataSvc.php");'."\r\n";
  $calls .= '$dataSvcCall->setKindOfCallLocal();'."\r\n";
  $calls .= '$dataSvcCall->setMethodName($busMethodName);'."\r\n";
  $calls .= '$dataSvcCall->addParameter("lds", serialize($layerBusData));'."\r\n";

  include("CodeGeneratorServicesGenerateView.php");
  include("CodeGeneratorServicesGenerateBus.php");
  include("CodeGeneratorServicesGenerateData.php");

  $resp = array("call" => $calls, "viewSvc" => $viewService, "busSvc" => $busService, "dataSvc" => $dataService);
}
else {
  $resp = array("error" => "no field");
}
echo json_encode($resp);
?>
