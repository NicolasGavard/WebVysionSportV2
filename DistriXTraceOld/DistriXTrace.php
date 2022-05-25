<?php // Needed to encode in UTF8 ààéàé //
include(__DIR__ . "/Data/DistriXTraceStorData.php");
include(__DIR__ . "/Storage/DistriXTraceStor.php");
if (!class_exists('DistriXTrace', false)) {
  class DistriXTrace
  {
    private $traces;
    private $idUser;
    private $applicationName;
    private $dbSchemaName;
    private $manualTrace;
    private $commitBefore;
    private $traceFile;

    public function __construct(int $idUser, string $applicationName, string $dbSchemaName)
    {
      $this->traces          = [];
      $this->idUser          = $idUser;
      $this->applicationName = $applicationName;
      $this->dbSchemaName    = $dbSchemaName;
      $this->manualTrace     = false;
      $this->commitBefore    = true;
      $this->traceFile       = "";
    }
    /* End __construct */

    public function commitTrace(DistriXPDOConnection $dbConnection): bool
    {
      $insere      = false;
      $fileHandle  = null;
      $traceInFile = false;

      $traceInFile = (strlen($this->getTraceFile()) > 0);
      if ($traceInFile) {
        $fileHandle = fopen($this->getTraceFile(), "a");
      }
      foreach ($this->traces as $trace) {
        $dataTracking = new DistriXTraceStorData();
        $dataTracking->setIdUser($trace->getIdUser());
        $dataTracking->setDataBaseschema($trace->getSchema());
        $dataTracking->setOperationTable($trace->getOperationTable());
        $dataTracking->setOperationId($trace->getOperationId());
        $dataTracking->setOperationCode($trace->getOperationCode());
        $dataTracking->setOperationDate($trace->getOperationDate());
        $dataTracking->setOperationTime($trace->getOperationTime());
        $dataTracking->setOperationData($trace->getOperationData());
        $tableName = "trace_" . strtolower($this->getApplicationName());
        if (!$traceInFile) {
          list($insere, $id) = DistriXTraceStor::create($tableName, $dataTracking, $dbConnection);
          if (!$insere) {
            break;
          }
        } else {
          if (!is_null($fileHandle) && $fileHandle !== FALSE) {
            $request  = "INSERT INTO $tableName(";
            $request .= "iduser,databaseschema,operationtable,operationid,operationcode,operationdate,operationtime,operationdata)";
            $request .= " VALUES(";
            $request .= $dataTracking->getIdUser() . ",";
            $request .= $dataTracking->getDataBaseschema() . ",";
            $request .= $dataTracking->getOperationTable() . ",";
            $request .= $dataTracking->getOperationId() . ",";
            $request .= $dataTracking->getOperationCode() . ",";
            $request .= $dataTracking->getOperationDate() . ",";
            $request .= $dataTracking->getOperationTime() . ",";
            $request .= $dataTracking->getOperationData() . ")";
            fwrite($fileHandle, $request);
          }
        }
      }
      if (!is_null($fileHandle) && $fileHandle !== FALSE) {
        $insere = fclose($fileHandle);
      }
      return $insere;
    }
    /* End commitTrace */

    public function addToTrace(DistriXTraceData $traceData)
    {
      $this->traces[] = $traceData;
    }

    // Gets
    public function getIdUser(): int
    {
      return $this->idUser;
    }
    public function getApplicationName(): string
    {
      return $this->applicationName;
    }
    public function getDbSchemaName(): string
    {
      return $this->dbSchemaName;
    }
    public function getManualTrace(): bool
    {
      return $this->manualTrace;
    }
    public function getCommitBefore(): bool
    {
      return $this->commitBefore;
    }
    public function getTraceFile(): string
    {
      return $this->traceFile;
    }
    // Sets
    public function setIdUser(int $idUser)
    {
      $this->idUser = $idUser;
    }
    public function setApplicationName(string $applicationName)
    {
      $this->applicationName = $applicationName;
    }
    public function setDbSchemaName(string $dbSchemaName)
    {
      $this->dbSchemaName = $dbSchemaName;
    }
    public function setManualTrace(bool $manualTrace)
    {
      $this->manualTrace = $manualTrace;
    }
    public function setCommitBefore(bool $commitBefore)
    {
      $this->commitBefore = $commitBefore;
    }
    public function setTraceFile(string $traceFile)
    {
      $this->traceFile = $traceFile;
    }
  }
  // End of Class
}
