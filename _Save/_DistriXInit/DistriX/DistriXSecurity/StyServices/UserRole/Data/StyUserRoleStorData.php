<?php // Needed to encode in UTF8 ààéàé //
class StyUserRoleStorData extends DistriXSvcAppData {
  protected $id;
  protected $idstyuser;
  protected $idstyrole;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idstyuser = 0;
      $this->idstyrole = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdStyUser():int { return $this->idstyuser; }
  public function getIdStyRole():int { return $this->idstyrole; }
  public function getTimestamp():int { return $this->timestamp; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdStyUser(int $idStyUser) { $this->idstyuser = $idStyUser; }
  public function setIdStyRole(int $idStyRole) { $this->idstyrole = $idStyRole; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
}
