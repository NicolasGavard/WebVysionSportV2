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
    protected $linkToPictureInternalPoster;
    protected $linkToPictureInternal;
    protected $linkToPictureExternal;
    protected $size;
    protected $type;
    protected $description;
    protected $exerciseMuscles;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id                           = 0;
      $this->idUserCoach                  = 0;
      $this->nameUserCoach                = "";
      $this->firstNameUserCoach           = "";
      $this->code                         = "";
      $this->name                         = "";
      $this->idExerciseType               = 0;
      $this->nameExerciseType             = "";
      $this->linkToPictureInternalPoster  = "";
      $this->linkToPictureInternal        = "";
      $this->linkToPictureExternal        = "";
      $this->size                         = 0;
      $this->type                         = "";
      $this->description                  = "";
      $this->exerciseMuscles              = [];
      $this->elemState                    = 0;
      $this->timestamp                    = 0;
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
    public function getLinkToPictureInternalPoster():string { return $this->linkToPictureInternalPoster; }
    public function getLinkToPictureInternal():string { return $this->linkToPictureInternal; }
    public function getLinkToPictureExternal():string { return $this->linkToPictureExternal; }
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
    public function setLinkToPictureInternalPoster(string $linkToPictureInternalPoster) { $this->linkToPictureInternalPoster = $linkToPictureInternalPoster; }
    public function setLinkToPictureInternal(string $linkToPictureInternal) { $this->linkToPictureInternal = $linkToPictureInternal; }
    public function setLinkToPictureExternal(string $linkToPictureExternal) { $this->linkToPictureExternal = $linkToPictureExternal; }
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
