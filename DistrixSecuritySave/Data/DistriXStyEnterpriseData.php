<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyEnterpriseData", false)) {
  class DistriXStyEnterpriseData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $name;
    protected $email;
    protected $phone;
    protected $mobile;
    protected $co;
    protected $street;
    protected $zipCode;
    protected $city;
    protected $linkToPicture;
    protected $logoImageHtmlName;
    protected $logoImageName;
    protected $logoSize;
    protected $logoType;
    protected $idRegion;
    protected $idCountry;
    protected $idLanguage;
    protected $idUserManager;
    protected $nameUserManager;
    protected $firstNameUserManager;
    protected $imgUserManager;
    protected $mailUserManager;
    protected $phoneUserManager;
    protected $mobileUserManager;
    protected $idStyEnterpriseParent;
    protected $statut;
    protected $timestamp;

    public function __construct(){
      $this->id                     = 0;
      $this->code                   = "";
      $this->name                   = "";
      $this->email                  = "";
      $this->phone                  = 0;
      $this->mobile                 = 0;
      $this->co                     = "";
      $this->street                 = "";
      $this->zipCode                = "";
      $this->city                   = "";
      $this->linkToPicture          = "";
      $this->logoImageHtmlName      = "";
      $this->logoImageName          = "";
      $this->logoSize               = 0;
      $this->logoType               = "";
      $this->idRegion               = 0;
      $this->idCountry              = 0;
      $this->idLanguage             = 0;
      $this->idUserManager          = 0;
      $this->nameUserManager        = "";
      $this->firstNameUserManager   = "";
      $this->imgUserManager         = "";
      $this->mailUserManager        = "";
      $this->phoneUserManager       = "";
      $this->mobileUserManager      = "";
      $this->idStyEnterpriseParent  = 0;
      $this->statut                 = 0;
      $this->timestamp              = 0;
    }
    // Gets
    public function getId():int  { return $this->id; }
    public function getCode():string  { return $this->code; }
    public function getName():string  { return $this->name; }
    public function getEmail():string  { return $this->email; }
    public function getPhone():string  { return $this->phone; }
    public function getMobile():string  { return $this->mobile; }
    public function getCo():string  { return $this->co; }
    public function getStreet():string  { return $this->street; }
    public function getZipCode():string  { return $this->zipCode; }
    public function getCity():string  { return $this->city; }
    public function getLinkToPicture():string  { return $this->linkToPicture; }
    public function getLogoImageHtmlName():string  { return $this->logoImageHtmlName; }
    public function getLogoImageName():string  { return $this->logoImageName; }
    public function getLogoSize():int  { return $this->logoSize; }
    public function getLogoType():string  { return $this->logoType; }
    public function getIdRegion():int  { return $this->idRegion; }
    public function getIdCountry():int  { return $this->idCountry; }
    public function getIdLanguage():int  { return $this->idLanguage; }
    public function getIdUserManager():int  { return $this->idUserManager; }
    public function getNameUserManager():string  { return $this->nameUserManager; }
    public function getFirstNameUserManager():string  { return $this->firstNameUserManager; }
    public function getImgUserManager():string  { return $this->imgUserManager; }
    public function getMailUserManager():string  { return $this->mailUserManager; }
    public function getPhoneUserManager():string  { return $this->phoneUserManager; }
    public function getMobileUserManager():string  { return $this->mobileUserManager; }
    public function getIdStyEnterpriseParent():int  { return $this->idStyEnterpriseParent; }
    public function getStatut():int  { return $this->statut; }
    public function getTimestamp():int  { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setEmail(string $email) { $this->email = $email; }
    public function setPhone(string $phone) { $this->phone = $phone; }
    public function setMobile(string $mobile) { $this->mobile = $mobile; }
    public function setCo(string $co) { $this->co = $co; }
    public function setStreet(string $street) { $this->street = $street; }
    public function setZipCode(string $zipCode) { $this->zipCode = $zipCode; }
    public function setCity(string $city) { $this->city = $city; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setLogoImageHtmlName(string $logoImageHtmlName) { $this->logoImageHtmlName = $logoImageHtmlName; }
    public function setLogoImageName(string $logoImageName) { $this->logoImageName = $logoImageName; }
    public function setLogoSize(int $logoSize) { $this->logoSize = $logoSize; }
    public function setLogoType(string $logoType) { $this->logoType = $logoType; }
    public function setIdRegion(int $idRegion) { $this->idRegion = $idRegion; }
    public function setIdCountry(int $idCountry) { $this->idCountry = $idCountry; }
    public function setIdLanguage(int $idLanguage) { $this->idLanguage = $idLanguage; }
    public function setIdUserManager(int $idUserManager) { $this->idUserManager = $idUserManager; }
    public function setNameUserManager(string $nameUserManager) { $this->nameUserManager = $nameUserManager; }
    public function setFirstNameUserManager(string $firstNameUserManager) { $this->firstNameUserManager = $firstNameUserManager; }
    public function setImgUserManager(string $imgUserManager) { $this->imgUserManager = $imgUserManager; }
    public function setMailUserManager(string $mailUserManager) { $this->mailUserManager = $mailUserManager; }
    public function setPhoneUserManager(string $phoneUserManager) { $this->phoneUserManager = $phoneUserManager; }
    public function setMobileUserManager(string $mobileUserManager) { $this->mobileUserManager = $mobileUserManager; }
    public function setIdStyEnterpriseParent(int $idStyEnterpriseParent) { $this->idStyEnterpriseParent = $idStyEnterpriseParent; }
    public function setStatut(int $statut) { $this->statut = $statut; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
