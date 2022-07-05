<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXSportMyExercisesMusclesData", false)) {
  class DistriXSportMyExercisesMusclesData extends DistriXSvcAppData
  {
    protected $id;
    protected $idExercise;
    protected $nameExercise;
    protected $idBodyMuscle;
    protected $nameBodyMuscle;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idExercise     = 0;
      $this->nameExercise   = "";
      $this->idBodyMuscle   = 0;
      $this->nameBodyMuscle = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdExercise():int { return $this->idExercise; }
    public function getNameExercise():string { return $this->nameExercise; }
    public function getIdBodyMuscle():int { return $this->idBodyMuscle; }
    public function getNameBodyMuscle():string { return $this->nameBodyMuscle; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdExercise(int $idExercise) { $this->idExercise = $idExercise; }
    public function setNameExercise(string $nameExercise) { $this->nameExercise = $nameExercise; }
    public function setIdBodyMuscle(int $idBodyMuscle) { $this->idBodyMuscle = $idBodyMuscle; }
    public function setNameBodyMuscle(int $nameBodyMuscle) { $this->nameBodyMuscle = $nameBodyMuscle; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
