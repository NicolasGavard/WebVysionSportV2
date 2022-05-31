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

    public function __construct()
    {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->email = "";
      $this->phone = 0;
      $this->mobile = 0;
      $this->co = "";
      $this->street = "";
      $this->zipCode = "";
      $this->city = "";
      $this->linkToPicture  = "";
      $this->logoImageHtmlName = "";
      $this->logoImageName = "";
      $this->logoSize = 0;
      $this->logoType = "";
      $this->idRegion = 0;
      $this->idCountry = 0;
      $this->idLanguage = 0;
      $this->idUserManager = 0;
      $this->nameUserManager = "";
      $this->firstNameUserManager = "";
      $this->imgUserManager = "";
      $this->mailUserManager = "";
      $this->phoneUserManager = "";
      $this->mobileUserManager = "";
      $this->idStyEnterpriseParent = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
    // Gets
    public function getId(){return $this->id;}
    public function getCode(){return $this->code;}
    public function getName(){return $this->name;}
    public function getEmail(){return $this->email;}
    public function getPhone(){return $this->phone;}
    public function getMobile(){return $this->mobile;}
    public function getCo(){return $this->co;}
    public function getStreet(){return $this->street;}
    public function getZipCode(){return $this->zipCode;}
    public function getCity(){return $this->city;}
    public function getLinkToPicture(){return $this->linkToPicture;}
    public function getLogoImageHtmlName(){return $this->logoImageHtmlName;}
    public function getLogoImageName(){return $this->logoImageName;}
    public function getLogoSize(){return $this->logoSize;}
    public function getLogoType(){return $this->logoType;}
    public function getIdRegion(){return $this->idRegion;}
    public function getIdCountry(){return $this->idCountry;}
    public function getIdLanguage(){return $this->idLanguage;}
    public function getIdUserManager(){return $this->idUserManager;}
    public function getNameUserManager(){return $this->nameUserManager;}
    public function getFirstNameUserManager(){return $this->firstNameUserManager;}
    public function getImgUserManager(){return $this->imgUserManager;}
    public function getMailUserManager(){return $this->mailUserManager;}
    public function getPhoneUserManager(){return $this->phoneUserManager;}
    public function getMobileUserManager(){return $this->mobileUserManager;}
    public function getIdStyEnterpriseParent(){return $this->idStyEnterpriseParent;}
    public function getStatut(){return $this->statut;}
    public function getTimestamp(){return $this->timestamp;}

    // Sets
    public function setId($id){$this->id = $id;}
    public function setCode($code){$this->code = $code;}
    public function setName($name){$this->name = $name;}
    public function setEmail($email){$this->email = $email;}
    public function setPhone($phone){$this->phone = $phone;}
    public function setMobile($mobile){$this->mobile = $mobile;}
    public function setCo($co){$this->co = $co;}
    public function setStreet($street){$this->street = $street;}
    public function setZipCode($zipCode){$this->zipCode = $zipCode;}
    public function setCity($city){$this->city = $city;}
    public function setLinkToPicture($linkToPicture){$this->linkToPicture = $linkToPicture;}
    public function setLogoImageHtmlName($logoImageHtmlName){$this->logoImageHtmlName = $logoImageHtmlName;}
    public function setLogoImageName($logoImageName){$this->logoImageName = $logoImageName;}
    public function setLogoSize($logoSize){$this->logoSize = $logoSize;}
    public function setLogoType($logoType){$this->logoType = $logoType;}
    public function setIdRegion($idRegion){$this->idRegion = $idRegion;}
    public function setIdCountry($idCountry){$this->idCountry = $idCountry;}
    public function setIdLanguage($idLanguage){$this->idLanguage = $idLanguage;}
    public function setIdUserManager($idUserManager){$this->idUserManager = $idUserManager;}
    public function setNameUserManager($nameUserManager){$this->nameUserManager = $nameUserManager;}
    public function setFirstNameUserManager($firstNameUserManager){$this->firstNameUserManager = $firstNameUserManager;}
    public function setImgUserManager($imgUserManager){$this->imgUserManager = $imgUserManager;}
    public function setMailUserManager($mailUserManager){$this->mailUserManager = $mailUserManager;}
    public function setPhoneUserManager($phoneUserManager){$this->phoneUserManager = $phoneUserManager;}
    public function setMobileUserManager($mobileUserManager){$this->mobileUserManager = $mobileUserManager;}
    public function setIdStyEnterpriseParent($idStyEnterpriseParent){$this->idStyEnterpriseParent = $idStyEnterpriseParent;}
    public function setStatut($statut){$this->statut = $statut;}
    public function setTimestamp($timestamp){$this->timestamp = $timestamp;}
  }
  // End of class
}
// class_exists
