<?php // Needed to encode in UTF8 ààéàé //
class CategoryNameStorData {
  const CATEGORYNAME_STATUS_AVAILABLE     = 0;
  const CATEGORYNAME_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idcategory;
  private $idlanguage;
  private $name;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idcategory = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdCategory() { return $this->idcategory; }
  public function getIdLanguage() { return $this->idlanguage; }
  public function getName() { return $this->name; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::CATEGORYNAME_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::CATEGORYNAME_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::CATEGORYNAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdCategory($idCategory) { $this->idcategory = $idCategory; }
  public function setIdLanguage($idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName($name) { $this->name = $name; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::CATEGORYNAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::CATEGORYNAME_STATUS_NOT_AVAILABLE; }
}
