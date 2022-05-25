<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyApplicationData", false)) {
  class DistriXStyApplicationData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $name;
    protected $statut;

    public function __construct()
    {
      $this->id     = 0;
      $this->code   = "";
      $this->name   = "";
      $this->statut = 0;
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
    public function getName()
    {
      return $this->name;
    }
    public function getStatut()
    {
      return $this->statut;
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
    public function setName($name)
    {
      $this->name = $name;
    }
    public function setStatut($statut)
    {
      $this->statut = $statut;
    }
  }
  // End of class
}
// class_exists
