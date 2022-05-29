<?php // Needed to encode in UTF8 ààéàé //
class NutritionalNameStorData extends DistriXSvcAppData {
  const NUTRITIONALNAME_STATUS_AVAILABLE     = 0;
  const NUTRITIONALNAME_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idnutritional;
  protected $idlanguage;
  protected $name;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idnutritional = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdNutritional():int { return $this->idnutritional; }
  public function getIdLanguage():int { return $this->idlanguage; }
  public function getName():string { return $this->name; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::NUTRITIONALNAME_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::NUTRITIONALNAME_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::NUTRITIONALNAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdNutritional(int $idNutritional) { $this->idnutritional = $idNutritional; }
  public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName(string $name) { $this->name = $name; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::NUTRITIONALNAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::NUTRITIONALNAME_STATUS_NOT_AVAILABLE; }
}
