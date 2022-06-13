<?php // Needed to encode in UTF8 ààéàé //
class TicketStatusStorData extends DistriXSvcAppData {
  const TICKETSTATUS_STATUS_AVAILABLE     = 0;
  const TICKETSTATUS_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $name;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::TICKETSTATUS_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::TICKETSTATUS_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::TICKETSTATUS_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::TICKETSTATUS_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::TICKETSTATUS_STATUS_NOT_AVAILABLE; }
}
