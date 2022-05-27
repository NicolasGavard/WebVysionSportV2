<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodNutriScoreData", false)) {
  class DistriXFoodNutriScoreData extends DistriXSvcAppData
  {
    protected $id;
    protected $letter;
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
      $this->letter         = "";
      $this->color          = "";
      $this->description    = "";
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->statut         = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getLetter():string { return $this->letter; }
    public function getColor():string { return $this->color; }
    public function getDescription():string { return $this->description; }
    public function getLinkToPicture():string { return $this->linkToPicture; }
    public function getSize():int { return $this->size; }
    public function getType():string { return $this->type; }
    public function getStatut():int { return $this->statut; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setLetter(string $letter) { $this->letter = $letter; }
    public function setColor(string $color) { $this->color = $color; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setStatut(int $statut) { $this->statut = $statut; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
