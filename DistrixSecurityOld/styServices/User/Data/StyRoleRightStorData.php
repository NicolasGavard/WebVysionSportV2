<?php // Needed to encode in UTF8 ààéàé //
class StyRoleRightStorData {
  private $id;
  private $idstyrole;
  private $idstyapplication;
  private $idstymodule;
  private $idstyfunctionality;
  private $sumofrights;
  private $timestamp;

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
  public function getId() { return $this->id; }
  public function getIdStyRole() { return $this->idstyrole; }
  public function getIdStyApplication() { return $this->idstyapplication; }
  public function getIdStyModule() { return $this->idstymodule; }
  public function getIdStyFunctionality() { return $this->idstyfunctionality; }
  public function getSumOfRights() { return $this->sumofrights; }
  public function getTimestamp() { return $this->timestamp; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdStyRole($idStyRole) { $this->idstyrole = $idStyRole; }
  public function setIdStyApplication($idStyApplication) { $this->idstyapplication = $idStyApplication; }
  public function setIdStyModule($idStyModule) { $this->idstymodule = $idStyModule; }
  public function setIdStyFunctionality($idStyFunctionality) { $this->idstyfunctionality = $idStyFunctionality; }
  public function setSumOfRights($sumOfRights) { $this->sumofrights = $sumOfRights; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
}
