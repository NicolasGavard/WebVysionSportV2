<?php // Needed to encode in UTF8 ààéàé //
class EnterpriseStorData {
  const ENTERPRISE_STATUS_AVAILABLE     = 0;
  const ENTERPRISE_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $code;
  private $name;
  private $email;
  private $phone;
  private $mobile;
  private $co;
  private $street;
  private $zipcode;
  private $city;
  private $logoimage;
  private $logoimagehtmlname;
  private $logoimagename;
  private $logosize;
  private $logotype;
  private $idregion;
  private $idcountry;
  private $idlanguage;
  private $idusermanager;
  private $identerpriseparent;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->email = "";
      $this->phone = "";
      $this->mobile = "";
      $this->co = "";
      $this->street = "";
      $this->zipcode = "";
      $this->city = "";
      $this->logoimage = "";
      $this->logoimagehtmlname = "";
      $this->logoimagename = "";
      $this->logosize = 0;
      $this->logotype = "";
      $this->idregion = 0;
      $this->idcountry = 0;
      $this->idlanguage = 0;
      $this->idusermanager = 0;
      $this->identerpriseparent = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getCode() { return $this->code; }
  public function getName() { return $this->name; }
  public function getEmail() { return $this->email; }
  public function getPhone() { return $this->phone; }
  public function getMobile() { return $this->mobile; }
  public function getCo() { return $this->co; }
  public function getStreet() { return $this->street; }
  public function getZipCode() { return $this->zipcode; }
  public function getCity() { return $this->city; }
  public function getLogoImage() { return $this->logoimage; }
  public function getLogoImageHtmlName() { return $this->logoimagehtmlname; }
  public function getLogoImageName() { return $this->logoimagename; }
  public function getLogoSize() { return $this->logosize; }
  public function getLogoType() { return $this->logotype; }
  public function getIdRegion() { return $this->idregion; }
  public function getIdCountry() { return $this->idcountry; }
  public function getIdLanguage() { return $this->idlanguage; }
  public function getIdUserManager() { return $this->idusermanager; }
  public function getIdEnterpriseParent() { return $this->identerpriseparent; }
  public function getStatus() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::ENTERPRISE_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::ENTERPRISE_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::ENTERPRISE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setCode($code) { $this->code = $code; }
  public function setName($name) { $this->name = $name; }
  public function setEmail($email) { $this->email = $email; }
  public function setPhone($phone) { $this->phone = $phone; }
  public function setMobile($mobile) { $this->mobile = $mobile; }
  public function setCo($co) { $this->co = $co; }
  public function setStreet($street) { $this->street = $street; }
  public function setZipCode($zipCode) { $this->zipcode = $zipCode; }
  public function setCity($city) { $this->city = $city; }
  public function setLogoImage($logoImage) { $this->logoimage = $logoImage; }
  public function setLogoImageHtmlName($logoImageHtmlName) { $this->logoimagehtmlname = $logoImageHtmlName; }
  public function setLogoImageName($logoImageName) { $this->logoimagename = $logoImageName; }
  public function setLogoSize($logoSize) { $this->logosize = $logoSize; }
  public function setLogoType($logoType) { $this->logotype = $logoType; }
  public function setIdRegion($idRegion) { $this->idregion = $idRegion; }
  public function setIdCountry($idCountry) { $this->idcountry = $idCountry; }
  public function setIdLanguage($idLanguage) { $this->idlanguage = $idLanguage; }
  public function setIdUserManager($idUserManager) { $this->idusermanager = $idUserManager; }
  public function setIdEnterpriseParent($idEnterpriseParent) { $this->identerpriseparent = $idEnterpriseParent; }
  public function setStatus($status) { $this->statut = $status; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::ENTERPRISE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::ENTERPRISE_STATUS_NOT_AVAILABLE; }
}
