<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionTemplateDietData", false)) {
  class DistriXNutritionTemplateDietData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCoatch;
    protected $nameUserCoatch;
    protected $firstNameUserCoatch;
    protected $name;
    protected $duration;
    protected $tags;
    protected $nbStudentAssigned;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idUserCoatch         = 0;
      $this->nameUserCoatch       = "";
      $this->firstNameUserCoatch  = "";
      $this->name           = "";
      $this->duration       = 0;
      $this->tags           = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdUserCoatch():int { return $this->idUserCoatch; }
    public function getNameUserCoatch():string { return $this->nameUserCoatch; }
    public function getFirstNameUserCoatch():string { return $this->firstNameUserCoatch; }
    public function getName():string { return $this->name; }
    public function getDuration():int { return $this->duration; }
    public function getTags():string { return $this->tags; }
    public function getNbStudentAssigned():int { return $this->nbStudentAssigned; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCoatch(int $idUserCoatch) { $this->idUserCoatch = $idUserCoatch; }
    public function setNameUserCoatch(string $nameUserCoatch) { $this->nameUserCoatch = $nameUserCoatch; }
    public function setFirstNameUserCoatch(string $firstNameUserCoatch) { $this->firstNameUserCoatch = $firstNameUserCoatch; }
    public function setName(string $name) { $this->name = $name; }
    public function setDuration(int $duration) { $this->duration = $duration; }
    public function setTags(string $tags) { $this->tags = $tags; }
    public function setNbStudentAssigned(array $nbStudentAssigned) { $this->nbStudentAssigned = $nbStudentAssigned; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
