<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableTicketStatusNameData", false)) {
  class DistriXCodeTableTicketStatusNameData extends DistriXSvcAppData {
    protected $id;
    protected $idTicketStatus;
    protected $idLanguage;
    protected $name;
    protected $elemState;
    protected $timestamp;
  
    public function __construct() {
      $this->id             = 0;
      $this->idTicketStatus = 0;
      $this->idLanguage     = 0;
      $this->name           = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdTicketStatus():int { return $this->idTicketStatus; }
    public function getIdLanguage():int { return $this->idLanguage; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdTicketStatus(int $idTicketStatus) { $this->idTicketStatus = $idTicketStatus; }
    public function setIdLanguage(int $idLanguage) { $this->idLanguage = $idLanguage; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
