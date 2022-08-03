<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXTicketTicketPictureData", false)) {
  class DistriXTicketTicketPictureData extends DistriXSvcAppData
  {
      protected $id;
      protected $idTicket;
      protected $idTicketComment;
      protected $linkToPicture;
      protected $size;
      protected $type;
      protected $elemState;
      protected $timestamp;

    public function __construct() {
        $this->id               = 0;
        $this->idTicket         = 0;
        $this->idTicketComment  = 0;
        $this->linkToPicture    = "";
        $this->size             = 0;
        $this->type             = "";
        $this->elemState        = 0;
        $this->timestamp        = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdTicket():int { return $this->idTicket; }
    public function getIdTicketComment():int { return $this->idTicketComment; }
    public function getLinkToPicture():string { return $this->linkToPicture; }
    public function getSize():int { return $this->size; }
    public function getType():string { return $this->type; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdTicket(int $idTicket) { $this->idTicket = $idTicket; }
    public function setIdTicketComment(int $idTicketComment) { $this->idTicketComment = $idTicketComment; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
