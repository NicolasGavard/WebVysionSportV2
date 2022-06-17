<?php // Needed to encode in UTF8 ààéàé //
class ApiTokenClientStorData {
  const APITOKENCLIENT_STATUS_AVAILABLE     = 0;
  const APITOKENCLIENT_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idapitokenenterprise;
  private $idapitokenuser;
  private $idapitokenapplication;
  private $clientid;
  private $secretkey;
  private $publickey;
  private $testkey;
  private $tokendurationsecond;
  private $tokendurationnbcallmax;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idapitokenenterprise = 0;
      $this->idapitokenuser = 0;
      $this->idapitokenapplication = 0;
      $this->clientid = "";
      $this->secretkey = "";
      $this->publickey = "";
      $this->testkey = "";
      $this->tokendurationsecond = 0;
      $this->tokendurationnbcallmax = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdApiTokenEnterprise() { return $this->idapitokenenterprise; }
  public function getIdApiTokenUser() { return $this->idapitokenuser; }
  public function getIdApiTokenApplication() { return $this->idapitokenapplication; }
  public function getClientId() { return $this->clientid; }
  public function getSecretKey() { return $this->secretkey; }
  public function getPublicKey() { return $this->publickey; }
  public function getTestKey() { return $this->testkey; }
  public function getTokenDurationSecond() { return $this->tokendurationsecond; }
  public function getTokenDurationNbCallMax() { return $this->tokendurationnbcallmax; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::APITOKENCLIENT_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::APITOKENCLIENT_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::APITOKENCLIENT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdApiTokenEnterprise($idApiTokenEnterprise) { $this->idapitokenenterprise = $idApiTokenEnterprise; }
  public function setIdApiTokenUser($idApiTokenUser) { $this->idapitokenuser = $idApiTokenUser; }
  public function setIdApiTokenApplication($idApiTokenApplication) { $this->idapitokenapplication = $idApiTokenApplication; }
  public function setClientId($clientId) { $this->clientid = $clientId; }
  public function setSecretKey($secretKey) { $this->secretkey = $secretKey; }
  public function setPublicKey($publicKey) { $this->publickey = $publicKey; }
  public function setTestKey($testKey) { $this->testkey = $testKey; }
  public function setTokenDurationSecond($tokenDurationSecond) { $this->tokendurationsecond = $tokenDurationSecond; }
  public function setTokenDurationNbCallMax($tokenDurationNbCallMax) { $this->tokendurationnbcallmax = $tokenDurationNbCallMax; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::APITOKENCLIENT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::APITOKENCLIENT_STATUS_NOT_AVAILABLE; }
}
