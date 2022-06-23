<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodNovaScoreData.php");

$listNovaScores = [];
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("App/Food/NovaScore/Services/DistriXFoodNovaScoreListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

$logOk = logController("Security_NovaScore", "DistriXNovaScoreListDataSvc", "ListNovaScores", $output);

if ($outputok && isset($output["ListNovaScores"]) && is_array($output["ListNovaScores"])) {
  list($listNovaScores, $jsonError) = DistriXFoodNovaScoreData::getJsonArray($output["ListNovaScores"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListNovaScores"]   = $listNovaScores;

echo json_encode($resp);