<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableWeightTypeNameData", false)) {
  class DistriXCodeTableWeightTypeNameData extends DistriXSvcAppData
  {
    protected $id;
    protected $idWeightType;
    protected $idLanguage;
    protected $code;
    protected $name;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->idWeightType = 0;
      $this->idLanguage   = 0;
      $this->code         = "";
      $this->name         = "";
      $this->elemState    = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdWeightType():int { return $this->idWeightType; }
    public function getIdLanguage():int { return $this->idLanguage; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdWeightType(int $idWeightType) { $this->idWeightType = $idWeightType; }
    public function setIdLanguage(int $idLanguage) { $this->idLanguage = $idLanguage; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
