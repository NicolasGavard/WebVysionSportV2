<?php // Needed to encode in UTF8 ààéàé //
class DietStudentStorData {
  const DIETSTUDENT_STATUS_AVAILABLE     = 0;
  const DIETSTUDENT_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $iddiet;
  private $iduser;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->iddiet = 0;
      $this->iduser = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdDiet() { return $this->iddiet; }
  public function getIdUser() { return $this->iduser; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::DIETSTUDENT_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::DIETSTUDENT_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::DIETSTUDENT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdDiet($idDiet) { $this->iddiet = $idDiet; }
  public function setIdUser($idUser) { $this->iduser = $idUser; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::DIETSTUDENT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::DIETSTUDENT_STATUS_NOT_AVAILABLE; }
}