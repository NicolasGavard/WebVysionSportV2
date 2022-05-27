<?php // Needed to encode in UTF8 ààéàé //
class StyLanguageStorData {
  const STYLANGUAGE_STATUS_AVAILABLE     = 0;
  const STYLANGUAGE_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $code;
  private $description;
  private $linktopicture;
  private $size;
  private $type;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->description = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getCode() { return $this->code; }
  public function getDescription() { return $this->description; }
  public function getLinkToPicture() { return $this->linktopicture; }
  public function getSize() { return $this->size; }
  public function getType() { return $this->type; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::STYLANGUAGE_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::STYLANGUAGE_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::STYLANGUAGE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setCode($code) { $this->code = $code; }
  public function setDescription($description) { $this->description = $description; }
  public function setLinkToPicture($linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize($size) { $this->size = $size; }
  public function setType($type) { $this->type = $type; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::STYLANGUAGE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::STYLANGUAGE_STATUS_NOT_AVAILABLE; }
}