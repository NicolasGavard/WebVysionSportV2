<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyLoginData", false)) {
  class DistriXStyLoginData extends DistriXSvcAppData
  {
    protected $application;
    protected $login;
    protected $password;
    protected $authType;

    public function __construct()
    {
      $this->application = "";
      $this->login = "";
      $this->password = "";
      $this->authType = "";
    }
    // Gets
    public function getApplication()
    {
      return $this->application;
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
