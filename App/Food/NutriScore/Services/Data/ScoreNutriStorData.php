<?php // Needed to encode in UTF8 ààéàé //
class ScoreNutriStorData extends DistriXSvcAppData {
  const SCORENUTRI_STATUS_AVAILABLE     = 0;
  const SCORENUTRI_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $letter;
  protected $color;
  protected $description;
  protected $linktopicture;
  protected $size;
  protected $type;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->letter = "";
      $this->color = "";
      $this->description = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->elemstate = 0;
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
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::SCORENUTRI_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::SCORENUTRI_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::SCORENUTRI_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setLetter($letter) { $this->letter = $letter; }
  public function setColor($color) { $this->color = $color; }
  public function setDescription($description) { $this->description = $description; }
  public function setLinkToPicture($linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize($size) { $this->size = $size; }
  public function setType($type) { $this->type = $type; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::SCORENUTRI_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::SCORENUTRI_STATUS_NOT_AVAILABLE; }
}
