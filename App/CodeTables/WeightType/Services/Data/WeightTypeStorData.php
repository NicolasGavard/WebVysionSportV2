<?php // Needed to encode in UTF8 ààéàé //
class WeightTypeStorData extends DistriXSvcAppData {
  const WEIGHTTYPE_STATUS_AVAILABLE     = 0;
  const WEIGHTTYPE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $name;
  protected $abbreviation;
  protected $issolid;
  protected $isliquid;
  protected $isother;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->abbreviation = "";
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
  public function getAbbreviation():string { return $this->abbreviation; }
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
  public function setAbbreviation(string $abbreviation) { $this->abbreviation = $abbreviation; }
  public function setIsSolid(int $issolid) { $this->issolid = $issolid; }
  public function setIsLiquid(int $isliquid) { $this->isliquid = $isliquid; }
  public function setIsOther(int $isother) { $this->isother = $isother; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::WEIGHTTYPE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::WEIGHTTYPE_STATUS_NOT_AVAILABLE; }
}
