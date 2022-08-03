<?php
  $dataService = '//--------  Data Service  --------'."\r\n";
  if ($serviceName != "Remove" && $serviceName != "Restore")
    $dataService.= 'if ($dataMethodName == "'.$serviceName.'") {'."\r\n";
  else
    $dataService.= 'if ($dataMethodName == "Remove" || $dataMethodName == "Restore") {'."\r\n";
// List
  if ($serviceName == "List") {
    $dataService.= '  $databasefile = "db/Infodbent.php";'."\r\n";
    $dataService.= '  $dbConnection = null;'."\r\n";
    $dataService.= '  $errortxt = "";'."\r\n";
    $dataService.= '  $error = false;'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'s = array(); $'.lcfirst($serviceElementName).'sInd = 0;'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'sData = array(); $'.lcfirst($serviceElementName).'sDataInd = 0;'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '  $connect = new StorPDOConnection($databasefile);'."\r\n";
    $dataService.= '  list($dbConnection, $error, $errortxt) = $connect->openConnection();'."\r\n";
    $dataService.= '  if ($dbConnection != null) {'."\r\n";
    $dataService.= '    $stor = new '.ucfirst($serviceElementName).'Stor($databasefile);'."\r\n";
    $dataService.= '    list($'.lcfirst($serviceElementName).'s, $'.lcfirst($serviceElementName).'sInd) = $stor->getList(true, $dbConnection);'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '    for ($indg=0; $indg < $'.lcfirst($serviceElementName).'sInd; $indg++) { '."\r\n";
    $dataService.= '      $'.lcfirst($globalNameUp).'DataData = new '.$globalNameUp.'DataData();'."\r\n";
    for ($i=0; $i < $svcFieldsInd; $i++) {
      $dataService.= '      $'.lcfirst($globalNameUp).'DataData->set'.ucfirst($svcFields[$i]["up"]).'(';
      $dataService.= '$'.lcfirst($serviceElementName).'s[$indg]->get'.ucfirst($serviceElementName).'StorData()';
      $dataService.= '->get'.ucfirst($svcFields[$i]["up"]).'());'."\r\n";
    }
    $dataService.= '      $'.lcfirst($serviceElementName).'sData[$'.lcfirst($serviceElementName).'sDataInd] = $'.lcfirst($globalNameUp).'DataData;'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'sDataInd++;'."\r\n";
    $dataService.= '    }'."\r\n";
    $dataService.= '    $'.lcfirst($serviceElementName).'sSer = array();'."\r\n";
    $dataService.= '    for ($indLst=0;$indLst<$'.lcfirst($serviceElementName).'sDataInd;$indLst+=1) {'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'sSer[$indLst] = serialize($'.lcfirst($serviceElementName).'sData[$indLst]);'."\r\n";
    $dataService.= '    }'."\r\n";
    $dataService.= '    $respData = array("'.lcfirst($serviceElementName).'s" => $'.lcfirst($serviceElementName).'sSer,';
    $dataService.= ' "nb'.lcfirst($serviceElementName).'" => $indLst);'."\r\n";
    $dataService.= '  }'."\r\n";
  }
