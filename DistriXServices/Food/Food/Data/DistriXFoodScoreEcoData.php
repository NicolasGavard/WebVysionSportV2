<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodScoreEcoData", false)) {
  class DistriXFoodScoreEcoData extends DistriXSvcAppData
  {
    protected $id;
    protected $letter;
    protected $color;
    protected $description;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $elemstate;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->letter         = "";
      $this->color          = "";
      $this->description    = "";
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->elemstate         = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getLetter() { return $this->letter; }
    public function getColor() { return $this->color; }
    public function getDescription() { return $this->description; }
    public function getLinkToPicture() { return $this->linkToPicture; }
    public function getSize() { return $this->size; }
    public function getType() { return $this->type; }
    public function getElemState() { return $this->elemstate; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setLetter($letter) { $this->letter = $letter; }
    public function setColor($color) { $this->color = $color; }
    public function setDescription($description) { $this->description = $description; }
    public function setLinkToPicture($linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize($size) { $this->size = $size; }
    public function setType($type) { $this->type = $type; }
    public function setElemState($elemstate) { $this->elemstate = $elemstate; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
