<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableMealTypeNameData", false)) {
  class DistriXCodeTableMealTypeNameData extends DistriXSvcAppData {
    protected $id;
    protected $idmealtype;
    protected $idlanguage;
    protected $name;
    protected $elemState;
    protected $timestamp;
  
    public function __construct() {
      $this->id         = 0;
      $this->idmealtype = 0;
      $this->idlanguage = 0;
      $this->name       = "";
      $this->elemState  = 0;
      $this->timestamp  = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdMealType():int { return $this->idmealtype; }
    public function getIdLanguage():int { return $this->idlanguage; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdMealType(int $idMealType) { $this->idmealtype = $idMealType; }
    public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
