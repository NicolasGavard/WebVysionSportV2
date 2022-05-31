<?php // Needed to encode in UTF8 ààéàé //
class StyUserRightStorData extends DistriXSvcAppData {
  
  protected $id;
  protected $idstyuser;
  protected $idstyapplication;
  protected $idstymodule;
  protected $idstyfunctionality;
  protected $sumofrights;

  public function __construct() {
      $this->id = 0;
      $this->idstyuser = 0;
      $this->idstyapplication = 0;
      $this->idstymodule = 0;
      $this->idstyfunctionality = 0;
      $this->sumofrights = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdStyUser():int { return $this->idstyuser; }
  public function getIdStyApplication():int { return $this->idstyapplication; }
  public function getIdStyModule():int { return $this->idstymodule; }
  public function getIdStyFunctionality():int { return $this->idstyfunctionality; }
  public function getSumOfRights():int { return $this->sumofrights; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdStyUser(int $idStyUser) { $this->idstyuser = $idStyUser; }
  public function setIdStyApplication(int $idStyApplication) { $this->idstyapplication = $idStyApplication; }
  public function setIdStyModule(int $idStyModule) { $this->idstymodule = $idStyModule; }
  public function setIdStyFunctionality(int $idStyFunctionality) { $this->idstyfunctionality = $idStyFunctionality; }
  public function setSumOfRights(int $sumOfRights) { $this->sumofrights = $sumOfRights; }
}
