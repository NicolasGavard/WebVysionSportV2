<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("DistriXStyUserEnterpriseData", false)) {
  class DistriXStyUserEnterpriseData extends DistriXSvcAppData
  {
    protected $id;
    protected $name;
    protected $city;
    protected $idEnterprise;

    public function __construct() {
      $this->id           = 0;
      $this->name         = "";
      $this->city         = "";
      $this->idEnterprise = 0;
    }
// Gets
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getCity() { return $this->city; }
    public function getIdEnterprise() { return $this->idEnterprise; }

// Sets
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setCity($city) { $this->city = $city; }
    public function setIdEnterprise($idEnterprise) { $this->idEnterprise = $idEnterprise; }
  }
  // End of class
}
// class_exists
