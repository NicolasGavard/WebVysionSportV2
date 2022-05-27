<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableNutritionalData", false)) {
  class DistriXCodeTableNutritionalData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $statut;
    protected $timestamp;

    public function __construct()
    {
      $this->id         = 0;
      $this->code       = "";
      $this->statut     = 0;
      $this->timestamp  = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getCode() { return $this->code; }
    public function getStatut() { return $this->statut; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setCode($code) { $this->code = $code; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
