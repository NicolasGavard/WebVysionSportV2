<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXTicketTicketData", false)) {
  class DistriXTicketTicketData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCreate;
    protected $nameUserCreate;
    protected $firstNameUserCreate;
    protected $idUserAssign;
    protected $nameUserAssign;
    protected $firstNameUserAssign;
    protected $idTicketType;
    protected $nameTicketType;
    protected $idTicketStatus;
    protected $nameTicketStatus;
    protected $title;
    protected $descMessage;
    protected $date;
    protected $time;
    protected $comment;
    protected $advancement;
    protected $picture;
    protected $elemState;
    protected $timestamp;

    public function __construct() {
        $this->id                   = 0;
        $this->idUserCreate         = 0;
        $this->nameUserCreate       = "";
        $this->firstNameUserCreate  = "";
        $this->idUserAssign         = 0;
        $this->nameUserAssign       = "";
        $this->firstNameUserAssign  = "";
        $this->idTicketType         = 0;
        $this->nameTicketType       = "";
        $this->idTicketStatus       = 0;
        $this->nameTicketStatus     = "";
        $this->title                = "";
        $this->descMessage          = "";
        $this->date                 = 0;
        $this->time                 = 0;
        $this->comment              = [];
        $this->advancement          = [];
        $this->picture              = [];
        $this->elemState            = 0;
        $this->timestamp            = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdUserCreate():int { return $this->idUserCreate; }
    public function getNameUserCreate():string { return $this->nameUserCreate; }
    public function getFirstNameUserCreate():string { return $this->firstNameUserCreate; }
    public function getIdUserAssign():int { return $this->idUserAssign; }
    public function getNameUserAssign():string { return $this->nameUserAssign; }
    public function getFirstNameUserAssign():string { return $this->firstNameUserAssign; }
    public function getIdTicketType():int { return $this->idTicketType; }
    public function getNameTicketType():string { return $this->nameTicketType; }
    public function getIdTicketStatus():int { return $this->idTicketStatus; }
    public function getNameTicketStatus():string { return $this->nameTicketStatus; }
    public function getTitle():string { return $this->title; }
    public function getDescMessage() { return $this->descMessage; }
    public function getDate():int { return $this->date; }
    public function getTime():int { return $this->time; }
    public function getComment():array { return $this->comment; }
    public function getAdvancement():array { return $this->advancement; }
    public function getPicture():array { return $this->picture; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCreate(int $idUserCreate) { $this->idUserCreate = $idUserCreate; }
    public function setNameUserCreate(string $nameUserCreate) { $this->nameUserCreate = $nameUserCreate; }
    public function setFirstNameUserCreate(string $firstNameUserCreate) { $this->firstNameUserCreate = $firstNameUserCreate; }
    public function setIdUserAssign(int $idUserAssign) { $this->idUserAssign = $idUserAssign; }
    public function setNameUserAssign(string $nameUserAssign) { $this->nameUserAssign = $nameUserAssign; }
    public function setFirstNameUserAssign(string $firstNameUserAssign) { $this->firstNameUserAssign = $firstNameUserAssign; }
    public function setIdTicketType(int $idTicketType) { $this->idTicketType = $idTicketType; }
    public function setNameTicketType(string $nameTicketType) { $this->nameTicketType = $nameTicketType; }
    public function setIdTicketStatus(int $idTicketStatus) { $this->idTicketStatus = $idTicketStatus; }
    public function setNameTicketStatus(string $nameTicketStatus) { $this->nameTicketStatus = $nameTicketStatus; }
    public function setTitle(string $title) { $this->title = $title; }
    public function setDescMessage(string $descMessage) { $this->descMessage = $descMessage; }
    public function setDate(int $date) { $this->date = $date; }
    public function setTime(int $time) { $this->time = $time; }
    public function setComment(array $comment) { $this->comment = $comment; }
    public function setAdvancement(array $advancement) { $this->advancement = $advancement; }
    public function setPicture(array $picture) { $this->picture = $picture; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}