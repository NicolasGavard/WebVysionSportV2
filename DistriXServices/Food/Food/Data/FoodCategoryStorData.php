<?php // Needed to encode in UTF8 ààéàé //
class FoodCategoryStorData {
  const FOODCATEGORY_STATUS_AVAILABLE     = 0;
  const FOODCATEGORY_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idfood;
  private $idcategory;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idcategory = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdFood() { return $this->idfood; }
  public function getIdCategory() { return $this->idcategory; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::FOODCATEGORY_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::FOODCATEGORY_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::FOODCATEGORY_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdFood($idFood) { $this->idfood = $idFood; }
  public function setIdCategory($idCategory) { $this->idcategory = $idCategory; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::FOODCATEGORY_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::FOODCATEGORY_STATUS_NOT_AVAILABLE; }
}
