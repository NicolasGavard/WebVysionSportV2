<?php // Needed to encode in UTF8 ààéàé //
class DietStorData {
  const DIET_STATUS_AVAILABLE     = 0;
  const DIET_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $iduser;
  private $iddiettemplate;
  private $datestart;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->iduser = 0;
      $this->iddiettemplate = 0;
      $this->datestart = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdUser() { return $this->iduser; }
  public function getIdDietTemplate() { return $this->iddiettemplate; }
  public function getDateStart() { return $this->datestart; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::DIET_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::DIET_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::DIET_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdUser($idUser) { $this->iduser = $idUser; }
  public function setIdDietTemplate($idDietTemplate) { $this->iddiettemplate = $idDietTemplate; }
  public function setDateStart($dateStart) { $this->datestart = $dateStart; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIET_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIET_STATUS_NOT_AVAILABLE; }
}
