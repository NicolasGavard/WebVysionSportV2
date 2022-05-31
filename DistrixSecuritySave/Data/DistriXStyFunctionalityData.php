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
    public function getId():int  { return $this->id; }
    public function getIdStyApplication():int  { return $this->idStyApplication; }
    public function getCodeStyApplication():string  { return $this->codeStyApplication; }
    public function getIdStyModule():int  { return $this->idStyModule; }
    public function getCodeStyModule():string  { return $this->codeStyModule; }
    public function getCode():string  { return $this->code; }
    public function getDescription():string  { return $this->description; }
    public function getStyRights():int  { return $this->styRights; }
    public function getStatus():int  { return $this->status; }
    public function getTimestamp():int  { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdStyApplication(int $idStyApplication) { $this->idStyApplication = $idStyApplication; }
    public function setCodeStyApplication(string $codeStyApplication) { $this->codeStyApplication = $codeStyApplication; }
    public function setIdStyModule(int $idStyModule) { $this->idStyModule = $idStyModule; }
    public function setCodeStyModule(string $codeStyModule) { $this->codeStyModule = $codeStyModule; }
    public function setCode(string $code) { $this->code = $code; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setStyRights(int $styRights) { $this->styRights = $styRights; }
    public function setStatus(int $status) { $this->status = $status; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
