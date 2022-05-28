<?php // Needed to encode in UTF8 ààéàé //
class NutritionalStorData extends DistriXSvcAppData {
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
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::NUTRITIONAL_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::NUTRITIONAL_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::NUTRITIONAL_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::NUTRITIONAL_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::NUTRITIONAL_STATUS_NOT_AVAILABLE; }
}