// Create
  if ($serviceName == "Create") {
    $dataService.= '  $'.lcfirst($nameForDataData).'DetailDataData = new '.ucfirst($nameForDataData).'DetailDataData();'."\r\n";
    $dataService.= '  if (@$_POST["Data"]) $'.lcfirst($nameForDataData).'DetailDataData = unserialize($_POST["Data"]);'."\r\n";
    $dataService.= '  if ($inLocalMode && isset($dataParameters["Data"])) {'."\r\n";
    $dataService.= '    $'.lcfirst($nameForDataData).'DetailDataData = unserialize($dataParameters["Data"]);'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'StorData = new '.ucfirst($serviceElementName).'StorData();'."\r\n";
    for ($i=0; $i < $svcFieldsInd; $i++) {
      $dataService.= '  $'.lcfirst($serviceElementName).'StorData->set'.ucfirst($svcFields[$i]["up"]).'(';
      $dataService.= '$'.lcfirst($nameForDataData).'DetailDataData->get'.ucfirst($svcFields[$i]["up"]).'());'."\r\n";
    }
    $dataService.= "\r\n";
    $dataService.= '  $databasefile = "db/Infodbent.php";'."\r\n";
    $dataService.= '  $dbConnection = null;'."\r\n";
    $dataService.= '  $errortxt = "";'."\r\n";
    $dataService.= '  $error = false;'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '  $connect = new StorPDOConnection($databasefile);'."\r\n";
    $dataService.= '  list($dbConnection, $error, $errortxt) = $connect->openConnection();'."\r\n";
    $dataService.= '  if ($dbConnection != null) {'."\r\n";
    $dataService.= '    if ($dbConnection->beginTransaction()) {'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setAvailable();'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setIdUserCreate($layerDataData->getIdUser());'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setDateCreate(getCurrentNumDate());'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setTimeCreate(getCurrentNumTime());'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'Stor = new '.ucfirst($serviceElementName).'Stor($databasefile);'."\r\n";
    $dataService.= '      list($insere, $id'.lcfirst($serviceElementName).') = ';
    $dataService.= '$'.lcfirst($serviceElementName).'Stor->create($'.lcfirst($serviceElementName).'StorData, $dbConnection);'."\r\n";
    $dataService.= '      if ($insere) {'."\r\n";
    $dataService.= '        $'.lcfirst($nameForDataData).'DetailDataData->setId($id'.lcfirst($serviceElementName).');'."\r\n";
    $dataService.= '        $dbConnection->commit();'."\r\n";
    $dataService.= '        $respData = array(\'ok\' => "ok");'."\r\n";
    $dataService.= '      }'."\r\n";
    $dataService.= '      else { //echo "<br/><br/>rollback.$request..<br/><br/>";'."\r\n";
    $dataService.= '        $dbConnection->rollBack();'."\r\n";
    $dataService.= '        $respData = array(\'error\' => \'Rollback\');'."\r\n";
    $dataService.= '      }'."\r\n";
    $dataService.= '    }'."\r\n";
    $dataService.= '    else  {'."\r\n";
    $dataService.= '      $respData = array(\'error\' => \'transaction\');'."\r\n";
    $dataService.= '    }'."\r\n";
    $dataService.= '    $connect->closeConnection();'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  else {'."\r\n";
    $dataService.= '    $respData = array(\'error\' => \'connection\');'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'Ser = serialize($'.lcfirst($nameForDataData).'DetailDataData);'."\r\n";
    $dataService.= '  $respData["'.lcfirst($serviceElementName).'"] = $'.lcfirst($serviceElementName).'Ser;'."\r\n";
  }
// Remove and Restore
  if ($serviceName == "Remove" || $serviceName == "Restore") {
    $dataService.= '  $genIdData = new GenIdData();'."\r\n";
    $dataService.= '  if (@$_POST["Data"]) $genIdData = unserialize($_POST["Data"]);'."\r\n";
    $dataService.= '  if ($inLocalMode && isset($dataParameters["Data"])) {'."\r\n";
    $dataService.= '    $genIdData = unserialize($dataParameters["Data"]);'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'StorData = new '.ucfirst($serviceElementName).'StorData();'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'StorData->setId($genIdData->getId());'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '  $databasefile = "db/Infodbent.php";'."\r\n";
    $dataService.= '  $dbConnection = null;'."\r\n";
    $dataService.= '  $errortxt = "";'."\r\n";
    $dataService.= '  $error = false;'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '  $connect = new StorPDOConnection($databasefile);'."\r\n";
    $dataService.= '  list($dbConnection, $error, $errortxt) = $connect->openConnection();'."\r\n";
    $dataService.= '  if ($dbConnection != null) {'."\r\n";
    $dataService.= '    if ($dbConnection->beginTransaction()) {'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'Stor = new '.ucfirst($serviceElementName).'Stor();'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData = $'.lcfirst($serviceElementName).'Stor->read($';
    $dataService.= lcfirst($serviceElementName).'StorData->getId(), $dbConnection);'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setUnavailable(); // Removed'."\r\n";
    $dataService.= '      if ($dataMethodName == "Restore") $'.lcfirst($serviceElementName).'StorData->setAvailable(); // Restored'."\r\n";

    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setIdUserModif($layerDataData->getIdUser());'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setDateModif(getCurrentNumDate());'."\r\n";
    $dataService.= '      $'.lcfirst($serviceElementName).'StorData->setTimeModif(getCurrentNumTime());'."\r\n";
    $dataService.= '      $insere = $'.lcfirst($serviceElementName).'Stor->update($'.lcfirst($serviceElementName).'StorData, $dbConnection);'."\r\n";
    $dataService.= '      $'.lcfirst($nameForDataData).'ListDataData = new '.$nameForDataData.'ListDataData();'."\r\n";
    $dataService.= '      $'.lcfirst($nameForDataData).'ListDataData->setId($'.lcfirst($serviceElementName).'StorData->getId());'."\r\n";
    $dataService.= '      $'.lcfirst($nameForDataData).'ListDataData->setStatus($'.lcfirst($serviceElementName).'StorData->getStatus());'."\r\n";
    $dataService.= '      $'.lcfirst($nameForDataData).'ListDataData->setAvailableValue($'.lcfirst($serviceElementName).'StorData->getAvailableValue());'."\r\n";
    $dataService.= '      $'.lcfirst($nameForDataData).'ListDataData->setUnavailableValue($'.lcfirst($serviceElementName).'StorData->getUnavailableValue());'."\r\n";
    $dataService.= '      if ($insere) {'."\r\n";
    $dataService.= '        $dbConnection->commit();'."\r\n";
    $dataService.= '        $respData = array(\'ok\' => "ok");'."\r\n";
    $dataService.= '      }'."\r\n";
    $dataService.= '      else { //echo "<br/><br/>rollback.$request..<br/><br/>";'."\r\n";
    $dataService.= '        $dbConnection->rollBack();'."\r\n";
    $dataService.= '        $respData = array(\'error\' => \'Rollback\');'."\r\n";
    $dataService.= '      }'."\r\n";
    $dataService.= '    }'."\r\n";
    $dataService.= '    else  {'."\r\n";
    $dataService.= '      $respData = array(\'error\' => \'transaction\');'."\r\n";
    $dataService.= '    }'."\r\n";
    $dataService.= '    $connect->closeConnection();'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  else {'."\r\n";
    $dataService.= '    $respData = array(\'error\' => \'connection\');'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'Ser = serialize($'.lcfirst($nameForDataData).'ListDataData);'."\r\n";
    $dataService.= '  $respData["'.lcfirst($serviceElementName).'"] = $'.lcfirst($serviceElementName).'Ser;'."\r\n";
  }
// Find
  if ($serviceName == "Find") {
    $dataService.= '  $genIdData = new GenIdData();'."\r\n";
    $dataService.= '  $'.lcfirst($nameForDataData).'DetailDataData = new '.ucfirst($nameForDataData).'DetailDataData();'."\r\n";
    $dataService.= '  if (@$_POST["Data"]) $genIdData = unserialize($_POST["Data"]);'."\r\n";
    $dataService.= '  if ($inLocalMode && isset($dataParameters["Data"])) {'."\r\n";
    $dataService.= '    $genIdData = unserialize($dataParameters["Data"]);'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'StorData = new '.ucfirst($serviceElementName).'StorData();'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'StorData->setId($genIdData->getId());'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '  $databasefile = "db/Infodbent.php";'."\r\n";
    $dataService.= '  $dbConnection = null;'."\r\n";
    $dataService.= '  $errortxt = "";'."\r\n";
    $dataService.= '  $error = false;'."\r\n";
    $dataService.= "\r\n";
    $dataService.= '  $connect = new StorPDOConnection($databasefile);'."\r\n";
    $dataService.= '  list($dbConnection, $error, $errortxt) = $connect->openConnection();'."\r\n";
    $dataService.= '  if ($dbConnection != null) {'."\r\n";
    $dataService.= '    $'.lcfirst($serviceElementName).'Stor = new '.ucfirst($serviceElementName).'Stor();'."\r\n";
    $dataService.= '    $'.lcfirst($serviceElementName).'StorData = $'.lcfirst($serviceElementName).'Stor->read($';
    $dataService.= lcfirst($serviceElementName).'StorData->getId(), $dbConnection);'."\r\n";
    for ($i=0; $i < $svcFieldsInd; $i++) {
      $dataService.= '    $'.lcfirst($nameForDataData).'DetailDataData->set'.ucfirst($svcFields[$i]["up"]).'(';
      $dataService.= '$'.lcfirst($serviceElementName).'StorData->get'.ucfirst($svcFields[$i]["up"]).'());'."\r\n";
    }
    if ($hasStatusField) {
      $dataService.= '    $'.lcfirst($nameForDataData).'DetailDataData->setAvailableValue($'.lcfirst($serviceElementName).'StorData->getAvailableValue());'."\r\n";
      $dataService.= '    $'.lcfirst($nameForDataData).'DetailDataData->setUnavailableValue($'.lcfirst($serviceElementName).'StorData->getUnavailableValue());'."\r\n";
    }
    $dataService.= '    $connect->closeConnection();'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  else {'."\r\n";
    $dataService.= '    $respData = array(\'error\' => \'connection\');'."\r\n";
    $dataService.= '  }'."\r\n";
    $dataService.= '  $'.lcfirst($serviceElementName).'Ser = serialize($'.lcfirst($nameForDataData).'DetailDataData);'."\r\n";
    $dataService.= '  $respData["'.lcfirst($serviceElementName).'"] = $'.lcfirst($serviceElementName).'Ser;'."\r\n";
  }
// Close if ($dataMethodName ==
  $dataService.= '}'."\r\n";
?>
