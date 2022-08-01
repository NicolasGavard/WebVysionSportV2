<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('CodeGeneratorData', false)) {
  class CodeGeneratorData
  {
    public function generateDataData($tableName, $dataObjectName, $field, $fieldind, $uniqueKey, $directory)
    {
      $done = false;
      $errorT = $errorR = "";
      $statusField = "status";
      $statusFieldBis = "statut";
      $hasStatusField = false;

      if (
        strlen($tableName) > 0 &&
        strlen($dataObjectName) > 0 &&
        $fieldind > 0 &&
        $uniqueKey > -1 &&
        strlen($directory) > 0
      ) {
        if (substr($directory, strlen($directory) - 1) != '\\') {
          $directory .= '\\';
        }
        $filename = $directory . $dataObjectName . ".php";
        $tableNameUpper = strtoupper($tableName);

        for ($i = 0; $i < $fieldind; $i++) {
          if (
            strtoupper($field[$i]["up"]) == strtoupper($statusField)
            || strtoupper($field[$i]["up"]) == strtoupper($statusFieldBis)
          ) {
            $hasStatusField = true;
            $field[$i]["up"] = $statusField;
            break;
          }
        }
        $f = fopen($filename, "w");
        fputs($f, '<?php // Needed to encode in UTF8 ààéàé //' . "\r\n");
        fputs($f, 'class ' . $dataObjectName . ' {' . "\r\n");

        if ($hasStatusField) {
          fputs($f, '  const ' . $tableNameUpper . '_STATUS_AVAILABLE     = 0;' . "\r\n");
          fputs($f, '  const ' . $tableNameUpper . '_STATUS_NOT_AVAILABLE = 1;' . "\r\n");
          fputs($f, "\r\n");
        }
        for ($i = 0; $i < $fieldind; $i++) {
          fputs($f, '  private $' . $field[$i]["nom"] . ';' . "\r\n");
        }
        fputs($f, "\r\n");
        fputs($f, '  public function __construct() {' . "\r\n");
        for ($i = 0; $i < $fieldind; $i++) {
          fputs($f, '      $this->' . $field[$i]["nom"] . ' =');
          if ($i != $uniqueKey) {
            if (
              stripos($field[$i]["type"], "int") !== false ||
              stripos($field[$i]["type"], "tinyint") !== false ||
              stripos($field[$i]["type"], "decimal") !== false ||
              stripos($field[$i]["type"], "bigint") !== false
            ) {
              fputs($f, ' 0;' . "\r\n");
            } else {
              if (
                stripos($field[$i]["type"], "varchar") !== false ||
                stripos($field[$i]["type"], "char") !== false
              ) {
                fputs($f, ' "";' . "\r\n");
              } else {
                fputs($f, ' "";' . "\r\n");
              }
            }
          } else {
            fputs($f, ' 0;' . "\r\n");
          }
        }
        fputs($f, '    }' . "\r\n");

        fputs($f, '// Gets' . "\r\n");
        for ($i = 0; $i < $fieldind; $i++) {
          fputs($f, '  public function get' . ucfirst($field[$i]["up"]) . '() { return $this->' . $field[$i]["nom"] . '; }' . "\r\n");
        }
        if ($hasStatusField) {
          fputs($f, '  public function isAvailable() { return ($this->statut == self::' . $tableNameUpper . '_STATUS_AVAILABLE); }' . "\r\n");
          fputs($f, '  public function getAvailableValue() { return self::' . $tableNameUpper . '_STATUS_AVAILABLE; }' . "\r\n");
          fputs($f, '  public function getUnavailableValue() { return self::' . $tableNameUpper . '_STATUS_NOT_AVAILABLE; }' . "\r\n");
        }

        fputs($f, '// Sets' . "\r\n");
        for ($i = 0; $i < $fieldind; $i++) {
          fputs($f, '  public function set' . ucfirst($field[$i]["up"]) . '($' . $field[$i]["up"] . ')');
          fputs($f, ' { $this->' . $field[$i]["nom"] . ' = $' . $field[$i]["up"] . '; }' . "\r\n");
        }
        if ($hasStatusField) {
          fputs($f, '  public function setAvailable() { $this->statut = self::' . $tableNameUpper . '_STATUS_AVAILABLE; }' . "\r\n");
          fputs($f, '  public function setUnavailable() { $this->statut = self::' . $tableNameUpper . '_STATUS_NOT_AVAILABLE; }' . "\r\n");
        }
        fputs($f, '}' . "\r\n");
        fclose($f);

        echo "ok";
        $done = true;
      } else {
        if (strlen($tableName) == 0) {
          $errorT = "sess_ErreurData";
          $errorR = "sess_ErreurNoTableName";
        }
        if (strlen($dataObjectName) == 0) {
          $errorT = "sess_ErreurData";
          $errorR = "sess_ErreurNoDataObjectName";
        }
        if ($fieldind == 0) {
          $errorT = "sess_ErreurData";
          $errorR = "sess_ErreurNoField";
        }
        if (strlen($uniqueKey) == 0) {
          $errorT = "sess_ErreurData";
          $errorR = "sess_ErreurNoUniqueKey";
        }
        if (strlen($directory) == 0) {
          $errorT = "sess_ErreurData";
          $errorR = "sess_ErreurNoDirectory";
        }
      }
      return array($done, $errorT, $errorR);
    }
    // End of generateDataData
  }
  // End of Class
}
// class_exists
