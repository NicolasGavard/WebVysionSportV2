<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXSportMyExerciseData", false)) {
  class DistriXSportMyExerciseData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCoach;
    protected $nameUserCoach;
    protected $firstNameUserCoach;
    protected $code;
    protected $name;
    protected $idExerciseType;
    protected $nameExerciseType;
    protected $isAudio;
    protected $isVideo;
    protected $playerType;
    protected $playerId;
    protected $linkToPicture;
    protected $linkToMedia;
    protected $size;
    protected $type;
    protected $description;
    protected $exerciseMuscles;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id                 = 0;
      $this->idUserCoach        = 0;
      $this->nameUserCoach      = "";
      $this->firstNameUserCoach = "";
      $this->code               = "";
      $this->name               = "";
      $this->idExerciseType     = 0;
      $this->nameExerciseType   = "";
      $this->isAudio            = 0;
      $this->isVideo            = 0;
      $this->playerType         = "";
      $this->playerId           = "";
      $this->linkToPicture      = "";
      $this->linkToMedia        = "";
      $this->size               = 0;
      $this->type               = "";
      $this->description        = "";
      $this->exerciseMuscles    = [];
      $this->elemState          = 0;
      $this->timestamp          = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdUserCoach():int { return $this->idUserCoach; }
    public function getNameUserCoach():string { return $this->nameUserCoach; }
    public function getFirstNameUserCoach():string { return $this->firstNameUserCoach; }
    public function getCode():string { return $this->name; }
    public function getName():string { return $this->name; }
    public function getIdExerciseType():int { return $this->idExerciseType; }
    public function getNameExerciseType():string { return $this->nameExerciseType; }
    public function getIsAudio():int { return $this->isAudio; }
    public function getIsVideo():int { return $this->isVideo; }
    public function getPlayerType():string { return $this->playerType; }
    public function getPlayerId():string { return $this->playerId; }
    public function getLinkToPicture():string { return $this->linkToPicture; }
    public function getLinkToMedia():string { return $this->linkToMedia; }
    public function getSize():int { return $this->size; }
    public function getType():string { return $this->type; }
    public function getDescription():string { return $this->description; }
    public function getExerciseMuscles():array { return $this->exerciseMuscles; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCoach(int $idUserCoach) { $this->idUserCoach = $idUserCoach; }
    public function setNameUserCoach(string $nameUserCoach) { $this->nameUserCoach = $nameUserCoach; }
    public function setFirstNameUserCoach(string $firstNameUserCoach) { $this->firstNameUserCoach = $firstNameUserCoach; }
    public function setIdExerciseType(int $idExerciseType) { $this->idExerciseType = $idExerciseType; }
    public function setNameExerciseType(string $nameExerciseType) { $this->nameExerciseType = $nameExerciseType; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setIsAudio(int $isAudio) { $this->isAudio = $isAudio; }
    public function setIsVideo(int $isVideo) { $this->isVideo = $isVideo; }
    public function setPlayerType(string $playerType) { $this->playerType = $playerType; }
    public function setPlayerId(string $playerId) { $this->playerId = $playerId; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setLinkToMedia(string $linkToMedia) { $this->linkToMedia = $linkToMedia; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setExerciseMuscles(array $exerciseMuscles) { $this->exerciseMuscles = $exerciseMuscles; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
