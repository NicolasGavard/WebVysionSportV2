<?php // Needed to encode in UTF8 ààéàé //
class StyUserStor
{

  //=============================================================================
  //== DO NOT REMOVE !
  //== CODE UNDER WILL BE AUTOMATICALLY REGENERATED !
  //== DO NOT REMOVE !
  //==
  //== PLEASE PUT YOUR OWN FUNCTIONS ON TOP OF THE CLASS !
  //==
  //=============================================================================
  //=============================================================================
  const TABLE_NAME = "styuser";
  const SELECT = 'SELECT id,idstyusertype,login,firstname,name,linktopicture,size,type,pass,email,emailbackup,phone,mobile,initpass,idlanguage,idstyenterprise,statut,timestamp';
  const FROM = ' FROM styuser';
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
    $data = new StyUserStorData();
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      if (!$all) {
        $request .= " WHERE statut = :statut";
      }
      $request .= " ORDER BY name";
      
      $stmt = $inDbConnection->prepare($request);
      if (!$all) {
        $stmt->execute(['statut' => $data->getAvailableValue()]);
      } else {
        $stmt->execute();
      }
      if (self::SHOW_READ_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserStorData");
      }
    }
    return array($list, count($list));
  }
  // End of getList

  public static function findByLogin(StyUserStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new StyUserStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE login = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0' => $dataIn->getLogin()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of findByLogin

  public static function findByEmail(StyUserStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new StyUserStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE email = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0' => $dataIn->getEmail()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of findByEmail

  public static function findByEmailBackup(StyUserStorData $dataIn, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new StyUserStorData();

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE emailbackup = :index0";
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute(['index0' => $dataIn->getEmailBackup()]);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserStorData");
        $data = $stmt->fetch();
      }
    }
    return $data;
  }
  // End of findByEmailBackup

  public static function findByEnterpise(StyUserStorData $dataIn, bool $all, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $list = [];

    if ($inDbConnection != null) {
      $request  = self::SELECT;
      $request .= self::FROM;
      $request .= " WHERE idstyenterprise = :index0";
      if (!$all) {
        $request .= " AND statut = :statut";
      }
      $params = [];
      $params["index0"] = $dataIn->getIdStyEnterprise();
      if (!$all) {
        $params["statut"] = $dataIn->getStatus();
      }
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      if (self::SHOW_FIND_REQUEST) {
        echo self::DEBUG_ERROR . $inDbConnection->errorInfo()[2] . self::BREAK . $stmt->debugDumpParams() . self::DOUBLE_BREAK;
      }
      if ($stmt->rowCount() > 0) {
        $list = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserStorData");
      }
    }
    return array($list, count($list));
  }
  // End of findByEnterpise

  public static function read(int $id, DistriXPDOConnection $inDbConnection)
  {
    $request = "";
    $data = new StyUserStorData();

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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "StyUserStorData");
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

  public static function update(StyUserStorData $data, $traceType, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE styuser SET ";
      $request .= "idstyusertype= :idstyusertype,";
      $request .= "login= :login,";
      $request .= "firstname= :firstname,";
      $request .= "name= :name,";
      $request .= "linktopicture= :linktopicture,";
      $request .= "size= :size,";
      $request .= "type= :type,";
      $request .= "pass= :pass,";
      $request .= "email= :email,";
      $request .= "emailbackup= :emailbackup,";
      $request .= "phone= :phone,";
      $request .= "mobile= :mobile,";
      $request .= "initpass= :initpass,";
      $request .= "idlanguage= :idlanguage,";
      $request .= "idstyenterprise= :idstyenterprise,";
      $request .= "statut= :statut,";
      $request .= "timestamp= :timestamp";
      $request .= " WHERE id = :id";
      $request .= " AND timestamp = :oldtimestamp";
      $params = [];
      $params["id"] = $data->getId();
      $params["idstyusertype"] = $data->getIdStyUserType();
      $params["login"] = $data->getLogin();
      $params["firstname"] = $data->getFirstName();
      $params["name"] = $data->getName();
      $params["linktopicture"] = $data->getLinkToPicture();
      $params["size"] = $data->getSize();
      $params["type"] = $data->getType();
      $params["pass"] = $data->getPass();
      $params["email"] = $data->getEmail();
      $params["emailbackup"] = $data->getEmailBackup();
      $params["phone"] = $data->getPhone();
      $params["mobile"] = $data->getMobile();
      $params["initpass"] = $data->getInitPass();
      $params["idlanguage"] = $data->getIdLanguage();
      $params["idstyenterprise"] = $data->getIdStyEnterprise();
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

  public static function save(StyUserStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function remove(StyUserStorData $data, DistriXPDOConnection $inDbConnection)
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

  public static function restore(StyUserStorData $data, DistriXPDOConnection $inDbConnection)
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
      $request  = "DELETE FROM styuser";
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

  public static function create(StyUserStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO styuser(";
      $request .= "idstyusertype,login,firstname,name,linktopicture,size,type,pass,email,emailbackup,phone,mobile,initpass,idlanguage,idstyenterprise,statut,timestamp)";
      $request .= " VALUES(";
      $request .= ":idstyusertype,";
      $request .= ":login,";
      $request .= ":firstname,";
      $request .= ":name,";
      $request .= ":linktopicture,";
      $request .= ":size,";
      $request .= ":type,";
      $request .= ":pass,";
      $request .= ":email,";
      $request .= ":emailbackup,";
      $request .= ":phone,";
      $request .= ":mobile,";
      $request .= ":initpass,";
      $request .= ":idlanguage,";
      $request .= ":idstyenterprise,";
      $request .= ":statut,";
      $request .= ":timestamp)";
      $params = [];
      $params["idstyusertype"] = $data->getIdStyUserType();
      $params["login"] = $data->getLogin();
      $params["firstname"] = $data->getFirstName();
      $params["name"] = $data->getName();
      $params["linktopicture"] = $data->getLinkToPicture();
      $params["size"] = $data->getSize();
      $params["type"] = $data->getType();
      $params["pass"] = $data->getPass();
      $params["email"] = $data->getEmail();
      $params["emailbackup"] = $data->getEmailBackup();
      $params["phone"] = $data->getPhone();
      $params["mobile"] = $data->getMobile();
      $params["initpass"] = $data->getInitPass();
      $params["idlanguage"] = $data->getIdLanguage();
      $params["idstyenterprise"] = $data->getIdStyEnterprise();
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
