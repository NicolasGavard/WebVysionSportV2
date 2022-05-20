<?php // Needed to encode in UTF8 ààéàé //
class StyUserRoleStorData {
  private $id;
  private $idstyuser;
  private $idstyrole;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idstyuser = 0;
      $this->idstyrole = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdStyUser() { return $this->idstyuser; }
  public function getIdStyRole() { return $this->idstyrole; }
  public function getTimestamp() { return $this->timestamp; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdStyUser($idStyUser) { $this->idstyuser = $idStyUser; }
  public function setIdStyRole($idStyRole) { $this->idstyrole = $idStyRole; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
}
