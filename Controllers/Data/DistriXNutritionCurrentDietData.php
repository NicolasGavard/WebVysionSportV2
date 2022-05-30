<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionCurrentDietData", false)) {
  class DistriXNutritionCurrentDietData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUser;
    protected $nameUser;
    protected $firstNameUser;
    protected $idDietTemplate;
    protected $name;
    protected $duration;
    protected $tags;
    protected $dateStart;
    protected $assignedUsers;
    protected $advancement;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idUser         = 0;
      $this->nameUser       = "";
      $this->firstNameUser  = "";
      $this->idDietTemplate = 0;
      $this->name           = "";
      $this->duration       = 0;
      $this->tags           = "";
      $this->dateStart      = "";
      $this->assignedUsers  = [];
      $this->advancement    = 0;
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdUser():int { return $this->idUser; }
    public function getNameUser():string { return $this->nameUser; }
    public function getFirstNameUser():string { return $this->firstNameUser; }
    public function getIdDietTemplate():int { return $this->idDietTemplate; }
    public function getName():string { return $this->name; }
    public function getDuration():int { return $this->duration; }
    public function getTags():string { return $this->tags; }
    public function getDateStart():int { return $this->dateStart; }
    public function getAssignedUsers():array { return $this->assignedUsers; }
    public function getAdvancement():int { return $this->advancement; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUser(int $idUser) { $this->idUser = $idUser; }
    public function setNameUser(string $nameUser) { $this->nameUser = $nameUser; }
    public function setFirstNameUser(string $firstNameUser) { $this->firstNameUser = $firstNameUser; }
    public function setIdDietTemplate(int $idDietTemplate) { $this->idDietTemplate = $idDietTemplate; }
    public function setName(string $name) { $this->name = $name; }
    public function setDuration(int $duration) { $this->duration = $duration; }
    public function setTags(string $tags) { $this->tags = $tags; }
    public function setDateStart(int $dateStart) { $this->dateStart = $dateStart; }
    public function setAssignedUsers(array $assignedUsers) { $this->assignedUsers = $assignedUsers; }
    public function setAdvancement(int $advancement) { $this->advancement = $advancement; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
