<?php // Needed to encode in UTF8 ààéàé //
class BrandStorData {
  const BRAND_STATUS_AVAILABLE     = 0;
  const BRAND_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $code;
  private $name;
  private $linktopicture;
  private $size;
  private $type;
  private $elemstate;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getCode() { return $this->code; }
  public function getName() { return $this->name; }
  public function getLinkToPicture() { return $this->linktopicture; }
  public function getSize() { return $this->size; }
  public function getType() { return $this->type; }
  public function getElemState() { return $this->elemstate; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->elemstate == self::BRAND_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::BRAND_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::BRAND_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setCode($code) { $this->code = $code; }
  public function setName($name) { $this->name = $name; }
  public function setLinkToPicture($linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize($size) { $this->size = $size; }
  public function setType($type) { $this->type = $type; }
  public function setElemState($elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::BRAND_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::BRAND_STATUS_NOT_AVAILABLE; }
}
