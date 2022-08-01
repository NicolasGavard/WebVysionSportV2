<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXLoggerInfoData', false)) {
  class DistriXLoggerInfoData
  {
    protected $logType;
    protected $logDate;
    protected $logTime;
    protected $logIpAddress;
    protected $logApplication;
    protected $logFunction;
    protected $logData;
    protected $logContext;

    public function __construct()
    {
      $this->logType        = DistriXLogger::LOG_INFO;
      $this->logDate        = DistriXSvcUtil::getCurrentNumDate();
      $this->logTime        = DistriXSvcUtil::getCurrentNumTime();
      $this->logIpAddress   = "";
      $this->logApplication = "";
      $this->logFunction    = "";
      $this->logData        = "";
      $this->logContext     = [];
    }
    // Gets
    public function getLogType(): string
    {
      return $this->logType;
    }
    public function getLogDate(): int
    {
      return $this->logDate;
    }
    public function getLogTime(): int
    {
      return $this->logTime;
    }
    public function getLogIpAddress(): string
    {
      return $this->logIpAddress;
    }
    public function getLogApplication(): string
    {
      return $this->logApplication;
    }
    public function getLogFunction(): string
    {
      return $this->logFunction;
    }
    public function getLogData(): string
    {
      return $this->logData;
    }
    public function getLogContext(): array
    {
      return $this->logContext;
    }
    // Sets
    public function setLogtype(string $logType)
    {
      $this->logType = $logType;
    }
    public function setLogDate(int $logDate)
    {
      $this->logDate = $logDate;
    }
    public function setLogTime(int $logTime)
    {
      $this->logTime = $logTime;
    }
    public function setLogIpAddress(string $logIpAddress)
    {
      $this->logIpAddress = $logIpAddress;
    }
    public function setLogApplication(string $logApplication)
    {
      $this->logApplication = $logApplication;
    }
    public function setLogFunction(string $logFunction)
    {
      $this->logFunction = $logFunction;
    }
    public function setLogData(string $logData)
    {
      $this->logData = $logData;
    }
    public function setLogContext(array $logContext)
    {
      $this->logContext = $logContext;
    }
  }
  // End of Class
}
