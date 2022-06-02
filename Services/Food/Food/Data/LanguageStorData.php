<?php // Needed to encode in UTF8 ààéàé //
class LanguageStorData extends DistriXSvcAppData {
  const LANGUAGE_STATUS_AVAILABLE     = 0;
  const LANGUAGE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $codeshort;
  protected $code;
  protected $name;
  protected $linktopicture;
  protected $size;
  protected $type;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->codeshort = "";
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
  public function getCodeShort():string { return $this->codeshort; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getLinkToPicture():string { return $this->linktopicture; }
  public function getSize():int { return $this->size; }
  public function getType():string { return $this->type; }
  public function getStatus():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::LANGUAGE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::LANGUAGE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::LANGUAGE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCodeShort(string $codeShort) { $this->codeshort = $codeShort; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setLinkToPicture(string $linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize(int $size) { $this->size = $size; }
  public function setType(string $type) { $this->type = $type; }
  public function setStatus(int $status) { $this->elemstate = $status; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::LANGUAGE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::LANGUAGE_STATUS_NOT_AVAILABLE; }
}
