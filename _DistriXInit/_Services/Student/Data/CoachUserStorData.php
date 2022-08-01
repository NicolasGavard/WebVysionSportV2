<?php // Needed to encode in UTF8 ààéàé //
class CoachUserStorData {
  const COACHUSER_STATUS_AVAILABLE     = 0;
  const COACHUSER_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $styIdUserCoach;
  private $styIdUser;
  private $datestart;
  private $dateend;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->styIdUserCoach = 0;
      $this->styIdUser = 0;
      $this->datestart = 0;
      $this->dateend = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getStyIdUserCoach() { return $this->styIdUserCoach; }
  public function getStyIdUser() { return $this->styIdUser; }
  public function getDateStart() { return $this->datestart; }
  public function getDateEnd() { return $this->dateend; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::COACHUSER_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::COACHUSER_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::COACHUSER_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setStyIdUserCoach($styIdUserCoach) { $this->styIdUserCoach = $styIdUserCoach; }
  public function setStyIdUser($styIdUser) { $this->styIdUser = $styIdUser; }
  public function setDateStart($dateStart) { $this->datestart = $dateStart; }
  public function setDateEnd($dateEnd) { $this->dateend = $dateEnd; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::COACHUSER_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::COACHUSER_STATUS_NOT_AVAILABLE; }
}
