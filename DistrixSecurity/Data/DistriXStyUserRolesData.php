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
    public function getId()
    {
      return $this->id;
    }
    public function getIdUser()
    {
      return $this->idUser;
    }
    public function getIdStyRole()
    {
      return $this->idStyRole;
    }
    public function getNameStyRole()
    {
      return $this->nameStyRole;
    }
    // Sets
    public function setId($id)
    {
      $this->id = $id;
    }
    public function setIdUser($idUser)
    {
      $this->idUser = $idUser;
    }
    public function setIdStyRole($idStyRole)
    {
      $this->idStyRole = $idStyRole;
    }
    public function setNameStyRole($nameStyRole)
    {
      $this->nameStyRole = $nameStyRole;
    }
  }
  // End of class
}
// class_exists
