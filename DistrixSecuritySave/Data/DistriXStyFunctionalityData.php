<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyFunctionalityData", false)) {
  class DistriXStyFunctionalityData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyApplication;
    protected $codeStyApplication;
    protected $idStyModule;
    protected $codeStyModule;
    protected $code;
    protected $description;
    protected $styRights;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id                 = 0;
      $this->idStyApplication   = 0;
      $this->codeStyApplication = "";
      $this->idStyModule        = 0;
      $this->codeStyModule      = "";
      $this->code               = "";
      $this->description        = "";
      $this->styRights          = array();
      $this->status             = 0;
      $this->timestamp          = 0;
    }

    // Gets
    public function getId()
    {
      return $this->id;
    }
    public function getIdStyApplication()
    {
      return $this->idStyApplication;
    }
    public function getCodeStyApplication()
    {
      return $this->codeStyApplication;
    }
    public function getIdStyModule()
    {
      return $this->idStyModule;
    }
    public function getCodeStyModule()
    {
      return $this->codeStyModule;
    }
    public function getCode()
    {
      return $this->code;
    }
    public function getDescription()
    {
      return $this->description;
    }
    public function getStyRights()
    {
      return $this->styRights;
    }
    public function getStatus()
    {
      return $this->status;
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
    public function setIdStyApplication($idStyApplication)
    {
      $this->idStyApplication = $idStyApplication;
    }
    public function setCodeStyApplication($codeStyApplication)
    {
      $this->codeStyApplication = $codeStyApplication;
    }
    public function setIdStyModule($idStyModule)
    {
      $this->idStyModule = $idStyModule;
    }
    public function setCodeStyModule($codeStyModule)
    {
      $this->codeStyModule = $codeStyModule;
    }
    public function setCode($code)
    {
      $this->code = $code;
    }
    public function setDescription($description)
    {
      $this->description = $description;
    }
    public function setStyRights($styRights)
    {
      $this->styRights = $styRights;
    }
    public function setStatus($status)
    {
      $this->status = $status;
    }
    public function setTimestamp($timestamp)
    {
      $this->timestamp = $timestamp;
    }
  }
  // End of class
}
// class_exists
