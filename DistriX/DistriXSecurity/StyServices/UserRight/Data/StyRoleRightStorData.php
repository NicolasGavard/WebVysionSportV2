<?php // Needed to encode in UTF8 ààéàé //
class StyRoleRightStorData extends DistriXSvcAppData {
  protected $id;
  protected $idstyrole;
  protected $idstyapplication;
  protected $idstymodule;
  protected $idstyfunctionality;
  protected $sumofrights;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idstyrole = 0;
      $this->idstyapplication = 0;
      $this->idstymodule = 0;
      $this->idstyfunctionality = 0;
      $this->sumofrights = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdStyRole():int { return $this->idstyrole; }
  public function getIdStyApplication():int { return $this->idstyapplication; }
  public function getIdStyModule():int { return $this->idstymodule; }
  public function getIdStyFunctionality():int { return $this->idstyfunctionality; }
  public function getSumOfRights():int { return $this->sumofrights; }
  public function getTimestamp():int { return $this->timestamp; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdStyRole(int $idStyRole) { $this->idstyrole = $idStyRole; }
  public function setIdStyApplication(int $idStyApplication) { $this->idstyapplication = $idStyApplication; }
  public function setIdStyModule(int $idStyModule) { $this->idstymodule = $idStyModule; }
  public function setIdStyFunctionality(int $idStyFunctionality) { $this->idstyfunctionality = $idStyFunctionality; }
  public function setSumOfRights(int $sumOfRights) { $this->sumofrights = $sumOfRights; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
}
