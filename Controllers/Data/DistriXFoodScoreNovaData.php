<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodScoreNovaData", false)) {
  class DistriXFoodScoreNovaData extends DistriXSvcAppData
  {
    protected $id;
    protected $number;
    protected $color;
    protected $description;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $statut;
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
      $this->statut         = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getNumber() { return $this->number; }
    public function getColor() { return $this->color; }
    public function getDescription() { return $this->description; }
    public function getLinkToPicture() { return $this->linkToPicture; }
    public function getSize() { return $this->size; }
    public function getType() { return $this->type; }
    public function getStatut() { return $this->statut; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setNumber($number) { $this->number = $number; }
    public function setColor($color) { $this->color = $color; }
    public function setDescription($description) { $this->description = $description; }
    public function setLinkToPicture($linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize($size) { $this->size = $size; }
    public function setType($type) { $this->type = $type; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
