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
    public function getId()
    {
      return $this->id;
    }
    public function getIdStyUser()
    {
      return $this->idStyUser;
    }
    public function getIdStyApplication()
    {
      return $this->idStyApplication;
    }
    public function getCodeApplication()
    {
      return $this->codeApplication;
    }
    public function getNameApplication()
    {
      return $this->nameApplication;
    }
    public function getIdStyModule()
    {
      return $this->idStyModule;
    }
    public function getCodeModule()
    {
      return $this->codeModule;
    }
    public function getNameModule()
    {
      return $this->nameModule;
    }
    public function getIdStyFunctionality()
    {
      return $this->idStyFunctionality;
    }
    public function getCodeFunctionality()
    {
      return $this->codeFunctionality;
    }
    public function getNameFunctionality()
    {
      return $this->nameFunctionality;
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
    public function setIdStyUser($idStyUser)
    {
      $this->idStyUser = $idStyUser;
    }
    public function setIdStyApplication($idStyApplication)
    {
      $this->idStyApplication = $idStyApplication;
    }
    public function setCodeApplication($codeApplication)
    {
      $this->codeApplication = $codeApplication;
    }
    public function setNameApplication($nameApplication)
    {
      $this->nameApplication = $nameApplication;
    }
    public function setIdStyModule($idStyModule)
    {
      $this->idStyModule = $idStyModule;
    }
    public function setCodeModule($codeModule)
    {
      $this->codeModule = $codeModule;
    }
    public function setNameModule($nameModule)
    {
      $this->nameModule = $nameModule;
    }
    public function setIdStyFunctionality($idStyFunctionality)
    {
      $this->idStyFunctionality = $idStyFunctionality;
    }
    public function setCodeFunctionality($codeFunctionality)
    {
      $this->codeFunctionality = $codeFunctionality;
    }
    public function setNameFunctionality($nameFunctionality)
    {
      $this->nameFunctionality = $nameFunctionality;
    }
    public function setSumOfRights($sumOfRights)
    {
      $this->SsmOfRights = $sumOfRights;
    }
    public function setTimestamp($timestamp)
    {
      $this->timestamp = $timestamp;
    }
  }
  // End of class
}
// class_exists
