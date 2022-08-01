<?php // Needed to encode in UTF8 ààéàé //
class StyEnterpriseStorData extends DistriXSvcAppData {
  const ENTERPRISE_STATUS_AVAILABLE     = 0;
  const ENTERPRISE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $name;
  protected $email;
  protected $phone;
  protected $mobile;
  protected $co;
  protected $street;
  protected $zipcode;
  protected $city;
  protected $logoimagehtmlname;
  protected $logoimagename;
  protected $logosize;
  protected $logotype;
  protected $idregion;
  protected $idcountry;
  protected $idlanguage;
  protected $idusermanager;
  protected $idstyenterpriseparent;
  protected $statut;
  protected $timestamp;

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
      $this->logoimagehtmlname = "";
      $this->logoimagename = "";
      $this->logosize = 0;
      $this->logotype = "";
      $this->idregion = 0;
      $this->idcountry = 0;
      $this->idlanguage = 0;
      $this->idusermanager = 0;
      $this->idstyenterpriseparent = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getEmail():string { return $this->email; }
  public function getPhone():string { return $this->phone; }
  public function getMobile():string { return $this->mobile; }
  public function getCo():string { return $this->co; }
  public function getStreet():string { return $this->street; }
  public function getZipCode():string { return $this->zipcode; }
  public function getCity():string { return $this->city; }
  public function getLogoImageHtmlName():string { return $this->logoimagehtmlname; }
  public function getLogoImageName():string { return $this->logoimagename; }
  public function getLogoSize():int { return $this->logosize; }
  public function getLogoType():string { return $this->logotype; }
  public function getIdRegion():int { return $this->idregion; }
  public function getIdCountry():int { return $this->idcountry; }
  public function getIdLanguage():int { return $this->idlanguage; }
  public function getIdUserManager():int { return $this->idusermanager; }
  public function getIdStyEnterpriseParent():int { return $this->idstyenterpriseparent; }
  public function getStatus():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->statut == self::ENTERPRISE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::ENTERPRISE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::ENTERPRISE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setEmail(string $email) { $this->email = $email; }
  public function setPhone(string $phone) { $this->phone = $phone; }
  public function setMobile(string $mobile) { $this->mobile = $mobile; }
  public function setCo(string $co) { $this->co = $co; }
  public function setStreet(string $street) { $this->street = $street; }
  public function setZipCode(string $zipCode) { $this->zipcode = $zipCode; }
  public function setCity(string $city) { $this->city = $city; }
  public function setLogoImageHtmlName(string $logoImageHtmlName) { $this->logoimagehtmlname = $logoImageHtmlName; }
  public function setLogoImageName(string $logoImageName) { $this->logoimagename = $logoImageName; }
  public function setLogoSize(int $logoSize) { $this->logosize = $logoSize; }
  public function setLogoType(string $logoType) { $this->logotype = $logoType; }
  public function setIdRegion(int $idRegion) { $this->idregion = $idRegion; }
  public function setIdCountry(int $idCountry) { $this->idcountry = $idCountry; }
  public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
  public function setIdUserManager(int $idUserManager) { $this->idusermanager = $idUserManager; }
  public function setIdStyEnterpriseParent(int $idStyEnterpriseParent) { $this->idstyenterpriseparent = $idStyEnterpriseParent; }
  public function setStatus(int $status) { $this->statut = $status; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::ENTERPRISE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::ENTERPRISE_STATUS_NOT_AVAILABLE; }
}
