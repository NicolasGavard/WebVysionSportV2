<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyLoginData", false)) {
  class DistriXStyLoginData extends DistriXSvcAppData
  {
    protected $application;
    protected $idUser;
    protected $login;
    protected $password;
    protected $authType;

    public function __construct()
    {
      $this->application  = "";
      $this->idUser       = 0;
      $this->login        = "";
      $this->password     = "";
      $this->authType     = "";
    }
    // Gets
    public function getApplication():string  { return $this->application; }
    public function getIdUser():int  { return $this->idUser; }
    public function getLogin():string  { return $this->login; }
    public function getPassword():string  { return $this->password; }
    public function getAuthType():string  { return $this->authType; }

    // Sets
    public function setApplication(string $application) { $this->application = $application; }
    public function setIdUser(int $idUser) { $this->idUser = $idUser; }
    public function setLogin(string $login) { $this->login = $login; }
    public function setPassword(string $password) { $this->password = $password; }
    public function setAuthType(string $authType) { $this->authType = $authType; }
  }
  // End of class
}
// class_exists
