<?php // Needed to encode in UTF8 ààéàé //
class DietStorData extends DistriXSvcAppData {
  const DIET_STATUS_AVAILABLE     = 0;
  const DIET_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idusercoatch;
  protected $iduserstudent;
  protected $iddiettemplate;
  protected $datestart;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idusercoatch = 0;
      $this->iduserstudent = 0;
      $this->iddiettemplate = 0;
      $this->datestart = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdUserCoatch():int { return $this->idusercoatch; }
  public function getIdUserStudent():int { return $this->iduserstudent; }
  public function getIdDietTemplate():int { return $this->iddiettemplate; }
  public function getDateStart():int { return $this->datestart; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::DIET_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::DIET_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::DIET_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUserCoatch(int $idUserCoatch) { $this->idusercoatch = $idUserCoatch; }
  public function setIdUserStudent(int $idUserStudent) { $this->iduserstudent = $idUserStudent; }
  public function setIdDietTemplate(int $idDietTemplate) { $this->iddiettemplate = $idDietTemplate; }
  public function setDateStart(int $dateStart) { $this->datestart = $dateStart; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::DIET_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::DIET_STATUS_NOT_AVAILABLE; }
}
