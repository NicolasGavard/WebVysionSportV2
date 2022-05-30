<?php // Needed to encode in UTF8 ààéàé //
class StyUserRoleStorData {
  private $id;
  private $idstyuser;
  private $idstyrole;

  public function __construct() {
      $this->id = 0;
      $this->idstyuser = 0;
      $this->idstyrole = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdStyUser() { return $this->idstyuser; }
  public function getIdStyRole() { return $this->idstyrole; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdStyUser($idStyUser) { $this->idstyuser = $idStyUser; }
  public function setIdStyRole($idStyRole) { $this->idstyrole = $idStyRole; }
}
