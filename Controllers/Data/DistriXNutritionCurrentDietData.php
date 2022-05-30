<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionCurrentDietData", false)) {
  class DistriXNutritionCurrentDietData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCoatch;
    protected $nameUserCoatch;
    protected $firstNameUserCoatch;
    protected $idUserStudent;
    protected $nameUserStudent;
    protected $firstNameUserStudent;
    protected $idDietTemplate;
    protected $name;
    protected $duration;
    protected $tags;
    protected $dateStart;
    protected $advancement;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id                   = 0;
      $this->idUserCoatch         = 0;
      $this->nameUserCoatch       = "";
      $this->firstNameUserCoatch  = "";
      $this->idUserStudent        = 0;
      $this->nameUserStudent      = "";
      $this->firstNameUserStudent = "";
      $this->idDietTemplate       = 0;
      $this->name                 = "";
      $this->duration             = 0;
      $this->tags                 = "";
      $this->dateStart            = "";
      $this->advancement          = 0;
      $this->elemState            = 0;
      $this->timestamp            = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdUserCoatch():int { return $this->idUserCoatch; }
    public function getNameUserCoatch():string { return $this->nameUserCoatch; }
    public function getFirstNameUserCoatch():string { return $this->firstNameUserCoatch; }
    public function getIdUserStudent():int { return $this->idUserStudent; }
    public function getNameUserStudent():string { return $this->nameUserStudent; }
    public function getFirstNameUserStudent():string { return $this->firstNameUserStudent; }
    public function getIdDietTemplate():int { return $this->idDietTemplate; }
    public function getName():string { return $this->name; }
    public function getDuration():int { return $this->duration; }
    public function getTags():string { return $this->tags; }
    public function getDateStart():int { return $this->dateStart; }
    public function getAdvancement():int { return $this->advancement; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCoatch(int $idUserCoatch) { $this->idUserCoatch = $idUserCoatch; }
    public function setNameUserCoatch(string $nameUserCoatch) { $this->nameUserCoatch = $nameUserCoatch; }
    public function setFirstNameUserCoatch(string $firstNameUserCoatch) { $this->firstNameUserCoatch = $firstNameUserCoatch; }
    public function setIdUserStudent(int $idUserStudent) { $this->idUserStudent = $idUserStudent; }
    public function setNameUserStudent(string $nameUserStudent) { $this->nameUserStudent = $nameUserStudent; }
    public function setFirstNameUserStudent(string $firstNameUserStudent) { $this->firstNameUserStudent = $firstNameUserStudent; }
    public function setIdDietTemplate(int $idDietTemplate) { $this->idDietTemplate = $idDietTemplate; }
    public function setName(string $name) { $this->name = $name; }
    public function setDuration(int $duration) { $this->duration = $duration; }
    public function setTags(string $tags) { $this->tags = $tags; }
    public function setDateStart(int $dateStart) { $this->dateStart = $dateStart; }
    public function setAdvancement(int $advancement) { $this->advancement = $advancement; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
