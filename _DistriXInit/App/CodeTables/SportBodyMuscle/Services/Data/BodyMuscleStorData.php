<?php // Needed to encode in UTF8 ààéàé //
class BodyMuscleStorData extends DistriXSvcAppData {
  const BODYMUSCLE_STATUS_AVAILABLE     = 0;
  const BODYMUSCLE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idbodymember;
  protected $code;
  protected $name;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idbodymember = 0;
      $this->code = "";
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdBodyMember():int { return $this->idbodymember; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::BODYMUSCLE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::BODYMUSCLE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::BODYMUSCLE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdBodyMember(int $idbodymember) { $this->idbodymember = $idbodymember; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::BODYMUSCLE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::BODYMUSCLE_STATUS_NOT_AVAILABLE; }
}
