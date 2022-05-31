<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyUserRightData", false)) {
  class DistriXStyUserRightData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyUser;
    protected $idStyApplication;
    protected $codeApplication;
    protected $nameApplication;
    protected $idStyModule;
    protected $codeModule;
    protected $nameModule;
    protected $idStyFunctionality;
    protected $codeFunctionality;
    protected $nameFunctionality;
    protected $sumOfRights;
    protected $timestamp;

    public function __construct()
    {
      $this->id                 = 0;
      $this->idStyUser          = 0;
      $this->idStyApplication   = 0;
      $this->codeApplication    = "";
      $this->nameApplication    = "";
      $this->idStyModule        = 0;
      $this->codeModule         = "";
      $this->nameModule         = "";
      $this->idStyFunctionality = 0;
      $this->codeFunctionality  = "";
      $this->nameFunctionality  = "";
      $this->sumOfRights        = 0;
      $this->timestamp          = 0;
    }
    // Gets
    public function getId():int  { return $this->id; }
    public function getIdStyUser():int  { return $this->idStyUser; }
    public function getIdStyApplication():int  { return $this->idStyApplication; }
    public function getCodeApplication():string  { return $this->codeApplication; }
    public function getNameApplication():string  { return $this->nameApplication; }
    public function getIdStyModule():int  { return $this->idStyModule; }
    public function getCodeModule():string  { return $this->codeModule; }
    public function getNameModule():string  { return $this->nameModule; }
    public function getIdStyFunctionality():int  { return $this->idStyFunctionality; }
    public function getCodeFunctionality():string  { return $this->codeFunctionality; }
    public function getNameFunctionality():string  { return $this->nameFunctionality; }
    public function getSumOfRights():int  { return $this->sumOfRights; }
    public function getTimestamp():int  { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdStyUser(int $idStyUser) { $this->idStyUser = $idStyUser; }
    public function setIdStyApplication(int $idStyApplication) { $this->idStyApplication = $idStyApplication; }
    public function setCodeApplication(string $codeApplication) { $this->codeApplication = $codeApplication; }
    public function setNameApplication(string $nameApplication) { $this->nameApplication = $nameApplication; }
    public function setIdStyModule(int $idStyModule) { $this->idStyModule = $idStyModule; }
    public function setCodeModule(string $codeModule) { $this->codeModule = $codeModule; }
    public function setNameModule(string $nameModule) { $this->nameModule = $nameModule; }
    public function setIdStyFunctionality(int $idStyFunctionality) { $this->idStyFunctionality = $idStyFunctionality; }
    public function setCodeFunctionality(string $codeFunctionality) { $this->codeFunctionality = $codeFunctionality; }
    public function setNameFunctionality(string $nameFunctionality) { $this->nameFunctionality = $nameFunctionality; }
    public function setSumOfRights(int $sumOfRights) { $this->SsmOfRights = $sumOfRights; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
