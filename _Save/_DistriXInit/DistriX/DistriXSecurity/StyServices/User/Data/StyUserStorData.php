<?php // Needed to encode in UTF8 ààéàé //
class StyUserStorData extends DistriXSvcAppData {
  const STYUSER_STATUS_AVAILABLE     = 0;
  const STYUSER_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idstyusertype;
  protected $login;
  protected $firstname;
  protected $name;
  protected $linktopicture;
  protected $size;
  protected $type;
  protected $pass;
  protected $email;
  protected $emailbackup;
  protected $phone;
  protected $mobile;
  protected $initpass;
  protected $idlanguage;
  protected $idstyenterprise;
  protected $statut;
  protected $timestamp;

  public function __construct()
  {
    $this->id = 0;
    $this->idstyusertype = 0;
    $this->login = "";
    $this->firstname = "";
    $this->name = "";
    $this->linktopicture = "";
    $this->size = 0;
    $this->type = "";
    $this->pass = "";
    $this->email = "";
    $this->emailbackup = "";
    $this->phone = "";
    $this->mobile = "";
    $this->initpass = 0;
    $this->idlanguage = 0;
    $this->idstyenterprise = 0;
    $this->statut = 0;
    $this->timestamp = 0;
  }
  // Gets
  public function getId():int {return $this->id;}
  public function getIdStyUserType():int {return $this->idstyusertype;}
  public function getLogin():string {return $this->login;}
  public function getFirstName():string {return $this->firstname;}
  public function getName():string {return $this->name;}
  public function getLinkToPicture():string {return $this->linktopicture;}
  public function getSize():int {return $this->size;}
  public function getType():string {return $this->type;}
  public function getPass():string {return $this->pass;}public function getEmail() {return $this->email;}
  public function getEmailBackup():string {return $this->emailbackup;}
  public function getPhone():string {return $this->phone;}
  public function getMobile():string {return $this->mobile;}
  public function getInitPass():int {return $this->initpass;}
  public function getIdLanguage():int {return $this->idlanguage;}
  public function getIdStyEnterprise():int {return $this->idstyenterprise;}
  public function getStatut():int {return $this->statut;}
  public function getTimestamp():int {return $this->timestamp;}
  public function isAvailable():int {return ($this->statut == self::STYUSER_STATUS_AVAILABLE);}
  public function getAvailableValue():int {return self::STYUSER_STATUS_AVAILABLE;}
  public function getUnavailableValue():int {return self::STYUSER_STATUS_NOT_AVAILABLE;}
  // Sets
  public function setId(int $id) {$this->id = $id;}
  public function setIdStyUserType(int $idStyUserType) {$this->idstyusertype = $idStyUserType;}
  public function setLogin(string $login) {$this->login = $login;}
  public function setFirstName(string $firstName) {$this->firstname = $firstName;}
  public function setName(string $name) {$this->name = $name;}
  public function setLinkToPicture(string $linkToPicture) {$this->linktopicture = $linkToPicture;}
  public function setSize(int $size) {$this->size = $size;}
  public function setType(string $type) {$this->type = $type;}
  public function setPass(string $pass) {$this->pass = $pass;}
  public function setEmail(string $email) {$this->email = $email;}
  public function setEmailBackup(string $emailBackup) {$this->emailbackup = $emailBackup;}
  public function setPhone(string $phone) {$this->phone = $phone;}
  public function setMobile(string $mobile) {$this->mobile = $mobile;}
  public function setInitPass(int $initPass) {$this->initpass = $initPass;}
  public function setIdLanguage(int $idLanguage) {$this->idlanguage = $idLanguage;}
  public function setIdStyEnterprise(int $idStyEnterprise) {$this->idstyenterprise = $idStyEnterprise;}
  public function setStatut(int $statut) {$this->statut = $statut;}
  public function setTimestamp(int $timestamp) {$this->timestamp = $timestamp;}
  public function setAvailable() {$this->statut = self::STYUSER_STATUS_AVAILABLE;}
  public function setUnavailable() {$this->statut = self::STYUSER_STATUS_NOT_AVAILABLE;}
}
