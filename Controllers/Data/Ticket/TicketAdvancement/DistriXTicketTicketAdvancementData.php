<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXTicketTicketAdvancementData", false)) {
  class DistriXTicketTicketAdvancementData extends DistriXSvcAppData
  {
  protected $id;
  protected $idTicket;
  protected $idTicketStatus;
  protected $nameTicketStatus;
  protected $date;
  protected $time;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id                 = 0;
      $this->idTicket           = 0;
      $this->idTicketStatus     = 0;
      $this->nameTicketStatus   = "";
      $this->date               = 0;
      $this->time               = 0;
      $this->elemstate          = 0;
      $this->timestamp          = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdTicket():int { return $this->idTicket; }
  public function getIdTicketStatus():int { return $this->idTicketStatus; }
  public function getNameTicketStatus():string { return $this->nameTicketStatus; }
  public function getDate():int { return $this->date; }
  public function getTime():int { return $this->time; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdTicket(int $idTicket) { $this->idTicket = $idTicket; }
  public function setIdTicketStatus(int $idTicketStatus) { $this->idTicketStatus = $idTicketStatus; }
  public function setNameTicketStatus(string $nameTicketStatus) { $this->nameTicketStatus = $nameTicketStatus; }
  public function setDate(int $date) { $this->date = $date; }
  public function setTime(int $time) { $this->time = $time; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
}
