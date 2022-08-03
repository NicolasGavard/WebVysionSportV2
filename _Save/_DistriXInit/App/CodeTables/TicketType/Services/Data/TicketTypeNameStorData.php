<?php // Needed to encode in UTF8 ààéàé //
class TicketTypeNameStorData extends DistriXSvcAppData {
  const TICKETTYPENAME_STATUS_AVAILABLE     = 0;
  const TICKETTYPENAME_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idtickettype;
  protected $idlanguage;
  protected $name;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idtickettype = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdTicketType():int { return $this->idtickettype; }
  public function getIdLanguage():int { return $this->idlanguage; }
  public function getName():string { return $this->name; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::TICKETTYPENAME_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::TICKETTYPENAME_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::TICKETTYPENAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdTicketType(int $idTicketType) { $this->idtickettype = $idTicketType; }
  public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName(string $name) { $this->name = $name; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::TICKETTYPENAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::TICKETTYPENAME_STATUS_NOT_AVAILABLE; }
}
