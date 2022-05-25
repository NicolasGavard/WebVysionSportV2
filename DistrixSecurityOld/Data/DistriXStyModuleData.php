<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyModuleData", false)) {
  class DistriXStyModuleData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyApplication;
    protected $codeStyApplication;
    protected $code;
    protected $description;
    protected $styFunctionalities;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id                 = 0;
      $this->idStyApplication   = 0;
      $this->codeStyApplication = "";
      $this->code               = "";
      $this->description        = "";
      $this->styFunctionalities = array();
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
    public function getCode()
    {
      return $this->code;
    }
    public function getDescription()
    {
      return $this->description;
    }
    public function getStyFunctionalities()
    {
      return $this->styFunctionalities;
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
    public function setCode($code)
    {
      $this->code = $code;
    }
    public function setDescription($description)
    {
      $this->description = $description;
    }
    public function setStyFunctionalities($styFunctionalities)
    {
      $this->styFunctionalities = $styFunctionalities;
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
