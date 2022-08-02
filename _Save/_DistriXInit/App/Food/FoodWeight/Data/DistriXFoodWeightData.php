<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodWeightData", false)) {
  class DistriXFoodWeightData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $name;
    protected $weight;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->idFood       = 0;
      $this->idWeightType = 0;
      $this->weight       = 0;
      $this->elemState    = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdFood():int { return $this->idFood; }
    public function getIdWeightType():int { return $this->idWeightType; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdFood(int $idFood) { $this->idFood = $idFood; }
    public function setIdWeightType(int $idWeightType) { $this->idWeightType = $idWeightType; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
