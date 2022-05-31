<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyUserRolesData", false)) {
  class DistriXStyUserRolesData extends DistriXSvcAppData
  {
    protected $id;
    protected $idUser;
    protected $idStyRole;
    protected $nameStyRole;

    public function __construct()
    {
      $this->id          = 0;
      $this->idUser      = 0;
      $this->idStyRole   = 0;
      $this->nameStyRole = "";
    }
    // Gets
    public function getId():int  { return $this->id; }
    public function getIdUser():int  { return $this->idUser; }
    public function getIdStyRole():int  { return $this->idStyRole; }
    public function getNameStyRole():string  { return $this->nameStyRole; }
    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdUser(int $idUser) { $this->idUser = $idUser; }
    public function setIdStyRole(int $idStyRole) { $this->idStyRole = $idStyRole; }
    public function setNameStyRole(string $nameStyRole) { $this->nameStyRole = $nameStyRole; }
  }
  // End of class
}
// class_exists
