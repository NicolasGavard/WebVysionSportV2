<?php
  $viewService = "";
  $viewService .= '//--------  View Service  --------'."\r\n";
  if ($serviceName != "Remove" && $serviceName != "Restore")
    $viewService.= 'if ($viewMethodName == "'.$serviceName.'") {'."\r\n";
  else
    $viewService.= 'if ($viewMethodName == "Remove" || $viewMethodName == "Restore") {'."\r\n";// List
// List
  if ($serviceName == "List") {
    $viewService .= '  $'.lcfirst($serviceElementName).'sSer = serialize(array()); $'.lcfirst($serviceElementName).'sSerInd = 0;'."\r\n";
    $viewService.= '  list($outputok, $output, $json_result, $error) = $busSvcCall->call();'."\r\n";
    $viewService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $viewService.= '    $'.lcfirst($serviceElementName).'sSer = $json_result["'.lcfirst($serviceElementName).'s"];'."\r\n";
    $viewService.= '    $'.lcfirst($serviceElementName).'sSerInd = $json_result["nb'.lcfirst($serviceElementName).'"];'."\r\n";
    $viewService.= '    if (isset($json_result["debug"])) $debugViewBuffer = $json_result["debug"];'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  else {'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  $respView = array("'.lcfirst($serviceElementName).'s" => $'.lcfirst($serviceElementName).'sSer,';
    $viewService.= ' "nb'.lcfirst($serviceElementName).'" => $'.lcfirst($serviceElementName).'sSerInd, '."\r\n";
    $viewService.= '                    "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Create
  if ($serviceName == "Create") {
    $viewService.= '  $'.lcfirst($globalNameUp).'ViewData = serialize(new '.$globalNameUp.'ViewData());'."\r\n";
    $viewService.= '  if (@$_POST["Data"]) $'.lcfirst($globalNameUp).'ViewData = $_POST["Data"];'."\r\n";
    $viewService.= '  if ($inLocalMode && isset($viewParameters["Data"])) {'."\r\n";
    $viewService.= '    $'.lcfirst($globalNameUp).'ViewData = $viewParameters["Data"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  $busSvcCall->addParameter("Data", $'.lcfirst($globalNameUp).'ViewData);'."\r\n";
    $viewService.= '  $'.lcfirst($serviceElementName).'Ser = $'.lcfirst($globalNameUp).'ViewData;'."\r\n";
    $viewService.= '  list($outputok, $output, $json_result, $error) = $busSvcCall->call();'."\r\n";
    $viewService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $viewService.= '    $'.lcfirst($serviceElementName).'Ser = $json_result["'.lcfirst($serviceElementName).'"];'."\r\n";
    $viewService.= '    if (isset($json_result["debug"])) $debugViewBuffer = $json_result["debug"];'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  else {'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  $respView = array("'.lcfirst($serviceElementName).'" => $'.lcfirst($serviceElementName).'Ser,'."\r\n";
    $viewService.= '                    "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Remove and Restore
  if ($serviceName == "Remove" || $serviceName == "Restore") {
    $viewService.= '  $genIdData = serialize(new GenIdData());'."\r\n";
    $viewService.= '  if (@$_POST["Data"]) $genIdData = $_POST["Data"];'."\r\n";
    $viewService.= '  if ($inLocalMode && isset($viewParameters["Data"])) {'."\r\n";
    $viewService.= '    $genIdData = $viewParameters["Data"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  $busSvcCall->addParameter("Data", $genIdData);'."\r\n";
    $viewService.= '  $'.lcfirst($serviceElementName).'Ser = serialize(new '.ucfirst($nameForDataData).'ListViewData());'."\r\n";
    $viewService.= '  list($outputok, $output, $json_result, $error) = $busSvcCall->call();'."\r\n";
    $viewService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $viewService.= '    $'.lcfirst($serviceElementName).'Ser = $json_result["'.lcfirst($serviceElementName).'"];'."\r\n";
    $viewService.= '    if (isset($json_result["debug"])) $debugViewBuffer = $json_result["debug"];'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  else {'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  $respView = array("'.lcfirst($serviceElementName).'" => $'.lcfirst($serviceElementName).'Ser,'."\r\n";
    $viewService.= '                    "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Find
  if ($serviceName == "Find") {
    $viewService.= '  $genIdData = serialize(new GenIdData());'."\r\n";
    $viewService.= '  if (@$_POST["Data"]) $genIdData = $_POST["Data"];'."\r\n";
    $viewService.= '  if ($inLocalMode && isset($viewParameters["Data"])) {'."\r\n";
    $viewService.= '    $genIdData = $viewParameters["Data"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  $busSvcCall->addParameter("Data", $genIdData);'."\r\n";
    $viewService.= '  $'.lcfirst($serviceElementName).'Ser = serialize(new '.ucfirst($globalNameUp).'ViewData());'."\r\n";
    $viewService.= '  list($outputok, $output, $json_result, $error) = $busSvcCall->call();'."\r\n";
    $viewService.= '  if ($outputok && sizeof($json_result) > 0) {'."\r\n";
    $viewService.= '    $'.lcfirst($serviceElementName).'Ser = $json_result["'.lcfirst($serviceElementName).'"];'."\r\n";
    $viewService.= '    if (isset($json_result["debug"])) $debugViewBuffer = $json_result["debug"];'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  else {'."\r\n";
    $viewService.= '    if (isset($json_result["error"])) $error = $json_result["error"];'."\r\n";
    $viewService.= '  }'."\r\n";
    $viewService.= '  $respView = array("'.lcfirst($serviceElementName).'" => $'.lcfirst($serviceElementName).'Ser,'."\r\n";
    $viewService.= '                    "outputok" => $outputok, "error" => $error);'."\r\n";
  }
// Close if ($viewMethodName ==
  $viewService.= '}'."\r\n";
  $viewService.= "\r\n";
?>
