<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyUserAllRightData", false)) {
  class DistriXStyUserAllRightData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyUser;
    protected $idStyApplication;
    protected $styApplicationCode;
    protected $styModuleCode;
    protected $styFunctionalityCode;
    protected $sumOfRights;

    public function __construct()
    {
      $this->id                   = 0;
      $this->idStyUser            = 0;
      $this->idStyApplication     = 0;
      $this->styApplicationCode   = "";
      $this->styModuleCode        = 0;
      $this->styFunctionalityCode = 0;
      $this->sumOfRights          = 0;
    }
    // Gets
    public function getId():int { return $this->id;}
    public function getIdStyUser():int { return $this->idStyUser;}
    public function getIdStyApplication():int { return $this->idStyApplication;}
    public function getStyApplicationCode():string { return $this->styApplicationCode;}
    public function getStyModuleCode():string { return $this->styModuleCode;}
    public function getStyFunctionalityCode():string { return $this->styFunctionalityCode;}
    public function getSumOfRights():int { return $this->sumOfRights;}
    // Sets
    public function setId(int $id) { $this->id = $id;}
    public function setIdStyUser(int $idStyUser) { $this->idStyUser = $idStyUser;}
    public function setIdStyApplication(int $idStyApplication) { $this->idStyApplication = $idStyApplication;}
    public function setStyApplicationCode(string $styApplicationCode) { $this->styApplicationCode = $styApplicationCode;}
    public function setStyModuleCode(string $styModuleCode) { $this->styModuleCode = $styModuleCode;}
    public function setStyFunctionalityCode(string $styFunctionalityCode) { $this->styFunctionalityCode = $styFunctionalityCode;}
    public function setSumOfRights(int $sumOfRights) { $this->sumOfRights = $sumOfRights;}
  }
  // End of class
}
// class_exists
