<?php // Needed to encode in UTF8 ààéàé //
class DietStudentStorData {
  const DIETSTUDENT_STATUS_AVAILABLE     = 0;
  const DIETSTUDENT_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $iddiet;
  private $iduser;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->iddiet = 0;
      $this->iduser = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdDiet() { return $this->iddiet; }
  public function getIdUser() { return $this->iduser; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::DIETSTUDENT_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::DIETSTUDENT_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::DIETSTUDENT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdDiet($idDiet) { $this->iddiet = $idDiet; }
  public function setIdUser($idUser) { $this->iduser = $idUser; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIETSTUDENT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIETSTUDENT_STATUS_NOT_AVAILABLE; }
}
