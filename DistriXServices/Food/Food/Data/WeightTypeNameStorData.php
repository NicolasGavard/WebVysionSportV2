<?php // Needed to encode in UTF8 ààéàé //
class WeightTypeNameStorData {
  const WEIGHTTYPENAME_STATUS_AVAILABLE     = 0;
  const WEIGHTTYPENAME_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idweighttype;
  private $idlanguage;
  private $name;
  private $description;
  private $abbreviation;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idweighttype = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->description = "";
      $this->abbreviation = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdWeightType() { return $this->idweighttype; }
  public function getIdLanguage() { return $this->idlanguage; }
  public function getName() { return $this->name; }
  public function getDescription() { return $this->description; }
  public function getAbbreviation() { return $this->abbreviation; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::WEIGHTTYPENAME_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::WEIGHTTYPENAME_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::WEIGHTTYPENAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdWeightType($idWeightType) { $this->idweighttype = $idWeightType; }
  public function setIdLanguage($idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName($name) { $this->name = $name; }
  public function setDescription($description) { $this->description = $description; }
  public function setAbbreviation($abbreviation) { $this->abbreviation = $abbreviation; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::WEIGHTTYPENAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::WEIGHTTYPENAME_STATUS_NOT_AVAILABLE; }
}
