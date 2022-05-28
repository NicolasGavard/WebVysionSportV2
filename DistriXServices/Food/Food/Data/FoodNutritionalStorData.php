<?php // Needed to encode in UTF8 ààéàé //
class FoodNutritionalStorData extends DistriXSvcAppData {
  const FOODNUTRITIONAL_STATUS_AVAILABLE     = 0;
  const FOODNUTRITIONAL_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idfood;
  protected $idnutritional;
  protected $nutritional;
  protected $idweighttype;
  protected $idweighttypebase;
  protected $weighttypebase;
  protected $elemstate;
  protected $timestamp;

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
  public function getId():int { return $this->id; }
  public function getIdFood():int { return $this->idfood; }
  public function getIdNutritional():int { return $this->idnutritional; }
  public function getNutritional():string { return $this->nutritional; }
  public function getIdWeightType():int { return $this->idweighttype; }
  public function getIdWeightTypeBase():int { return $this->idweighttypebase; }
  public function getWeightTypeBase():int { return $this->weighttypebase; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::FOODNUTRITIONAL_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::FOODNUTRITIONAL_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::FOODNUTRITIONAL_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdFood(int $idFood) { $this->idfood = $idFood; }
  public function setIdNutritional(int $idNutritional) { $this->idnutritional = $idNutritional; }
  public function setNutritional(string $nutritional) { $this->nutritional = $nutritional; }
  public function setIdWeightType(int $idWeightType) { $this->idweighttype = $idWeightType; }
  public function setIdWeightTypeBase(int $idWeightTypeBase) { $this->idweighttypebase = $idWeightTypeBase; }
  public function setWeightTypeBase(int $weightTypeBase) { $this->weighttypebase = $weightTypeBase; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::FOODNUTRITIONAL_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::FOODNUTRITIONAL_STATUS_NOT_AVAILABLE; }
}
