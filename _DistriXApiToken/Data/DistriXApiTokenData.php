<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXApiTokenData", false)) {
  class DistriXApiTokenData extends DistriXSvcAppData
  {
    protected $clientId;
    protected $publicKey;
    protected $secretKey;
    protected $testKey;
    protected $token;
    protected $applicationCode;
    protected $moduleCode;
    protected $functionalityCode;
    protected $valid;
    protected $tokenDate;
    protected $tokenTime;
    protected $tokenError;

    public function __construct()
    {
      $this->clientId          = "";
      $this->publicKey         = "";
      $this->secretKey         = "";
      $this->testKey           = "";
      $this->token             = "";
      $this->applicationCode   = "";
      $this->moduleCode        = "";
      $this->functionalityCode = "";
      $this->valid             = false;
      $this->tokenDate         = 0;
      $this->tokenTime         = 0;
      $this->tokenError        = new DistriXSvcErrorData();
    }
    // Gets
    public function getClientId()
    {
      return $this->clientId;
    }
    public function getPublicKey(): string
    {
      return $this->publicKey;
    }
    public function getSecretKey(): string
    {
      return $this->secretKey;
    }
    public function getTestKey(): string
    {
      return $this->testKey;
    }
    public function getToken(): string
    {
      return $this->token;
    }
    public function getApplicationCode(): string
    {
      return $this->applicationCode;
    }
    public function getModuleCode(): string
    {
      return $this->moduleCode;
    }
    public function getFunctionalityCode(): string
    {
      return $this->functionalityCode;
    }
    public function getValid(): bool
    {
      return $this->valid;
    }
    public function getTokenDate(): int
    {
      return $this->tokenDate;
    }
    public function getTokenTime(): int
    {
      return $this->tokenTime;
    }
    public function getTokenError()
    {
      return $this->tokenError;
    }
    // Sets
    public function setClientId($clientId)
    {
      $this->clientId = $clientId;
    }
    public function setPublicKey(string $publicKey)
    {
      $this->publicKey = $publicKey;
    }
    public function setSecretKey(string $secretKey)
    {
      $this->secretKey = $secretKey;
    }
    public function setTestKey(string $testKey)
    {
      $this->testKey = $testKey;
    }
    public function setToken(string $token)
    {
      $this->token = $token;
    }
    public function setApplicationCode(string $applicationCode)
    {
      $this->applicationCode = $applicationCode;
    }
    public function setModuleCode(string $moduleCode)
    {
      $this->moduleCode = $moduleCode;
    }
    public function setFunctionalityCode(string $functionalityCode)
    {
      $this->functionalityCode = $functionalityCode;
    }
    public function setValid(bool $valid)
    {
      $this->valid = $valid;
    }
    public function setTokenDate(int $tokenDate)
    {
      $this->tokenDate = $tokenDate;
    }
    public function setTokenTime(int $tokenTime)
    {
      $this->tokenTime = $tokenTime;
    }
    public function setTokenError($tokenError)
    {
      $this->tokenError = $tokenError;
    }
  }
  // End of class
}
// class_exists
