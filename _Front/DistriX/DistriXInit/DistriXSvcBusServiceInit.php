<?php // Needed to encode in UTF8 ààéàé //
include(__DIR__ . "/../DistriXSvc/Config/DistriXSvcAuthData.php");
include(__DIR__ . "/../DistriXSvc/Config/DistriXEnv.php");
include(__DIR__ . "/../DistriXSvc/Const/DistriXSvcConst.php");
include(__DIR__ . "/../DistriXSvc/Svc/DistriXSvcBase.php");
include(__DIR__ . "/../DistriXSvc/Data/DistriXSvcAppData.php");
include(__DIR__ . "/../DistriXSvc/Data/DistriXSvcErrorData.php");
include(__DIR__ . "/../DistriXSvc/Data/DistriXSvcLayerData.php");
include(__DIR__ . "/../DistriXSvc/DistriXSvcUtil.php");
include(__DIR__ . "/../DistriXSvc/Svc/DistriXSvcCaller.php");
include(__DIR__ . "/../DistriXSvc/Svc/DistriXSvcBusService.php");
include(__DIR__ . "/../DistriXSvc/Svc/DistriXSvc.php");
include(__DIR__ . "/../DistriXSvc/Data/DistriXSvcData.php");

$busSvc    = new DistriXSvcBusService();
$layerData = $busSvc->getLayerData();

if ($busSvc->getJsonCall()) {
  if ($busSvc->getParameter("layerData") != null) {
    $layerData->setData($busSvc->getParameter("layerData"));
  }
  $busSvc->setMethodName($busSvc->getParameter("function"));
}
$busSvc->startDebug();
