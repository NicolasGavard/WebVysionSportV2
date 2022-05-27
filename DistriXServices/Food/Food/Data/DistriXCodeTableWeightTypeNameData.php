<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableWeightTypeNameData", false)) {
  class DistriXCodeTableWeightTypeNameData extends DistriXSvcAppData
  {
    protected $id;
    protected $idWeightType;
    protected $idLanguage;
    protected $code;
    protected $name;
    protected $description;
    protected $abbreviation;
    protected $isSolid;
    protected $isLiquid;
    protected $isOther;
    protected $elemstate;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->idWeightType = 0;
      $this->idLanguage   = 0;
      $this->code         = "";
      $this->name         = "";
      $this->description  = "";
      $this->abbreviation = "";
      $this->isSolid      = 0;
      $this->isLiquid     = 0;
      $this->isOther      = 0;
      $this->elemstate       = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdWeightType() { return $this->idWeightType; }
    public function getIdLanguage() { return $this->idLanguage; }
    public function getCode() { return $this->code; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getAbbreviation() { return $this->abbreviation; }
    public function getIsSolid() { return $this->isSolid; }
    public function getIsLiquid() { return $this->isLiquid; }
    public function getIsOther() { return $this->isOther; }
    public function getElemState() { return $this->elemstate; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdWeightType($idWeightType) { $this->idWeightType = $idWeightType; }
    public function setIdLanguage($idLanguage) { $this->idLanguage = $idLanguage; }
    public function setCode($code) { $this->code = $code; }
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setAbbreviation($abbreviation) { $this->abbreviation = $abbreviation; }
    public function setIsSolid($isSolid) { $this->isSolid = $isSolid; }
    public function setIsLiquid($isLiquid) { $this->isLiquid = $isLiquid; }
    public function setIsOther($isOther) { $this->isOther = $isOther; }
    public function setElemState($elemstate) { $this->elemstate = $elemstate; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
