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
    public function getId():int  { return $this->id; }
    public function getIdStyApplication():int  { return $this->idStyApplication; }
    public function getCodeStyApplication():string  { return $this->codeStyApplication; }
    public function getCode():string  { return $this->code; }
    public function getDescription():string  { return $this->description; }
    public function getStyFunctionalities():array  { return $this->styFunctionalities; }
    public function getStatus():int  { return $this->status; }
    public function getTimestamp():int  { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdStyApplication(int $idStyApplication) { $this->idStyApplication = $idStyApplication; }
    public function setCodeStyApplication(string $codeStyApplication) { $this->codeStyApplication = $codeStyApplication; }
    public function setCode(string $code) { $this->code = $code; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setStyFunctionalities(array $styFunctionalities) { $this->styFunctionalities = $styFunctionalities; }
    public function setStatus(int $status) { $this->status = $status; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
