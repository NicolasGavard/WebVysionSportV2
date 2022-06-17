<?php // Needed to encode in UTF8 ààéàé //
class StyEnterprisePosStorData extends DistriXSvcAppData {
  const STY_ENTERPRISEPOS_STATUS_AVAILABLE     = 0;
  const STY_ENTERPRISEPOS_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $styidenterprise;
  protected $idpos;
  protected $statut;
  protected $timestamp;

  public function __construct() {
      $this->id           = 0;
      $this->styidenterprise = 0;
      $this->idpos        = 0;
      $this->statut       = 0;
      $this->timestamp    = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getStyIdEnterprise():int { return $this->styidenterprise; }
  public function getIdPos():int { return $this->idpos; }
  public function getStatus():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->statut == self::STY_ENTERPRISEPOS_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::STY_ENTERPRISEPOS_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::STY_ENTERPRISEPOS_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setStyIdEnterprise(int $styIdEnterprise) { $this->styidenterprise = $styIdEnterprise; }
  public function setIdPos(int $idPos) { $this->idpos = $idPos; }
  public function setStatus(int $status) { $this->statut = $status; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::STY_ENTERPRISEPOS_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::STY_ENTERPRISEPOS_STATUS_NOT_AVAILABLE; }
}
