<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyEnterprisePosData", false)) {
  class DistriXStyEnterprisePosData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyEnterprise;
    protected $idPos;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id = 0;
      $this->idStyEnterprise = 0;
      $this->idPos = 0;
      $this->status = 0;
      $this->timestamp = 0;
    }
    // Gets
    public function getId(){return $this->id;}
    public function getIdStyEnterprise(){return $this->idStyEnterprise;}
    public function getIdPos(){return $this->idPos;}
    public function getStatus(){return $this->status;}
    public function getTimestamp(){return $this->timestamp;}

    // Sets
    public function setId($id){$this->id = $id;}
    public function setIdStyEnterprise($idStyEnterprise){$this->idStyEnterprise = $idStyEnterprise;}
    public function setIdPos($idPos){$this->idPos = $idPos;}
    public function setStatus($status){$this->status = $status;}
    public function setTimestamp($timestamp){$this->timestamp = $timestamp;}
  }
  // End of class
}
// class_exists
