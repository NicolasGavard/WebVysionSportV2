<?php // Needed to encode in UTF8 ààéàé //
class MealTypeStor {

  const TABLE_NAME_TABLENAME = "mealtypename";
  const FIELDS_TABLENAME = ',mealtypename.id mealtypenameid,idmealtype mealtypenameidmealtype,idlanguage mealtypenameidlanguage,mealtypename.name mealtypename,mealtypename.elemstate mealtypenameelemstate,mealtypename.timestamp mealtypenametimestamp';

  public static function getListNames(bool $all, MealTypeNameStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new MealTypeStorData();
    $list = [];
    $listNames = [];
  
    if ($inDbConnection != null) {
      $request  = "SELECT mealtype.id,mealtype.code,mealtype.name,mealtype.displayorder,mealtype.elemstate,mealtype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idmealtype";
      if ($dataIn->getIdLanguage() > 0) {
        $request .= " AND ".self::TABLE_NAME_TABLENAME.".idlanguage = ".$dataIn->getIdLanguage();
      }
      if (!$all) {
        $request .= " WHERE ".self::TABLE_NAME.".elemstate = :statut";
      }
      $request .= " ORDER BY  mealtype.displayorder,".self::TABLE_NAME.".code";

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
          $dataName = new MealTypeNameStorData();
          if (! is_null($row["mealtypenameid"])) {
            $dataName->setId($row["mealtypenameid"]);
            $dataName->setIdMealType($row["mealtypenameidmealtype"]);
            $dataName->setIdLanguage($row["mealtypenameidlanguage"]);
            $dataName->setName($row["mealtypename"]);
            $dataName->setElemState($row["mealtypenameelemstate"]);
            $dataName->setTimestamp($row["mealtypenametimestamp"]);
          }
          if ($oldValue != $row["code"]) {
             $oldValue = $row["code"];
             if ($data->getId() > 0) {
               $list[] = $data;
               $data = new MealTypeStorData();
             }
          }
          $data->setId($row["id"]);
          $data->setCode($row["code"]);
          $data->setName($row["name"]);
          $data->setDisplayOrder($row["displayorder"]);
          $data->setElemState($row["elemstate"]);
          $data->setTimestamp($row["timestamp"]);
          if (! is_null($row["mealtypenameid"])) {
            $listNames[] = $dataName;
          }
        }
        $list[] = $data;
      }
    }
    return array($list, $listNames);
  }

  public static function findByIndCodeNames(MealTypeStorData $dataIn, MealTypeNameStorData $dataNameIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new MealTypeStorData();
    $listNames = [];

    if ($inDbConnection != null) {
      $request  = "SELECT mealtype.id,mealtype.code,mealtype.name,mealtype.displayorder,mealtype.elemstate,mealtype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idmealtype";
      if ($dataNameIn->getIdLanguage() > 0) {
        $request .= " AND ".self::TABLE_NAME_TABLENAME.".idlanguage = ".$dataNameIn->getIdLanguage();
      }
      $request .= " WHERE mealtype.code = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0'=>  $dataIn->getCode()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
          // print_r($row);
          $dataName = new MealTypeNameStorData();
          if (! is_null($row["mealtypenameid"])) {
            $dataName->setId($row["mealtypenameid"]);
            $dataName->setIdMealType($row["mealtypenameidmealtype"]);
            $dataName->setIdLanguage($row["mealtypenameidlanguage"]);
            $dataName->setName($row["mealtypename"]);
            $dataName->setElemState($row["mealtypenameelemstate"]);
            $dataName->setTimestamp($row["mealtypenametimestamp"]);
            $listNames[] = $dataName;
          }
          $data->setId($row["id"]);
          $data->setCode($row["code"]);
          $data->setName($row["name"]);
          $data->setDisplayOrder($row["displayorder"]);
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
    $data = new MealTypeStorData();
    $listNames = [];

    if ($inDbConnection != null) {
      $request  = "SELECT mealtype.id,mealtype.code,mealtype.name,mealtype.displayorder,mealtype.elemstate,mealtype.timestamp";
      $request .= self::FIELDS_TABLENAME;
      $request .= self::FROM;
      $request .= " LEFT JOIN ".self::TABLE_NAME_TABLENAME." ON ".self::TABLE_NAME.".id = ".self::TABLE_NAME_TABLENAME.".idmealtype";
      $request .= " WHERE ".self::TABLE_NAME.".id = :id";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['id'=> $id]);
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
          // print_r($row);
          $dataName = new MealTypeNameStorData();
          if (! is_null($row["mealtypenameid"])) {
            $dataName->setId($row["mealtypenameid"]);
            $dataName->setIdMealType($row["mealtypenameidmealtype"]);
            $dataName->setIdLanguage($row["mealtypenameidlanguage"]);
            $dataName->setName($row["mealtypename"]);
            $dataName->setElemState($row["mealtypenameelemstate"]);
            $dataName->setTimestamp($row["mealtypenametimestamp"]);
            $listNames[] = $dataName;
          }
          $data->setId($row["id"]);
          $data->setCode($row["code"]);
          $data->setName($row["name"]);
          $data->setDisplayOrder($row["displayorder"]);
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
  const TABLE_NAME = "mealtype";
  const SELECT = 'SELECT id,code,name,displayorder,elemstate,timestamp';
  const FROM = ' FROM mealtype';
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
    $data = new MealTypeStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE elemstate = :statut";
      }
      $request .= " ORDER BY displayorder";

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
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "MealTypeStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function getListFromList(array $inList, bool $all, string $className, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new MealTypeStorData();
    $list = [];

    if ($inDbConnection != null && (!is_null($inList)) && (!empty($inList))) {
      if ($className == "" || is_null($className)) {
        $className = "MealTypeStorData";
      }
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE id IN('" . implode("','", array_map(function($data) { return $data->getId(); }, $inList))."')";
      if (!$all) {
        $request .= " AND elemstate = :statut";
      }
      $request .= " ORDER BY displayorder";

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

  public static function findByCode(MealTypeStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new MealTypeStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "MealTypeStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of Code

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new MealTypeStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "MealTypeStorData");
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

  public static function update(MealTypeStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE mealtype SET ";
      $request .= "code= :code,";
      $request .= "name= :name,";
      $request .= "displayorder= :displayorder,";
      $request .= "elemstate= :elemstate,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["displayorder"] = $data->getDisplayOrder();
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

  public static function save(MealTypeStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function remove(MealTypeStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function restore(MealTypeStorData $data, DistriXPDOConnection $inDbConnection)
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
      $request  = "DELETE FROM mealtype";
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

  public static function create(MealTypeStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO mealtype(";
      $request .= "code,name,elemstate,timestamp)";
      $request .= " VALUES(";
      $request .= ":code,";
      $request .= ":name,";
      $request .= ":displayorder,";
      $request .= ":elemstate,";
      $request .= ":timestamp)";
      $params = [];
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["displayorder"] = $data->getDisplayOrder();
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
