<?php // Needed to encode in UTF8 ààéàé //
class StyUserAllRoleStorData extends DistriXSvcAppData {
  
  protected $idstyrole;
  protected $styrolename;

  public function __construct(){$this->idstyrole = 0;}
  // Gets
  public function getIdStyRole():int {return $this->idstyrole;}
  public function getStyRoleName():string {return $this->styrolename;}
  // Sets
  public function setIdStyRole(int $idStyRole) {$this->idstyrole = $idStyRole;}
  public function setStyRoleName(string $styRoleName) {$this->styrolename = $styRoleName;}
}
