<?php // Needed to encode in UTF8 ààéàé //
// Constants
include(__DIR__ . "/../Const/DistriXStyRightConst.php");
// Data
include(__DIR__ . "/../Data/DistriXStyUserRightsData.php");

class DistriXStyRight
{
  public static function isRightConnected(string $application, string $module, string $functionality): bool
  {
    $isRightConnected = false;
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      $userData  = unserialize($_SESSION["DistriXSvcSecurity"]["StyUser"]);
      $isRightConnected = ($userData->getConnected());
    }
    if ($isRightConnected) {
      $isRightConnected = self::hasAnyRightInternal($application, $module, $functionality);
    }
    return $isRightConnected;
  }
  public static function hasRightConnected(int $right, string $application, string $module, string $functionality): bool
  {
    $hasRightConnected = false;
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      $userData  = unserialize($_SESSION["DistriXSvcSecurity"]["StyUser"]);
      $hasRightConnected = ($userData->getConnected());
    }
    if ($hasRightConnected) {
      $hasRightConnected = self::hasRightInternal($right, $application, $module, $functionality);
    }
    return $hasRightConnected;
  }

  private static function hasRightInternal(int $right, string $app, string $module, string $functionality): bool
  {
    $hasRight = false;
    if ($right > 0 && $app != "" && isset($_SESSION["DistriXSvcSecurity"]["StyUserRights"])) {
      $userRights = unserialize($_SESSION["DistriXSvcSecurity"]["StyUserRights"]);
      $userRightsInd = 0;
      if (!empty($userRights)) {
        $userRightsInd = count($userRights);
      }
      for ($indR = 0; $indR < $userRightsInd && !$hasRight; $indR++) {
        $dataRight = $userRights[$indR];
        if (
          $dataRight->getApplicationCode() == $app &&
          ($dataRight->getModuleCode() == $module || $module == "") &&
          ($dataRight->getFunctionalityCode() == $functionality || $functionality == "")
        ) {
          $calc = $dataRight->getSumOfRights();
          //echo "#hasRight#@calc#$calc<br/>";
          //echo "#hasRight#@right recherche#$right<br/>";

          $hasRight = ($calc >= $right || $calc == STY_RIGHT_MANAGE);
          // les droits sont-ils assez élevés pour le droit recheché  or Full Power User ?
          if ($hasRight && $calc != STY_RIGHT_MANAGE) {
            $calc -= $right;
            //echo "hasRight#@calc - right #$calc<br/>";
            if ($calc == 0) {
              $hasRight = true; // Seulement un droit et celui recherché
            } else {
              $i = STY_RIGHT_MAX;
              while ($i >= STY_RIGHT_MIN) {
                if ($calc >= $i && $i != $right) { // Droit mixé avec d'autres droits ?
                  $calc -= $i;
                  //echo "hasRight#@type role#$i<br/>";
                  //echo "hasRight#@calc #$calc<br/>";
                }
                $i = $i / 2;
              }
            }
            $hasRight = ($calc == 0);
            //$hasRight = ($calc == 0)?1:0;
          }
        }
      }
    }
    return $hasRight;
  }
  // End of hasRight

  private static function hasAnyRightInternal(string $app, string $module, string $functionality): bool
  {
    $hasAnyRight = false;
    if ($app != "" && isset($_SESSION["DistriXSvcSecurity"]["StyUserRights"])) {
      $userRights = unserialize($_SESSION["DistriXSvcSecurity"]["StyUserRights"]);
      $userRightsInd = 0;
      if (!empty($userRights)) {
        $userRightsInd = count($userRights);
      }
      for ($indR = 0; $indR < $userRightsInd && !$hasAnyRight; $indR++) {
        $dataRight = $userRights[$indR];
        if (
          $dataRight->getApplicationCode() == $app &&
          ($dataRight->getModuleCode() == $module || $module == "") &&
          ($dataRight->getFunctionalityCode() == $functionality || $functionality == "")
        ) {
          $hasAnyRight = true;
        }
      }
    }
    return $hasAnyRight;
  }
  // End of hasAnyRight
}
