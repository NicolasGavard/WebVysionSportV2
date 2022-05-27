<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCodeTableFoodCategoryData", false)) {
  class DistriXCodeTableFoodCategoryData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $elemstate;
    protected $timestamp;

    public function __construct()
    {
      $this->id         = 0;
      $this->code       = "";
      $this->elemstate     = 0;
      $this->timestamp  = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getCode() { return $this->code; }
    public function getElemState() { return $this->elemstate; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setCode($code) { $this->code = $code; }
    public function setElemState($elemstate) { $this->elemstate = $elemstate; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
