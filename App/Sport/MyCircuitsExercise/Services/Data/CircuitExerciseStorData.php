<?php // Needed to encode in UTF8 ààéàé //
class CircuitExerciseStorData extends DistriXSvcAppData {
  const CIRCUITEXERCISE_STATUS_AVAILABLE     = 0;
  const CIRCUITEXERCISE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idcircuittemplate;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idcircuittemplate = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdCircuitTemplate():int { return $this->idcircuittemplate; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::CIRCUITEXERCISE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::CIRCUITEXERCISE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::CIRCUITEXERCISE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdCircuitTemplate(int $idCircuitTemplate) { $this->idcircuittemplate = $idCircuitTemplate; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::CIRCUITEXERCISE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::CIRCUITEXERCISE_STATUS_NOT_AVAILABLE; }
}
