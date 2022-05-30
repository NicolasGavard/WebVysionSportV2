<?php // Needed to encode in UTF8 ààéàé //
class DietTemplateStorData extends DistriXSvcAppData {
  const DIETTEMPLATE_STATUS_AVAILABLE     = 0;
  const DIETTEMPLATE_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $iduser;
  private $name;
  private $duration;
  private $tags;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->iduser = 0;
      $this->name = "";
      $this->duration = 0;
      $this->tags = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdUser():int { return $this->iduser; }
  public function getName():string { return $this->name; }
  public function getDuration():int { return $this->duration; }
  public function getTags():string { return $this->tags; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::DIETTEMPLATE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::DIETTEMPLATE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::DIETTEMPLATE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUser(int $idUser) { $this->iduser = $idUser; }
  public function setName(string $name) { $this->name = $name; }
  public function setDuration(int $duration) { $this->duration = $duration; }
  public function setTags(string $tags) { $this->tags = $tags; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIETTEMPLATE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIETTEMPLATE_STATUS_NOT_AVAILABLE; }
}
