<?php // Needed to encode in UTF8 ààéàé //
class FoodLabelStorData {
  const FOODLABEL_STATUS_AVAILABLE     = 0;
  const FOODLABEL_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idfood;
  private $idlabel;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idlabel = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdFood() { return $this->idfood; }
  public function getIdLabel() { return $this->idlabel; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::FOODLABEL_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::FOODLABEL_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::FOODLABEL_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdFood($idFood) { $this->idfood = $idFood; }
  public function setIdLabel($idLabel) { $this->idlabel = $idLabel; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::FOODLABEL_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::FOODLABEL_STATUS_NOT_AVAILABLE; }
}
