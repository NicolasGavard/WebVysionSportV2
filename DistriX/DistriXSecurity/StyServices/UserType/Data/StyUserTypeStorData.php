<?php // Needed to encode in UTF8 ààéàé //
class StyUserTypeStorData extends DistriXSvcAppData {
  const STYUSERTYPE_STATUS_AVAILABLE     = 0;
  const STYUSERTYPE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $name;
  protected $statut;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getCode() { return $this->code; }
  public function getName() { return $this->name; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::STYUSERTYPE_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::STYUSERTYPE_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::STYUSERTYPE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setCode($code) { $this->code = $code; }
  public function setName($name) { $this->name = $name; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::STYUSERTYPE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::STYUSERTYPE_STATUS_NOT_AVAILABLE; }
}
