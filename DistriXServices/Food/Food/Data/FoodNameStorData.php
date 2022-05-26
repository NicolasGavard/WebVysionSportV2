<?php // Needed to encode in UTF8 ààéàé //
class FoodNameStorData {
  const FOODNAME_STATUS_AVAILABLE     = 0;
  const FOODNAME_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idfood;
  private $idlanguage;
  private $name;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdFood() { return $this->idfood; }
  public function getIdLanguage() { return $this->idlanguage; }
  public function getName() { return $this->name; }
  public function getStatut() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::FOODNAME_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::FOODNAME_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::FOODNAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdFood($idFood) { $this->idfood = $idFood; }
  public function setIdLanguage($idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName($name) { $this->name = $name; }
  public function setStatut($statut) { $this->statut = $statut; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::FOODNAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::FOODNAME_STATUS_NOT_AVAILABLE; }
}
