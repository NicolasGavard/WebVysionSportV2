<?php // Needed to encode in UTF8 ààéàé //
class TicketStorData extends DistriXSvcAppData {
  const TICKET_STATUS_AVAILABLE     = 0;
  const TICKET_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idusercreate;
  protected $iduserassign;
  protected $idtickettype;
  protected $idticketstatus;
  protected $title;
  protected $descmessage;
  protected $date;
  protected $time;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idusercreate = 0;
      $this->iduserassign = 0;
      $this->idtickettype = 0;
      $this->idticketstatus = 0;
      $this->title = "";
      $this->descmessage = "";
      $this->date = 0;
      $this->time = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdUserCreate():int { return $this->idusercreate; }
  public function getIdUserAssign():int { return $this->iduserassign; }
  public function getIdTicketType():int { return $this->idtickettype; }
  public function getIdTicketStatus():int { return $this->idticketstatus; }
  public function getTitle():string { return $this->title; }
  public function getDescMessage() { return $this->descmessage; }
  public function getDate():int { return $this->date; }
  public function getTime():int { return $this->time; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::TICKET_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::TICKET_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::TICKET_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUserCreate(int $idUserCreate) { $this->idusercreate = $idUserCreate; }
  public function setIdUserAssign(int $idUserAssign) { $this->iduserassign = $idUserAssign; }
  public function setIdTicketType(int $idTicketType) { $this->idtickettype = $idTicketType; }
  public function setIdTicketStatus(int $idTicketStatus) { $this->idticketstatus = $idTicketStatus; }
  public function setTitle(string $title) { $this->title = $title; }
  public function setDescMessage($descMessage) { $this->descmessage = $descMessage; }
  public function setDate(int $date) { $this->date = $date; }
  public function setTime(int $time) { $this->time = $time; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::TICKET_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::TICKET_STATUS_NOT_AVAILABLE; }
}
