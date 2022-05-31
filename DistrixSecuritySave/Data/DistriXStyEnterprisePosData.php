<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyEnterprisePosData", false)) {
  class DistriXStyEnterprisePosData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyEnterprise;
    protected $idPos;
    protected $status;
    protected $timestamp;

    public function __construct(){
      $this->id               = 0;
      $this->idStyEnterprise  = 0;
      $this->idPos            = 0;
      $this->status           = 0;
      $this->timestamp        = 0;
    }
    // Gets
    public function getId():int  { return $this->id; }
    public function getIdStyEnterprise():int  { return $this->idStyEnterprise; }
    public function getIdPos():int  { return $this->idPos; }
    public function getStatus():int  { return $this->status; }
    public function getTimestamp():int  { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdStyEnterprise(int $idStyEnterprise) { $this->idStyEnterprise = $idStyEnterprise; }
    public function setIdPos(int $idPos) { $this->idPos = $idPos; }
    public function setStatus(int $status) { $this->status = $status; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
