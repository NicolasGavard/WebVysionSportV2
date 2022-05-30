<?php // Needed to encode in UTF8 ààéàé //
class DietStudentStorData extends DistriXSvcAppData {
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
  public function getId():int { return $this->id; }
  public function getIdDiet():int { return $this->iddiet; }
  public function getIdUser():int { return $this->iduser; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::DIETSTUDENT_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::DIETSTUDENT_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::DIETSTUDENT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdDiet(int $idDiet) { $this->iddiet = $idDiet; }
  public function setIdUser(int $idUser) { $this->iduser = $idUser; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIETSTUDENT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIETSTUDENT_STATUS_NOT_AVAILABLE; }
}
