<?php // Needed to encode in UTF8 ààéàé //
class CircuitTypeNameStor {

//=============================================================================
//== DO NOT REMOVE !
//== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
//== DO NOT REMOVE !
//==
//== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
//==
//=============================================================================
//=============================================================================
  const TABLE_NAME = "circuittypename";
  const SELECT = 'SELECT id,idcircuittype,idlanguage,name,elemstate,timestamp';
  const FROM = ' FROM circuittypename';
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
    $data = new CircuitTypeNameStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE elemstate = :statut";
      }
      $request .= " ORDER BY name";

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
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "CircuitTypeNameStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function getListFromList(array $inList, bool $all, string $className, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new CircuitTypeNameStorData();
    $list = [];

    if ($inDbConnection != null && (!is_null($inList)) && (!empty($inList))) {
      if ($className == "" || is_null($className)) {
        $className = "CircuitTypeNameStorData";
      }
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE id IN('" . implode("','", array_map(function($data) { return $data->getId(); }, $inList))."')";
      if (!$all) {
        $request .= " AND elemstate = :statut";
      }
      $request .= " ORDER BY name";

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

  public static function findByindcircuitTypeunique(CircuitTypeNameStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new CircuitTypeNameStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idcircuittype = :index0";
      $request .= " AND idlanguage = :index1";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0'=>  $dataIn->getIdCircuitType(), 'index1'=>  $dataIn->getIdLanguage()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "CircuitTypeNameStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of indcircuitTypeunique

  public static function findByindlanguage(CircuitTypeNameStorData $dataIn, bool $all, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idlanguage = :index0";
      if (!$all) {
        $request .= " AND elemstate = :statut";
      }
      $params = [];
      $params["index0"] = $dataIn->getIdLanguage();
      if (!$all) {
        $params["statut"] = $dataIn->getAvailableValue();
      }
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "CircuitTypeNameStorData");
      }
    }
    return array($list, count($list));
  }
  // End of indlanguage

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new CircuitTypeNameStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "CircuitTypeNameStorData");
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

  public static function update(CircuitTypeNameStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE circuittypename SET ";
      $request .= "idcircuittype= :idcircuittype,";
      $request .= "idlanguage= :idlanguage,";
      $request .= "name= :name,";
      $request .= "elemstate= :elemstate,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["idcircuittype"] = $data->getIdCircuitType();
      $params["idlanguage"] = $data->getIdLanguage();
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

  public static function save(CircuitTypeNameStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function remove(CircuitTypeNameStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function restore(CircuitTypeNameStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    if ($data->getId() > 0) {
      $data = self::read($data->getId(), $inDbConnection);
      $data->setAvailable();
      $insere = self::update($data, "TRACE_RESTORE", $inDbConnection);
    }
    return $insere;
  }
  // End of restore

  public static function delete(int $id, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "DELETE FROM circuittypename";
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

  public static function create(CircuitTypeNameStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO circuittypename(";
      $request .= "idcircuittype,idlanguage,name,elemstate,timestamp)";
      $request .= " VALUES(";
      $request .= ":idcircuittype,";
      $request .= ":idlanguage,";
      $request .= ":name,";
      $request .= ":elemstate,";
      $request .= ":timestamp)";
      $params = [];
      $params["idcircuittype"] = $data->getIdCircuitType();
      $params["idlanguage"] = $data->getIdLanguage();
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
