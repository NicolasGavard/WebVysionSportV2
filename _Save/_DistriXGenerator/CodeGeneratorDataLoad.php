<?php
session_start();

function writeContent($f, $isService = false)
{
  global $className, $dataFields, $dataFieldsInd;
  global $dataTypes;

  fputs($f, '<?php // Needed to encode in UTF8 ààéàé //' . "\r\n");
  fputs($f, 'if (! class_exists("' . $className . '", false)) {' . "\r\n");
  fputs($f, '  class ' . $className . ' extends PHP_D_SvcAppData {' . "\r\n");
  for ($i = 0; $i < $dataFieldsInd; $i++) {
    fputs($f, '    protected $' . $dataFields[$i]["up"] . ';' . "\r\n");
  }
  fputs($f, "\r\n");
  fputs($f, '    public function __construct() {' . "\r\n");
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

$dataObjectName = $dataObjectDirectory = $filename = "";
$fields = $types = [];
$resp = [];

if (@$_POST["don"]) $dataObjectName = $_POST["don"];
if (@$_POST["dod"]) $dataObjectDirectory = $_POST["dod"];

$className = ucfirst($dataObjectName);
$filename = "$dataObjectDirectory/$className.php";

$f = null;
if (file_exists($filename)) {
  $f = fopen($filename, 'r');
}
if ($f) {
  while ($line = fgets($f)) {
    $line = trim($line);
    $textThis = '$this->';
    if (stristr($line, $textThis) && (!stristr($line, 'get')) && (!stristr($line, 'set'))) {
      $lineField = substr($line, stripos($line, $textThis) + strlen($textThis));
      $equalPos = stripos($lineField, "=");
      $semicolonPos = stripos($lineField, ";");
      $fields[] = trim(substr($lineField, 0, $equalPos));
      $type = trim(substr($lineField, $equalPos + 1, ($semicolonPos - ($equalPos + 1))));
      if ($type == "[]") $type = "array";
      if ($type == "false") $type = "bool";
      if (strpos($type, "0.0") !== FALSE) $type = "float";
      if ($type == "0") $type = "int";
      if ($type == "null") $type = "object";
      if ($type == '""') $type = "string";
      $types[] = $type;
    }
  }
  $resp = array("fields" => $fields, "types" => $types);
} else {
  $resp = array("error" => "bad filename : $filename");
}
$resp["filename"] = $filename;
echo json_encode($resp);
