<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyApplicationData", false)) {
  class DistriXStyApplicationData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $description;
    protected $styModules;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->code         = "";
      $this->description  = "";
      $this->styModules   = array();
      $this->status       = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getDescription():string { return $this->description; }
    public function getStyModules():array { return $this->styModules; }
    public function getStatus():int { return $this->status; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setDescription(string $description) { $this->description = $description; }
    public function setStyModules(array $styModules) { $this->styModules = $styModules; }
    public function setStatus(int $status) { $this->status = $status; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
