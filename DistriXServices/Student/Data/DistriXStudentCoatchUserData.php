<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStudentCoatchUserData", false)) {
  class DistriXStudentCoatchUserData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUserCoach;
    protected $nameUserCoach;
    protected $firstNameUserCoach;
    protected $idUser;
    protected $nameUser;
    protected $firstNameUser;
    protected $dateStart;
    protected $dateEnd;
    protected $elemstate;
    protected $timestamp;

    public function __construct()
    {
      $this->id                 = 0;
      $this->idUserCoach        = 0;
      $this->nameUserCoach      = "";
      $this->firstNameUserCoach = "";
      $this->idUser             = 0;
      $this->nameUser           = "";
      $this->firstNameUser      = "";
      $this->dateStart          = 0;
      $this->dateEnd            = 0;
      $this->elemstate             = 0;
      $this->timestamp          = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdUserCoach() { return $this->idUserCoach; }
    public function getNameUserCoach() { return $this->nameUserCoach; }
    public function getFirstNameUserCoach() { return $this->firstNameUserCoach; }
    public function getIdUser() { return $this->idUser; }
    public function getNameUser() { return $this->nameUser; }
    public function getFirstNameUser() { return $this->firstNameUser; }
    public function getDateStart() { return $this->dateStart; }
    public function getDateEnd() { return $this->dateEnd; }
    public function getElemState() { return $this->elemstate; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdUserCoach($idUserCoach) { $this->idUserCoach = $idUserCoach; }
    public function setNameUserCoach($nameUserCoach) { $this->nameUserCoach = $nameUserCoach; }
    public function setFirstNameUserCoach($firstNameUserCoach) { $this->firstNameUserCoach = $firstNameUserCoach; }
    public function setIdUser($idUser) { $this->idUser = $idUser; }
    public function setNameUser($nameUser) { $this->nameUser = $nameUser; }
    public function setFirstNameUser($firstNameUser) { $this->firstNameUser = $firstNameUser; }
    public function setDateStart($dateStart) { $this->dateStart = $dateStart; }
    public function setDateEnd($dateEnd) { $this->dateEnd = $dateEnd; }
    public function setElemState($elemstate) { $this->elemstate = $elemstate; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
