<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodFoodLabelData", false)) {
  class DistriXFoodFoodLabelData extends DistriXSvcAppData
  {
    protected $id;
    protected $idFood;
    protected $idLabel;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id         = 0;
      $this->idFood     = 0;
      $this->idLabel    = 0;
      $this->elemState  = 0;
      $this->timestamp  = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdFood():int { return $this->idFood; }
    public function getIdLabel():int { return $this->idLabel; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdFood(int $idFood) { $this->idFood = $idFood; }
    public function setIdLabel(int $idLabel) { $this->idLabel = $idLabel; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
