<?php // Needed to encode in UTF8 ààéàé //
class ExerciseTypeStor {

  const TABLE_NAME_TABLENAME = "exercisetypename";
  const FIELDS_TABLENAME = ',exercisetypename.id exercisetypenameid,idexercisetype exercisetypenameidexercisetype,idlanguage exercisetypenameidlanguage,exercisetypename.name exercisetypename,exercisetypename.elemstate exercisetypenameelemstate,exercisetypename.timestamp exercisetypenametimestamp';

  public static function getListNames(bool $all, ExerciseTypeNameStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ExerciseTypeStorData();
    $list = [];
    $listNames = [];
  
    if ($inDbConnection != null) {
      $request  = "SELECT exercisetype.id,exercisetype.code,exercisetype.name,exercisetype.elemstate,exercisetype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idexercisetype";
      if ($dataIn->getIdLanguage() > 0) {
        $request .= " AND ".self::TABLE_NAME_TABLENAME.".idlanguage = ".$dataIn->getIdLanguage();
      }
      if (!$all) {
        $request .= " WHERE ".self::TABLE_NAME.".elemstate = :statut";
      }
      $request .= " ORDER BY  ".self::TABLE_NAME.".code";

      $stmt = $inDbConnection->prepare($request);
      if (!$all) {
        $stmt->execute(['statut'=> $data->getAvailableValue()]);
      } else {
        $stmt->execute();
      }
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $oldValue = "";
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
          // print_r($row);
          $dataName = new ExerciseTypeNameStorData();
          if (! is_null($row["exercisetypenameid"])) {
            $dataName->setId($row["exercisetypenameid"]);
            $dataName->setIdExerciseType($row["exercisetypenameidexercisetype"]);
            $dataName->setIdLanguage($row["exercisetypenameidlanguage"]);
            $dataName->setName($row["exercisetypename"]);
            $dataName->setElemState($row["exercisetypenameelemstate"]);
            $dataName->setTimestamp($row["exercisetypenametimestamp"]);
          }
          if ($oldValue != $row["code"]) {
             $oldValue = $row["code"];
             if ($data->getId() > 0) {
               $list[] = $data;
               $data = new ExerciseTypeStorData();
             }
          }
          $data->setId($row["id"]);
          $data->setCode($row["code"]);
          $data->setName($row["name"]);
          $data->setElemState($row["elemstate"]);
          $data->setTimestamp($row["timestamp"]);
          if (! is_null($row["exercisetypenameid"])) {
            $listNames[] = $dataName;
          }
        }
        $list[] = $data;
      }
    }
    return array($list, $listNames);
  }

  public static function findByIndCodeNames(ExerciseTypeStorData $dataIn, ExerciseTypeNameStorData $dataNameIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ExerciseTypeStorData();
    $listNames = [];

    if ($inDbConnection != null) {
      $request  = "SELECT exercisetype.id,exercisetype.code,exercisetype.name,exercisetype.elemstate,exercisetype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idexercisetype";
      if ($dataNameIn->getIdLanguage() > 0) {
        $request .= " AND ".self::TABLE_NAME_TABLENAME.".idlanguage = ".$dataNameIn->getIdLanguage();
      }
      $request .= " WHERE exercisetype.code = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0'=>  $dataIn->getCode()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
          // print_r($row);
          $dataName = new ExerciseTypeNameStorData();
          if (! is_null($row["exercisetypenameid"])) {
            $dataName->setId($row["exercisetypenameid"]);
            $dataName->setIdExerciseType($row["exercisetypenameidexercisetype"]);
            $dataName->setIdLanguage($row["exercisetypenameidlanguage"]);
            $dataName->setName($row["exercisetypename"]);
            $dataName->setElemState($row["exercisetypenameelemstate"]);
            $dataName->setTimestamp($row["exercisetypenametimestamp"]);
            $listNames[] = $dataName;
          }
          $data->setId($row["id"]);
          $data->setCode($row["code"]);
          $data->setName($row["name"]);
          $data->setElemState($row["elemstate"]);
          $data->setTimestamp($row["timestamp"]);
        }
      }
    }
    return array($data, $listNames);
  }
  // End of findByIndCodeNames

  public static function readNames(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ExerciseTypeStorData();
    $listNames = [];

    if ($inDbConnection != null) {
      $request  = "SELECT exercisetype.id,exercisetype.code,exercisetype.name,exercisetype.elemstate,exercisetype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idexercisetype";
      $request .= " WHERE ".self::TABLE_NAME.".id = :id";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['id'=> $id]);
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
          // print_r($row);
          $dataName = new ExerciseTypeNameStorData();
          if (! is_null($row["exercisetypenameid"])) {
            $dataName->setId($row["exercisetypenameid"]);
            $dataName->setIdExerciseType($row["exercisetypenameidexercisetype"]);
            $dataName->setIdLanguage($row["exercisetypenameidlanguage"]);
            $dataName->setName($row["exercisetypename"]);
            $dataName->setElemState($row["exercisetypenameelemstate"]);
            $dataName->setTimestamp($row["exercisetypenametimestamp"]);
            $listNames[] = $dataName;
          }
          $data->setId($row["id"]);
          $data->setCode($row["code"]);
          $data->setName($row["name"]);
          $data->setElemState($row["elemstate"]);
          $data->setTimestamp($row["timestamp"]);
        }
      }
      $trace = $inDbConnection->getTrace();
      if (!is_null($trace) && !$trace->getManualTrace()) {
        $traceData = new DistriXTraceData();
        $traceData->setIdUser($trace->getIdUser());
        $traceData->setApplication($trace->getApplicationName());
        $traceData->setSchema($trace->getDbSchemaName());
        $traceData->setOperationCode($traceData::TRACE_READ);
        $traceData->setOperationId($id);
        $traceData->setOperationTable(self::TABLE_NAME);
        $traceData->setOperationData(print_r($data, true));
        $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());
        $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());
        $trace->addToTrace($traceData);
      }
    }
    return array($data, $listNames);
  }
  // End of readNames

