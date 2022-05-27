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
    public function getApplication()
    {
      return $this->application;
    }
    public function getIdUser()
    {
      return $this->idUser;
    }
    public function getLogin()
    {
      return $this->login;
    }
    public function getPassword()
    {
      return $this->password;
    }
    public function getAuthType()
    {
      return $this->authType;
    }

    // Sets
    public function setApplication($application)
    {
      $this->application = $application;
    }
    public function setIdUser($idUser)
    {
      $this->idUser = $idUser;
    }
    public function setLogin($login)
    {
      $this->login = $login;
    }
    public function setPassword($password)
    {
      $this->password = $password;
    }
    public function setAuthType($authType)
    {
      $this->authType = $authType;
    }
  }
  // End of class
}
// class_exists
