<?php // Needed to encode in UTF8 ààéàé //
class FoodTypeStor {

  const TABLE_NAME_TABLENAME = "foodtypename";
  const FIELDS_TABLENAME = ',foodtypename.id foodtypenameid,idfoodtype foodtypenameidfoodtype,idlanguage foodtypenameidlanguage,foodtypename.name foodtypename,foodtypename.elemstate foodtypenameelemstate,foodtypename.timestamp foodtypenametimestamp';

  public static function getListNames(bool $all, FoodTypeNameStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new FoodTypeStorData();
    $list = [];
    $listNames = [];
  
    if ($inDbConnection != null) {
      $request  = "SELECT foodtype.id,foodtype.code,foodtype.name,foodtype.elemstate,foodtype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idfoodtype";
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
          $dataName = new FoodTypeNameStorData();
          if (! is_null($row["foodtypenameid"])) {
            $dataName->setId($row["foodtypenameid"]);
            $dataName->setIdFoodType($row["foodtypenameidfoodtype"]);
            $dataName->setIdLanguage($row["foodtypenameidlanguage"]);
            $dataName->setName($row["foodtypename"]);
            $dataName->setElemState($row["foodtypenameelemstate"]);
            $dataName->setTimestamp($row["foodtypenametimestamp"]);
          }
          if ($oldValue != $row["code"]) {
             $oldValue = $row["code"];
             if ($data->getId() > 0) {
               $list[] = $data;
               $data = new FoodTypeStorData();
             }
          }
          $data->setId($row["id"]);
          $data->setCode($row["code"]);
          $data->setName($row["name"]);
          $data->setElemState($row["elemstate"]);
          $data->setTimestamp($row["timestamp"]);
          if (! is_null($row["foodtypenameid"])) {
            $listNames[] = $dataName;
          }
        }
        $list[] = $data;
      }
    }
    return array($list, $listNames);
  }

  public static function findByIndCodeNames(FoodTypeStorData $dataIn, FoodTypeNameStorData $dataNameIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new FoodTypeStorData();
    $listNames = [];

    if ($inDbConnection != null) {
      $request  = "SELECT foodtype.id,foodtype.code,foodtype.name,foodtype.elemstate,foodtype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idfoodtype";
      if ($dataNameIn->getIdLanguage() > 0) {
        $request .= " AND ".self::TABLE_NAME_TABLENAME.".idlanguage = ".$dataNameIn->getIdLanguage();
      }
      $request .= " WHERE foodtype.code = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0'=>  $dataIn->getCode()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
          // print_r($row);
          $dataName = new FoodTypeNameStorData();
          if (! is_null($row["foodtypenameid"])) {
            $dataName->setId($row["foodtypenameid"]);
            $dataName->setIdFoodType($row["foodtypenameidfoodtype"]);
            $dataName->setIdLanguage($row["foodtypenameidlanguage"]);
            $dataName->setName($row["foodtypename"]);
            $dataName->setElemState($row["foodtypenameelemstate"]);
            $dataName->setTimestamp($row["foodtypenametimestamp"]);
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


//=============================================================================
//== DO NOT REMOVE !
//== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
//== DO NOT REMOVE !
//==
//== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
//==
//=============================================================================
//=============================================================================
  const TABLE_NAME = "foodtype";
  const SELECT = 'SELECT id,code,name,elemstate,timestamp';
  const FROM = ' FROM foodtype';
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
    $data = new FoodTypeStorData();
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
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "FoodTypeStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function getListFromList(array $inList, bool $all, string $className, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new FoodTypeStorData();
    $list = [];

    if ($inDbConnection != null && (!is_null($inList)) && (!empty($inList))) {
      if ($className == "" || is_null($className)) {
        $className = "FoodTypeStorData";
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

  public static function findByIndCode(FoodTypeStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new FoodTypeStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "FoodTypeStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of IndCode

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new FoodTypeStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "FoodTypeStorData");
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

  public static function update(FoodTypeStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE foodtype SET ";
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

  public static function save(FoodTypeStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function remove(FoodTypeStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function restore(FoodTypeStorData $data, DistriXPDOConnection $inDbConnection)
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
      $request  = "DELETE FROM foodtype";
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

  public static function create(FoodTypeStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO foodtype(";
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
