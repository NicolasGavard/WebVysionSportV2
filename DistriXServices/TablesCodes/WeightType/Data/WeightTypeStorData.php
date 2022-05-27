<?php // Needed to encode in UTF8 ààéàé //
class WeightTypeStorData extends DistriXSvcAppData {
  const WEIGHTTYPE_STATUS_AVAILABLE     = 0;
  const WEIGHTTYPE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $name;
  protected $issolid;
  protected $isliquid;
  protected $isother;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->issolid = 0;
      $this->isliquid = 0;
      $this->isother = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getIsSolid():int { return $this->issolid; }
  public function getIsLiquid():int { return $this->isliquid; }
  public function getIsOther():int { return $this->isother; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::WEIGHTTYPE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::WEIGHTTYPE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::WEIGHTTYPE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setIsSolid(int $isSolid) { $this->issolid = $isSolid; }
  public function setIsLiquid(int $isLiquid) { $this->isliquid = $isLiquid; }
  public function setIsOther(int $isOther) { $this->isother = $isOther; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::WEIGHTTYPE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::WEIGHTTYPE_STATUS_NOT_AVAILABLE; }
}
