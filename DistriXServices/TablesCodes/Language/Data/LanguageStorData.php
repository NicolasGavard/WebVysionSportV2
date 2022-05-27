<?php // Needed to encode in UTF8 ààéàé //
class LanguageStorData extends DistriXSvcAppData {
  const LANGUAGE_STATUS_AVAILABLE     = 0;
  const LANGUAGE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $description;
  protected $name;
  protected $linktopicture;
  protected $size;
  protected $type;
  protected $statut;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->description = "";
      $this->name = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getDescription():string { return $this->description; }
  public function getName():string { return $this->name; }
  public function getLinkToPicture():string { return $this->linktopicture; }
  public function getSize():int { return $this->size; }
  public function getType():string { return $this->type; }
  public function getStatut():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->statut == self::LANGUAGE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::LANGUAGE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::LANGUAGE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setName(string $name) { $this->name = $name; }
  public function setLinkToPicture(string $linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize(int $size) { $this->size = $size; }
  public function setType(string $type) { $this->type = $type; }
  public function setStatut(int $statut) { $this->statut = $statut; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::LANGUAGE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::LANGUAGE_STATUS_NOT_AVAILABLE; }
}
