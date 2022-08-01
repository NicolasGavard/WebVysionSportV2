<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableExerciseTypeData", false)) {
  class DistriXCodeTableExerciseTypeData extends DistriXSvcAppData {
    protected $id;
    protected $code;
    protected $name;
    protected $elemState;
    protected $timestamp;
    protected $nbLanguages;
    protected $nbLanguagesTotal;
    protected $names;

    public function __construct() {
      $this->id               = 0;
      $this->code             = "";
      $this->name             = "";
      $this->elemState        = 0;
      $this->timestamp        = 0;
      $this->nbLanguages      = 0;
      $this->nbLanguagesTotal = 0;
      $this->names            = [];
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
    public function getNbLanguages():int { return $this->nbLanguages; }
    public function getNbLanguagesTotal():int { return $this->nbLanguagesTotal; }
    public function getNames():array { return $this->names; }
    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
    public function setNbLanguages(int $nbLanguages) { $this->nbLanguages = $nbLanguages; }
    public function setNbLanguagesTotal(int $nbLanguagesTotal) { $this->nbLanguagesTotal = $nbLanguagesTotal; }
    public function setNames(array $names) { $this->names = $names; }
    }
}
