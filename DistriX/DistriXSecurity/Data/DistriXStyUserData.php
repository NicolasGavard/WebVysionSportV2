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
    protected $statut;

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
      $this->statut         = 0;
    }
    // Gets
    public function getId():int {return $this->id;}
    public function getIdStyUserType():int {return $this->idStyUserType;}
    public function getLogin():string {return $this->login;}
    public function getFirstName():string {return $this->firstName;}
    public function getName():string {return $this->name;}
    public function getLinkToPicture():string {return $this->linkToPicture;}
    public function getSize():int {return $this->size;}
    public function getType():string {return $this->type;}
    public function getPass():string {return $this->pass;}
    public function getEmail():string {return $this->email;}
    public function getEmailBackup():string {return $this->emailBackup;}
    public function getPhone():string {return $this->phone;}
    public function getMobile():string {return $this->mobile;}
    public function getInitPass():int {return $this->initPass;}
    public function getIdLanguage():int {return $this->idLanguage;}
    public function getIdStyEnterprise():int {return $this->idStyEnterprise;}
    public function getNameEnterprise():string {return $this->nameEnterprise;}
    public function getRoles():array {return $this->roles;}
    public function getStatut():int {return $this->statut;}

    // Sets
    public function setId(int $id){$this->id = $id;}
    public function setIdStyUserType(int $idStyUserType){$this->idStyUserType = $idStyUserType;}
    public function setLogin(string $login){$this->login = $login;}
    public function setFirstName(string $firstName){$this->firstName = $firstName;}
    public function setName(string $name){$this->name = $name;}
    public function setLinkToPicture(string $linkToPicture){$this->linkToPicture = $linkToPicture;}
    public function setSize(int $size){$this->size = $size;}
    public function setType(string $type){$this->type = $type;}
    public function setPass(string $pass){$this->pass = $pass;}
    public function setEmail(string $email){$this->email = $email;}
    public function setEmailBackup(string $emailBackup){$this->emailBackup = $emailBackup;}
    public function setPhone(string $phone){$this->phone = $phone;}
    public function setMobile(string $mobile){$this->mobile = $mobile;}
    public function setInitPass(int $initPass){$this->initPass = $initPass;}
    public function setIdLanguage(int $idLanguage){$this->idLanguage = $idLanguage;}
    public function setIdStyEnterprise(int $idStyEnterprise){$this->idStyEnterprise = $idStyEnterprise;}
    public function setnameEnterprise(string $nameEnterprise){$this->nameEnterprise = $nameEnterprise;}
    public function setRoles(array $roles){$this->roles = $roles;}
    public function setStatut(int $statut){$this->statut = $statut;}
  }
  // End of class
}
// class_exists
