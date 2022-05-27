<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableWeightTypeData", false)) {
  class DistriXCodeTableWeightTypeData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $isLiquid;
    protected $isSolid;
    protected $isOther;
    protected $statut;
    protected $timestamp;

    public function __construct()
    {
      $this->id         = 0;
      $this->code       = "";
      $this->isLiquid   = 0;
      $this->isSolid    = 0;
      $this->isOther    = 0;
      $this->statut     = 0;
      $this->timestamp  = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getIsLiquid():int { return $this->isLiquid; }
    public function getIsSolid():int { return $this->isSolid; }
    public function getIsOther():int { return $this->isOther; }
    public function getStatut():int { return $this->statut; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setIsLiquid(int $isLiquid) { $this->isLiquid = $isLiquid; }
    public function setIsSolid(int $isSolid) { $this->isSolid = $isSolid; }
    public function setIsOther(int $isOther) { $this->isOther = $isOther; }
    public function setStatut(int $statut) { $this->statut = $statut; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
