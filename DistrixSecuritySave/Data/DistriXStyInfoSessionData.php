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
    public function getIdUser():int  { return $this->idUser; }
    public function getApplication():string  { return $this->application; }
    public function getConnected():int  { return $this->connected; }
    public function getTimeConnected():int  { return $this->timeConnected; }
    
    // Sets
    public function setIdUser(int $idUser) { $this->idUser = $idUser; }
    public function setApplication(string $application) { $this->application = $application; }
    public function setConnected(int $connected) { $this->connected = $connected; }
    public function setTimeConnected(int $timeConnected) { $this->timeConnected = $timeConnected; }
  }
  // End of class
}
// class_exists
