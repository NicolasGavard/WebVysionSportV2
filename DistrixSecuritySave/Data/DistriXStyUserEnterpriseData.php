<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("DistriXStyUserEnterpriseData", false)) {
  class DistriXStyUserEnterpriseData extends DistriXSvcAppData
  {
    protected $id;
    protected $name;
    protected $city;
    protected $idStyEnterprise;

    public function __construct() {
      $this->id           = 0;
      $this->name         = "";
      $this->city         = "";
      $this->idStyEnterprise = 0;
    }
// Gets
    public function getId():int { return $this->id; }
    public function getName():string { return $this->name; }
    public function getCity():string { return $this->city; }
    public function getIdStyEnterprise():int { return $this->idStyEnterprise; }

// Sets
    public function setId(int $id) { $this->id = $id; }
    public function setName(string $name) { $this->name = $name; }
    public function setCity(string $city) { $this->city = $city; }
    public function setIdStyEnterprise(int $idStyEnterprise) { $this->idStyEnterprise = $idStyEnterprise; }
  }
  // End of class
}
// class_exists
