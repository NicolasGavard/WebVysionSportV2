<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXLoggerTypeData', false)) {
  class DistriXLoggerTypeData
  {
    protected $logFilename;
    protected $logExtension;
    protected $logDaily;
    protected $logAppend;
    protected $logEmergency;
    protected $logCritical;
    protected $logError;
    protected $logAlert;
    protected $logWarning;
    protected $logNotice;
    protected $logInfo;
    protected $logDebug;
    protected $logFormat;

    public function __construct($DistriXLoggerSettings)
    {
      $this->logFilename  = "";
      $this->logExtension = "";
      $this->logDaily     = true;
      $this->logAppend    = true;
      $this->logEmergency = true;
      $this->logCritical  = true;
      $this->logError     = true;
      $this->logAlert     = true;
      $this->logWarning   = true;
      $this->logNotice    = true;
      $this->logInfo      = true;
      $this->logDebug     = true;
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
      if (isset($DistriXLoggerSettings["logEmergency"])) {
        $this->setLogEmergency($DistriXLoggerSettings["logEmergency"]);
      }
      if (isset($DistriXLoggerSettings["logCritical"])) {
        $this->setLogCritical($DistriXLoggerSettings["logCritical"]);
      }
      if (isset($DistriXLoggerSettings["logError"])) {
        $this->setLogError($DistriXLoggerSettings["logError"]);
      }
      if (isset($DistriXLoggerSettings["logAlert"])) {
        $this->setLogAlert($DistriXLoggerSettings["logAlert"]);
      }
      if (isset($DistriXLoggerSettings["logWarning"])) {
        $this->setLogWarning($DistriXLoggerSettings["logWarning"]);
      }
      if (isset($DistriXLoggerSettings["logNotice"])) {
        $this->setLogNotice($DistriXLoggerSettings["logNotice"]);
      }
      if (isset($DistriXLoggerSettings["logInfo"])) {
        $this->setLogInfo($DistriXLoggerSettings["logInfo"]);
      }
      if (isset($DistriXLoggerSettings["logDebug"])) {
        $this->setLogDebug($DistriXLoggerSettings["logDebug"]);
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
    public function getLogEmergency(): bool
    {
      return $this->logEmergency;
    }
    public function getLogCritical(): bool
    {
      return $this->logCritical;
    }
    public function getLogError(): bool
    {
      return $this->logError;
    }
    public function getLogAlert(): bool
    {
      return $this->logAlert;
    }
    public function getLogWarning(): bool
    {
      return $this->logWarning;
    }
    public function getLogNotice(): bool
    {
      return $this->logNotice;
    }
    public function getLogInfo(): bool
    {
      return $this->logInfo;
    }
    public function getLogDebug(): bool
    {
      return $this->logDebug;
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
    public function setLogEmergency(bool $logEmergency)
    {
      $this->logEmergency = $logEmergency;
    }
    public function setLogCritical(bool $logCritical)
    {
      $this->logCritical = $logCritical;
    }
    public function setLogError(bool $logError)
    {
      $this->logError = $logError;
    }
    public function setLogAlert(bool $logAlert)
    {
      $this->logAlert = $logAlert;
    }
    public function setLogWarning(bool $logWarning)
    {
      $this->logWarning = $logWarning;
    }
    public function setLogNotice(bool $logNotice)
    {
      $this->logNotice = $logNotice;
    }
    public function setLogInfo(bool $logInfo)
    {
      $this->logInfo = $logInfo;
    }
    public function setLogDebug(bool $logDebug)
    {
      $this->logDebug = $logDebug;
    }
    public function setLogFormat(string $logFormat)
    {
      $this->logFormat = $logFormat;
    }
  }
  // End of Class
}
