<?php
    $busService = '//--------  Bus Service  --------'."\r\n";
  if ($serviceName != "Remove" && $serviceName != "Restore")
    $busService.= 'if ($busMethodName == "'.$serviceName.'") {'."\r\n";
  else
    $busService.= 'if ($busMethodName == "Remove" || $busMethodName == "Restore") {'."\r\n";// List

// List
  if ($serviceName == "List") {
    $busService.= '  $'.lcfirst($serviceElementName).'sInd = 0;'."\r\n";
    $busService.= '  $'.lcfirst($serviceElementName).'sView = array(); $'.lcfirst($serviceElementName).'sViewInd = 0;'."\r\n";
    $busService.= '  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();'."\r\n";
    $busService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $busService.= '    $'.lcfirst($serviceElementName).'sInd = $json_result["nb'.lcfirst($serviceElementName).'"];'."\r\n";
    $busService.= '    for ($indg=0; $indg<$'.lcfirst($serviceElementName).'sInd; $indg+=1) {'."\r\n";
    $busService.= '      $'.lcfirst($serviceElementName).' = unserialize($json_result["'.lcfirst($serviceElementName).'s"][$indg]);'."\r\n";
    $busService.= '      $'.lcfirst($globalNameUp).'ViewData = new '.$globalNameUp.'ViewData();'."\r\n";

    for ($i=0; $i < $svcFieldsInd; $i++) {
      $busService.= '      $'.lcfirst($globalNameUp).'ViewData->set'.ucfirst($svcFields[$i]["up"]).'(';
      $busService.= '$'.lcfirst($serviceElementName).'->get'.ucfirst($svcFields[$i]["up"]).'());'."\r\n";
    }
    $busService.= '      $'.lcfirst($serviceElementName).'sView[$'.lcfirst($serviceElementName).'sViewInd] = $'.lcfirst($globalNameUp).'ViewData;'."\r\n";
    $busService.= '      $'.lcfirst($serviceElementName).'sViewInd++;'."\r\n";
    $busService.= '    }'."\r\n";
    $busService.= '    if (isset($json_result["debug"])) $debugBusBuffer = $json_result["debug"];'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  else {'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $'.lcfirst($serviceElementName).'sSer = array();'."\r\n";
    $busService.= '  for ($indLst=0;$indLst<$'.lcfirst($serviceElementName).'sViewInd;$indLst+=1) {'."\r\n";
    $busService.= '    $'.lcfirst($serviceElementName).'sSer[$indLst] = serialize($'.lcfirst($serviceElementName).'sView[$indLst]);'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $respBus = array("'.lcfirst($serviceElementName).'s" => $'.lcfirst($serviceElementName).'sSer,';
    $busService.= ' "nb'.lcfirst($serviceElementName).'" => $indLst,'."\r\n";
    $busService.= '                   "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Create
  if ($serviceName == "Create") {
    $busService.= '  $'.lcfirst($globalNameUp).'ViewData = new '.$globalNameUp.'ViewData();'."\r\n";
    $busService.= '  if (@$_POST["Data"]) $'.lcfirst($globalNameUp).'ViewData = unserialize($_POST["Data"]);'."\r\n";
    $busService.= '  if ($inLocalMode && isset($busParameters["Data"])) {'."\r\n";
    $busService.= '    $'.lcfirst($globalNameUp).'ViewData = unserialize($busParameters["Data"]);'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $'.lcfirst($nameForDataData).'DetailDataData = new '.$nameForDataData.'DetailDataData();'."\r\n";

    for ($i=0; $i < $svcFieldsInd; $i++) {
      $busService.= '  $'.lcfirst($nameForDataData).'DetailDataData->set'.ucfirst($svcFields[$i]["up"]).'(';
      $busService.= '$'.lcfirst($globalNameUp).'ViewData->get'.ucfirst($svcFields[$i]["up"]).'());'."\r\n";
    }
    $busService.= '  $dataSvcCall->addParameter("Data", serialize($'.lcfirst($nameForDataData).'DetailDataData));'."\r\n";
    $busService.= '  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();'."\r\n";
    $busService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $busService.= '    $'.lcfirst($nameForDataData).'DetailDataData = unserialize($json_result["'.lcfirst($serviceElementName).'"]);'."\r\n";
    $busService.= '    $'.lcfirst($globalNameUp).'ViewData->setId($'.lcfirst($nameForDataData).'DetailDataData->getId());'."\r\n";
    $busService.= '    if (isset($json_result["debug"])) $debugBusBuffer = $json_result["debug"];'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  else {'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $'.lcfirst($serviceElementName).'Ser = serialize($'.lcfirst($globalNameUp).'ViewData);'."\r\n";
    $busService.= '  $respBus = array("'.lcfirst($serviceElementName).'" => $'.lcfirst($serviceElementName).'Ser,'."\r\n";
    $busService.= '                   "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Remove and Restore
  if ($serviceName == "Remove" || $serviceName == "Restore") {
    $busService.= '  $'.lcfirst($nameForDataData).'ListViewData = new '.$nameForDataData.'ListViewData();'."\r\n";
    $busService.= '  $genIdData = serialize(new GenIdData());'."\r\n";
    $busService.= '  if(@$_POST["Data"]) $genIdData = $_POST["Data"];'."\r\n";
    $busService.= '  if ($inLocalMode && isset($busParameters["Data"])) {'."\r\n";
    $busService.= '    $genIdData = $busParameters["Data"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $dataSvcCall->addParameter("Data", $genIdData);'."\r\n";
    $busService.= '  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();'."\r\n";
    $busService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $busService.= '    $'.lcfirst($nameForDataData).'ListDataData = unserialize($json_result["'.lcfirst($serviceElementName).'"]);'."\r\n";
    $busService.= '    $'.lcfirst($nameForDataData).'ListViewData->setId($'.lcfirst($nameForDataData).'ListDataData->getId());'."\r\n";
    $busService.= '    $'.lcfirst($nameForDataData).'ListViewData->setStatus($'.lcfirst($nameForDataData).'ListDataData->getStatus());'."\r\n";
    $busService.= '    $'.lcfirst($nameForDataData).'ListViewData->setAvailableValue($'.lcfirst($nameForDataData).'ListDataData->getAvailableValue());'."\r\n";
    $busService.= '    $'.lcfirst($nameForDataData).'ListViewData->setUnavailableValue($'.lcfirst($nameForDataData).'ListDataData->getUnavailableValue());'."\r\n";
    $busService.= '    if (isset($json_result["debug"])) $debugBusBuffer = $json_result["debug"];'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  else {'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $'.lcfirst($serviceElementName).'Ser = serialize($'.lcfirst($nameForDataData).'ListViewData);'."\r\n";
    $busService.= '  $respBus = array("'.lcfirst($serviceElementName).'" => $'.lcfirst($serviceElementName).'Ser,'."\r\n";
    $busService.= '                   "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Find
  if ($serviceName == "Find") {
    $busService.= '  $'.lcfirst($globalNameUp).'ViewData = new '.$globalNameUp.'ViewData();'."\r\n";
    $busService.= '  $genIdData = serialize(new GenIdData());'."\r\n";
    $busService.= '  if(@$_POST["Data"]) $genIdData = $_POST["Data"];'."\r\n";
    $busService.= '  if ($inLocalMode && isset($busParameters["Data"])) {'."\r\n";
    $busService.= '    $genIdData = $busParameters["Data"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $dataSvcCall->addParameter("Data", $genIdData);'."\r\n";
    $busService.= '  list($outputok, $output, $json_result, $error) = $dataSvcCall->call();'."\r\n";
    $busService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $busService.= '    $'.lcfirst($nameForDataData).'DetailDataData = unserialize($json_result["'.lcfirst($serviceElementName).'"]);'."\r\n";
    for ($i=0; $i < $svcFieldsInd; $i++) {
      $busService.= '    $'.lcfirst($globalNameUp).'ViewData->set'.ucfirst($svcFields[$i]["up"]).'(';
      $busService.= '$'.lcfirst($nameForDataData).'DetailDataData->get'.ucfirst($svcFields[$i]["up"]).'());'."\r\n";
    }
    $busService.= '    if (isset($json_result["debug"])) $debugBusBuffer = $json_result["debug"];'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  else {'."\r\n";
    $busService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $busService.= '  }'."\r\n";
    $busService.= '  $'.lcfirst($serviceElementName).'Ser = serialize($'.lcfirst($globalNameUp).'ViewData);'."\r\n";
    $busService.= '  $respBus = array("'.lcfirst($serviceElementName).'" => $'.lcfirst($serviceElementName).'Ser,'."\r\n";
    $busService.= '                   "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Close if ($busMethodName ==
  $busService.= '}'."\r\n";
?>
