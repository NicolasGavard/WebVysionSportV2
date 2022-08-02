<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("CircuitExerciseData", false)) {
  class CircuitExerciseData extends DistriXSvcAppData
  {
    protected $id;
    protected $idCircuitTemplate;
    protected $nameCircuitTemplate;
    protected $idEexercise;
    protected $nameEexercise;
    protected $elemstate;
    protected $timestamp;

    public function __construct() {
        $this->id                   = 0;
        $this->idCircuitTemplate    = 0;
        $this->nameCircuitTemplate  = "";
        $this->idEexercise          = 0;
        $this->nameEexercise        = "";
        $this->elemstate            = 0;
        $this->timestamp            = 0;
      }
  // Gets
    public function getId():int { return $this->id; }
    public function getIdCircuitTemplate():int { return $this->idCircuitTemplate; }
    public function getNameCircuitTemplate():string { return $this->nameCircuitTemplate; }
    public function getIdEexercise():int { return $this->idEexercise; }
    public function getNameEexercise():string { return $this->nameEexercise; }
    public function getElemState():int { return $this->elemstate; }
    public function getTimestamp():int { return $this->timestamp; }
  // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdCircuitTemplate(int $idCircuitTemplate) { $this->idCircuitTemplate = $idCircuitTemplate; }
    public function setNameCircuitTemplate(string $nameCircuitTemplate) { $this->nameCircuitTemplate = $nameCircuitTemplate; }
    public function setIdEexercise(int $idEexercise) { $this->idEexercise = $idEexercise; }
    public function setNameEexercise(string $nameEexercise) { $this->nameEexercise = $nameEexercise; }
    public function setElemState(int $elemState) { $this->elemstate = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
}
