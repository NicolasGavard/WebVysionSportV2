<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('CodeGeneratorDb', false)) {
  class CodeGeneratorDb
  {
/* TO BE DONE

*/

    const COMMENT_SEPARATOR = '//=============================================================================';

    public function generate(
      $tableName,
      $storName,
      $field,
      $fieldind,
      $uniqueKey,
      $dbDataObjectName,
      $directory,
      $listSortedBy,
      $timestamp,
      $uniqueIndexes,
      $indexes,
      $uniqueToGenerate,
      $indexToGenerate,
      $generateFor
    ) {
      $done = false;
      $errorT = $errorR = "";
      $statusField = "status";
      $statusFieldBis = "statut";
      $statusFieldTer = "elemstate";
      $hasStatusField = $hasStatusFieldTer = $hasTimestampField = false;

      if (
        strlen($tableName) > 0 &&
        $fieldind > 0 &&
        $uniqueKey > -1 &&
        strlen($directory) > 0
      ) {
        if (substr($directory, strlen($directory) - 1) != '\\') {
          $directory .= '\\';
        }
        $filename = $directory . $storName . ".php";
        $hasTimestampField = ($timestamp > -1);

        for ($i = 0; $i < $fieldind; $i++) {
          if (
            strtoupper($field[$i]["nom"]) == strtoupper($statusField)
            || strtoupper($field[$i]["nom"]) == strtoupper($statusFieldBis)
          ) {
            $hasStatusField = true;
            $field[$i]["up"] = $statusField;
            break;
          }
          if (strtoupper($field[$i]["nom"]) == strtoupper($statusFieldTer)) {
            $hasStatusFieldTer = true;
            break;
          }        }
        $firstLine  = '<?php // Needed to encode in UTF8 ààéàé //' . "\r\n";
        $secondLine = 'class ' . $storName . ' {' . "\r\n";
        $firstLineToSearch  = self::COMMENT_SEPARATOR . "\r\n";
        $secondLineToSearch = '//== DO NOT REMOVE !' . "\r\n";

        $f = null;
        $userCode = "";
        if (file_exists($filename)) {
          $content = file_get_contents($filename);
          $pos = stripos($content, $firstLineToSearch . $secondLineToSearch);
          $length = (strlen($firstLine) + strlen($secondLine));
          if ($pos !== false && $pos > $length) {
            $userCode = substr($content, $length, $pos - $length);
          }
        }
        $f = fopen($filename, 'w');
        fputs($f, $firstLine);
        fputs($f, $secondLine);
        fputs($f, $userCode);
        if (strlen($userCode) == 0) {
          fputs($f, "\r\n");
        }
        fputs($f, $firstLineToSearch);
        fputs($f, $secondLineToSearch);
        fputs($f, '//== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !' . "\r\n");
        fputs($f, '//== DO NOT REMOVE !' . "\r\n");
        fputs($f, '//==' . "\r\n");
        fputs($f, '//== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !' . "\r\n");
        fputs($f, '//==' . "\r\n");
        fputs($f, self::COMMENT_SEPARATOR . "\r\n");
        fputs($f, self::COMMENT_SEPARATOR . "\r\n");
        // Table name
        fputs($f, '  const TABLE_NAME = "' . $tableName . '";' . "\r\n");
        $select = 'SELECT ';
        for ($i = 0; $i < $fieldind; $i++) {
          if ($i > 0) {
            $select .= ',';
          }
          $select .= $field[$i]["nom"];
        }
        fputs($f, "  const SELECT = '" . $select . "';" . "\r\n");
        $from = "FROM $tableName";

        fputs($f, "  const FROM = ' " . $from . "';" . "\r\n");
        fputs($f, "  const SHOW_READ_REQUEST = FALSE;" . "\r\n");
        fputs($f, "  const SHOW_FIND_REQUEST = FALSE;" . "\r\n");
        fputs($f, "  const SHOW_CREATE_REQUEST = FALSE;" . "\r\n");
        fputs($f, "  const SHOW_UPDATE_REQUEST = FALSE;" . "\r\n");
        fputs($f, "  const SHOW_DELETE_REQUEST = FALSE;" . "\r\n");
        fputs($f, '  const DEBUG_ERROR = "</p><br/>DB Error: ";' . "\r\n");
        fputs($f, '  const BREAK = "<br/>";' . "\r\n");
        fputs($f, '  const DOUBLE_BREAK = "<br/><br/>";' . "\r\n");

        fputs($f, "\r\n");

        // Get List
        fputs($f, '  public static function getList(');
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, 'bool $all, ');
        }
        if ($generateFor == "P") {
          fputs($f, 'DistriXPDOConnection ');
        }
        fputs($f, '$inDbConnection)' . "\r\n");
        fputs($f, '  {' . "\r\n");
        fputs($f, '    $request = "";' . "\r\n");
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, '    $data = new ' . $dbDataObjectName . '();' . "\r\n");
        }
        fputs($f, '    $list = [];' . "\r\n");
        fputs($f, "\r\n");
        fputs($f, '    if ($inDbConnection != null) {' . "\r\n");
        fputs($f, '      $request  = self::SELECT;' . "\r\n");
        fputs($f, '      $request .= self::FROM;' . "\r\n");
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, '      if (!$all) {' . "\r\n");
          if ($hasStatusField) {
            fputs($f, '        $request .= " WHERE statut = :statut";' . "\r\n");
          } else {
            fputs($f, '        $request .= " WHERE elemstate = :statut";' . "\r\n");
          }
          fputs($f, '      }' . "\r\n");
        }
        fputs($f, '      $request .= " ORDER BY ' . $field[$listSortedBy]["nom"] . '";' . "\r\n");
        fputs($f, "\r\n");

        fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, '      if (!$all) {' . "\r\n");
          fputs($f, '        $stmt->execute([' . "'statut'" . '=> $data->getAvailableValue()]);' . "\r\n");
          fputs($f, '      } else {' . "\r\n");
          fputs($f, '        $stmt->execute();' . "\r\n");
          fputs($f, '      }' . "\r\n");
        } else {
          fputs($f, '      $stmt->execute();' . "\r\n");
        }
        fputs($f, '      if (self::SHOW_READ_REQUEST) {' . "\r\n");
        fputs($f, '        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '      if ($stmt->rowCount() > 0) {' . "\r\n");
        fputs($f, '        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "' . $dbDataObjectName . '");' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '    }' . "\r\n");
        fputs($f, '    return array($list, count($list));' . "\r\n");
        fputs($f, '  }' . "\r\n");
        fputs($f, '  // End of getList' . "\r\n");
        fputs($f, "\r\n");

        // Get List From List
        fputs($f, '  public static function getListFromList(');
        fputs($f, 'array $inList, ');
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, 'bool $all, ');
        }
        fputs($f, 'string $className, ');
        if ($generateFor == "P") {
          fputs($f, 'DistriXPDOConnection ');
        }
        fputs($f, '$inDbConnection)' . "\r\n");
        fputs($f, '  {' . "\r\n");
        fputs($f, '    $request = "";' . "\r\n");
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, '    $data = new ' . $dbDataObjectName . '();' . "\r\n");
        }
        fputs($f, '    $list = [];' . "\r\n");
        fputs($f, "\r\n");
        fputs($f, '    if ($inDbConnection != null && (!is_null($inList)) && (!empty($inList))) {' . "\r\n");
        fputs($f, '      if ($className == "" || is_null($className)) {' . "\r\n");
        fputs($f, '        $className = "'.$dbDataObjectName.'";' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '      $request  = self::SELECT;' . "\r\n");
        fputs($f, '      $request .= self::FROM;' . "\r\n");
        fputs($f, '      $request .= " WHERE id IN('."'".'" . implode("'."','".'", array_map(function($data) { return $data->getId(); }, '.'$inList'.")).".'"'."')".'";' . "\r\n");
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, '      if (!$all) {' . "\r\n");
          if ($hasStatusField) {
            fputs($f, '        $request .= " AND statut = :statut";' . "\r\n");
          } else {
            fputs($f, '        $request .= " AND elemstate = :statut";' . "\r\n");
          }
          fputs($f, '      }' . "\r\n");
        }
        fputs($f, '      $request .= " ORDER BY ' . $field[$listSortedBy]["nom"] . '";' . "\r\n");
        fputs($f, "\r\n");

        fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, '      if (!$all) {' . "\r\n");
          fputs($f, '        $stmt->execute([' . "'statut'" . '=> $data->getAvailableValue()]);' . "\r\n");
          fputs($f, '      } else {' . "\r\n");
          fputs($f, '        $stmt->execute();' . "\r\n");
          fputs($f, '      }' . "\r\n");
        } else {
          fputs($f, '      $stmt->execute();' . "\r\n");
        }
        fputs($f, '      if (self::SHOW_READ_REQUEST) {' . "\r\n");
        fputs($f, '        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '      if ($stmt->rowCount() > 0) {' . "\r\n");
        fputs($f, '        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $className);' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '    }' . "\r\n");
        fputs($f, '    return array($list, count($list));' . "\r\n");
        fputs($f, '  }' . "\r\n");
        fputs($f, '  // End of getListFromList' . "\r\n");

        // Find methods based on unique indexes
        foreach ($uniqueToGenerate as $uniqueGenerate) {
          fputs($f, "\r\n");
          fputs($f, '  public static function findBy');
          fputs($f, $uniqueGenerate["name"] . '(' . $dbDataObjectName . ' $dataIn, ');
          if ($generateFor == "P") {
            fputs($f, 'DistriXPDOConnection ');
          }
          fputs($f, '$inDbConnection)' . "\r\n");
          fputs($f, '  {' . "\r\n");
          fputs($f, '    $request = "";' . "\r\n");
          fputs($f, '    $data = new ' . $dbDataObjectName . '();' . "\r\n");
          fputs($f, "\r\n");
          fputs($f, '    if ($inDbConnection != null) {' . "\r\n");
          fputs($f, '      $request  = self::SELECT;' . "\r\n");
          fputs($f, '      $request .= self::FROM;' . "\r\n");
          fputs($f, '      $request .= " WHERE ');
          for ($indI = 0; $indI < 150; $indI++) {
            if (isset($uniqueIndexes[$uniqueGenerate["number"]]["field" . $indI])) {
              if ($indI > 0) {
                fputs($f, '      $request .= " AND ');
              }
              fputs($f, $uniqueIndexes[$uniqueGenerate["number"]]["field" . $indI] . ' = :index' . $indI . '";' . "\r\n");
            }
          }
          fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
          fputs($f, '      $stmt->execute([');
          for ($indI = 0; $indI < 150; $indI++) {
            if (isset($uniqueIndexes[$uniqueGenerate["number"]]["field" . $indI])) {
              if ($indI > 0) {
                fputs($f, ', ');
              }
              fputs($f, "'index" . $indI . "'" . '=> ');
              for ($i = 0; $i < $fieldind; $i++) {
                if ($field[$i]["nom"] == $uniqueIndexes[$uniqueGenerate["number"]]["field" . $indI]) {
                  fputs($f, ' $dataIn->get' . ucfirst($field[$i]["up"]) . '()');
                }
              }
            }
          }
          fputs($f, ']);' . "\r\n");
          fputs($f, '      if (self::SHOW_FIND_REQUEST) {' . "\r\n");
          fputs($f, '        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
          fputs($f, '      }' . "\r\n");
          fputs($f, '      if ($stmt->rowCount() > 0) {' . "\r\n");
          fputs($f, '        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "' . $dbDataObjectName . '");' . "\r\n");
          fputs($f, '        $data = $stmt->fetch();' . "\r\n");
          fputs($f, '      }' . "\r\n");
          fputs($f, '    }' . "\r\n");
          fputs($f, '    return $data;' . "\r\n");
          fputs($f, '  }' . "\r\n");
          fputs($f, '  // End of ' . $uniqueGenerate["name"] . "\r\n");
        }

        // Find methods based on non unique indexes
        foreach ($indexToGenerate as $indexGenerate) {
          fputs($f, "\r\n");
          fputs($f, '  public static function findBy');
          fputs($f, $indexGenerate["name"] . '(' . $dbDataObjectName . ' $dataIn, ');
          if ($hasStatusField || $hasStatusFieldTer) {
            fputs($f, 'bool $all, ');
          }
          if ($generateFor == "P") {
            fputs($f, 'DistriXPDOConnection ');
          }
          fputs($f, '$inDbConnection)' . "\r\n");
          fputs($f, '  {' . "\r\n");
          fputs($f, '    $request = "";' . "\r\n");
          fputs($f, '    $list = [];' . "\r\n");
          fputs($f, "\r\n");
          fputs($f, '    if ($inDbConnection != null) {' . "\r\n");
          fputs($f, '      $request  = self::SELECT;' . "\r\n");
          fputs($f, '      $request .= self::FROM;' . "\r\n");
          fputs($f, '      $request .= " WHERE ');
          for ($indI = 0; $indI < 150; $indI++) {
            if (isset($indexes[$indexGenerate["number"]]["field" . $indI])) {
              if ($indI > 0) {
                fputs($f, '      $request .= " AND ');
              }
              fputs($f, $indexes[$indexGenerate["number"]]["field" . $indI] . ' = :index' . $indI . '";' . "\r\n");
            }
          }
          if ($hasStatusField || $hasStatusFieldTer) {
            fputs($f, '      if (!$all) {' . "\r\n");
            if ($hasStatusField) {
              fputs($f, '        $request .= " AND statut = :statut";' . "\r\n");
            } else {
              fputs($f, '        $request .= " AND elemstate = :statut";' . "\r\n");
            }
            fputs($f, '      }' . "\r\n");
          }
          fputs($f, '      $params = [];' . "\r\n");
          for ($indI = 0; $indI < 150; $indI++) {
            if (isset($indexes[$indexGenerate["number"]]["field" . $indI])) {
              for ($i = 0; $i < $fieldind; $i++) {
                if ($field[$i]["nom"] == $indexes[$indexGenerate["number"]]["field" . $indI]) {
                  fputs($f, '      $params["index' . $indI . '"] = $dataIn->get' . ucfirst($field[$i]["up"]) . '();' . "\r\n");
                }
              }
            }
          }
          if ($hasStatusField || $hasStatusFieldTer) {
            fputs($f, '      if (!$all) {' . "\r\n");
            fputs($f, '        $params["statut"] = $dataIn->getAvailableValue();' . "\r\n");
            fputs($f, '      }' . "\r\n");
          }
          fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
          fputs($f, '      $stmt->execute($params);' . "\r\n");
          fputs($f, '      if (self::SHOW_FIND_REQUEST) {' . "\r\n");
          fputs($f, '        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
          fputs($f, '      }' . "\r\n");
          fputs($f, '      if ($stmt->rowCount() > 0) {' . "\r\n");
          fputs($f, '        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "' . $dbDataObjectName . '");' . "\r\n");
          fputs($f, '      }' . "\r\n");
          fputs($f, '    }' . "\r\n");
          fputs($f, '    return array($list, count($list));' . "\r\n");
          fputs($f, '  }' . "\r\n");
          fputs($f, '  // End of ' . $indexGenerate["name"] . "\r\n");
        }

        // Read
        fputs($f, "\r\n");
        fputs($f, '  public static function read(int $id, ');
        if ($generateFor == "P") {
          fputs($f, 'DistriXPDOConnection ');
        }
        fputs($f, '$inDbConnection)' . "\r\n");
        fputs($f, '  {' . "\r\n");
        fputs($f, '    $request = "";' . "\r\n");
        fputs($f, '    $data = new ' . $dbDataObjectName . '();' . "\r\n");
        fputs($f, "\r\n");
        fputs($f, '    if ($inDbConnection != null) {' . "\r\n");
        fputs($f, '      $request  = self::SELECT;' . "\r\n");
        fputs($f, '      $request .= self::FROM;' . "\r\n");
        fputs($f, '      $request .= " WHERE ' . $field[$uniqueKey]["nom"] . ' = :id";' . "\r\n");
        fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
        fputs($f, '      $stmt->execute([' . "'id'" . '=> $id]);' . "\r\n");
        fputs($f, '      if (self::SHOW_READ_REQUEST) {' . "\r\n");
        fputs($f, '        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '      if ($stmt->rowCount() > 0) {' . "\r\n");
        fputs($f, '        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "' . $dbDataObjectName . '");' . "\r\n");
        fputs($f, '        $data = $stmt->fetch();' . "\r\n");
        fputs($f, '      }' . "\r\n");
        if ($generateFor == "P") {
          fputs($f, '      $trace = $inDbConnection->getTrace();' . "\r\n");
          fputs($f, '      if (!is_null($trace) && !$trace->getManualTrace()) {' . "\r\n");
          fputs($f, '        $traceData = new DistriXTraceData();' . "\r\n");
          fputs($f, '        $traceData->setIdUser($trace->getIdUser());' . "\r\n");
          fputs($f, '        $traceData->setApplication($trace->getApplicationName());' . "\r\n");
          fputs($f, '        $traceData->setSchema($trace->getDbSchemaName());' . "\r\n");
          fputs($f, '        $traceData->setOperationCode($traceData::TRACE_READ);' . "\r\n");
          fputs($f, '        $traceData->setOperationId($id);' . "\r\n");
          fputs($f, '        $traceData->setOperationTable(self::TABLE_NAME);' . "\r\n");
          for ($i = 0; $i < $fieldind; $i++) {
            if (stripos($field[$i]["type"], "blob") !== false) {
              fputs($f, '        $data->set' . ucfirst($field[$i]["up"]) . '("");' . "\r\n");
            }
          }
          fputs($f, '        $traceData->setOperationData(print_r($data, true));' . "\r\n");
          fputs($f, '        $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());' . "\r\n");
          fputs($f, '        $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());' . "\r\n");
          fputs($f, '        $trace->addToTrace($traceData);' . "\r\n");
          fputs($f, '      }' . "\r\n");
        }
        fputs($f, '    }' . "\r\n");
        fputs($f, '    return $data;' . "\r\n");
        fputs($f, '  }' . "\r\n");
        fputs($f, '  // End of read' . "\r\n");

        // Update
        fputs($f, "\r\n");
        fputs($f, '  public static function update(' . $dbDataObjectName . ' $data, ');
        if ($generateFor == "P") {
          fputs($f, '$traceType, ');
        }
        if ($generateFor == "P") {
          fputs($f, 'DistriXPDOConnection ');
        }
        fputs($f, '$inDbConnection)' . "\r\n");
        fputs($f, '  {' . "\r\n");
        fputs($f, '    $insere = false;' . "\r\n");
        fputs($f, '    $request = "";' . "\r\n");
        fputs($f, "\r\n");
        fputs($f, '    if ($inDbConnection != null) {' . "\r\n");

        fputs($f, '      $request  = "UPDATE ' . $tableName . ' SET ";' . "\r\n");
        $alreadyOneField = false;
        for ($i = 0; $i < $fieldind; $i++) {
          if ($i != $uniqueKey) {
            if ($i < $fieldind && $alreadyOneField) {
              fputs($f, ',";' . "\r\n");
            }
            $alreadyOneField = true;
            fputs($f, '      $request .= "' . $field[$i]["nom"] . '= :' . $field[$i]["nom"]);
          }
        }
        fputs($f, '";' . "\r\n");
        fputs($f, '      $request .= " WHERE ' . $field[$uniqueKey]["nom"] . ' = :' . $field[$uniqueKey]["nom"] . '";' . "\r\n");
        if ($hasTimestampField) {
          fputs($f, '      $request .= " AND ' . $field[$timestamp]["nom"] . ' = :oldtimestamp";' . "\r\n");
        }
        fputs($f, '      $params = [];' . "\r\n");
        $alreadyOneField = false;
        for ($i = 0; $i < $fieldind; $i++) {
          if ($hasTimestampField && $field[$i]["nom"] == $field[$timestamp]["nom"]) {
            fputs($f, '      $params["' . $field[$i]["nom"] . '"] = $data->get' . ucfirst($field[$i]["up"]) . '() + 1;' . "\r\n");
          } else {
            if (strtoupper($field[$i]["nom"]) != strtoupper($statusFieldTer)) {
              fputs($f, '      $params["' . $field[$i]["nom"] . '"] = $data->get' . ucfirst($field[$i]["up"]) . '();' . "\r\n");
            } else {
              fputs($f, '      $params["' . $field[$i]["nom"] . '"] = $data->getElemState();' . "\r\n");
            }
          }
        }
        if ($hasTimestampField) {
          fputs($f, '      $params["oldtimestamp"] = $data->get' . ucfirst($field[$timestamp]["up"]) . '();' . "\r\n");
        }
        fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
        fputs($f, '      $stmt->execute($params);' . "\r\n");

        // CHANGED BECAUSE RETURN FALSE IF NO DATA MODIFIED. Yvan 4-2-21
        // fputs($f,'      $insere = ($stmt->rowCount() > 0 && is_null($inDbConnection->errorInfo()[2])); // If there is no DB error'."\r\n");
        fputs($f, '      $insere = is_null($inDbConnection->errorInfo()[2]); // If there is no DB error' . "\r\n");
        fputs($f, '      if (self::SHOW_UPDATE_REQUEST) {' . "\r\n");
        fputs($f, '        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
        fputs($f, '      }' . "\r\n");

        fputs($f, '      if ($insere) {' . "\r\n");
        if ($generateFor == "P") {
          fputs($f, '        $trace = $inDbConnection->getTrace();' . "\r\n");
          fputs($f, '        if (!is_null($trace) && !$trace->getManualTrace()) {' . "\r\n");
          fputs($f, '          $traceData = new DistriXTraceData();' . "\r\n");
          fputs($f, '          $traceData->setIdUser($trace->getIdUser());' . "\r\n");
          fputs($f, '          $traceData->setApplication($trace->getApplicationName());' . "\r\n");
          fputs($f, '          $traceData->setSchema($trace->getDbSchemaName());' . "\r\n");
          fputs($f, '          $operationCode = DistriXTraceData::TRACE_UPDATE;' . "\r\n");
          fputs($f, '          if ($traceType == "TRACE_REMOVE") {' . "\r\n");
          fputs($f, '            $operationCode = DistriXTraceData::TRACE_REMOVE;' . "\r\n");
          fputs($f, '          } elseif ($traceType == "TRACE_RESTORE") {' . "\r\n");
          fputs($f, '            $operationCode = DistriXTraceData::TRACE_RESTORE;' . "\r\n");
          fputs($f, '          }' . "\r\n");
          fputs($f, '          $traceData->setOperationCode($operationCode);' . "\r\n");
          fputs($f, '          $traceData->setOperationId($data->getId());' . "\r\n");
          fputs($f, '          $traceData->setOperationTable(self::TABLE_NAME);' . "\r\n");
          for ($i = 0; $i < $fieldind; $i++) {
            if (stripos($field[$i]["type"], "blob") !== false) {
              fputs($f, '          $data->set' . ucfirst($field[$i]["up"]) . '("");' . "\r\n");
            }
          }
          fputs($f, '          $traceData->setOperationData(print_r($data, true));' . "\r\n");
          fputs($f, '          $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());' . "\r\n");
          fputs($f, '          $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());' . "\r\n");
          fputs($f, '          $trace->addToTrace($traceData);' . "\r\n");
          fputs($f, '        }' . "\r\n");
        } else {
          fputs($f, '        if (method_exists($inDbConnection, "getDataTracking")) {' . "\r\n");
          fputs($f, '          $inDbConnection->getDataTracking()->updateToDataTracking($data->getId(), self::TABLE_NAME, $data);' . "\r\n");
          fputs($f, '        }' . "\r\n");
        }
        fputs($f, '      }' . "\r\n");
        fputs($f, '    }' . "\r\n");
        fputs($f, '    return $insere;' . "\r\n");
        fputs($f, '  }' . "\r\n");
        fputs($f, '  // End of update' . "\r\n");

        // save
        fputs($f, "\r\n");
        fputs($f, '  public static function save(' . $dbDataObjectName . ' $data, ');
        if ($generateFor == "P") {
          fputs($f, 'DistriXPDOConnection ');
        }
        fputs($f, '$inDbConnection)' . "\r\n");
        fputs($f, '  {' . "\r\n");
        fputs($f, '    $insere = false; $id = 0;' . "\r\n");
        fputs($f, '    if ($data->getId() > 0) {' . "\r\n");
        fputs($f, '      $id = $data->getId();' . "\r\n");
        if ($generateFor == "P") {
          fputs($f, '      $insere = self::update($data, "TRACE_UPDATE", $inDbConnection);' . "\r\n");
        } else {
          fputs($f, '      $insere = self::update($data, $inDbConnection);' . "\r\n");
        }
        fputs($f, '    } else {' . "\r\n");
        fputs($f, '      list($insere, $id) = self::create($data, $inDbConnection);' . "\r\n");
        fputs($f, '    }' . "\r\n");
        fputs($f, '    return array($insere, $id);' . "\r\n");
        fputs($f, '  }' . "\r\n");
        fputs($f, '  // End of save' . "\r\n");

        // remove
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, "\r\n");
          fputs($f, '  public static function remove(' . $dbDataObjectName . ' $data, ');
          if ($generateFor == "P") {
            fputs($f, 'DistriXPDOConnection ');
          }
          fputs($f, '$inDbConnection)' . "\r\n");
          fputs($f, '  {' . "\r\n");
          fputs($f, '    $insere = false;' . "\r\n");
          fputs($f, '    if ($data->getId() > 0) {' . "\r\n");
          fputs($f, '      $data = self::read($data->getId(), $inDbConnection);' . "\r\n");
          fputs($f, '      $data->setUnavailable();' . "\r\n");
          if ($generateFor == "P") {
            fputs($f, '      $insere = self::update($data, "TRACE_REMOVE", $inDbConnection);' . "\r\n");
          } else {
            fputs($f, '      $insere = self::update($data, $inDbConnection);' . "\r\n");
          }
          fputs($f, '    }' . "\r\n");
          fputs($f, '    return $insere;' . "\r\n");
          fputs($f, '  }' . "\r\n");
          fputs($f, '  // End of remove' . "\r\n");
        }
        // restore
        if ($hasStatusField || $hasStatusFieldTer) {
          fputs($f, "\r\n");
          fputs($f, '  public static function restore(' . $dbDataObjectName . ' $data, ');
          if ($generateFor == "P") {
            fputs($f, 'DistriXPDOConnection ');
          }
          fputs($f, '$inDbConnection)' . "\r\n");
          fputs($f, '  {' . "\r\n");
          fputs($f, '    $insere = false;' . "\r\n");
          fputs($f, '    if ($data->getId() > 0) {' . "\r\n");
          fputs($f, '      $data = self::read($data->getId(), $inDbConnection);' . "\r\n");
          fputs($f, '      $data->setAvailable();' . "\r\n");
          if ($generateFor == "P") {
            fputs($f, '      $insere = self::update($data, "TRACE_RESTORE", $inDbConnection);' . "\r\n");
          } else {
            fputs($f, '      $insere = self::update($data, $inDbConnection);' . "\r\n");
          }
          fputs($f, '    }' . "\r\n");
          fputs($f, '    return $insere;' . "\r\n");
          fputs($f, '  }' . "\r\n");
          fputs($f, '  // End of restore' . "\r\n");
        }
        // delete
        fputs($f, "\r\n");
        fputs($f, '  public static function delete(int $id, ');
        if ($generateFor == "P") {
          fputs($f, 'DistriXPDOConnection ');
        }
        fputs($f, '$inDbConnection)' . "\r\n");
        fputs($f, '  {' . "\r\n");
        fputs($f, '    $insere = false;' . "\r\n");
        fputs($f, '    $request = "";' . "\r\n");
        fputs($f, "\r\n");
        fputs($f, '    if ($inDbConnection != null) {' . "\r\n");
        fputs($f, '      $request  = "DELETE FROM ' . $tableName . '";' . "\r\n");
        fputs($f, '      $request .= " WHERE ' . $field[$uniqueKey]["nom"] . ' = :id";' . "\r\n");
        fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
        fputs($f, '      $stmt->execute([' . "'id'" . '=> $id]);' . "\r\n");
        fputs($f, '      $insere = is_null($inDbConnection->errorInfo()[2]); // If there is no DB error' . "\r\n");
        fputs($f, '      if (self::SHOW_DELETE_REQUEST) {' . "\r\n");
        fputs($f, '       echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '      if ($insere) {' . "\r\n");
        if ($generateFor == "P") {
          fputs($f, '        $trace = $inDbConnection->getTrace();' . "\r\n");
          fputs($f, '        if (!is_null($trace) && !$trace->getManualTrace()) {' . "\r\n");
          fputs($f, '          $traceData = new DistriXTraceData();' . "\r\n");
          fputs($f, '          $traceData->setIdUser($trace->getIdUser());' . "\r\n");
          fputs($f, '          $traceData->setApplication($trace->getApplicationName());' . "\r\n");
          fputs($f, '          $traceData->setSchema($trace->getDbSchemaName());' . "\r\n");
          fputs($f, '          $traceData->setOperationCode($traceData::TRACE_DELETE);' . "\r\n");
          fputs($f, '          $traceData->setOperationId($id);' . "\r\n");
          fputs($f, '          $traceData->setOperationTable(self::TABLE_NAME);' . "\r\n");
          fputs($f, '          $traceData->setOperationData("");' . "\r\n");
          fputs($f, '          $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());' . "\r\n");
          fputs($f, '          $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());' . "\r\n");
          fputs($f, '          $trace->addToTrace($traceData);' . "\r\n");
          fputs($f, '        }' . "\r\n");
        } else {
          fputs($f, '        if (method_exists($inDbConnection, "getDataTracking")) {' . "\r\n");
          fputs($f, '          $inDbConnection->getDataTracking()->deleteToDataTracking($id, self::TABLE_NAME, "");' . "\r\n");
          fputs($f, '        }' . "\r\n");
        }
        fputs($f, '      }' . "\r\n");
        fputs($f, '    }' . "\r\n");
        fputs($f, '    return $insere;' . "\r\n");
        fputs($f, '  }' . "\r\n");
        fputs($f, '  // End of delete' . "\r\n");

        // Create
        fputs($f, "\r\n");
        fputs($f, '  public static function create(' . $dbDataObjectName . ' $data, ');
        if ($generateFor == "P") {
          fputs($f, 'DistriXPDOConnection ');
        }
        fputs($f, '$inDbConnection)' . "\r\n");
        fputs($f, '  {' . "\r\n");
        fputs($f, '    $insere = false;' . "\r\n");
        fputs($f, '    $request = "";' . "\r\n");
        fputs($f, "\r\n");
        fputs($f, '    if ($inDbConnection != null) {' . "\r\n");
        fputs($f, '      $request  = "INSERT INTO ' . $tableName . '(";' . "\r\n");
        fputs($f, '      $request .= "');
        $alreadyOneField = false;
        for ($i = 0; $i < $fieldind; $i++) {
          if ($i != $uniqueKey) {
            if ($alreadyOneField) {
              fputs($f, ',');
            }
            $alreadyOneField = true;
            fputs($f, $field[$i]["nom"]);
          }
        }
        fputs($f, ')";' . "\r\n");
        fputs($f, '      $request .= " VALUES(";' . "\r\n");
        $alreadyOneField = false;
        for ($i = 0; $i < $fieldind; $i++) {
          if ($i != $uniqueKey && $i < $fieldind) {
            if ($alreadyOneField) {
              fputs($f, ',";' . "\r\n");
            }
            $alreadyOneField = true;
            fputs($f, '      $request .= ":' . $field[$i]["nom"]);
          }
        }
        fputs($f, ')";' . "\r\n");
        fputs($f, '      $params = [];' . "\r\n");
        $alreadyOneField = false;
        for ($i = 0; $i < $fieldind; $i++) {
          if ($i != $uniqueKey) {
            if (strtoupper($field[$i]["nom"]) != strtoupper($statusFieldTer)) {
              fputs($f, '      $params["' . $field[$i]["nom"] . '"] = $data->get' . ucfirst($field[$i]["up"]) . '();' . "\r\n");
            } else {
              fputs($f, '      $params["' . $field[$i]["nom"] . '"] = $data->getElemState();' . "\r\n");
            }
          }
        }
        fputs($f, '      $stmt = $inDbConnection->prepare($request);' . "\r\n");
        fputs($f, '      $stmt->execute($params);' . "\r\n");
        fputs($f, '      $insere = ($stmt->rowCount() > 0 && is_null($inDbConnection->errorInfo()[2])); // If there is no DB error' . "\r\n");
        fputs($f, '      if (self::SHOW_CREATE_REQUEST) {' . "\r\n");
        fputs($f, '        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;' . "\r\n");
        fputs($f, '      }' . "\r\n");
        fputs($f, '      $data->setId($inDbConnection->lastInsertId());' . "\r\n");
        fputs($f, '      if ($insere) {' . "\r\n");
        if ($generateFor == "P") {
          fputs($f, '        $trace = $inDbConnection->getTrace();' . "\r\n");
          fputs($f, '        if (!is_null($trace) && !$trace->getManualTrace()) {' . "\r\n");
          fputs($f, '          $traceData = new DistriXTraceData();' . "\r\n");
          fputs($f, '          $traceData->setIdUser($trace->getIdUser());' . "\r\n");
          fputs($f, '          $traceData->setApplication($trace->getApplicationName());' . "\r\n");
          fputs($f, '          $traceData->setSchema($trace->getDbSchemaName());' . "\r\n");
          fputs($f, '          $traceData->setOperationCode($traceData::TRACE_CREATE);' . "\r\n");
          fputs($f, '          $traceData->setOperationId($data->getId());' . "\r\n");
          fputs($f, '          $traceData->setOperationTable(self::TABLE_NAME);' . "\r\n");
          for ($i = 0; $i < $fieldind; $i++) {
            if (stripos($field[$i]["type"], "blob") !== false) {
              fputs($f, '          $data->set' . ucfirst($field[$i]["up"]) . '("");' . "\r\n");
            }
          }
          fputs($f, '          $traceData->setOperationData(print_r($data, true));' . "\r\n");
          fputs($f, '          $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());' . "\r\n");
          fputs($f, '          $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());' . "\r\n");
          fputs($f, '          $trace->addToTrace($traceData);' . "\r\n");
          fputs($f, '        }' . "\r\n");
        } else {
          fputs($f, '        if (method_exists($inDbConnection, "getDataTracking")) {' . "\r\n");
          fputs($f, '          $inDbConnection->getDataTracking()->createToDataTracking($data->getId(), self::TABLE_NAME, $data);' . "\r\n");
          fputs($f, '        }' . "\r\n");
        }
        fputs($f, '      }' . "\r\n");
        fputs($f, '    }' . "\r\n");
        fputs($f, '    return array($insere, $data->getId());' . "\r\n");
        fputs($f, '  }' . "\r\n");
        fputs($f, '  // End of create' . "\r\n");

        // Close class and file
        fputs($f, '}' . "\r\n");
        fputs($f, '// End of class' . "\r\n");
        fputs($f, '?>' . "\r\n");
        fclose($f);

        echo "ok";
        $done = true;
      } else {
        if (strlen($tableName) == 0) {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoTableName";
        }
        if ($fieldind == 0) {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoField";
        }
        if (strlen($uniqueKey) == 0) {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoUniqueKey";
        }
        if (strlen($directory) == 0) {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoDirectory";
        }
      }
      return array($done, $errorT, $errorR);
    }
    // End of generate
  }
  // End of Class
}
// class_exists
