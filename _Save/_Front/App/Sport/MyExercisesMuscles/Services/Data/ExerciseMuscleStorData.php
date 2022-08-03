<?php // Needed to encode in UTF8 ààéàé //
class ExerciseMuscleStorData extends DistriXSvcAppData {
  const EXERCISEMUSCLE_STATUS_AVAILABLE     = 0;
  const EXERCISEMUSCLE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idexercise;
  protected $idbodymuscle;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idexercise = 0;
      $this->idbodymuscle = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdExercise():int { return $this->idexercise; }
  public function getIdBodyMuscle():int { return $this->idbodymuscle; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::EXERCISEMUSCLE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::EXERCISEMUSCLE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::EXERCISEMUSCLE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdExercise(int $idExercise) { $this->idexercise = $idExercise; }
  public function setIdBodyMuscle(int $idBodyMuscle) { $this->idbodymuscle = $idBodyMuscle; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::EXERCISEMUSCLE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::EXERCISEMUSCLE_STATUS_NOT_AVAILABLE; }
}
