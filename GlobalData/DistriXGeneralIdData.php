<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXGeneralIdData", false)) {
  class DistriXGeneralIdData extends DistriXSvcAppData
  {
    protected $id;
    
    public function __construct()
    {
      $this->id = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    
    // Sets
    public function setId($id) { $this->id = $id; }
  }
  // End of class
}
// class_exists
