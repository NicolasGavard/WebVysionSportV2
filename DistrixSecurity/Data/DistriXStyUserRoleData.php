<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyUserRoleData", false)) {
  class DistriXStyUserRoleData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyUser;
    protected $idStyRole;
    protected $codeRole;
    protected $nameRole;
    protected $timestamp;

    public function __construct()
    {
      $this->id         = 0;
      $this->idStyUser  = 0;
      $this->idStyRole  = 0;
      $this->code       = "";
      $this->name       = "";
      $this->timestamp  = 0;
    }
    // Gets
    public function getId(){return $this->id;}
    public function getIdStyUser(){return $this->idStyUser;}
    public function getIdStyRole(){return $this->idStyRole;}
    public function getCodeRole(){return $this->codeRole;}
    public function getNameRole(){return $this->nameRole;}
    public function getTimestamp(){return $this->timestamp;}

    // Sets
    public function setId($id){$this->id = $id;}
    public function setIdStyUser($idStyUser){$this->idStyUser = $idStyUser;}
    public function setIdStyRole($idStyRole){$this->idStyRole = $idStyRole;}
    public function setCodeRole($codeRole){$this->codeRole = $codeRole;}
    public function setNameRole($nameRole){$this->nameRole = $nameRole;}
    public function setTimestamp($timestamp){$this->timestamp = $timestamp;}
  }
  // End of class
}
// class_exists
