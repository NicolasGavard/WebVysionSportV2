<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableBodyMembersMusclesData", false)) {
  class DistriXCodeTableBodyMembersMusclesData extends DistriXSvcAppData {
    protected $id;
    protected $code;
    protected $name;
    protected $elemState;
    protected $timestamp;
    protected $muscles;

    public function __construct() {
      $this->id               = 0;
      $this->code             = "";
      $this->name             = "";
      $this->elemState        = 0;
      $this->timestamp        = 0;
      $this->muscles          = [];
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }
    public function getMuscles():array { return $this->muscles; }
    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
    public function setMuscles(array $muscles) { $this->muscles = $muscles; }
    }
}
