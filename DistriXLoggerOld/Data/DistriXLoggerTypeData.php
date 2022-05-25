<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXLoggerTypeData', false)) {
  class DistriXLoggerTypeData
  {
    protected $logFilename;
    protected $logExtension;
    protected $logDaily;
    protected $logAppend;
    protected $logError;
    protected $logInfo;
    protected $logMessage;
    protected $logWarning;
    protected $logFormat;

    public function __construct($DistriXLoggerSettings)
    {
      $this->logFilename  = "";
      $this->logExtension = "";
      $this->logDaily     = true;
      $this->logAppend    = true;
      $this->logError     = true;
      $this->logInfo      = true;
      $this->logMessage   = true;
      $this->logWarning   = true;
      $this->logFormat    = "[Date] [Time] [Type] [IpAddress] [Parameters] [Application] [Function] [Message]";

      if (isset($DistriXLoggerSettings["logFilename"])) {
        $this->setLogFilename($DistriXLoggerSettings["logFilename"]);
      }
      if (isset($DistriXLoggerSettings["logExtension"])) {
        $this->setLogExtension($DistriXLoggerSettings["logExtension"]);
      }
      if (isset($DistriXLoggerSettings["logDaily"])) {
        $this->setLogDaily($DistriXLoggerSettings["logDaily"]);
      }
      if (isset($DistriXLoggerSettings["logAppend"])) {
        $this->setLogAppend($DistriXLoggerSettings["logAppend"]);
      }
      if (isset($DistriXLoggerSettings["logMessage"])) {
        $this->setLogMessage($DistriXLoggerSettings["logMessage"]);
      }
      if (isset($DistriXLoggerSettings["logInfo"])) {
        $this->setLogInfo($DistriXLoggerSettings["logInfo"]);
      }
      if (isset($DistriXLoggerSettings["logError"])) {
        $this->setLogError($DistriXLoggerSettings["logError"]);
      }
      if (isset($DistriXLoggerSettings["logWarning"])) {
        $this->setLogWarning($DistriXLoggerSettings["logWarning"]);
      }
      if (isset($DistriXLoggerSettings["logFormat"])) {
        $this->setLogFormat($DistriXLoggerSettings["logFormat"]);
      }
    }
    // Gets
    public function getLogFilename(): string
    {
      return $this->logFilename;
    }
    public function getLogExtension(): string
    {
      return $this->logExtension;
    }
    public function getLogDaily(): bool
    {
      return $this->logDaily;
    }
    public function getLogAppend(): bool
    {
      return $this->logAppend;
    }
    public function getLogError(): bool
    {
      return $this->logError;
    }
    public function getLogInfo(): bool
    {
      return $this->logInfo;
    }
    public function getLogMessage(): bool
    {
      return $this->logMessage;
    }
    public function getLogWarning(): bool
    {
      return $this->logWarning;
    }
    public function getLogFormat(): string
    {
      return $this->logFormat;
    }
    // Sets
    public function setLogFilename(string $logFilename)
    {
      $this->logFilename = $logFilename;
    }
    public function setLogExtension(string $logExtension)
    {
      $this->logExtension = $logExtension;
    }
    public function setLogDaily(bool $logDaily)
    {
      $this->logDaily = $logDaily;
    }
    public function setLogAppend(bool $logAppend)
    {
      $this->logAppend = $logAppend;
    }
    public function setLogError(bool $logError)
    {
      $this->logError = $logError;
    }
    public function setLogInfo(bool $logInfo)
    {
      $this->logInfo = $logInfo;
    }
    public function setLogMessage(bool $logMessage)
    {
      $this->logMessage = $logMessage;
    }
    public function setLogWarning(bool $logWarning)
    {
      $this->logWarning = $logWarning;
    }
    public function setLogFormat(string $logFormat)
    {
      $this->logFormat = $logFormat;
    }
  }
  // End of Class
}
