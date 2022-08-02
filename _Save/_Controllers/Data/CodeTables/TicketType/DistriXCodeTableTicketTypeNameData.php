<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableTicketTypeNameData", false)) {
  class DistriXCodeTableTicketTypeNameData extends DistriXSvcAppData {
    protected $id;
    protected $idTicketType;
    protected $idLanguage;
    protected $name;
    protected $elemState;
    protected $timestamp;
  
    public function __construct() {
      $this->id             = 0;
      $this->idTicketType = 0;
      $this->idLanguage     = 0;
      $this->name           = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdTicketType():int { return $this->idTicketType; }
    public function getIdLanguage():int { return $this->idLanguage; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdTicketType(int $idTicketType) { $this->idTicketType = $idTicketType; }
    public function setIdLanguage(int $idLanguage) { $this->idLanguage = $idLanguage; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
