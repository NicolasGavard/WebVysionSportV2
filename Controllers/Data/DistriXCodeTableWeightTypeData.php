<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableWeightTypeData", false)) {
  class DistriXCodeTableWeightTypeData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $name;
    protected $abbreviation;
    protected $isLiquid;
    protected $isSolid;
    protected $isOther;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->code         = "";
      $this->name         = "";
      $this->abbreviation = "";
      $this->isLiquid     = 0;
      $this->isSolid      = 0;
      $this->isOther      = 0;
      $this->elemState    = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getAbbreviation():string { return $this->abbreviation; }
    public function getIsLiquid():int { return $this->isLiquid; }
    public function getIsSolid():int { return $this->isSolid; }
    public function getIsOther():int { return $this->isOther; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setAbbreviation(string $abbreviation) { $this->abbreviation = $abbreviation; }
    public function setIsLiquid(int $isLiquid) { $this->isLiquid = $isLiquid; }
    public function setIsSolid(int $isSolid) { $this->isSolid = $isSolid; }
    public function setIsOther(int $isOther) { $this->isOther = $isOther; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
