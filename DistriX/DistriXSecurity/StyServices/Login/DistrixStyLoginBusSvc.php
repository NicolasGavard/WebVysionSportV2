<?php
include("../DistriXInit/DistriXSvcBusServiceInit.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// Layers
include(__DIR__ . "/../../Layers/DistriXStySvcCaller.php");
// Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../../Data/DistriXStyEnterprisePosData.php");
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/DistriXStyUserEnterpriseData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRightData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRightsData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRolesData.php");

// Data Svc
$styServicesCaller = new DistriXStySvcCaller();

// Login
if ($busSvc->getMethodName() == "Login") {
  $connected        = false;
  $enterprisesData  = [];
  $enterprisesPos   = [];
  $userRights       = [];
  $userRoles        = [];
  $userEnterprises  = [];
  $styGlobalSession = new DistriXStyInfoSessionData();
  $infoUser         = new DistriXStyUserData();
  
  $dataApp          = $busSvc->getParameter("dataApp");
  $dataUser         = $busSvc->getParameter("dataUser");
  list($dataAppBus, $errorJson) = DistriXStyApplicationData::getJsonData($dataApp);

  if ($dataApp != null && $dataUser != null)  {
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyLoginDataSvc.php");
    $styServicesCaller->setMethodName("Login");
    $styServicesCaller->addParameter("data", $dataUser);
    list($outputok, $output, $errorData) = $styServicesCaller->call();
    // echo " Security BUS Svc-$outputok--------<br><br>";
    // echo " Security DATA Svc-" . print_r($dataUser, true) . "<br><br>";
    // echo " Security BUS Svc-" . print_r($output, true) . "<br><br>";
    // echo " Security BUS Svc Error -" . print_r($errorData, true) . "<br><br>";

    if ($outputok && isset($output["StyInfoSession"]) && is_array($output["StyInfoSession"])) {
      list($infoUser, $errorJson) = DistriXStyUserData::getJsonData($output["StyInfoSession"]);
      if ($infoUser->getId() > 0) {
        $connected  = true;
        
        $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightFindByUserDataSvc.php");
        $styServicesCaller->addParameter("data", $dataApp);
        $styServicesCaller->addParameter("infoSession", $infoUser);
        
        $styRolesCaller = new DistriXStySvcCaller();
        $styRolesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleFindByUserDataSvc.php");
        $styRolesCaller->addParameter("data", $dataApp);
        $styRolesCaller->addParameter("infoSession", $infoUser);
        
        $styEnterprisesCaller = new DistriXStySvcCaller();
        $styEnterprisesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterpriseFindByUserDataSvc.php");
        $styEnterprisesCaller->addParameter("infoSession", $infoUser);
        
        $svc = new DistriXSvc();
        $svc->addToCall("Rights", $styServicesCaller);
        $svc->addToCall("Roles", $styRolesCaller);
        $svc->addToCall("Enterprises", $styEnterprisesCaller);
        $callsOk = $svc->call();

        list($outputok, $output, $errorData) = $svc->getResult("Rights");
        // echo " Security Rights Svc-$outputok--------<br><br>";
        // echo " Security Rights Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Rights Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output) && isset($output["StyUserRights"])) {
          $userRights = $output["StyUserRights"];
        }

        list($outputok, $output, $errorData) = $svc->getResult("Roles");
        // echo " Security Roles Svc-$outputok--------<br><br>";
        // echo " Security Roles Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Roles Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output) && isset($output["StyUserRoles"])) {
          $infoUser->setRoles($output["StyUserRoles"]);
          $userRoles = $output["StyUserRoles"];
        }

        list($outputok, $output, $errorData) = $svc->getResult("Enterprises");
        // echo " Security Enterprises Svc-$outputok--------<br><br>";
        // echo " Security Enterprises Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Enterprises Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output)) {
          if (isset($output["StyUserEnterprises"])) {
            $userEnterprises = $output["StyUserEnterprises"];
          }
          if (isset($output["StyEnterprises"])) {
            $enterprisesData = $output["StyEnterprises"];
          }
          if (isset($output["StyEnterprisePos"])) {
            $enterprisesPos = $output["StyEnterprisePos"];
          }
        }
        $styGlobalSession->setidUser($infoUser->getId());
        $styGlobalSession->setApplication($dataAppBus->getCode());
        $styGlobalSession->setConnected($connected);
        $styGlobalSession->setTimeConnected(date('His'));
      };
    }
  }
  $busSvc->addToResponse("StyGlobalSession", $styGlobalSession);
  $busSvc->addToResponse("StyInfoUser", $infoUser);
  $busSvc->addToResponse("StyUserRights", $userRights);
  $busSvc->addToResponse("StyUserRoles", $userRoles);
  $busSvc->addToResponse("StyUserEnterprises", $userEnterprises);
  $busSvc->addToResponse("StyEnterprises", $enterprisesData);
  $busSvc->addToResponse("StyEnterprisePos", $enterprisesPos);
}
$busSvc->endOfService();