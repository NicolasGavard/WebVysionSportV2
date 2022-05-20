<?php // Needed to encode in UTF8 ààéàé //
class StyUserAllRightStorData
{
  private $id;
  private $idstyuser;
  private $idstyapplication;
  private $styapplicationcode;
  private $stymodulecode;
  private $styfunctionalitycode;
  private $sumofrights;

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
  public function getId()
  {
    return $this->id;
  }
  public function getIdStyUser()
  {
    return $this->idstyuser;
  }
  public function getIdStyApplication()
  {
    return $this->idstyapplication;
  }
  public function getStyApplicationCode()
  {
    return $this->styapplicationcode;
  }
  public function getStyModuleCode()
  {
    return $this->stymodulecode;
  }
  public function getStyFunctionalityCode()
  {
    return $this->styfunctionalitycode;
  }
  public function getSumOfRights()
  {
    return $this->sumofrights;
  }
  // Sets
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setIdStyUser($idStyUser)
  {
    $this->idstyuser = $idStyUser;
  }
  public function setIdStyApplication($idStyApplication)
  {
    $this->idstyapplication = $idStyApplication;
  }
  public function setStyApplicationCode($styApplicationCode)
  {
    $this->styapplicationcode = $styApplicationCode;
  }
  public function setStyModuleCode($styModuleCode)
  {
    $this->stymodulecode = $styModuleCode;
  }
  public function setStyFunctionalityCode($styFunctionalityCode)
  {
    $this->styfunctionalitycode = $styFunctionalityCode;
  }
  public function setSumOfRights($sumOfRights)
  {
    $this->sumofrights = $sumOfRights;
  }
}
