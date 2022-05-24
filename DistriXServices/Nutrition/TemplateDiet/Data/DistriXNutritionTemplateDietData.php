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
    protected $status;
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
      $this->status         = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdUser() { return $this->idUser; }
    public function getNameUser() { return $this->nameUser; }
    public function getFirstNameUser() { return $this->firstNameUser; }
    public function getName() { return $this->name; }
    public function getDuration() { return $this->duration; }
    public function getTags() { return $this->tags; }
    public function getStatus() { return $this->status; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdUser($idUser) { $this->idUser = $idUser; }
    public function setNameUser($nameUser) { $this->nameUser = $nameUser; }
    public function setFirstNameUser($firstNameUser) { $this->firstNameUser = $firstNameUser; }
    public function setName($name) { $this->name = $name; }
    public function setDuration($duration) { $this->duration = $duration; }
    public function setTags($tags) { $this->tags = $tags; }
    public function setStatus($status) { $this->status = $status; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
