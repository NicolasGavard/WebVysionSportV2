<?php // Needed to encode in UTF8 ààéàé //
class CategoryNameStorData {
  const CATEGORYNAME_STATUS_AVAILABLE     = 0;
  const CATEGORYNAME_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idcategory;
  private $idlanguage;
  private $name;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idcategory = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdCategory() { return $this->idcategory; }
  public function getIdLanguage() { return $this->idlanguage; }
  public function getName() { return $this->name; }
  public function getStatut() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::CATEGORYNAME_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::CATEGORYNAME_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::CATEGORYNAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdCategory($idCategory) { $this->idcategory = $idCategory; }
  public function setIdLanguage($idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName($name) { $this->name = $name; }
  public function setStatut($statut) { $this->statut = $statut; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::CATEGORYNAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::CATEGORYNAME_STATUS_NOT_AVAILABLE; }
}
