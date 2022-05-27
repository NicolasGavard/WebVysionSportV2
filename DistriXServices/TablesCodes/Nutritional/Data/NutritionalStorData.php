<?php // Needed to encode in UTF8 ààéàé //
class NutritionalStorData {
  const NUTRITIONAL_STATUS_AVAILABLE     = 0;
  const NUTRITIONAL_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $code;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getCode() { return $this->code; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::NUTRITIONAL_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::NUTRITIONAL_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::NUTRITIONAL_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setCode($code) { $this->code = $code; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::NUTRITIONAL_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::NUTRITIONAL_STATUS_NOT_AVAILABLE; }
}
