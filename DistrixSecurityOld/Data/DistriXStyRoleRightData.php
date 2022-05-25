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
    public function getId()
    {
      return $this->id;
    }
    public function getIdStyRole()
    {
      return $this->idStyRole;
    }
    public function getCodeStyRole()
    {
      return $this->codeRole;
    }
    public function getNameRole()
    {
      return $this->nameRole;
    }
    public function getIdStyApplication()
    {
      return $this->idStyApplication;
    }
    public function getCodeApplication()
    {
      return $this->codeApplication;
    }
    public function getDescriptionApplication()
    {
      return $this->descriptionApplication;
    }
    public function getIdStyModule()
    {
      return $this->idStyModule;
    }
    public function getCodeModule()
    {
      return $this->codeModule;
    }
    public function getDescriptionModule()
    {
      return $this->descriptionModule;
    }
    public function getIdStyFunctionality()
    {
      return $this->idStyFunctionality;
    }
    public function getCodeFunctionality()
    {
      return $this->codeFunctionality;
    }
    public function getDescriptionFunctionality()
    {
      return $this->descriptionFunctionality;
    }
    public function getSumOfRights()
    {
      return $this->sumOfRights;
    }
    public function getTimestamp()
    {
      return $this->timestamp;
    }

    // Sets
    public function setId($id)
    {
      $this->id = $id;
    }
    public function setIdStyRole($idStyRole)
    {
      $this->idStyRole = $idStyRole;
    }
    public function setCodeRole($codeRole)
    {
      $this->codeRole = $codeRole;
    }
    public function setNameRole($nameRole)
    {
      $this->nameRole = $nameRole;
    }
    public function setIdStyApplication($idStyApplication)
    {
      $this->idStyApplication = $idStyApplication;
    }
    public function setCodeApplication($codeApplication)
    {
      $this->codeApplication = $codeApplication;
    }
    public function setDescriptionApplication($descriptionApplication)
    {
      $this->descriptionApplication = $descriptionApplication;
    }
    public function setIdStyModule($idStyModule)
    {
      $this->idStyModule = $idStyModule;
    }
    public function setCodeModule($codeModule)
    {
      $this->codeModule = $codeModule;
    }
    public function setDescriptionModule($descriptionModule)
    {
      $this->descriptionModule = $descriptionModule;
    }
    public function setIdStyFunctionality($idStyFunctionality)
    {
      $this->idStyFunctionality = $idStyFunctionality;
    }
    public function setCodeFunctionality($codeFunctionality)
    {
      $this->codeFunctionality = $codeFunctionality;
    }
    public function setDescriptionFunctionality($descriptionFunctionality)
    {
      $this->descriptionFunctionality = $descriptionFunctionality;
    }
    public function setSumOfRights($sumOfRights)
    {
      $this->sumOfRights = $sumOfRights;
    }
    public function setTimestamp($timestamp)
    {
      $this->timestamp = $timestamp;
    }
  }
  // End of class
}
// class_exists
