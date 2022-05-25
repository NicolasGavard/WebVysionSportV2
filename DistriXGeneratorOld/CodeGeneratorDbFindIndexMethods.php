<?php
// print_r($_POST);

class indexData
{
  protected $name;
  protected $fields;

  public function __construct()
  {
    $this->name = "";
    $this->fields = [];
  }
  public function getName(): string
  {
    return $this->name;
  }
  public function getFields(): array
  {
    return $this->fields;
  }
  public function setName(string $name)
  {
    $this->name = $name;
  }
  public function setFields(array $fields)
  {
    $this->fields = $fields;
  }
}

$dirName = $storName = $filename = "";
$names = [];
$resp = [];
$indexMethod = "findBy";
$lenMethod = strlen($indexMethod);
$where = "WHERE";
$lenWhere = strlen($where);
$and = "AND";
$lenAnd = strlen($and);

if (@$_POST["dir"]) $dirName = $_POST["dir"];
if (@$_POST["name"]) $storName = $_POST["name"];

$filename = "$dirName/$storName.php";

$f = null;
if (file_exists($filename)) {
  $content = file_get_contents($filename);
  $posFindBy = stripos($content, $indexMethod);
  while ($posFindBy !== FALSE) {
    $posParenthesis = stripos($content, "(", $posFindBy);
    $data = new indexData();
    $data->setName(trim(substr($content, $posFindBy + $lenMethod, $posParenthesis - ($posFindBy + $lenMethod))));
    $posWhere = stripos($content, $where, $posParenthesis);
    if ($posWhere !== FALSE) {
      $maxPos = stripos($content, "{", $posWhere);
      $fields = [];
      $posEqual = stripos($content, "=", $posWhere);
      if ($posEqual !== FALSE) {
        $fields[] = trim(substr($content, $posWhere + $lenWhere, $posEqual - ($posWhere + $lenWhere)));
        $posAnd = stripos($content, $and, $posEqual);
        while ($posAnd !== FALSE && $posAnd < $maxPos) {
          $posEqual = stripos($content, "=", $posAnd);
          if ($posEqual !== FALSE) {
            $fields[] = trim(substr($content, $posAnd + $lenAnd, $posEqual - ($posAnd + $lenAnd)));
          }
          $posAnd = stripos($content, $and, $posAnd + $lenAnd);
        }
      }
      $data->setFields($fields);
    }
    $names[] = $data;
    $posFindBy = stripos($content, $indexMethod, $posParenthesis);
  }
  $resp = array("names" => serialize($names));
} else {
  $resp = array("error" => "bad filename : $filename");
}
$resp["filename"] = $filename;
echo json_encode($resp);
