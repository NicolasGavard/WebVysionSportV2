<?php // Needed to encode in UTF8 ààéàé //
class StyModuleStorData extends DistriXSvcAppData {
  const STYMODULE_STATUS_AVAILABLE     = 0;
  const STYMODULE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idstyapplication;
  protected $code;
  protected $description;
  protected $statut;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idstyapplication = 0;
      $this->code = "";
      $this->description = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdStyApplication():int { return $this->idstyapplication; }
  public function getCode():string { return $this->code; }
  public function getDescription():string { return $this->description; }
  public function getStatus():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->statut == self::STYMODULE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::STYMODULE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::STYMODULE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdStyApplication(int $idStyApplication) { $this->idstyapplication = $idStyApplication; }
  public function setCode(string $code) { $this->code = $code; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setStatus(int $status) { $this->statut = $status; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::STYMODULE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::STYMODULE_STATUS_NOT_AVAILABLE; }
}
