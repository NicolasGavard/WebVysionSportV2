<?php // Needed to encode in UTF8 ààéàé //
class StyUserAllRoleStorData
{
  private $idstyrole;
  private $styrolename;

  public function __construct()
  {
    $this->idstyrole = 0;
  }
  // Gets
  public function getIdStyRole()
  {
    return $this->idstyrole;
  }
  public function getStyRoleName()
  {
    return $this->styrolename;
  }
  // Sets
  public function setIdStyRole($idStyRole)
  {
    $this->idstyrole = $idStyRole;
  }
  public function setStyRoleName($styRoleName)
  {
    $this->styrolename = $styRoleName;
  }
}
