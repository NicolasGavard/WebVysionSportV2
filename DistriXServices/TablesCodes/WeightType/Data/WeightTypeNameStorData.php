<?php // Needed to encode in UTF8 ààéàé //
class WeightTypeNameStorData extends DistriXSvcAppData {
  const BRAND_STATUS_AVAILABLE     = 0;
  const WEIGHTTYPENAME_STATUS_AVAILABLE     = 0;
  const WEIGHTTYPENAME_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idweighttype;
  protected $idlanguage;
  protected $name;
  protected $description;
  protected $abbreviation;
  protected $statut;
  protected $timestamp;

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
  public function getId():int { return $this->id; }
  public function getIdWeightType():int { return $this->idweighttype; }
  public function getIdLanguage():int { return $this->idlanguage; }
  public function getName():string { return $this->name; }
  public function getDescription():string { return $this->description; }
  public function getAbbreviation():string { return $this->abbreviation; }
  public function getStatut():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->statut == self::WEIGHTTYPENAME_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::WEIGHTTYPENAME_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::WEIGHTTYPENAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdWeightType(int $idWeightType) { $this->idweighttype = $idWeightType; }
  public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName(string $name) { $this->name = $name; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setAbbreviation(string $abbreviation) { $this->abbreviation = $abbreviation; }
  public function setStatut(int $statut) { $this->statut = $statut; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::WEIGHTTYPENAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::WEIGHTTYPENAME_STATUS_NOT_AVAILABLE; }
}
