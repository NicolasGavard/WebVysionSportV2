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
    public function getId()
    {
      return $this->id;
    }
    public function getIdStyRole()
    {
      return $this->idStyRole;
    }
    public function getCodeStyRole()
    {
      return $this->codeRole;
    }
    public function getNameRole()
    {
      return $this->nameRole;
    }
    public function getStyApplications()
    {
      return $this->styApplications;
    }
    
    // Sets
    public function setId($id)
    {
      $this->id = $id;
    }
    public function setIdStyRole($idStyRole)
    {
      $this->idStyRole = $idStyRole;
    }
    public function setCodeRole($codeRole)
    {
      $this->codeRole = $codeRole;
    }
    public function setNameRole($nameRole)
    {
      $this->nameRole = $nameRole;
    }
    public function setStyApplications($styApplications)
    {
      $this->styApplications = $styApplications;
    }   
  }
  // End of class
}
// class_exists
