<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('PHP_D_LoggerInfoData', false)) {
  class PHP_D_LoggerInfoData
  {
    protected $logIpAddress;
    protected $logApplication;
    protected $logFunction;
    protected $logData;
    protected $logParameters;

    public function __construct(string $idAddress, string $application, string $function, string|array $data, array $parameters = [])
    {
      $this->logIpAddress   = $idAddress;
      $this->logApplication = $application;
      $this->logFunction    = $function;
      $this->logData        = $data;
      $this->logParameters  = $parameters;
    }
    // Gets
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
    public function getLogParameters(): array
    {
      return $this->logParameters;
    }
    // Sets
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
    public function setLogParameters(array $logParameters)
    {
      $this->logParameters = $logParameters;
    }
  }
  // End of Class
}
