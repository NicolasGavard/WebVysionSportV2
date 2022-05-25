<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyInfoSessionData", false)) {
  class DistriXStyInfoSessionData extends DistriXSvcAppData
  {
    protected $idUser;
    protected $connected;
    protected $login;
    protected $firstName;
    protected $name;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $pass;
    protected $email;
    protected $emailBackup;
    protected $phone;
    protected $mobile;
    protected $initPass;
    protected $idLanguage;
    protected $idEnterprise;
    protected $roles;
    protected $status;

    public function __construct()
    {
      $this->idUser         = 0;
      $this->connected      = false;
      $this->login          = "";
      $this->firstName      = "";
      $this->name           = "";
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->pass           = "";
      $this->email          = "";
      $this->emailBackup    = "";
      $this->phone          = "";
      $this->mobile         = "";
      $this->initPass       = 0;
      $this->idLanguage     = 0;
      $this->idEnterprise   = 0;
      $this->roles          = [];
      $this->status         = 0;
    }
    // Gets
    public function getIdUser()
    {
      return $this->idUser;
    }
    public function getConnected()
    {
      return $this->connected;
    }
    public function getLogin()
    {
      return $this->login;
    }
    public function getFirstName()
    {
      return $this->firstName;
    }
    public function getName()
    {
      return $this->name;
    }
    public function getLinkToPicture()
    {
      return $this->linkToPicture;
    }
    public function getSize()
    {
      return $this->size;
    }
    public function getType()
    {
      return $this->type;
    }
    public function getPass()
    {
      return $this->pass;
    }
    public function getEmail()
    {
      return $this->email;
    }
    public function getEmailBackup()
    {
      return $this->emailBackup;
    }
    public function getPhone()
    {
      return $this->phone;
    }
    public function getMobile()
    {
      return $this->mobile;
    }
    public function getInitPass()
    {
      return $this->initPass;
    }
    public function getIdLanguage()
    {
      return $this->idLanguage;
    }
    public function getIdEnterprise()
    {
      return $this->idEnterprise;
    }
    public function getRoles()
    {
      return $this->roles;
    }
    public function getStatus()
    {
      return $this->status;
    }

    // Sets
    public function setIdUser($idUser)
    {
      $this->idUser = $idUser;
    }
    public function setConnected($connected)
    {
      $this->connected = $connected;
    }
    public function setLogin($login)
    {
      $this->login = $login;
    }
    public function setFirstName($firstName)
    {
      $this->firstName = $firstName;
    }
    public function setName($name)
    {
      $this->name = $name;
    }
    public function setLinkToPicture($linkToPicture)
    {
      $this->linkToPicture = $linkToPicture;
    }
    public function setSize($size)
    {
      $this->size = $size;
    }
    public function setType($type)
    {
      $this->type = $type;
    }
    public function setPass($pass)
    {
      $this->pass = $pass;
    }
    public function setEmail($email)
    {
      $this->email = $email;
    }
    public function setEmailBackup($emailBackup)
    {
      $this->emailBackup = $emailBackup;
    }
    public function setPhone($phone)
    {
      $this->phone = $phone;
    }
    public function setMobile($mobile)
    {
      $this->mobile = $mobile;
    }
    public function setInitPass($initPass)
    {
      $this->initPass = $initPass;
    }
    public function setIdLanguage($idLanguage)
    {
      $this->idLanguage = $idLanguage;
    }
    public function setIdEnterprise($idEnterprise)
    {
      $this->idEnterprise = $idEnterprise;
    }
    public function setRoles($roles)
    {
      $this->roles = $roles;
    }
    public function setStatus($status)
    {
      $this->status = $status;
    }
  }
  // End of class
}
// class_exists
