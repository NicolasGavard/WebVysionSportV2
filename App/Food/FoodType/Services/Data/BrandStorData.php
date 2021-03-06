<?php // Needed to encode in UTF8 ààéàé //
class BrandStorData extends DistriXSvcAppData {
  const BRAND_STATUS_AVAILABLE     = 0;
  const BRAND_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $name;
  protected $linktopicture;
  protected $size;
  protected $type;
  protected $elemstate;
  protected $timestamp;

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
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getLinkToPicture():string { return $this->linktopicture; }
  public function getSize():int { return $this->size; }
  public function getType():string { return $this->type; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::BRAND_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::BRAND_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::BRAND_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setLinkToPicture(string $linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize(int $size) { $this->size = $size; }
  public function setType(string $type) { $this->type = $type; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::BRAND_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::BRAND_STATUS_NOT_AVAILABLE; }
}
