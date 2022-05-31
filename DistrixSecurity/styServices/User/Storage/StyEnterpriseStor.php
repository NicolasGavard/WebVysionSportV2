<?php // Needed to encode in UTF8 ààéàé //
class StyEnterpriseStor
{
  public static function getParentList(bool $all, DistriXPDOConnection $inDbConnection): array
  {
    $request = "";
    $data = new StyEnterpriseStorData();
    $list = array();
    $listInd = 0;

    if ($inDbConnection != null) {
      $request  = "SELECT entc.id id,entc.name name,entc.city city,entc.statut statut,entp.id idstyenterpriseparent";
      $request .= " FROM enterprise as entc";
      $request .= " LEFT JOIN enterprise AS entp ON entc.identerpriseparent = entp.id";
      if (!$all) {
        $request .= " WHERE entc.statut = :statut";
      }

      $params = [];
      if (!$all) {
        $params["statut"] = $data->getAvailableValue();
      }
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyEnterpriseStorData");
      }
    }
    return array($list, $listInd);
  }
  // End of getParentList

  //=============================================================================
  //== DO NOT REMOVE !
  //== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
  //== DO NOT REMOVE !
  //==
  //== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
  //==
  //=============================================================================
  //=============================================================================
  const TABLE_NAME = "styenterprise";
  const SELECT = 'SELECT id,code,name,email,phone,mobile,co,street,zipcode,city,logoimagehtmlname,logoimagename,logosize,logotype,idregion,idcountry,idlanguage,idusermanager,idstyenterpriseparent,statut,timestamp';
  const FROM = ' FROM styenterprise';
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
    $data = new StyEnterpriseStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE statut = :statut";
      }
      $request .= " ORDER BY code";

      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['statut' => $data->getAvailableValue()]);
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyEnterpriseStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function findByCode(StyEnterpriseStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new StyEnterpriseStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE code = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0' =>  $dataIn->getCode()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyEnterpriseStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of findByCode

  public static function findByName(StyEnterpriseStorData $dataIn, bool $all, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE name = :index0";
      if (!$all) {
        $request .= " AND statut = :statut";
      }
      $params = [];
      $params["index0"] = $dataIn->getName();
      if (!$all) {
        $params["statut"] = $dataIn->getStatus();
      }
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyEnterpriseStorData");
      }
    }
    return array($list, count($list));
  }
  // End of findByName

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new StyEnterpriseStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyEnterpriseStorData");
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

  public static function update(StyEnterpriseStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE enterprise SET ";
      $request .= "code= :code,";
      $request .= "name= :name,";
      $request .= "email= :email,";
      $request .= "phone= :phone,";
      $request .= "mobile= :mobile,";
      $request .= "co= :co,";
      $request .= "street= :street,";
      $request .= "zipcode= :zipcode,";
      $request .= "city= :city,";
      $request .= "logoimagehtmlname= :logoimagehtmlname,";
      $request .= "logoimagename= :logoimagename,";
      $request .= "logosize= :logosize,";
      $request .= "logotype= :logotype,";
      $request .= "idregion= :idregion,";
      $request .= "idcountry= :idcountry,";
      $request .= "idlanguage= :idlanguage,";
      $request .= "idusermanager= :idusermanager,";
      $request .= "idstyenterpriseparent= :idstyenterpriseparent,";
      $request .= "statut= :statut,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["email"] = $data->getEmail();
      $params["phone"] = $data->getPhone();
      $params["mobile"] = $data->getMobile();
      $params["co"] = $data->getCo();
      $params["street"] = $data->getStreet();
      $params["zipcode"] = $data->getZipCode();
      $params["city"] = $data->getCity();
      $params["logoimagehtmlname"] = $data->getLogoImageHtmlName();
      $params["logoimagename"] = $data->getLogoImageName();
      $params["logosize"] = $data->getLogoSize();
      $params["logotype"] = $data->getLogoType();
      $params["idregion"] = $data->getIdRegion();
      $params["idcountry"] = $data->getIdCountry();
      $params["idlanguage"] = $data->getIdLanguage();
      $params["idusermanager"] = $data->getIdUserManager();
      $params["idstyenterpriseparent"] = $data->getIdStyEnterpriseParent();
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

  public static function save(StyEnterpriseStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function remove(StyEnterpriseStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function restore(StyEnterpriseStorData $data, DistriXPDOConnection $inDbConnection)
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
      $request  = "DELETE FROM enterprise";
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

  public static function create(StyEnterpriseStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO enterprise(";
      $request .= "code,name,email,phone,mobile,co,street,zipcode,city,logoimagehtmlname,logoimagename,logosize,logotype,idregion,idcountry,idlanguage,idusermanager,idstyenterpriseparent,statut,timestamp)";
      $request .= " VALUES(";
      $request .= ":code,";
      $request .= ":name,";
      $request .= ":email,";
      $request .= ":phone,";
      $request .= ":mobile,";
      $request .= ":co,";
      $request .= ":street,";
      $request .= ":zipcode,";
      $request .= ":city,";
      $request .= ":logoimagehtmlname,";
      $request .= ":logoimagename,";
      $request .= ":logosize,";
      $request .= ":logotype,";
      $request .= ":idregion,";
      $request .= ":idcountry,";
      $request .= ":idlanguage,";
      $request .= ":idusermanager,";
      $request .= ":idstyenterpriseparent,";
      $request .= ":statut,";
      $request .= ":timestamp)";
      $params = [];
      $params["code"] = $data->getCode();
      $params["name"] = $data->getName();
      $params["email"] = $data->getEmail();
      $params["phone"] = $data->getPhone();
      $params["mobile"] = $data->getMobile();
      $params["co"] = $data->getCo();
      $params["street"] = $data->getStreet();
      $params["zipcode"] = $data->getZipCode();
      $params["city"] = $data->getCity();
      $params["logoimagehtmlname"] = $data->getLogoImageHtmlName();
      $params["logoimagename"] = $data->getLogoImageName();
      $params["logosize"] = $data->getLogoSize();
      $params["logotype"] = $data->getLogoType();
      $params["idregion"] = $data->getIdRegion();
      $params["idcountry"] = $data->getIdCountry();
      $params["idlanguage"] = $data->getIdLanguage();
      $params["idusermanager"] = $data->getIdUserManager();
      $params["idstyenterpriseparent"] = $data->getIdStyEnterpriseParent();
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
