<?php // Needed to encode in UTF8 ààéàé //
class StyUserAllRightStorData extends DistriXSvcAppData {
  
  protected $id;
  protected $idstyuser;
  protected $idstyapplication;
  protected $styapplicationcode;
  protected $stymodulecode;
  protected $styfunctionalitycode;
  protected $sumofrights;

  public function __construct()
  {
    $this->id = 0;
    $this->idstyuser = 0;
    $this->idstyapplication = 0;
    $this->styapplicationcode = "";
    $this->stymodulecode = 0;
    $this->styfunctionalitycode = 0;
    $this->sumofrights = 0;
  }
  // Gets
  public function getId():int { return $this->id;}
  public function getIdStyUser():int { return $this->idstyuser;}
  public function getIdStyApplication():int { return $this->idstyapplication;}
  public function getStyApplicationCode():string { return $this->styapplicationcode;}
  public function getStyModuleCode():string { return $this->stymodulecode;}
  public function getStyFunctionalityCode():string { return $this->styfunctionalitycode;}
  public function getSumOfRights():int { return $this->sumofrights;}
  // Sets
  public function setId(int $id) { $this->id = $id;}
  public function setIdStyUser(int $idStyUser) { $this->idstyuser = $idStyUser;}
  public function setIdStyApplication(int $idStyApplication) { $this->idstyapplication = $idStyApplication;}
  public function setStyApplicationCode(string $styApplicationCode) { $this->styapplicationcode = $styApplicationCode;}
  public function setStyModuleCode(string $styModuleCode) { $this->stymodulecode = $styModuleCode;}
  public function setStyFunctionalityCode(string $styFunctionalityCode) { $this->styfunctionalitycode = $styFunctionalityCode;}
  public function setSumOfRights(int $sumOfRights) { $this->sumofrights = $sumOfRights;}
}
