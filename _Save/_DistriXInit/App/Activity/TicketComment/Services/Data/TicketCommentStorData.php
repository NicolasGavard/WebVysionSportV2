<?php // Needed to encode in UTF8 ààéàé //
class TicketCommentStorData extends DistriXSvcAppData {
  const TICKETCOMMENT_STATUS_AVAILABLE     = 0;
  const TICKETCOMMENT_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idticket;
  protected $iduser;
  protected $title;
  protected $descmessage;
  protected $date;
  protected $time;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idticket = 0;
      $this->iduser = 0;
      $this->title = "";
      $this->descmessage = "";
      $this->date = 0;
      $this->time = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdTicket():int { return $this->idticket; }
  public function getIdUser():int { return $this->iduser; }
  public function getTitle():string { return $this->title; }
  public function getDescMessage() { return $this->descmessage; }
  public function getDate():int { return $this->date; }
  public function getTime():int { return $this->time; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::TICKETCOMMENT_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::TICKETCOMMENT_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::TICKETCOMMENT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdTicket(int $idTicket) { $this->idticket = $idTicket; }
  public function setIdUser(int $idUser) { $this->iduser = $idUser; }
  public function setTitle(string $title) { $this->title = $title; }
  public function setDescMessage($descMessage) { $this->descmessage = $descMessage; }
  public function setDate(int $date) { $this->date = $date; }
  public function setTime(int $time) { $this->time = $time; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::TICKETCOMMENT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::TICKETCOMMENT_STATUS_NOT_AVAILABLE; }
}
