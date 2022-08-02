<?php // Needed to encode in UTF8 ààéàé //
$globalServices = null;
try {
  include(__DIR__ . "/Config/DistriXSvcAuthData.php");
  include(__DIR__ . "/Config/DistriXEnv.php");
  include(__DIR__ . "/Const/DistriXSvcConst.php");
  include(__DIR__ . "/Data/DistriXSvcAppData.php");
  include(__DIR__ . "/Data/DistriXSvcData.php");
  include(__DIR__ . "/Data/DistriXSvcErrorData.php");
  include(__DIR__ . "/Data/DistriXSvcLayerData.php");
  include(__DIR__ . "/Svc/DistriXSvc.php");
  include(__DIR__ . "/Svc/DistriXSvcBase.php");
  include(__DIR__ . "/Svc/DistriXSvcBusService.php");
  include(__DIR__ . "/Svc/DistriXSvcCaller.php");
  include(__DIR__ . "/Svc/DistriXSvcController.php");
  include(__DIR__ . "/Svc/DistriXSvcDataService.php");
  include(__DIR__ . "/DistriXSvcUtil.php");
  include(__DIR__ . "/../DistriXApiToken/Data/DistriXApiTokenData.php");

  $globalServices = new DistriXSvcBase();

  if ($globalServices->isAuthorized()) {
    // file_exists()
    // if (is_readable(DISTRIX_SVC_SERVICE_LEVEL . $globalServices->getServiceName())) {
    // echo "<br/>" . DISTRIX_SVC_SERVICE_LEVEL . $globalServices->getServiceName() . "<br/>";
    $serviceLevel = DISTRIX_SVC_SERVICE_LEVEL;
    $internalName = "DistriX";
    if (substr($globalServices->getServiceName(), 0, strlen($internalName)) == $internalName) {
      $serviceLevel = DISTRIX_INTERNAL_SVC_SERVICE_LEVEL;
    }
    if (file_exists($serviceLevel . $globalServices->getServiceName())) {
      include($serviceLevel . $globalServices->getServiceName());
    } else {
      $error = new DistriXSvcErrorData();
      $error->setTypeSystem();
      $error->setSeverityCritical();
      $error->setCode("Service");
      $error->setTextToAllText("Service unavailable - " . $serviceLevel . $globalServices->getServiceName());
      $error->setFileName($globalServices->getServiceName());
      $globalServices->addErrorToResponse($error);
      $globalServices->endOfBaseService("");
    }
  }
} catch (ErrorException $e) {
  $error = new DistriXSvcErrorData();
  $error->setTypeSystem();
  $error->setSeverityCritical();
  $error->setCode($e->getCode());
  $error->setTextToAllText($e->getMessage());
  $error->setParameters($e->getTrace());
  $error->setFileName($e->getFile() . ", line " . $e->getLine());
  if ($globalServices != null) {
    $globalServices->addErrorToResponse($error);
    $globalServices->endOfBaseService("");
  } else {
    print_r($error);
  }
}
