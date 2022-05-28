<?php // Needed to encode in UTF8 ààéàé //
class FoodStorData extends DistriXSvcAppData {
  const FOOD_STATUS_AVAILABLE     = 0;
  const FOOD_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idbrand;
  protected $idscorenutri;
  protected $idscorenova;
  protected $idscoreeco;
  protected $code;
  protected $name;
  protected $description;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idbrand = 0;
      $this->idscorenutri = 0;
      $this->idscorenova = 0;
      $this->idscoreeco = 0;
      $this->code = "";
      $this->name = "";
      $this->description = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdBrand():int { return $this->idbrand; }
  public function getIdScoreNutri():int { return $this->idscorenutri; }
  public function getIdScoreNova():int { return $this->idscorenova; }
  public function getIdScoreEco():int { return $this->idscoreeco; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getDescription():string { return $this->description; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::FOOD_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::FOOD_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::FOOD_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdBrand(int $idBrand) { $this->idbrand = $idBrand; }
  public function setIdScoreNutri(int $idScoreNutri) { $this->idscorenutri = $idScoreNutri; }
  public function setIdScoreNova(int $idScoreNova) { $this->idscorenova = $idScoreNova; }
  public function setIdScoreEco(int $idScoreEco) { $this->idscoreeco = $idScoreEco; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::FOOD_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::FOOD_STATUS_NOT_AVAILABLE; }
}
