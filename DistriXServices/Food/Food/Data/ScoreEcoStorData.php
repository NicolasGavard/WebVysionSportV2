<?php // Needed to encode in UTF8 ààéàé //
class ScoreEcoStorData {
  const SCOREECO_STATUS_AVAILABLE     = 0;
  const SCOREECO_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $letter;
  private $color;
  private $description;
  private $linktopicture;
  private $size;
  private $type;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->letter = "";
      $this->color = "";
      $this->description = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getLetter() { return $this->letter; }
  public function getColor() { return $this->color; }
  public function getDescription() { return $this->description; }
  public function getLinkToPicture() { return $this->linktopicture; }
  public function getSize() { return $this->size; }
  public function getType() { return $this->type; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::SCOREECO_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::SCOREECO_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::SCOREECO_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setLetter($letter) { $this->letter = $letter; }
  public function setColor($color) { $this->color = $color; }
  public function setDescription($description) { $this->description = $description; }
  public function setLinkToPicture($linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize($size) { $this->size = $size; }
  public function setType($type) { $this->type = $type; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::SCOREECO_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::SCOREECO_STATUS_NOT_AVAILABLE; }
}
