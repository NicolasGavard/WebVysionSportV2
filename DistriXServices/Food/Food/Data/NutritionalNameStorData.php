<?php // Needed to encode in UTF8 ààéàé //
class NutritionalNameStorData {
  const NUTRITIONALNAME_STATUS_AVAILABLE     = 0;
  const NUTRITIONALNAME_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idnutritional;
  private $idlanguage;
  private $name;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idnutritional = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdNutritional() { return $this->idnutritional; }
  public function getIdLanguage() { return $this->idlanguage; }
  public function getName() { return $this->name; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::NUTRITIONALNAME_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::NUTRITIONALNAME_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::NUTRITIONALNAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdNutritional($idNutritional) { $this->idnutritional = $idNutritional; }
  public function setIdLanguage($idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName($name) { $this->name = $name; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::NUTRITIONALNAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::NUTRITIONALNAME_STATUS_NOT_AVAILABLE; }
}
