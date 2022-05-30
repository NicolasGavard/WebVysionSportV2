<?php // Needed to encode in UTF8 ààéàé //
class DietStorData extends DistriXSvcAppData {
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
  public function getId():int { return $this->id; }
  public function getIdUser():int { return $this->iduser; }
  public function getIdDietTemplate():int { return $this->iddiettemplate; }
  public function getDateStart():int { return $this->datestart; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::DIET_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::DIET_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::DIET_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUser(int $idUser) { $this->iduser = $idUser; }
  public function setIdDietTemplate(int $idDietTemplate) { $this->iddiettemplate = $idDietTemplate; }
  public function setDateStart(int $dateStart) { $this->datestart = $dateStart; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIET_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIET_STATUS_NOT_AVAILABLE; }
}
