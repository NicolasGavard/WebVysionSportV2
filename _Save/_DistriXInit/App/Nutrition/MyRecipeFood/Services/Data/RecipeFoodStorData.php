<?php // Needed to encode in UTF8 ààéàé //
class RecipefoodStorData extends DistriXSvcAppData {
  const RECIPEFOOD_STATUS_AVAILABLE     = 0;
  const RECIPEFOOD_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idrecipe;
  protected $idfood;
  protected $weight;
  protected $idweighttype;
  protected $calorie;
  protected $proetin;
  protected $glucide;
  protected $lipid;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idrecipe = 0;
      $this->idfood = 0;
      $this->weight = 0;
      $this->idweighttype = 0;
      $this->calorie = 0;
      $this->proetin = 0;
      $this->glucide = 0;
      $this->lipid = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdRecipe():int { return $this->idrecipe; }
  public function getIdFood():int { return $this->idfood; }
  public function getWeight():int { return $this->weight; }
  public function getIdWeightType():int { return $this->idweighttype; }
  public function getCalorie():int { return $this->calorie; }
  public function getProetin():int { return $this->proetin; }
  public function getGlucide():int { return $this->glucide; }
  public function getLipid():int { return $this->lipid; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::RECIPEFOOD_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::RECIPEFOOD_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::RECIPEFOOD_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdRecipe(int $idRecipe) { $this->idrecipe = $idRecipe; }
  public function setIdFood(int $idFood) { $this->idfood = $idFood; }
  public function setWeight(int $weight) { $this->weight = $weight; }
  public function setIdWeightType(int $idWeightType) { $this->idweighttype = $idWeightType; }
  public function setCalorie(int $calorie) { $this->calorie = $calorie; }
  public function setProetin(int $proetin) { $this->proetin = $proetin; }
  public function setGlucide(int $glucide) { $this->glucide = $glucide; }
  public function setLipid(int $lipid) { $this->lipid = $lipid; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::RECIPEFOOD_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::RECIPEFOOD_STATUS_NOT_AVAILABLE; }
}
