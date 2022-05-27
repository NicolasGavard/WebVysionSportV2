<?php // Needed to encode in UTF8 ààéàé //
class FoodNutritionalStorData {
  const FOODNUTRITIONAL_STATUS_AVAILABLE     = 0;
  const FOODNUTRITIONAL_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idfood;
  private $idnutritional;
  private $nutritional;
  private $idweighttype;
  private $idweighttypebase;
  private $weighttypebase;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idnutritional = 0;
      $this->nutritional = "";
      $this->idweighttype = 0;
      $this->idweighttypebase = 0;
      $this->weighttypebase = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdFood() { return $this->idfood; }
  public function getIdNutritional() { return $this->idnutritional; }
  public function getNutritional() { return $this->nutritional; }
  public function getIdWeightType() { return $this->idweighttype; }
  public function getIdWeightTypeBase() { return $this->idweighttypebase; }
  public function getWeightTypeBase() { return $this->weighttypebase; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::FOODNUTRITIONAL_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::FOODNUTRITIONAL_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::FOODNUTRITIONAL_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdFood($idFood) { $this->idfood = $idFood; }
  public function setIdNutritional($idNutritional) { $this->idnutritional = $idNutritional; }
  public function setNutritional($nutritional) { $this->nutritional = $nutritional; }
  public function setIdWeightType($idWeightType) { $this->idweighttype = $idWeightType; }
  public function setIdWeightTypeBase($idWeightTypeBase) { $this->idweighttypebase = $idWeightTypeBase; }
  public function setWeightTypeBase($weightTypeBase) { $this->weighttypebase = $weightTypeBase; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::FOODNUTRITIONAL_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::FOODNUTRITIONAL_STATUS_NOT_AVAILABLE; }
}
