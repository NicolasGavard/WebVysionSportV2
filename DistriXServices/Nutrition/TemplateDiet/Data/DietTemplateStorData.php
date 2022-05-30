<?php // Needed to encode in UTF8 ààéàé //
class DiettemplateStorData extends DistriXSvcAppData {
  const DIETTEMPLATE_STATUS_AVAILABLE     = 0;
  const DIETTEMPLATE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idusercoatch;
  protected $name;
  protected $duration;
  protected $tags;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idusercoatch = 0;
      $this->name = "";
      $this->duration = 0;
      $this->tags = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdUserCoatch():int { return $this->idusercoatch; }
  public function getName():string { return $this->name; }
  public function getDuration():int { return $this->duration; }
  public function getTags():string { return $this->tags; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::DIETTEMPLATE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::DIETTEMPLATE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::DIETTEMPLATE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUserCoatch(int $idUserCoatch) { $this->idusercoatch = $idUserCoatch; }
  public function setName(string $name) { $this->name = $name; }
  public function setDuration(int $duration) { $this->duration = $duration; }
  public function setTags(string $tags) { $this->tags = $tags; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIETTEMPLATE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIETTEMPLATE_STATUS_NOT_AVAILABLE; }
}
