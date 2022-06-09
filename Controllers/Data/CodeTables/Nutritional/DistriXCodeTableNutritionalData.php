<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableNutritionalData", false)) {
  class DistriXCodeTableNutritionalData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $name;
    protected $isCalorie;
    protected $isProetin;
    protected $isGlucide;
    protected $isLipid;
    protected $isVitamin;
    protected $isTraceElement;
    protected $isMineral;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->code           = "";
      $this->name           = "";
      $this->isCalorie      = 0;
      $this->isProetin      = 0;
      $this->isGlucide      = 0;
      $this->isLipid        = 0;
      $this->isVitamin      = 0;
      $this->isTraceElement = 0;
      $this->isMineral      = 0;
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getIsCalorie():int {return $this->isCalorie;}
    public function getIsProetin():int {return $this->isProetin;}
    public function getIsGlucide():int {return $this->isGlucide;}
    public function getIsLipid():int {return $this->isLipid;}
    public function getIsVitamin():int {return $this->isVitamin;}
    public function getIsTraceElement():int {return $this->isTraceElement;}
    public function getIsMineral():int {return $this->isMineral;}
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setIsCalorie(int $isCalorie) { $this->isCalorie = $isCalorie; }
    public function setIsProetin(int $isProetin) { $this->isProetin = $isProetin; }
    public function setIsGlucide(int $isGlucide) { $this->isGlucide = $isGlucide; }
    public function setIsLipid(int $isLipid) { $this->isLipid = $isLipid; }
    public function setIsVitamin(int $isVitamin) { $this->isVitamin = $isVitamin; }
    public function setIsTraceElement(int $isTraceElement) { $this->isTraceElement = $isTraceElement; }
    public function setIsMineral(int $isMineral) { $this->isMineral = $isMineral; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
