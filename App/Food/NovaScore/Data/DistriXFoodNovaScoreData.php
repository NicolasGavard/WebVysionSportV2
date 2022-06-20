<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodNovaScoreData", false)) {
  class DistriXFoodNovaScoreData extends DistriXSvcAppData
  {
    protected $id;
    protected $number;
    protected $color;
    protected $description;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->number         = 0;
      $this->color          = "";
      $this->description    = "";
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getNumber():int { return $this->number; }
    public function getColor():string { return $this->color; }
    public function getDescription():string { return $this->description; }
    public function getLinkToPicture():string { return $this->linkToPicture; }
    public function getSize():int { return $this->size; }
    public function getType():string { return $this->type; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setNumber(int $number) { $this->number = $number; }
    public function setColor(string $color) { $this->color = $color; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
