<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableFoodCategoryNameData", false)) {
  class DistriXCodeTableFoodCategoryNameData extends DistriXSvcAppData
  {
    protected $id;
    protected $idCategory;
    protected $idLanguage;
    protected $code;
    protected $name;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->idCategory   = 0;
      $this->idLanguage   = 0;
      $this->code         = "";
      $this->name         = "";
      $this->status       = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdCategory() { return $this->idCategory; }
    public function getIdLanguage() { return $this->idLanguage; }
    public function getCode() { return $this->code; }
    public function getName() { return $this->name; }
    public function getStatus() { return $this->status; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdCategory($idCategory) { $this->idCategory = $idCategory; }
    public function setIdLanguage($idLanguage) { $this->idLanguage = $idLanguage; }
    public function setCode($code) { $this->code = $code; }
    public function setName($name) { $this->name = $name; }
    public function setStatus($status) { $this->status = $status; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
