<?php // Needed to encode in UTF8 ààéàé //
class DistriXTraceStor
{
  public static function create(string $tableName, DistriXTraceStorData $data, DistriXPDOConnection $inDbConnection)
  {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO $tableName(";
      $request .= "iduser,databaseschema,operationtable,operationid,operationcode,operationdate,operationtime,operationdata)";
      $request .= " VALUES(";
      $request .= ":iduser,";
      $request .= ":databaseschema,";
      $request .= ":operationtable,";
      $request .= ":operationid,";
      $request .= ":operationcode,";
      $request .= ":operationdate,";
      $request .= ":operationtime,";
      $request .= ":operationdata)";
      $params = [];
      $params["iduser"] = $data->getIdUser();
      $params["databaseschema"] = $data->getDataBaseschema();
      $params["operationtable"] = $data->getOperationTable();
      $params["operationid"] = $data->getOperationId();
      $params["operationcode"] = $data->getOperationCode();
      $params["operationdate"] = $data->getOperationDate();
      $params["operationtime"] = $data->getOperationTime();
      $params["operationdata"] = $data->getOperationData();
      $stmt = $inDbConnection->prepare($request);
      $stmt->execute($params);
      $insere = ($stmt->rowCount() > 0 && is_null($inDbConnection->errorInfo()[2])); // If there is no DB error
      //  echo "<p>------------------<br>DB Error: " . $inDbConnection->errorInfo()[2] . "<br>------------------<br>".$stmt->debugDumpParams()."<br><br>";
      $data->setId($inDbConnection->lastInsertId());
    }
    return array($insere, $data->getId());
  }
  // End of create
}
// End of class
