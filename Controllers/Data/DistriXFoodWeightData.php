<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodWeightData", false)) {
  class DistriXFoodWeightData extends DistriXSvcAppData
  {
    protected $id;
    protected $idFood;
    protected $idWeightType;
    protected $nameWeightType;
    protected $weight;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idFood         = 0;
      $this->idWeightType   = 0;
      $this->nameWeightType = '';
      $this->weight         = 0.0;
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdFood():int { return $this->idFood; }
    public function getIdWeightType():int { return $this->idWeightType; }
    public function getNameWeightType():string { return $this->nameWeightType; }
    public function getWeight():float { return $this->weight; }
    public function getLinkToPicture():string { return $this->linkToPicture; }
    public function getSize():int { return $this->size; }
    public function getType():string { return $this->type; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdFood(int $idFood) { $this->idFood = $idFood; }
    public function setIdWeightType(int $idWeightType) { $this->idWeightType = $idWeightType; }
    public function setNameWeightType(string $nameWeightType) { $this->nameWeightType = $nameWeightType; }
    public function setWeight(float $weight) { $this->weight = $weight; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
