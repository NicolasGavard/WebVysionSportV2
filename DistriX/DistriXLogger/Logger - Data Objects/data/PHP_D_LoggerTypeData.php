<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('PHP_D_LoggerTypeData', false)) {
  class PHP_D_LoggerTypeData
  {
    protected $logFilename;
    protected $logDaily;
    protected $logAppend;
    protected $logDate;
    protected $logTime;

    public function __construct(string $filename, int $date = 0, int $time = 0, bool $daily = true, bool $append = true)
    {
      $this->logFilename = $filename;
      $this->logDaily    = $daily;
      $this->logAppend   = $append;
      $this->logDate     = $date;
      if ($this->logDate == 0) $this->logDate = PHP_D_SvcUtil::getCurrentNumDate();
      $this->logTime     = $time;
      if ($this->logTime == 0) $this->logTime = PHP_D_SvcUtil::getCurrentNumTime();
    }
    // Gets
    public function getLogFilename(): string
    {
      return $this->logFilename;
    }
    public function getLogDate(): int
    {
      return $this->logDate;
    }
    public function getLogTime(): int
    {
      return $this->logTime;
    }
    public function getLogDaily(): bool
    {
      return $this->logDaily;
    }
    public function getLogAppend(): bool
    {
      return $this->logAppend;
    }
    // Sets
    public function setLogFilename(string $logFilename)
    {
      $this->logFilename = $logFilename;
    }
    public function setLogDate(int $logDate)
    {
      $this->logDate = $logDate;
    }
    public function setLogTime(int $logTime)
    {
      $this->logTime = $logTime;
    }
    public function setLogDaily(bool $logDaily)
    {
      $this->logDaily = $logDaily;
    }
    public function setLogAppend(bool $logAppend)
    {
      $this->logAppend = $logAppend;
    }
  }
  // End of Class
}
