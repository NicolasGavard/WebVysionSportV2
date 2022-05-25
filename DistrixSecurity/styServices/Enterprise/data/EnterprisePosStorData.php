<?php // Needed to encode in UTF8 ààéàé //
class EnterprisePosStorData {
  const ENTERPRISEPOS_STATUS_AVAILABLE     = 0;
  const ENTERPRISEPOS_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $identerprise;
  private $idpos;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->identerprise = 0;
      $this->idpos = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdEnterprise() { return $this->identerprise; }
  public function getIdPos() { return $this->idpos; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::ENTERPRISEPOS_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::ENTERPRISEPOS_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::ENTERPRISEPOS_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdEnterprise($idEnterprise) { $this->identerprise = $idEnterprise; }
  public function setIdPos($idPos) { $this->idpos = $idPos; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::ENTERPRISEPOS_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::ENTERPRISEPOS_STATUS_NOT_AVAILABLE; }
}
