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
    public function getId():int  { return $this->id; }
    public function getIdStyUser():int  { return $this->idStyUser; }
    public function getIdStyRole():int  { return $this->idStyRole; }
    public function getCodeRole():string  { return $this->codeRole; }
    public function getNameRole():string  { return $this->nameRole; }
    public function getTimestamp():int  { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdStyUser(int $idStyUser) { $this->idStyUser = $idStyUser; }
    public function setIdStyRole(int $idStyRole) { $this->idStyRole = $idStyRole; }
    public function setCodeRole(string $codeRole) { $this->codeRole = $codeRole; }
    public function setNameRole(string $nameRole) { $this->nameRole = $nameRole; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
