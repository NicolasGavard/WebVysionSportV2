<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXStudentCoachUserData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp           = array();
$listMyStudents = array();
$error          = array();
$output         = array();
$outputok       = false;

$distriXStudentCoachUserData = new DistriXStudentCoachUserData();
$distriXStudentCoachUserData->setIdUserCoach($_POST['idUser']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListMyStudents");
$servicesCaller->setServiceName("DistriXServices/Student/DistriXStudentMyStudentsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXStudentCoachUserData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListMyStudents"])) {
    $listMyStudents = $output["ListMyStudents"];
  }
} else {
  $error = $errorData;
}

$resp["ListMyStudents"] = $listMyStudents;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);