<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyRoleRightsData", false)) {
  class DistriXStyRoleRightsData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyRole;
    protected $codeRole;
    protected $nameRole;
    protected $styApplications;
    
    public function __construct()
    {
      $this->id                 = 0;
      $this->idStyRole          = 0;
      $this->codeRole           = "";
      $this->nameRole           = "";
      $this->styApplications    = array();
    }
    // Gets
    public function getId():int  { return $this->id; }
    public function getIdStyRole():int  { return $this->idStyRole; }
    public function getCodeStyRole():string  { return $this->codeRole; }
    public function getNameRole():string  { return $this->nameRole; }
    public function getStyApplications():array  { return $this->styApplications; }
    
    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdStyRole(int $idStyRole) { $this->idStyRole = $idStyRole; }
    public function setCodeRole(string $codeRole) { $this->codeRole = $codeRole; }
    public function setNameRole(string $nameRole) { $this->nameRole = $nameRole; }
    public function setStyApplications(array $styApplications) { $this->styApplications = $styApplications;}    
  }
  // End of class
}
// class_exists
