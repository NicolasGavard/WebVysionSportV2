<?php // Needed to encode in UTF8 ààéàé //
class RecipeStor {

//=============================================================================
//== DO NOT REMOVE !
//== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
//== DO NOT REMOVE !
//==
//== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
//==
//=============================================================================
//=============================================================================
  const TABLE_NAME = "recipe";
  const SELECT = 'SELECT id,idusercoach,code,name,description,linktopicture,size,type,rating,elemstate,timestamp';
  const FROM = ' FROM recipe';
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
    $data = new RecipeStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE elemstate = :statut";
      }
      $request .= " ORDER BY id";

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
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "RecipeStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function getListFromList(array $inList, bool $all, string $className, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new RecipeStorData();
    $list = [];

    if ($inDbConnection != null && (!is_null($inList)) && (!empty($inList))) {
      if ($className == "" || is_null($className)) {
        $className = "RecipeStorData";
      }
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE id IN('" . implode("','", array_map(function($data) { return $data->getId(); }, $inList))."')";
      if (!$all) {
        $request .= " AND elemstate = :statut";
      }
      $request .= " ORDER BY id";

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

  public static function findByIdUserCoachCode(RecipeStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new RecipeStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE code = :index0";
      $request .= " AND idusercoach = :index1";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0'=>  $dataIn->getCode(), 'index1'=>  $dataIn->getIdUserCoach()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "RecipeStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of IdUserCoachCode

  public static function findByCode(RecipeStorData $dataIn, bool $all, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE code = :index0";
      if (!$all) {
        $request .= " AND elemstate = :statut";
      }
      $params = [];
      $params["index0"] = $dataIn->getCode();
      if (!$all) {
        $params["statut"] = $dataIn->getAvailableValue();
      }
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "RecipeStorData");
      }
    }
    return array($list, count($list));
  }
  // End of Code

  public static function findByIdUserCoach(RecipeStorData $dataIn, bool $all, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idusercoach = :index0";
      if (!$all) {
        $request .= " AND elemstate = :statut";
      }
      $params = [];
      $params["index0"] = $dataIn->getIdUserCoach();
      if (!$all) {
        $params["statut"] = $dataIn->getAvailableValue();
      }
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "RecipeStorData");
      }
    }
    return array($list, count($list));
  }
  // End of IdUserCoach

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new RecipeStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "RecipeStorData");
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

  public static function update(RecipeStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE recipe SET ";
      $request .= "idusercoach= :idusercoach,";
      $request .= "code= :code,";
      $request .= "name= :name,";
      $request .= "description= :description,";
      $request .= "linktopicture= :linktopicture,";
      $request .= "size= :size,";
      $request .= "type= :type,";
      $request .= "rating= :rating,";
      $request .= "elemstate= :elemstate,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["idusercoach"] = $data->getIdUserCoach();
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["description"] = $data->getDescription();
      $params["linktopicture"] = $data->getLinkToPicture();
      $params["size"] = $data->getSize();
      $params["type"] = $data->getType();
      $params["rating"] = $data->getRating();
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

  public static function save(RecipeStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function remove(RecipeStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function restore(RecipeStorData $data, DistriXPDOConnection $inDbConnection)
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
      $request  = "DELETE FROM recipe";
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

  public static function create(RecipeStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO recipe(";
      $request .= "idusercoach,code,name,description,linktopicture,size,type,rating,elemstate,timestamp)";
      $request .= " VALUES(";
      $request .= ":idusercoach,";
      $request .= ":code,";
      $request .= ":name,";
      $request .= ":description,";
      $request .= ":linktopicture,";
      $request .= ":size,";
      $request .= ":type,";
      $request .= ":rating,";
      $request .= ":elemstate,";
      $request .= ":timestamp)";
      $params = [];
      $params["idusercoach"] = $data->getIdUserCoach();
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["description"] = $data->getDescription();
      $params["linktopicture"] = $data->getLinkToPicture();
      $params["size"] = $data->getSize();
      $params["type"] = $data->getType();
      $params["rating"] = $data->getRating();
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
