<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXTraceData", false)) {
  class DistriXTraceData extends DistriXSvcAppData
  {
    const TRACE_READ    = "TRACE_READ";
    const TRACE_CREATE  = "TRACE_CREATE";
    const TRACE_UPDATE  = "TRACE_UPDATE";
    const TRACE_DELETE  = "TRACE_DELETE";
    const TRACE_REMOVE  = "TRACE_REMOVE";
    const TRACE_RESTORE = "TRACE_RESTORE";

    protected $id;
    protected $idUser;
    protected $schema;
    protected $application;
    protected $operationTable;
    protected $operationId;
    protected $operationCode;
    protected $operationDate;
    protected $operationTime;
    protected $operationData;
    protected $operationParams;

    public function __construct(string $schema = '', string $application = '', int $idUser = 0, int $date = 0, int $time = 0)
    {
      $this->id              = 0;
      $this->idUser          = $idUser;
      $this->schema          = $schema;
      $this->application     = $application;
      $this->operationTable  = "";
      $this->operationId     = 0;
      $this->operationCode   = "";
      $this->operationDate   = $date;
      $this->operationTime   = $time;
      $this->operationData   = "";
      $this->operationParams = "";
    }
    // Gets
    public function getId(): int
    {
      return $this->id;
    }
    public function getSchema(): string
    {
      return $this->schema;
    }
    public function getIdUser(): int
    {
      return $this->idUser;
    }
    public function getApplication(): string
    {
      return $this->application;
    }
    public function getOperationTable(): string
    {
      return $this->operationTable;
    }
    public function getOperationId(): int
    {
      return $this->operationId;
    }
    public function getOperationCode(): string
    {
      return $this->operationCode;
    }
    public function getOperationDate(): int
    {
      return $this->operationDate;
    }
    public function getOperationTime(): int
    {
      return $this->operationTime;
    }
    public function getOperationData(): string
    {
      return $this->operationData;
    }
    public function getOperationParams(): string
    {
      return $this->operationParams;
    }
    // Sets
    public function setId(int $id)
    {
      $this->id = $id;
    }
    public function setSchema(string $schema)
    {
      $this->schema = $schema;
    }
    public function setIdUser(int $idUser)
    {
      $this->idUser = $idUser;
    }
    public function setApplication(string $application)
    {
      $this->application = $application;
    }
    public function setOperationTable(string $operationTable)
    {
      $this->operationTable = $operationTable;
    }
    public function setOperationId(int $operationId)
    {
      $this->operationId = $operationId;
    }
    public function setOperationCode(string $operationCode)
    {
      $this->operationCode = $operationCode;
    }
    public function setOperationDate(int $operationDate)
    {
      $this->operationDate = $operationDate;
    }
    public function setOperationTime(int $operationTime)
    {
      $this->operationTime = $operationTime;
    }
    public function setOperationData(string $operationData)
    {
      $this->operationData = $operationData;
    }
    public function setOperationParams(string $operationParams)
    {
      $this->operationParams = $operationParams;
    }
    // End of class
  }
  // class_exists
}
