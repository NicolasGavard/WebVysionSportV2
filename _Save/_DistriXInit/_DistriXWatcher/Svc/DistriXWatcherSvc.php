<?php
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// Data
include(__DIR__ . "/../Data/DistriXWatcherData.php");

list($data, $jsonError) = DistriXWatcherData::getJsonData($dataSvc->getParameter("Data"));

if (!is_null($data) && strlen($data->getFileToInclude()) > 0) {
  include(__DIR__ . "/" . $data->getFileToInclude());
  if (isset($returnValue)) {
    $dataSvc->addToResponse("Data", $returnValue);
  }
}
// Return response
$dataSvc->endOfService();
