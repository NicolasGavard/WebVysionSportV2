<?php // Needed to encode in UTF8 ààéàé //
class BodyMuscleNameStorData extends DistriXSvcAppData {
  const BODYMUSCLENAME_STATUS_AVAILABLE     = 0;
  const BODYMUSCLENAME_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idbodymuscle;
  protected $idlanguage;
  protected $name;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idbodymuscle = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdBodyMuscle():int { return $this->idbodymuscle; }
  public function getIdLanguage():int { return $this->idlanguage; }
  public function getName():string { return $this->name; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::BODYMUSCLENAME_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::BODYMUSCLENAME_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::BODYMUSCLENAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdBodyMuscle(int $idBodyMuscle) { $this->idbodymuscle = $idBodyMuscle; }
  public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName(string $name) { $this->name = $name; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::BODYMUSCLENAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::BODYMUSCLENAME_STATUS_NOT_AVAILABLE; }
}
