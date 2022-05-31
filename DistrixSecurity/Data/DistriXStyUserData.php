<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyUserData", false)) {
  class DistriXStyUserData extends DistriXSvcAppData
  {
    protected $id;
    protected $idStyUserType;
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
    protected $idStyEnterprise;
    protected $nameEnterprise;
    protected $roles;
    protected $status;

    public function __construct()
    {
      $this->id             = 0;
      $this->idStyUserType  = 0;
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
      $this->idStyEnterprise= 0;
      $this->nameEnterprise = "";
      $this->roles          = [];
      $this->status         = 0;
    }
    // Gets
    public function getId(){return $this->id;}
    public function getIdStyUserType(){return $this->idStyUserType;}
    public function getLogin(){return $this->login;}
    public function getFirstName(){return $this->firstName;}
    public function getName(){return $this->name;}
    public function getLinkToPicture(){return $this->linkToPicture;}
    public function getSize(){return $this->size;}
    public function getType(){return $this->type;}
    public function getPass(){return $this->pass;}
    public function getEmail(){return $this->email;}
    public function getEmailBackup(){return $this->emailBackup;}
    public function getPhone(){return $this->phone;}
    public function getMobile(){return $this->mobile;}
    public function getInitPass(){return $this->initPass;}
    public function getIdLanguage(){return $this->idLanguage;}
    public function getIdStyEnterprise(){return $this->idStyEnterprise;}
    public function getNameEnterprise(){return $this->nameEnterprise;}
    public function getRoles(){return $this->roles;}
    public function getStatus(){return $this->status;}

    // Sets
    public function setId($id){$this->id = $id;}
    public function setIdStyUserType($idStyUserType){$this->idStyUserType = $idStyUserType;}
    public function setLogin($login){$this->login = $login;}
    public function setFirstName($firstName){$this->firstName = $firstName;}
    public function setName($name){$this->name = $name;}
    public function setLinkToPicture($linkToPicture){$this->linkToPicture = $linkToPicture;}
    public function setSize($size){$this->size = $size;}
    public function setType($type){$this->type = $type;}
    public function setPass($pass){$this->pass = $pass;}
    public function setEmail($email){$this->email = $email;}
    public function setEmailBackup($emailBackup){$this->emailBackup = $emailBackup;}
    public function setPhone($phone){$this->phone = $phone;}
    public function setMobile($mobile){$this->mobile = $mobile;}
    public function setInitPass($initPass){$this->initPass = $initPass;}
    public function setIdLanguage($idLanguage){$this->idLanguage = $idLanguage;}
    public function setIdStyEnterprise($idStyEnterprise){$this->idStyEnterprise = $idStyEnterprise;}
    public function setnameEnterprise($nameEnterprise){$this->nameEnterprise = $nameEnterprise;}
    public function setRoles($roles){$this->roles = $roles;}
    public function setStatus($status){$this->status = $status;}
  }
  // End of class
}
// class_exists
