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
    private $distriXMultiCall;
    private $distriXCaller;

    public function __construct(int $idUser, string $applicationName, string $dbSchemaName)
    {
      $this->traces           = [];
      $this->idUser           = $idUser;
      $this->applicationName  = $applicationName;
      $this->dbSchemaName     = $dbSchemaName;
      $this->manualTrace      = false;
      $this->commitBefore     = true;
      $this->traceFile        = "";
      $this->distriXMultiCall = null;
      $this->distriXCaller    = null;
    }
    /* End __construct */

    public function commitTrace(DistriXPDOConnection $dbConnection): bool
    {
      $insere             = false;
      $fileHandle         = null;
      $traceInFile        = false;
      $traceSentToService = false;

      $traceInFile = (strlen($this->getTraceFile()) > 0);
      if ($traceInFile) {
        $fileHandle = fopen($this->getTraceFile(), "a");
      }
      if (!is_null($this->getDistriXCaller())) {
        $traceSentToService = true;
        if (is_null($this->getDistriXMultiCall())) {
          $this->setDistriXMultiCall(new DistriXSvc());
        }
      }
      foreach ($this->traces as $trace) {
        $dataTracking = new DistriXTraceStorData();
        $dataTracking->setIdUser($trace->getIdUser());
        $dataTracking->setDataBaseSchema($trace->getSchema());
        $dataTracking->setOperationTable($trace->getOperationTable());
        $dataTracking->setOperationId($trace->getOperationId());
        $dataTracking->setOperationCode($trace->getOperationCode());
        $dataTracking->setOperationDate($trace->getOperationDate());
        $dataTracking->setOperationTime($trace->getOperationTime());
        $dataTracking->setOperationData($trace->getOperationData());
        $tableName = "trace_" . strtolower($this->getApplicationName());
        if (!$traceInFile && !$traceSentToService) {
          list($insere, $id) = DistriXTraceStor::create($tableName, $dataTracking, $dbConnection);
          if (!$insere) {
            break;
          }
        } else {
          if ($traceInFile && !is_null($fileHandle) && $fileHandle !== FALSE) {
            $request  = "INSERT INTO $tableName(";
            $request .= "iduser,databaseschema,operationtable,operationid,operationcode,operationdate,operationtime,operationdata)";
            $request .= " VALUES(";
            $request .= $dataTracking->getIdUser() . ",";
            $request .= $dataTracking->getDataBaseSchema() . ",";
            $request .= $dataTracking->getOperationTable() . ",";
            $request .= $dataTracking->getOperationId() . ",";
            $request .= $dataTracking->getOperationCode() . ",";
            $request .= $dataTracking->getOperationDate() . ",";
            $request .= $dataTracking->getOperationTime() . ",";
            $request .= $dataTracking->getOperationData() . ")";
            fwrite($fileHandle, $request);
          } else {
            if ($traceSentToService) {
              $caller = $this->getDistriXCaller();
              $caller->addParameter("Trace", $trace);
              $paramName = $trace->getSchema() . $trace->getOperationTable() . $trace->getOperationId();
              $this->getDistriXMultiCall()->addToCall($paramName, $caller);
            }
          }
        }
      }
      if (!is_null($fileHandle) && $fileHandle !== FALSE) {
        $insere = fclose($fileHandle);
      }
      if ($traceSentToService) {
        $insere = $this->getDistriXMultiCall()->call();
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
    public function getDistriXMultiCall(): ?object
    {
      return $this->distriXMultiCall;
    }
    public function getDistriXCaller(): ?object
    {
      return $this->distriXCaller;
    }
    public function getResults(string $name): array
    {
      $outputok   = false;
      $output     = null;
      $errorData  = null;

      if (!is_null($this->distriXMultiCall)) {
        list($outputok, $output, $errorData) = $this->distriXMultiCall->getResult($name);
      }
      return array($outputok, $output, $errorData);
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
    public function setDistriXMultiCall(object $distriXMultiCall)
    {
      $this->distriXMultiCall = $distriXMultiCall;
    }
    public function setDistriXCaller(object $distriXCaller)
    {
      $this->distriXCaller = $distriXCaller;
    }
  }
  // End of Class
}
