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
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id                   = 0;
      $this->idFood               = 0;
      $this->idNutritional        = 0;
      $this->nameNutritional      = "";
      $this->nutritional          = "";
      $this->idweighttype         = 0;
      $this->nameweighttype      = "";
      $this->idweighttypebase     = 0;
      $this->nameweighttypebase  = "";
      $this->weighttypebase       = 0;
      $this->status               = 0;
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
    public function getStatus() { return $this->status; }
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
    public function setStatus($status) { $this->status = $status; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
