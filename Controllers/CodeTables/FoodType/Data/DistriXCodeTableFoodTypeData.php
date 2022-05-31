<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableFoodTypeData", false)) {
  class DistriXCodeTableFoodTypeData extends DistriXSvcAppData {
    protected $id;
    protected $code;
    protected $name;
    protected $elemstate;
    protected $timestamp;
    protected $names;

    public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
      $this->names = [];
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemstate; }
    public function getTimestamp():int { return $this->timestamp; }
    public function getNames():array { return $this->names; }
    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemstate = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
    public function setNames(array $names) { $this->names = $names; }
    }
}
