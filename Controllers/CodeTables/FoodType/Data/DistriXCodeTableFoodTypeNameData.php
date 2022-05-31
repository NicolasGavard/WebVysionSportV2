<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableFoodTypeNameData", false)) {
  class DistriXCodeTableFoodTypeNameData extends DistriXSvcAppData {
    protected $id;
    protected $idfoodtype;
    protected $idlanguage;
    protected $name;
    protected $elemstate;
    protected $timestamp;
  
    public function __construct() {
      $this->id = 0;
      $this->idfoodtype = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdFoodType():int { return $this->idfoodtype; }
    public function getIdLanguage():int { return $this->idlanguage; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemstate; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdFoodType(int $idFoodType) { $this->idfoodtype = $idFoodType; }
    public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemstate = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
