<?php // Needed to encode in UTF8 ààéàé //
class StyApplicationStorData {
  const STYAPPLICATION_STATUS_AVAILABLE     = 0;
  const STYAPPLICATION_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $description;
  protected $statut;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->description = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getDescription():string { return $this->description; }
  public function getStatus():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->statut == self::STYAPPLICATION_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::STYAPPLICATION_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::STYAPPLICATION_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setStatus(int $status) { $this->statut = $status; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::STYAPPLICATION_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::STYAPPLICATION_STATUS_NOT_AVAILABLE; }
}
