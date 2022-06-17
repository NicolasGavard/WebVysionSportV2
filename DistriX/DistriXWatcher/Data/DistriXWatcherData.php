<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXWatcherData", false)) {
  class DistriXWatcherData extends DistriXSvcAppData
  {
    protected $idEnterprise;
    protected $serverAddress;
    protected $serverCall;
    protected $serverDirectory;
    protected $fileToInclude;
    protected $expectedReturnValue;
    protected $alive;
    protected $responseTime;
    protected $logSettingsFile;
    protected $emailIfNotAlive;
    protected $emailSending;
    protected $token;
    protected $secretKey;

    public function __construct()
    {
      $this->idEnterprise = 0;
      $this->serverAddress = "";
      $this->serverCall = "";
      $this->serverDirectory = "";
      $this->fileToInclude = "";
      $this->expectedReturnValue = "";
      $this->alive = false;
      $this->responseTime = 0;
      $this->logSettingsFile = "";
      $this->emailIfNotAlive = "";
      $this->emailSending = false;
      $this->token = null;
      $this->secretKey = "";
    }
    // Gets
    public function getIdEnterprise(): int
    {
      return $this->idEnterprise;
    }
    public function getServerAddress(): string
    {
      return $this->serverAddress;
    }
    public function getServerCall(): string
    {
      return $this->serverCall;
    }
    public function getServerDirectory(): string
    {
      return $this->serverDirectory;
    }
    public function getFileToInclude(): string
    {
      return $this->fileToInclude;
    }
    public function getExpectedReturnValue(): string
    {
      return $this->expectedReturnValue;
    }
    public function getAlive(): bool
    {
      return $this->alive;
    }
    public function getResponseTime(): int
    {
      return $this->responseTime;
    }
    public function getLogSettingsFile(): string
    {
      return $this->logSettingsFile;
    }
    public function getEmailIfNotAlive(): string
    {
      return $this->emailIfNotAlive;
    }
    public function getEmailSending(): bool
    {
      return $this->emailSending;
    }
    public function getToken()
    {
      return $this->token;
    }
    public function getSecretKey(): string
    {
      return $this->secretKey;
    }

    // Sets
    public function setIdEnterprise(int $idEnterprise)
    {
      $this->idEnterprise = $idEnterprise;
    }
    public function setServerAddress(string $serverAddress)
    {
      $this->serverAddress = $serverAddress;
    }
    public function setServerCall(string $serverCall)
    {
      $this->serverCall = $serverCall;
    }
    public function setServerDirectory(string $serverDirectory)
    {
      $this->serverDirectory = $serverDirectory;
    }
    public function setFileToInclude(string $fileToInclude)
    {
      $this->fileToInclude = $fileToInclude;
    }
    public function setExpectedReturnValue(string $expectedReturnValue)
    {
      $this->expectedReturnValue = $expectedReturnValue;
    }
    public function setAlive(bool $alive)
    {
      $this->alive = $alive;
    }
    public function setResponseTime(int $responseTime)
    {
      $this->responseTime = $responseTime;
    }
    public function setLogSettingsFile(string $logSettingsFile)
    {
      $this->logSettingsFile = $logSettingsFile;
    }
    public function setEmailIfNotAlive(string $emailIfNotAlive)
    {
      $this->emailIfNotAlive = $emailIfNotAlive;
    }
    public function setEmailSending(bool $emailSending)
    {
      $this->emailSending = $emailSending;
    }
    public function setToken($token)
    {
      $this->token = $token;
    }
    public function setSecretKey(string $secretKey)
    {
      $this->secretKey = $secretKey;
    }
  }
  // End of class
}
// class_exists
