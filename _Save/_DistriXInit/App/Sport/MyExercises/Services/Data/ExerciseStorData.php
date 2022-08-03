<?php // Needed to encode in UTF8 ààéàé //
class ExerciseStorData extends DistriXSvcAppData {
  const EXERCISE_STATUS_AVAILABLE     = 0;
  const EXERCISE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idusercoach;
  protected $code;
  protected $name;
  protected $idexercisetype;
  protected $isaudio;
  protected $isvideo;
  protected $playertype;
  protected $playerid;
  protected $linktopicture;
  protected $linktomedia;
  protected $size;
  protected $type;
  protected $description;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idusercoach = 0;
      $this->code = "";
      $this->name = "";
      $this->idexercisetype = 0;
      $this->isaudio = 0;
      $this->isvideo = 0;
      $this->playertype = "";
      $this->playerid = "";
      $this->linktopicture = "";
      $this->linktomedia = "";
      $this->size = 0;
      $this->type = "";
      $this->description = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdUserCoach():int { return $this->idusercoach; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getIdExerciseType():int { return $this->idexercisetype; }
  public function getIsAudio():int { return $this->isaudio; }
  public function getIsVideo():int { return $this->isvideo; }
  public function getPlayerType():string { return $this->playertype; }
  public function getPlayerId():string { return $this->playerid; }
  public function getLinkToPicture():string { return $this->linktopicture; }
  public function getLinkToMedia():string { return $this->linktomedia; }
  public function getSize():int { return $this->size; }
  public function getType():string { return $this->type; }
  public function getDescription():string { return $this->description; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::EXERCISE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::EXERCISE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::EXERCISE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUserCoach(int $idUserCoach) { $this->idusercoach = $idUserCoach; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setIdExerciseType(int $idExerciseType) { $this->idexercisetype = $idExerciseType; }
  public function setIsAudio(int $isAudio) { $this->isaudio = $isAudio; }
  public function setIsVideo(int $isVideo) { $this->isvideo = $isVideo; }
  public function setPlayerType(string $playerType) { $this->playertype = $playerType; }
  public function setPlayerId(string $playerId) { $this->playerid = $playerId; }
  public function setLinkToPicture(string $linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setLinkToMedia(string $linkToMedia) { $this->linktomedia = $linkToMedia; }
  public function setSize(int $size) { $this->size = $size; }
  public function setType(string $type) { $this->type = $type; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::EXERCISE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::EXERCISE_STATUS_NOT_AVAILABLE; }
}
