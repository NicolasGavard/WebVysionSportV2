<?php
session_start();

function writeContent($f, $isService = false)
{
  global $className, $dataFields, $dataFieldsInd;
  global $dataTypes, $generateFor, $hasArray;

  fputs($f, '<?php // Needed to encode in UTF8 ààéàé //' . "\r\n");
  fputs($f, 'if (! class_exists("' . $className . '", false)) {' . "\r\n");
  if ($generateFor == "P")
    fputs($f, '  class ' . $className . ' extends DistriXSvcAppData {' . "\r\n");
  else
    fputs($f, '  class ' . $className . ' extends DjangoSvcAppData {' . "\r\n");
  for ($i = 0; $i < $dataFieldsInd; $i++) {
    fputs($f, '    protected $' . $dataFields[$i]["up"] . ';' . "\r\n");
  }
  if ($generateFor == "D") {
    if ($hasArray)
      fputs($f, '    const HAS_ARRAY = true;' . "\r\n");
    else
      fputs($f, '    const HAS_ARRAY = false;' . "\r\n");
  }
  fputs($f, "\r\n");
  fputs($f, '    public function __construct() {' . "\r\n");
  if ($generateFor == "D")
    fputs($f, '      parent::__construct(self::HAS_ARRAY);' . "\r\n");

  for ($i = 0; $i < $dataFieldsInd; $i++) {
    fputs($f, '      $this->' . $dataFields[$i]["up"] . ' = ');
    if ($dataTypes[$i]["up"] == "array") fputs($f, '[];');
    if ($dataTypes[$i]["up"] == "bool") fputs($f, 'false;');
    if ($dataTypes[$i]["up"] == "float") fputs($f, '0.0;');
    if ($dataTypes[$i]["up"] == "int") fputs($f, '0;');
    if ($dataTypes[$i]["up"] == "object") fputs($f, 'null;');
    if ($dataTypes[$i]["up"] == "string") fputs($f, '"";');
    fputs($f, "\r\n");
  }
  fputs($f, '    }' . "\r\n");
  fputs($f, '// Gets' . "\r\n");
  for ($i = 0; $i < $dataFieldsInd; $i++) {
    fputs($f, '    public function get' . ucfirst($dataFields[$i]["up"]) . '()');
    if ($dataTypes[$i]["up"] != "object") fputs($f, ':' . $dataTypes[$i]["up"]);
    fputs($f, ' { return $this->' . $dataFields[$i]["up"] . '; }' . "\r\n");
  }
  fputs($f, "\r\n");
  fputs($f, '// Sets' . "\r\n");
  for ($i = 0; $i < $dataFieldsInd; $i++) {
    fputs($f, '    public function set' . ucfirst($dataFields[$i]["up"]) . '(');
    if ($dataTypes[$i]["up"] != "object") fputs($f, $dataTypes[$i]["up"] . ' ');
    fputs($f, '$' . $dataFields[$i]["up"] . ')');
    fputs($f, ' { $this->' . $dataFields[$i]["up"] . ' = $' . $dataFields[$i]["up"] . '; }' . "\r\n");
  }
  fputs($f, '  }' . "\r\n");
  fputs($f, '  // End of class' . "\r\n");
  fputs($f, '}' . "\r\n");
  fputs($f, '// class_exists' . "\r\n");
  fputs($f, '?>' . "\r\n");
}

// print_r($_POST);
$generateFor = "P";
$hasArray = false;
$dataFields = [];
$dataFieldsInd = 0;
$tempDataObjectFields = [];
$tempDataObjectFieldsInd = 0;
$dataTypes = [];
$dataTypesInd = 0;
$tempDataObjectTypes = [];
$tempDataObjectTypesInd = 0;
$dataObjectName = $dataObjectDirectory = $filename = "";
$listData = $detailData = 0;
$resp = [];

if (@$_POST["gfor"]) $generateFor = $_POST["gfor"];
if (@$_POST["hasA"]) $hasArray = true;
if (@$_POST["don"]) $dataObjectName = $_POST["don"];
if (@$_POST["dod"]) $dataObjectDirectory = $_POST["dod"];
if (@$_POST["df"]) $tempDataObjectFields = $_POST["df"];
$tempDataObjectFieldsInd = count($tempDataObjectFields);
for ($indt = 0; $indt < $tempDataObjectFieldsInd; $indt++) {
  if (strlen($tempDataObjectFields[$indt]) > 0 && $tempDataObjectFields[$indt] != "\n")
    $dataFields[$indt]["up"] = lcfirst($tempDataObjectFields[$indt]);
}
// print_r($dataFields);
$dataFieldsInd = count($dataFields);

if (@$_POST["dt"]) $tempDataObjectTypes = $_POST["dt"];
$tempDataObjectTypesInd = count($tempDataObjectTypes);
for ($indt = 0; $indt < $tempDataObjectTypesInd; $indt++) {
  if (isset($dataFields[$indt]) && strlen($tempDataObjectTypes[$indt]) > 0 && $tempDataObjectTypes[$indt] != "\n")
    $dataTypes[$indt]["up"] = lcfirst($tempDataObjectTypes[$indt]);
}
$dataTypesInd = count($dataTypes);

if ($dataFieldsInd > 0 && $dataTypesInd == $dataFieldsInd) {
  if (strlen($dataObjectDirectory) > 0) {
    if (substr($dataObjectDirectory, strlen($dataObjectDirectory) - 1) != '\\') $dataObjectDirectory .= '\\';

    $className = ucfirst($dataObjectName);
    $filename = $dataObjectDirectory . $className . ".php";

    $f = fopen($filename, 'w');
    if ($f !== FALSE) {
      writeContent($f, false);
      fclose($f);
    } else {
      $resp = array("errorfile" => "The file $filename cannot be opened !");
    }
    $resp["filename"] = $filename;
  } else {
    $resp = array("error" => "no filename");
  }
} else {
  $resp = array("error" => "no field");
}
echo json_encode($resp);
