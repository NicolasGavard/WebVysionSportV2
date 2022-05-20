<?php // Needed to encode in UTF8 ààéàé //
class StyModuleStorData {
  const STYMODULE_STATUS_AVAILABLE     = 0;
  const STYMODULE_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idstyapplication;
  private $code;
  private $description;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idstyapplication = 0;
      $this->code = "";
      $this->description = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdStyApplication() { return $this->idstyapplication; }
  public function getCode() { return $this->code; }
  public function getDescription() { return $this->description; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::STYMODULE_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::STYMODULE_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::STYMODULE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdStyApplication($idStyApplication) { $this->idstyapplication = $idStyApplication; }
  public function setCode($code) { $this->code = $code; }
  public function setDescription($description) { $this->description = $description; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::STYMODULE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::STYMODULE_STATUS_NOT_AVAILABLE; }
}
