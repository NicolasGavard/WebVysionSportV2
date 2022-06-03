<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionTemplateDietData", false)) {
  class DistriXNutritionTemplateDietData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCoach;
    protected $nameUserCoach;
    protected $firstNameUserCoach;
    protected $name;
    protected $duration;
    protected $tags;
    protected $nbStudentAssigned;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id                 = 0;
      $this->idUserCoach        = 0;
      $this->nameUserCoach      = "";
      $this->firstNameUserCoach = "";
      $this->name               = "";
      $this->duration           = 0;
      $this->tags               = "";
      $this->nbStudentAssigned  = 0;
      $this->elemState          = 0;
      $this->timestamp          = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdUserCoach():int { return $this->idUserCoach; }
    public function getNameUserCoach():string { return $this->nameUserCoach; }
    public function getFirstNameUserCoach():string { return $this->firstNameUserCoach; }
    public function getName():string { return $this->name; }
    public function getDuration():int { return $this->duration; }
    public function getTags():string { return $this->tags; }
    public function getNbStudentAssigned():int { return $this->nbStudentAssigned; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCoach(int $idUserCoach) { $this->idUserCoach = $idUserCoach; }
    public function setNameUserCoach(string $nameUserCoach) { $this->nameUserCoach = $nameUserCoach; }
    public function setFirstNameUserCoach(string $firstNameUserCoach) { $this->firstNameUserCoach = $firstNameUserCoach; }
    public function setName(string $name) { $this->name = $name; }
    public function setDuration(int $duration) { $this->duration = $duration; }
    public function setTags(string $tags) { $this->tags = $tags; }
    public function setNbStudentAssigned(int $nbStudentAssigned) { $this->nbStudentAssigned = $nbStudentAssigned; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
