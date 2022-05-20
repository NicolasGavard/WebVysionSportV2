<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableNutritionalNameData", false)) {
  class DistriXCodeTableNutritionalNameData extends DistriXSvcAppData
  {
    protected $id;
    protected $idNutritional;
    protected $idLanguage;
    protected $code;
    protected $name;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->idNutritional = 0;
      $this->idLanguage   = 0;
      $this->code         = "";
      $this->name         = "";
      $this->status       = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdNutritional() { return $this->idNutritional; }
    public function getIdLanguage() { return $this->idLanguage; }
    public function getCode() { return $this->code; }
    public function getName() { return $this->name; }
    public function getStatus() { return $this->status; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdNutritional($idNutritional) { $this->idNutritional = $idNutritional; }
    public function setIdLanguage($idLanguage) { $this->idLanguage = $idLanguage; }
    public function setCode($code) { $this->code = $code; }
    public function setName($name) { $this->name = $name; }
    public function setStatus($status) { $this->status = $status; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
