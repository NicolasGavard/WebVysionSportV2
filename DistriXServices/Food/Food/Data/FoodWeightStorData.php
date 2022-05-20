<?php // Needed to encode in UTF8 ààéàé //
class FoodWeightStorData {
  const FOODWEIGHT_STATUS_AVAILABLE     = 0;
  const FOODWEIGHT_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idfood;
  private $idweighttype;
  private $weight;
  private $linktopicture;
  private $size;
  private $type;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idweighttype = 0;
      $this->weight = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdFood() { return $this->idfood; }
  public function getIdWeightType() { return $this->idweighttype; }
  public function getWeight() { return $this->weight; }
  public function getLinkToPicture() { return $this->linktopicture; }
  public function getSize() { return $this->size; }
  public function getType() { return $this->type; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::FOODWEIGHT_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::FOODWEIGHT_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::FOODWEIGHT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdFood($idFood) { $this->idfood = $idFood; }
  public function setIdWeightType($idWeightType) { $this->idweighttype = $idWeightType; }
  public function setWeight($weight) { $this->weight = $weight; }
  public function setLinkToPicture($linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize($size) { $this->size = $size; }
  public function setType($type) { $this->type = $type; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::FOODWEIGHT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::FOODWEIGHT_STATUS_NOT_AVAILABLE; }
}
