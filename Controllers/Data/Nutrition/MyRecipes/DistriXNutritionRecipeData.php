<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionRecipeData", false)) {
  class DistriXNutritionRecipeData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCoach;
    protected $code;
    protected $name;
    protected $description;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $nutritionalInfo;
    protected $rating;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id               = 0;
      $this->idUserCoach      = 0;
      $this->code             = "";
      $this->name             = "";
      $this->description      = "";
      $this->linkToPicture    = "";
      $this->size             = 0;
      $this->type             = "";
      $this->nutritionalInfo  = [];
      $this->rating           = 0;
      $this->elemState        = 0;
      $this->timestamp        = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdUserCoach():int { return $this->idUserCoach; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getDescription():string { return $this->description; }
    public function getLinkToPicture():string { return $this->linkToPicture; }
    public function getSize():int { return $this->size; }
    public function getType():string { return $this->type; }
    public function getNutritionalInfo():array { return $this->nutritionalInfo; }
    public function getRating():int { return $this->rating; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCoach(int $idUserCoach) { $this->idUserCoach = $idUserCoach; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setNutritionalInfo(array $nutritionalInfo) { $this->nutritionalInfo = $nutritionalInfo; }
    public function setRating(int $rating) { $this->rating = $rating; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
