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
    public function getId() { return $this->id; }
    public function getIdUser() { return $this->idUser; }
    public function getNameUser() { return $this->nameUser; }
    public function getFirstNameUser() { return $this->firstNameUser; }
    public function getIdDietTemplate() { return $this->idDietTemplate; }
    public function getName() { return $this->name; }
    public function getDuration() { return $this->duration; }
    public function getTags() { return $this->tags; }
    public function getDateStart() { return $this->dateStart; }
    public function getAssignedUsers() { return $this->assignedUsers; }
    public function getAdvancement() { return $this->advancement; }
    public function getElemState() { return $this->elemState; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdUser($idUser) { $this->idUser = $idUser; }
    public function setNameUser($nameUser) { $this->nameUser = $nameUser; }
    public function setFirstNameUser($firstNameUser) { $this->firstNameUser = $firstNameUser; }
    public function setIdDietTemplate($idDietTemplate) { $this->idDietTemplate = $idDietTemplate; }
    public function setName($name) { $this->name = $name; }
    public function setDuration($duration) { $this->duration = $duration; }
    public function setTags($tags) { $this->tags = $tags; }
    public function setDateStart($dateStart) { $this->dateStart = $dateStart; }
    public function setAssignedUsers($assignedUsers) { $this->assignedUsers = $assignedUsers; }
    public function setAdvancement($advancement) { $this->advancement = $advancement; }
    public function setElemState($elemState) { $this->elemState = $elemState; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
