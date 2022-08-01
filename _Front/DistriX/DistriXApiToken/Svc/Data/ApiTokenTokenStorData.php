<?php // Needed to encode in UTF8 ààéàé //
class ApiTokenTokenStorData {
  private $id;
  private $idapitokenclient;
  private $token;
  private $tokendate;
  private $tokentime;
  private $keyused;
  private $tokennbuse;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idapitokenclient = 0;
      $this->token = "";
      $this->tokendate = 0;
      $this->tokentime = 0;
      $this->keyused = "";
      $this->tokennbuse = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdApiTokenClient() { return $this->idapitokenclient; }
  public function getToken() { return $this->token; }
  public function getTokenDate() { return $this->tokendate; }
  public function getTokenTime() { return $this->tokentime; }
  public function getKeyUsed() { return $this->keyused; }
  public function getTokenNbUse() { return $this->tokennbuse; }
  public function getTimestamp() { return $this->timestamp; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdApiTokenClient($idApiTokenClient) { $this->idapitokenclient = $idApiTokenClient; }
  public function setToken($token) { $this->token = $token; }
  public function setTokenDate($tokenDate) { $this->tokendate = $tokenDate; }
  public function setTokenTime($tokenTime) { $this->tokentime = $tokenTime; }
  public function setKeyUsed($keyUsed) { $this->keyused = $keyUsed; }
  public function setTokenNbUse($tokenNbUse) { $this->tokennbuse = $tokenNbUse; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
}
