<?php // Needed to encode in UTF8 ààéàé //
class FoodNameStorData extends DistriXSvcAppData {
  const FOODNAME_STATUS_AVAILABLE     = 0;
  const FOODNAME_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idfood;
  protected $idlanguage;
  protected $name;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdFood():int { return $this->idfood; }
  public function getIdLanguage():int { return $this->idlanguage; }
  public function getName():string { return $this->name; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::FOODNAME_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::FOODNAME_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::FOODNAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdFood(int $idFood) { $this->idfood = $idFood; }
  public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName(string $name) { $this->name = $name; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::FOODNAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::FOODNAME_STATUS_NOT_AVAILABLE; }
}
