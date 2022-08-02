<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXTicketTicketCommentData", false)) {
  class DistriXTicketTicketCommentData extends DistriXSvcAppData
  {
    protected $id;
    protected $idTicket;
    protected $idUserCreate;
    protected $nameUserCreate;
    protected $firstNameidUserCreate;
    protected $title;
    protected $descMessage;
    protected $date;
    protected $time;
    protected $picture;
    protected $elemState;
    protected $timestamp;

    public function __construct() {
        $this->id                   = 0;
        $this->idTicket             = 0;
        $this->idUserCreate         = 0;
        $this->nameUserCreate       = "";
        $this->firstNameUserCreate  = "";
        $this->title                = "";
        $this->descMessage          = "";
        $this->date                 = 0;
        $this->time                 = 0;
        $this->picture              = [];
        $this->elemState            = 0;
        $this->timestamp            = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdTicket():int { return $this->idTicket; }
    public function getIdUserCreate():int { return $this->idUserCreate; }
    public function getNameUserCreate():string { return $this->nameUserCreate; }
    public function getFirstNameUserCreate():string { return $this->firstNameUserCreate; }
    public function getTitle():string { return $this->title; }
    public function getDescMessage() { return $this->descMessage; }
    public function getDate():int { return $this->date; }
    public function getTime():int { return $this->time; }
    public function getPicture():array { return $this->picture; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdTicket(int $idTicket) { $this->idTicket = $idTicket; }
    public function setIdUserCreate(int $idUserCreate) { $this->idUserCreate = $idUserCreate; }
    public function setNameUserCreate(string $nameUserCreate) { $this->nameUserCreate = $nameUserCreate; }
    public function setFirstNameUserCreate(string $firstNameUserCreate) { $this->firstNameUserCreate = $firstNameUserCreate; }
    public function setTitle(string $title) { $this->title = $title; }
    public function setDescMessage(string $descMessage) { $this->descMessage = $descMessage; }
    public function setDate(int $date) { $this->date = $date; }
    public function setTime(int $time) { $this->time = $time; }
    public function setPicture(array $picture) { $this->picture = $picture; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
