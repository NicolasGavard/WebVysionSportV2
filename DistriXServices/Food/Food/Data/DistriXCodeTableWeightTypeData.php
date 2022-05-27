<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableWeightTypeData", false)) {
  class DistriXCodeTableWeightTypeData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $isLiquid;
    protected $isSolid;
    protected $isOther;
    protected $elemstate;
    protected $timestamp;

    public function __construct()
    {
      $this->id         = 0;
      $this->code       = "";
      $this->isLiquid   = 0;
      $this->isSolid    = 0;
      $this->isOther    = 0;
      $this->elemstate     = 0;
      $this->timestamp  = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getCode() { return $this->code; }
    public function getIsLiquid() { return $this->isLiquid; }
    public function getIsSolid() { return $this->isSolid; }
    public function getIsOther() { return $this->isOther; }
    public function getElemState() { return $this->elemstate; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setCode($code) { $this->code = $code; }
    public function setIsLiquid($isLiquid) { $this->isLiquid = $isLiquid; }
    public function setIsSolid($isSolid) { $this->isSolid = $isSolid; }
    public function setIsOther($isOther) { $this->isOther = $isOther; }
    public function setElemState($elemstate) { $this->elemstate = $elemstate; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
