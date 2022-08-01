<?php // Needed to encode in UTF8 ààéàé //
class ApiTokenClientStor
{
  public static function findByClientIdApplication(ApiTokenClientStorData $inData, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ApiTokenClientStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE clientid = :clientId";
      $request .= " AND idapitokenapplication = :idApplication";
      $request .= " AND statut = " . $data->getAvailableValue();

      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['clientId' => $inData->getClientId(), 'idApplication' => $inData->getIdApiTokenApplication()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ApiTokenClientStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of findByClientIdApplication

  //=============================================================================
  //== DO NOT REMOVE !
  //== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
  //== DO NOT REMOVE !
  //==
  //== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
  //==
  //=============================================================================
  //=============================================================================
  const TABLE_NAME = "apitokenclient";
  const SELECT = 'SELECT id,idapitokenenterprise,idapitokenuser,idapitokenapplication,clientid,secretkey,publickey,testkey,tokendurationsecond,tokendurationnbcallmax,statut,timestamp';
  const FROM = ' FROM apitokenclient';
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
    $data = new ApiTokenClientStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE statut = :statut";
      }
      $request .= " ORDER BY clientid";

      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['statut' => $data->getAvailableValue()]);
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ApiTokenClientStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function findByEnterpriseUserApp(ApiTokenClientStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ApiTokenClientStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idapitokenenterprise = :index0";
      $request .= " AND idapitokenuser = :index1";
      $request .= " AND idapitokenapplication = :index2";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0' =>  $dataIn->getIdApiTokenEnterprise(), 'index1' =>  $dataIn->getIdApiTokenUser(), 'index2' =>  $dataIn->getIdApiTokenApplication()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ApiTokenClientStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of findByEnterpriseUserApp

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new ApiTokenClientStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ApiTokenClientStorData");
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

  public static function update(ApiTokenClientStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE apitokenclient SET ";
      $request .= "idapitokenenterprise= :idapitokenenterprise,";
      $request .= "idapitokenuser= :idapitokenuser,";
      $request .= "idapitokenapplication= :idapitokenapplication,";
      $request .= "clientid= :clientid,";
      $request .= "secretkey= :secretkey,";
      $request .= "publickey= :publickey,";
      $request .= "testkey= :testkey,";
      $request .= "tokendurationsecond= :tokendurationsecond,";
      $request .= "tokendurationnbcallmax= :tokendurationnbcallmax,";
      $request .= "statut= :statut,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["idapitokenenterprise"] = $data->getIdApiTokenEnterprise();
      $params["idapitokenuser"] = $data->getIdApiTokenUser();
      $params["idapitokenapplication"] = $data->getIdApiTokenApplication();
      $params["clientid"] = $data->getClientId();
      $params["secretkey"] = $data->getSecretKey();
      $params["publickey"] = $data->getPublicKey();
      $params["testkey"] = $data->getTestKey();
      $params["tokendurationsecond"] = $data->getTokenDurationSecond();
      $params["tokendurationnbcallmax"] = $data->getTokenDurationNbCallMax();
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

  public static function save(ApiTokenClientStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function remove(ApiTokenClientStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function restore(ApiTokenClientStorData $data, DistriXPDOConnection $inDbConnection)
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
      $request  = "DELETE FROM apitokenclient";
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

  public static function create(ApiTokenClientStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO apitokenclient(";
      $request .= "idapitokenenterprise,idapitokenuser,idapitokenapplication,clientid,secretkey,publickey,testkey,tokendurationsecond,tokendurationnbcallmax,statut,timestamp)";
      $request .= " VALUES(";
      $request .= ":idapitokenenterprise,";
      $request .= ":idapitokenuser,";
      $request .= ":idapitokenapplication,";
      $request .= ":clientid,";
      $request .= ":secretkey,";
      $request .= ":publickey,";
      $request .= ":testkey,";
      $request .= ":tokendurationsecond,";
      $request .= ":tokendurationnbcallmax,";
      $request .= ":statut,";
      $request .= ":timestamp)";
      $params = [];
      $params["idapitokenenterprise"] = $data->getIdApiTokenEnterprise();
      $params["idapitokenuser"] = $data->getIdApiTokenUser();
      $params["idapitokenapplication"] = $data->getIdApiTokenApplication();
      $params["clientid"] = $data->getClientId();
      $params["secretkey"] = $data->getSecretKey();
      $params["publickey"] = $data->getPublicKey();
      $params["testkey"] = $data->getTestKey();
      $params["tokendurationsecond"] = $data->getTokenDurationSecond();
      $params["tokendurationnbcallmax"] = $data->getTokenDurationNbCallMax();
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
