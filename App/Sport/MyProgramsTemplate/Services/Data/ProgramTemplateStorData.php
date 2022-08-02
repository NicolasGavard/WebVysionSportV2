<?php // Needed to encode in UTF8 ààéàé //
class ProgramTemplateStorData extends DistriXSvcAppData {
  const PROGRAMTEMPLATE_STATUS_AVAILABLE     = 0;
  const PROGRAMTEMPLATE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idusercoach;
  protected $name;
  protected $description;
  protected $duration;
  protected $tags;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idusercoach = 0;
      $this->name = "";
      $this->description = "";
      $this->duration = 0;
      $this->tags = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdUserCoach():int { return $this->idusercoach; }
  public function getName():string { return $this->name; }
  public function getDescription():string { return $this->description; }
  public function getDuration():int { return $this->duration; }
  public function getTags():string { return $this->tags; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::PROGRAMTEMPLATE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::PROGRAMTEMPLATE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::PROGRAMTEMPLATE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUserCoach(int $idUserCoach) { $this->idusercoach = $idUserCoach; }
  public function setName(string $name) { $this->name = $name; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setDuration(int $duration) { $this->duration = $duration; }
  public function setTags(string $tags) { $this->tags = $tags; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::PROGRAMTEMPLATE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::PROGRAMTEMPLATE_STATUS_NOT_AVAILABLE; }
}
