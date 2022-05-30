<?php
include("../DistriXInit/DistriXSvcBusServiceInit.php");
// Error
// include("../data/ApplicationErrorData.php");
// Layers
include(__DIR__ . "/../../Layers/DistriXStySvcCaller.php");
// Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../../Data/DistriXStyEnterprisePosData.php");
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../../Data/DistriXStyUserEnterpriseData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRightsData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRolesData.php");

// Data Svc
$styServicesCaller = new DistriXStySvcCaller();

// Login
if ($busSvc->getMethodName() == "Login") {
  $enterprisesData = [];
  $enterprisesPos  = [];
  $infoSession     = new DistriXStyInfoSessionData();
  $userRights      = [];
  $userRoles       = [];
  $userEnterprises = [];

  $data = $busSvc->getParameter("data");

  if ($data != null) {
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("Login");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyLoginDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();
    // echo " Security BUS Svc-$outputok--------<br><br>";
    // echo " Security BUS Svc-" . print_r($output, true) . "<br><br>";
    // echo " Security BUS Svc Error -" . print_r($errorData, true) . "<br><br>";

    if ($outputok && is_array($output) && isset($output["StyInfoSession"])) {
      list($infoSession, $jsonError) = DistriXStyInfoSessionData::getJsonData($output["StyInfoSession"]);

      if ($infoSession->getIdUser() > 0) {
        $svc = new DistriXSvc();

        $styServicesCaller->addParameter("data", $data);
        $styServicesCaller->addParameter("infoSession", $infoSession);
        $styServicesCaller->setMethodName("FindByApplicationCode");
        $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightFindByUserDataSvc.php");
        $svc->addToCall("Rights", $styServicesCaller);

        $styRolesCaller = new DistriXStySvcCaller();
        $styRolesCaller->addParameter("infoSession", $infoSession);
        $styRolesCaller->setMethodName("FindByApplicationCode");
        $styRolesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleFindByUserDataSvc.php");
        $svc->addToCall("Roles", $styRolesCaller);

        $styEnterprisesCaller = new DistriXStySvcCaller();
        $styEnterprisesCaller->addParameter("infoSession", $infoSession);
        $styEnterprisesCaller->setMethodName("FindByUser");
        $styEnterprisesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterprisesListDataSvc.php");
        $svc->addToCall("Enterprises", $styEnterprisesCaller);

        $callsOk = $svc->call();

        list($outputok, $output, $errorData) = $svc->getResult("Rights");
        // echo " Security Rights Svc-$outputok--------<br><br>";
        // echo " Security Rights Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Rights Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output) && isset($output["StyUserRights"])) {
          list($userRights, $jsonError) =  DistriXStyUserRightsData::getJsonArray($output["StyUserRights"]);
        }

        list($outputok, $output, $errorData) = $svc->getResult("Roles");
        // echo " Security Roles Svc-$outputok--------<br><br>";
        // echo " Security Roles Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Roles Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output) && isset($output["StyUserRoles"])) {
          list($userRoles, $jsonError) =  DistriXStyUserRolesData::getJsonArray($output["StyUserRoles"]);
          $infoSession->setRoles($userRoles);
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
      }
    }
  }
  $busSvc->addToResponse("StyInfoSession", $infoSession);
  $busSvc->addToResponse("StyUserRights", $userRights);
  $busSvc->addToResponse("StyUserRoles", $userRoles);
  $busSvc->addToResponse("StyUserEnterprises", $userEnterprises);
  $busSvc->addToResponse("StyEnterprises", $enterprisesData);
  $busSvc->addToResponse("StyEnterprisePos", $enterprisesPos);
}
$busSvc->endOfService();
