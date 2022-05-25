<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyApplicationData", false)) {
  class DistriXStyApplicationData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $description;
    protected $styModules;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id           = 0;
      $this->code         = "";
      $this->description  = "";
      $this->styModules   = array();
      $this->status       = 0;
      $this->timestamp    = 0;
    }
    // Gets
    public function getId()
    {
      return $this->id;
    }
    public function getCode()
    {
      return $this->code;
    }
    public function getDescription()
    {
      return $this->description;
    }
    public function getStyModules()
    {
      return $this->styModules;
    }
    public function getStatus()
    {
      return $this->status;
    }
    public function getTimestamp()
    {
      return $this->timestamp;
    }

    // Sets
    public function setId($id)
    {
      $this->id = $id;
    }
    public function setCode($code)
    {
      $this->code = $code;
    }
    public function setDescription($description)
    {
      $this->description = $description;
    }
    public function setStyModules($styModules)
    {
      $this->styModules = $styModules;
    }
    public function setStatus($status)
    {
      $this->status = $status;
    }
    public function setTimestamp($timestamp)
    {
      $this->timestamp = $timestamp;
    }
  }
  // End of class
}
// class_exists
