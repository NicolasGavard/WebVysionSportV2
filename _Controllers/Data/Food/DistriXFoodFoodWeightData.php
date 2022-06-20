<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodFoodWeightData", false)) {
  class DistriXFoodFoodWeightData extends DistriXSvcAppData
  {
    protected $id;
    protected $idFood;
    protected $idWeight;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id         = 0;
      $this->idFood     = 0;
      $this->idWeight    = 0;
      $this->elemState  = 0;
      $this->timestamp  = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdFood():int { return $this->idFood; }
    public function getIdWeight():int { return $this->idWeight; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdFood(int $idFood) { $this->idFood = $idFood; }
    public function setIdWeight(int $idWeight) { $this->idWeight = $idWeight; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
