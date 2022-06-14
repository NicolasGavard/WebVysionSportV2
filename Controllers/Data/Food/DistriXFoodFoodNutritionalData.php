<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodFoodNutritionalData", false)) {
  class DistriXFoodFoodNutritionalData extends DistriXSvcAppData
  {
    protected $id;
    protected $idFood;
    protected $idNutritional;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idFood         = 0;
      $this->idNutritional  = 0;
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdFood():int { return $this->idFood; }
    public function getIdNutritional():int { return $this->idNutritional; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdFood(int $idFood) { $this->idFood = $idFood; }
    public function setIdNutritional(int $idNutritional) { $this->idNutritional = $idNutritional; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
