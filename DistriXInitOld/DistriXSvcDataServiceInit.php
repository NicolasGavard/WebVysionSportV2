<?php // Needed to encode in UTF8 ààéàé //
include("Svc/DistriXSvcDataService.php");

$dataSvc   = new DistriXSvcDataService();
$layerData = $dataSvc->getLayerData();

if ($dataSvc->getJsonCall()) {
  if ($dataSvc->getParameter("layerData") != null) {
    $layerData->setData($dataSvc->getParameter("layerData"));
  }
  $dataSvc->setMethodName($dataSvc->getParameter("function"));
}
