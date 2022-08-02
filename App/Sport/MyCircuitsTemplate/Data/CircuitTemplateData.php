<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("CircuitTemplateData", false)) {
  class CircuitTemplateData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCoach;
    protected $nameUserCoach;
    protected $firstNameUserCoach;
    protected $name;
    protected $description;
    protected $duration;
    protected $tags;
    protected $exercises;
    protected $elemstate;
    protected $timestamp;

    public function __construct() {
        $this->id                 = 0;
        $this->idUserCoach        = 0;
        $this->nameUserCoach      = 0;
        $this->firstNameUserCoach = 0;
        $this->name               = "";
        $this->description        = "";
        $this->duration           = 0;
        $this->tags               = "";
        $this->exercises          = [];
        $this->elemstate          = 0;
        $this->timestamp          = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdUserCoach():int { return $this->idUserCoach; }
    public function getNameUserCoach():int { return $this->nameUserCoach; }
    public function getFirstNameUserCoach():int { return $this->firstNameUserCoach; }
    public function getName():string { return $this->name; }
    public function getDescription():string { return $this->description; }
    public function getDuration():int { return $this->duration; }
    public function getTags():string { return $this->tags; }
    public function getExercises():array { return $this->exercises; }
    public function getElemState():int { return $this->elemstate; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCoach(int $idUserCoach) { $this->idUserCoach = $idUserCoach; }
    public function setNameUserCoach(int $nameUserCoach) { $this->nameUserCoach = $nameUserCoach; }
    public function setFirstNameUserCoach(int $firstNameUserCoach) { $this->firstNameUserCoach = $firstNameUserCoach; }
    public function setName(string $name) { $this->name = $name; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setDuration(int $duration) { $this->duration = $duration; }
    public function setTags(string $tags) { $this->tags = $tags; }
    public function setExercises(string $exercises) { $this->exercises = $exercises; }
    public function setElemState(int $elemState) { $this->elemstate = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
