<?php // Needed to encode in UTF8 ààéàé //
class WeightTypeStorData {
  const WEIGHTTYPE_STATUS_AVAILABLE     = 0;
  const WEIGHTTYPE_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $code;
  private $issolid;
  private $isliquid;
  private $isother;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->issolid = 0;
      $this->isliquid = 0;
      $this->isother = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getCode() { return $this->code; }
  public function getIsSolid() { return $this->issolid; }
  public function getIsLiquid() { return $this->isliquid; }
  public function getIsOther() { return $this->isother; }
  public function getStatut() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::WEIGHTTYPE_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::WEIGHTTYPE_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::WEIGHTTYPE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setCode($code) { $this->code = $code; }
  public function setIsSolid($isSolid) { $this->issolid = $isSolid; }
  public function setIsLiquid($isLiquid) { $this->isliquid = $isLiquid; }
  public function setIsOther($isOther) { $this->isother = $isOther; }
  public function setStatut($statut) { $this->statut = $statut; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::WEIGHTTYPE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::WEIGHTTYPE_STATUS_NOT_AVAILABLE; }
}
