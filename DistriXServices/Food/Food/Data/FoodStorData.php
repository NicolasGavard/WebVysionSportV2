<?php // Needed to encode in UTF8 ààéàé //
class FoodStorData {
  const FOOD_STATUS_AVAILABLE     = 0;
  const FOOD_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idbrand;
  private $idscorenutri;
  private $idscorenova;
  private $idscoreeco;
  private $code;
  private $name;
  private $description;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idbrand = 0;
      $this->idscorenutri = 0;
      $this->idscorenova = 0;
      $this->idscoreeco = 0;
      $this->code = "";
      $this->name = "";
      $this->description = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdBrand() { return $this->idbrand; }
  public function getIdScoreNutri() { return $this->idscorenutri; }
  public function getIdScoreNova() { return $this->idscorenova; }
  public function getIdScoreEco() { return $this->idscoreeco; }
  public function getCode() { return $this->code; }
  public function getName() { return $this->name; }
  public function getDescription() { return $this->description; }
  public function getStatut() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::FOOD_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::FOOD_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::FOOD_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdBrand($idBrand) { $this->idbrand = $idBrand; }
  public function setIdScoreNutri($idScoreNutri) { $this->idscorenutri = $idScoreNutri; }
  public function setIdScoreNova($idScoreNova) { $this->idscorenova = $idScoreNova; }
  public function setIdScoreEco($idScoreEco) { $this->idscoreeco = $idScoreEco; }
  public function setCode($code) { $this->code = $code; }
  public function setName($name) { $this->name = $name; }
  public function setDescription($description) { $this->description = $description; }
  public function setStatut($statut) { $this->statut = $statut; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::FOOD_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::FOOD_STATUS_NOT_AVAILABLE; }
}
