<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodNutritionalData", false)) {
  class DistriXFoodNutritionalData extends DistriXSvcAppData
  {
    protected $id;
    protected $idFood;
    protected $idNutritional;
    protected $nameNutritional;
    protected $nutritional;
    protected $idWeightType;
    protected $nameWeightType;
    protected $idWeightTypeBase;
    protected $nameWeightTypeBase;
    protected $weightTypeBase;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id                   = 0;
      $this->idFood               = 0;
      $this->idNutritional        = 0;
      $this->nameNutritional      = "";
      $this->nutritional          = "";
      $this->idWeightType         = 0;
      $this->nameWeightType       = "";
      $this->idWeightTypeBase     = 0;
      $this->nameWeightTypeBase   = "";
      $this->weightTypeBase       = 0;
      $this->elemState            = 0;
      $this->timestamp            = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdFood() { return $this->idFood; }
    public function getIdNutritional() { return $this->idNutritional; }
    public function getNameNutritional() { return $this->nameNutritional; }
    public function getNutritional() { return $this->nutritional; }
    public function getIdWeightType() { return $this->idWeightType; }
    public function getNameWeightType() { return $this->nameWeightType; }
    public function getIdWeightTypeBase() { return $this->idWeightTypeBase; }
    public function getNameWeightTypeBase() { return $this->nameWeightTypeBase; }
    public function getWeightTypeBase() { return $this->weightTypeBase; }
    public function getElemState() { return $this->elemState; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdFood($idFood) { $this->idFood = $idFood; }
    public function setIdNutritional($idNutritional) { $this->idNutritional = $idNutritional; }
    public function setNameNutritional($nameNutritional) { $this->nameNutritional = $nameNutritional; }
    public function setNutritional($nutritional) { $this->nutritional = $nutritional; }
    public function setIdWeightType($idWeightType) { $this->idWeightType = $idWeightType; }
    public function setNameWeightType($nameWeightType) { $this->nameWeightType = $nameWeightType; }
    public function setIdWeightTypeBase($idWeightTypeBase) { $this->idWeightTypeBase = $idWeightTypeBase; }
    public function setNameWeightTypeBase($nameWeightTypeBase) { $this->nameWeightTypeBase = $nameWeightTypeBase; }
    public function setWeightTypeBase($weightTypeBase) { $this->weightTypeBase = $weightTypeBase; }
    public function setElemState($elemState) { $this->elemState = $elemState; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
