<?php // Needed to encode in UTF8 ààéàé //
class StyUserRightStor
{
  public static function findAllByUserApp(StyUserAllRightStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request  = "";
    $list     = [];

    if ($inDbConnection != null) {
      $request  = "SELECT app.code styapplicationcode, modu.code stymodulecode, funct.code styfunctionalitycode, styrights.id id, styrights.idstyuser idstyuser, styrights.sumofrights";
      $request .= " FROM styapplication app, styuserright styrights";
      $request .= " LEFT JOIN stymodule modu ON (modu.id = styrights.idstymodule)";
      $request .= " LEFT JOIN styfunctionality funct ON (funct.id = styrights.idstyfunctionality)";
      $request .= " WHERE app.code = :index0";
      $request .= " AND styrights.idstyuser = :index1";
      $request .= " AND styrights.idstyapplication = app.id";
      $params = [];
      $params["index0"] = $dataIn->getStyApplicationCode();
      $params["index1"] = $dataIn->getIdStyUser();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserAllRightStorData");
      }
    }
    return array($list, count($list));
  }
  // End of findAllByUserApp

  //=============================================================================
  //== DO NOT REMOVE !
  //== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
  //== DO NOT REMOVE !
  //==
  //== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
  //==
  //=============================================================================
  //=============================================================================
  const TABLE_NAME = "styuserright";
  const SELECT = 'SELECT id,idstyuser,idstyapplication,idstymodule,idstyfunctionality,sumofrights';
  const FROM = ' FROM styuserright';
  const SHOW_READ_REQUEST   = FALSE;
  const SHOW_FIND_REQUEST   = FALSE;
  const SHOW_CREATE_REQUEST = FALSE;
  const SHOW_UPDATE_REQUEST = FALSE;
  const SHOW_DELETE_REQUEST = FALSE;
  const DEBUG_ERROR = "</p><br/>DB Error: ";
  const BREAK = "<br/>";
  const DOUBLE_BREAK = "<br/><br/>";

  public static function getList(DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " ORDER BY idstyuser";

      $stmt = $inDbConnection->prepare($request);
      $stmt->execute();
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserRightStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function findByUser(StyUserRightStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idstyuser = :index0";
      $params = [];
      $params["index0"] = $dataIn->getIdStyUser();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserRightStorData");
      }
    }
    return array($list, count($list));
  }
  // End of findByUser

  public static function findByUserApp(StyUserRightStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idstyuser = :index0";
      $request .= " AND idstyapplication = :index1";
      $params = [];
      $params["index0"] = $dataIn->getIdStyUser();
      $params["index1"] = $dataIn->getIdStyApplication();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserRightStorData");
      }
    }
    return array($list, count($list));
  }
  // End of findByUserApp

  public static function findByUserModule(StyUserRightStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idstyuser = :index0";
      $request .= " AND idstyapplication = :index1";
      $request .= " AND idstymodule = :index2";
      $params = [];
      $params["index0"] = $dataIn->getIdStyUser();
      $params["index1"] = $dataIn->getIdStyApplication();
      $params["index2"] = $dataIn->getIdStyModule();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserRightStorData");
      }
    }
    return array($list, count($list));
  }
  // End of findByUserModule

  public static function findByUserModuleFunc(StyUserRightStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idstyuser = :index0";
      $request .= " AND idstyapplication = :index1";
      $request .= " AND idstymodule = :index2";
      $request .= " AND idstyfunctionality = :index3";
      $params = [];
      $params["index0"] = $dataIn->getIdStyUser();
      $params["index1"] = $dataIn->getIdStyApplication();
      $params["index2"] = $dataIn->getIdStyModule();
      $params["index3"] = $dataIn->getIdStyFunctionality();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserRightStorData");
      }
    }
    return array($list, count($list));
  }
  // End of findByUserModuleFunc

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new StyUserRightStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE id = :id";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['id' => $id]);
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserRightStorData");
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

  public static function update(StyUserRightStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE styuserright SET ";
      $request .= "idstyuser= :idstyuser,";
      $request .= "idstyapplication= :idstyapplication,";
      $request .= "idstymodule= :idstymodule,";
      $request .= "idstyfunctionality= :idstyfunctionality,";
      $request .= "sumofrights= :sumofrights";
      $request .= " WHERE id = :id";
      $params = [];
      $params["id"] = $data->getId();
      $params["idstyuser"] = $data->getIdStyUser();
      $params["idstyapplication"] = $data->getIdStyApplication();
      $params["idstymodule"] = $data->getIdStyModule();
      $params["idstyfunctionality"] = $data->getIdStyFunctionality();
      $params["sumofrights"] = $data->getSumOfRights();
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

  public static function save(StyUserRightStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $id = 0;
    if ($data->getId() > 0) {
      $id = $data->getId();
      $insere = self::update($data, DistriXTraceData::TRACE_UPDATE, $inDbConnection);
    } else {
      list($insere, $id) = self::create($data, $inDbConnection);
    }
    return array($insere, $id);
  }
  // End of save

  public static function delete(int $id, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "DELETE FROM styuserright";
      $request .= " WHERE id = :id";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['id' => $id]);
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

  public static function create(StyUserRightStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO styuserright(";
      $request .= "idstyuser,idstyapplication,idstymodule,idstyfunctionality,sumofrights)";
      $request .= " VALUES(";
      $request .= ":idstyuser,";
      $request .= ":idstyapplication,";
      $request .= ":idstymodule,";
      $request .= ":idstyfunctionality,";
      $request .= ":sumofrights)";
      $params = [];
      $params["idstyuser"] = $data->getIdStyUser();
      $params["idstyapplication"] = $data->getIdStyApplication();
      $params["idstymodule"] = $data->getIdStyModule();
      $params["idstyfunctionality"] = $data->getIdStyFunctionality();
      $params["sumofrights"] = $data->getSumOfRights();
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
