<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionTemplateDietData", false)) {
  class DistriXNutritionTemplateDietData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUser;
    protected $nameUser;
    protected $firstNameUser;
    protected $name;
    protected $duration;
    protected $tags;
    protected $nbStudentAssigned;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idUser         = 0;
      $this->nameUser       = "";
      $this->firstNameUser  = "";
      $this->name           = "";
      $this->duration       = 0;
      $this->tags           = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdUser():int { return $this->idUser; }
    public function getNameUser():string { return $this->nameUser; }
    public function getFirstNameUser():string { return $this->firstNameUser; }
    public function getName():string { return $this->name; }
    public function getDuration():int { return $this->duration; }
    public function getTags():string { return $this->tags; }
    public function getNbStudentAssigned():int { return $this->nbStudentAssigned; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUser(int $idUser) { $this->idUser = $idUser; }
    public function setNameUser(string $nameUser) { $this->nameUser = $nameUser; }
    public function setFirstNameUser(string $firstNameUser) { $this->firstNameUser = $firstNameUser; }
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
