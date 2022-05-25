<?php // Needed to encode in UTF8 ààéàé //
class LabelStor {

//=============================================================================
//== DO NOT REMOVE !
//== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
//== DO NOT REMOVE !
//==
//== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
//==
//=============================================================================
//=============================================================================
  const TABLE_NAME = "label";
  const SELECT = 'SELECT id,code,name,linktopicture,size,type,statut,timestamp';
  const FROM = ' FROM label';
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
    $data = new LabelStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE statut = :statut";
      }
      $request .= " ORDER BY id";

      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['statut'=> $data->getAvailableValue()]);
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "LabelStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function findByCode(LabelStorData $dataIn, bool $all, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE code = :index0";
      if (!$all) {
        $request .= " WHERE statut = :statut";
      }
      $params = [];
      $params["index0"] = $dataIn->getCode();
      if (!$all) {
        $params["statut"] = $dataIn->getStatus();
      }
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "LabelStorData");
      }
    }
    return array($list, count($list));
  }
  // End of Code

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new LabelStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "LabelStorData");
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

  public static function update(LabelStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE label SET ";
      $request .= "code= :code,";
      $request .= "name= :name,";
      $request .= "linktopicture= :linktopicture,";
      $request .= "size= :size,";
      $request .= "type= :type,";
      $request .= "statut= :statut,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["linktopicture"] = $data->getLinkToPicture();
      $params["size"] = $data->getSize();
      $params["type"] = $data->getType();
      $params["statut"] = $data->getStatus();
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
          $traceData->setOperationCode($traceType);
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

  public static function save(LabelStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false; $id = 0;
    if ($data->getId() > 0) {
      $id = $data->getId();
      $insere = self::update($data, DistriXTraceData::TRACE_UPDATE, $inDbConnection);
    } else {
      list($insere, $id) = self::create($data, $inDbConnection);
    }
    return array($insere, $id);
  }
  // End of save

  public static function remove(LabelStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    if ($data->getId() > 0) {
      $data = self::read($data->getId(), $inDbConnection);
      $data->setUnavailable();
      $insere = self::update($data, DistriXTraceData::TRACE_REMOVE, $inDbConnection);
    }
    return $insere;
  }
  // End of remove

  public static function restore(LabelStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    if ($data->getId() > 0) {
      $data = self::read($data->getId(), $inDbConnection);
      $data->setAvailable();
      $insere = self::update($data, DistriXTraceData::TRACE_RESTORE, $inDbConnection);
    }
    return $insere;
  }
  // End of restore

  public static function delete(int $id, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "DELETE FROM label";
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

  public static function create(LabelStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO label(";
      $request .= "code,name,linktopicture,size,type,statut,timestamp)";
      $request .= " VALUES(";
      $request .= ":code,";
      $request .= ":name,";
      $request .= ":linktopicture,";
      $request .= ":size,";
      $request .= ":type,";
      $request .= ":statut,";
      $request .= ":timestamp)";
      $params = [];
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["linktopicture"] = $data->getLinkToPicture();
      $params["size"] = $data->getSize();
      $params["type"] = $data->getType();
      $params["statut"] = $data->getStatus();
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