//=============================================================================
//== DO NOT REMOVE !
//== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
//== DO NOT REMOVE !
//==
//== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
//==
//=============================================================================
//=============================================================================
  const TABLE_NAME = "exercisetype";
  const SELECT = 'SELECT id,code,name,elemstate,timestamp';
  const FROM = ' FROM exercisetype';
  const SHOW_READ_REQUEST = FALSE;
  const SHOW_FIND_REQUEST = FALSE;
  const SHOW_CREATE_REQUEST = FALSE;
  const SHOW_UPDATE_REQUEST = FALSE;
  const SHOW_DELETE_REQUEST = FALSE;
  const DEBUG_ERROR = "</p><br/>DB Error: ";
  const BREAK = "<br/>";
  const DOUBLE_BREAK = "<br/><br/>";

  public static function getList(bool $all, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ExerciseTypeStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE elemstate = :statut";
      }
      $request .= " ORDER BY code";

      $stmt = $inDbConnection->prepare($request);
      if (!$all) {
        $stmt->execute(['statut'=> $data->getAvailableValue()]);
      } else {
        $stmt->execute();
      }
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ExerciseTypeStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function getListFromList(array $inList, bool $all, string $className, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ExerciseTypeStorData();
    $list = [];

    if ($inDbConnection != null && (!is_null($inList)) && (!empty($inList))) {
      if ($className == "" || is_null($className)) {
        $className = "ExerciseTypeStorData";
      }
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE id IN('" . implode("','", array_map(function($data) { return $data->getId(); }, $inList))."')";
      if (!$all) {
        $request .= " AND elemstate = :statut";
      }
      $request .= " ORDER BY code";

      $stmt = $inDbConnection->prepare($request);
      if (!$all) {
        $stmt->execute(['statut'=> $data->getAvailableValue()]);
      } else {
        $stmt->execute();
      }
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $className);
      }
    }
    return array($list, count($list));
  }
  // End of getListFromList

  public static function findByIndCode(ExerciseTypeStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ExerciseTypeStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE code = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0'=>  $dataIn->getCode()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ExerciseTypeStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of IndCode

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ExerciseTypeStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE id = :id";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['id'=> $id]);
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ExerciseTypeStorData");
        $data = $stmt->fetch();
      }
      $trace = $inDbConnection->getTrace();
      if (!is_null($trace) && !$trace->getManualTrace()) {
        $traceData = new DistriXTraceData();
        $traceData->setIdUser($trace->getIdUser());
        $traceData->setApplication($trace->getApplicationName());
        $traceData->setSchema($trace->getDbSchemaName());
        $traceData->setOperationCode($traceData::TRACE_READ);
        $traceData->setOperationId($id);
        $traceData->setOperationTable(self::TABLE_NAME);
        $traceData->setOperationData(print_r($data, true));
        $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());
        $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());
        $trace->addToTrace($traceData);
      }
    }
    return $data;
  }
  // End of read

  public static function update(ExerciseTypeStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE exercisetype SET ";
      $request .= "code= :code,";
      $request .= "name= :name,";
      $request .= "elemstate= :elemstate,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["elemstate"] = $data->getElemState();
      $params["timestamp"] = $data->getTimestamp() + 1;
      $params["oldtimestamp"] = $data->getTimestamp();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      $insere = is_null($inDbConnection->errorInfo()[2]); // If there is no DB error
      if (self::SHOW_UPDATE_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($insere) {
        $trace = $inDbConnection->getTrace();
        if (!is_null($trace) && !$trace->getManualTrace()) {
          $traceData = new DistriXTraceData();
          $traceData->setIdUser($trace->getIdUser());
          $traceData->setApplication($trace->getApplicationName());
          $traceData->setSchema($trace->getDbSchemaName());
          $operationCode = DistriXTraceData::TRACE_UPDATE;
          if ($traceType == "TRACE_REMOVE") {
            $operationCode = DistriXTraceData::TRACE_REMOVE;
          } elseif ($traceType == "TRACE_RESTORE") {
            $operationCode = DistriXTraceData::TRACE_RESTORE;
          }
          $traceData->setOperationCode($operationCode);
          $traceData->setOperationId($data->getId());
          $traceData->setOperationTable(self::TABLE_NAME);
          $traceData->setOperationData(print_r($data, true));
          $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());
          $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());
          $trace->addToTrace($traceData);
        }
      }
    }
    return $insere;
  }
  // End of update

  public static function save(ExerciseTypeStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false; $id = 0;
    if ($data->getId() > 0) {
      $id = $data->getId();
      $insere = self::update($data, "TRACE_UPDATE", $inDbConnection);
    } else {
      list($insere, $id) = self::create($data, $inDbConnection);
    }
    return array($insere, $id);
  }
  // End of save

  public static function remove(ExerciseTypeStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    if ($data->getId() > 0) {
      $data = self::read($data->getId(), $inDbConnection);
      $data->setUnavailable();
      $insere = self::update($data, "TRACE_REMOVE", $inDbConnection);
    }
    return $insere;
  }
  // End of remove

  public static function restore(ExerciseTypeStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    if ($data->getId() > 0) {
      $data = self::read($data->getId(), $inDbConnection);
      $data->setAvailable();
      $insere = self::update($data, "Restore", $inDbConnection);
    }
    return $insere;
  }
  // End of restore

  public static function delete(int $id, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "DELETE FROM exercisetype";
      $request .= " WHERE id = :id";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['id'=> $id]);
      $insere = is_null($inDbConnection->errorInfo()[2]); // If there is no DB error
      if (self::SHOW_DELETE_REQUEST) {
       echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($insere) {
        $trace = $inDbConnection->getTrace();
        if (!is_null($trace) && !$trace->getManualTrace()) {
          $traceData = new DistriXTraceData();
          $traceData->setIdUser($trace->getIdUser());
          $traceData->setApplication($trace->getApplicationName());
          $traceData->setSchema($trace->getDbSchemaName());
          $traceData->setOperationCode($traceData::TRACE_DELETE);
          $traceData->setOperationId($id);
          $traceData->setOperationTable(self::TABLE_NAME);
          $traceData->setOperationData("");
          $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());
          $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());
          $trace->addToTrace($traceData);
        }
      }
    }
    return $insere;
  }
  // End of delete

  public static function create(ExerciseTypeStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO exercisetype(";
      $request .= "code,name,elemstate,timestamp)";
      $request .= " VALUES(";
      $request .= ":code,";
      $request .= ":name,";
      $request .= ":elemstate,";
      $request .= ":timestamp)";
      $params = [];
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["elemstate"] = $data->getElemState();
      $params["timestamp"] = $data->getTimestamp();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      $insere = ($stmt->rowCount() > 0 && is_null($inDbConnection->errorInfo()[2])); // If there is no DB error
      if (self::SHOW_CREATE_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      $data->setId($inDbConnection->lastInsertId());
      if ($insere) {
        $trace = $inDbConnection->getTrace();
        if (!is_null($trace) && !$trace->getManualTrace()) {
          $traceData = new DistriXTraceData();
          $traceData->setIdUser($trace->getIdUser());
          $traceData->setApplication($trace->getApplicationName());
          $traceData->setSchema($trace->getDbSchemaName());
          $traceData->setOperationCode($traceData::TRACE_CREATE);
          $traceData->setOperationId($data->getId());
          $traceData->setOperationTable(self::TABLE_NAME);
          $traceData->setOperationData(print_r($data, true));
          $traceData->setOperationDate(DistriXSvcUtil::getCurrentNumDate());
          $traceData->setOperationTime(DistriXSvcUtil::getCurrentNumTime());
          $trace->addToTrace($traceData);
        }
      }
    }
    return array($insere, $data->getId());
  }
  // End of create
}
// End of class
?>
