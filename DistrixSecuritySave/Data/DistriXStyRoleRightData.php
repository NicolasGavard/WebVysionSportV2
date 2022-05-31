<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyRoleRightData", false)) {
  class DistriXStyRoleRightData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyRole;
    protected $codeRole;
    protected $nameRole;
    protected $idStyApplication;
    protected $codeApplication;
    protected $descriptionApplication;
    protected $idStyModule;
    protected $codeModule;
    protected $descriptionModule;
    protected $idStyFunctionality;
    protected $codeFunctionality;
    protected $descriptionFunctionality;
    protected $sumOfRights;
    protected $timestamp;

    public function __construct()
    {
      $this->id                       = 0;
      $this->idStyRole                = 0;
      $this->codeRole                 = "";
      $this->nameRole                 = "";
      $this->idStyApplication         = 0;
      $this->codeApplication          = "";
      $this->descriptionApplication   = "";
      $this->idStyModule              = 0;
      $this->codeModule               = "";
      $this->descriptionModule        = "";
      $this->idStyFunctionality       = 0;
      $this->codeFunctionality        = "";
      $this->descriptionFunctionality = "";
      $this->sumOfRights              = 0;
      $this->timestamp                = 0;
    }
    // Gets
    public function getId():int  { return $this->id; }
    public function getIdStyRole():int  { return $this->idStyRole; }
    public function getCodeStyRole():string  { return $this->codeRole; }
    public function getNameRole():string  { return $this->nameRole; }
    public function getIdStyApplication():int  { return $this->idStyApplication; }
    public function getCodeApplication():string  { return $this->codeApplication; }
    public function getDescriptionApplication():string  { return $this->descriptionApplication; }
    public function getIdStyModule():int  { return $this->idStyModule; }
    public function getCodeModule():string  { return $this->codeModule; }
    public function getDescriptionModule():string  { return $this->descriptionModule; }
    public function getIdStyFunctionality():int  { return $this->idStyFunctionality; }
    public function getCodeFunctionality():string  { return $this->codeFunctionality; }
    public function getDescriptionFunctionality():string  { return $this->descriptionFunctionality; }
    public function getSumOfRights():int  { return $this->sumOfRights; }
    public function getTimestamp():int  { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdStyRole(int $idStyRole) { $this->idStyRole = $idStyRole; }
    public function setCodeRole(string $codeRole) { $this->codeRole = $codeRole; }
    public function setNameRole(string $nameRole) { $this->nameRole = $nameRole; }
    public function setIdStyApplication(int $idStyApplication) { $this->idStyApplication = $idStyApplication; }
    public function setCodeApplication(string $codeApplication) { $this->codeApplication = $codeApplication; }
    public function setDescriptionApplication(string $descriptionApplication) { $this->descriptionApplication = $descriptionApplication; }
    public function setIdStyModule(int $idStyModule) { $this->idStyModule = $idStyModule; }
    public function setCodeModule(string $codeModule) { $this->codeModule = $codeModule; }
    public function setDescriptionModule(string $descriptionModule) { $this->descriptionModule = $descriptionModule; }
    public function setIdStyFunctionality(int $idStyFunctionality) { $this->idStyFunctionality = $idStyFunctionality; }
    public function setCodeFunctionality(string $codeFunctionality) { $this->codeFunctionality = $codeFunctionality; }
    public function setDescriptionFunctionality(string $descriptionFunctionality) { $this->descriptionFunctionality = $descriptionFunctionality; }
    public function setSumOfRights(int $sumOfRights) { $this->sumOfRights = $sumOfRights; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
