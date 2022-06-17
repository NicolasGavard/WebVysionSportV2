<?php // Needed to encode in UTF8 ààéàé //
class DietMealStorData extends DistriXSvcAppData {
  const DIETMEAL_STATUS_AVAILABLE     = 0;
  const DIETMEAL_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $iddiet;
  protected $iddietrecipe;
  protected $daynumber;
  protected $idmealtype;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->iddiet = 0;
      $this->iddietrecipe = 0;
      $this->daynumber = 0;
      $this->idmealtype = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdDiet():int { return $this->iddiet; }
  public function getIdDietRecipe():int { return $this->iddietrecipe; }
  public function getDayNumber():int { return $this->daynumber; }
  public function getIdMealType():int { return $this->idmealtype; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::DIETMEAL_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::DIETMEAL_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::DIETMEAL_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdDiet(int $idDiet) { $this->iddiet = $idDiet; }
  public function setIdDietRecipe(int $idDietRecipe) { $this->iddietrecipe = $idDietRecipe; }
  public function setDayNumber(int $dayNumber) { $this->daynumber = $dayNumber; }
  public function setIdMealType(int $idMealType) { $this->idmealtype = $idMealType; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIETMEAL_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIETMEAL_STATUS_NOT_AVAILABLE; }
}
