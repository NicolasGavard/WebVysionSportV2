<?php // Needed to encode in UTF8 ààéàé //
class FoodCategoryStorData extends DistriXSvcAppData {
  const FOODCATEGORY_STATUS_AVAILABLE     = 0;
  const FOODCATEGORY_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idfood;
  protected $idcategory;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idcategory = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdFood():int { return $this->idfood; }
  public function getIdCategory():int { return $this->idcategory; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::FOODCATEGORY_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::FOODCATEGORY_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::FOODCATEGORY_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdFood(int $idFood) { $this->idfood = $idFood; }
  public function setIdCategory(int $idCategory) { $this->idcategory = $idCategory; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::FOODCATEGORY_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::FOODCATEGORY_STATUS_NOT_AVAILABLE; }
}
