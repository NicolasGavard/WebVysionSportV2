<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyInfoSessionData", false)) {
  class DistriXStyInfoSessionData extends DistriXSvcAppData
  {
    protected $idUser;
    protected $application;
    protected $timeConnected;
    protected $connected;
    
    public function __construct()
    {
      $this->idUser         = 0;
      $this->application    = "";
      $this->connected      = false;
      $this->timeConnected  = 0;
    }
    // Gets
    public function getIdUser(){return $this->idUser;}
    public function getApplication(){return $this->application;}
    public function getConnected(){return $this->connected;}
    public function getTimeConnected(){return $this->timeConnected;}
    
    // Sets
    public function setIdUser($idUser){$this->idUser = $idUser;}
    public function setApplication($application){$this->application = $application;}
    public function setConnected($connected){$this->connected = $connected;}
    public function setTimeConnected($timeConnected){$this->timeConnected = $timeConnected;}
  }
  // End of class
}
// class_exists
