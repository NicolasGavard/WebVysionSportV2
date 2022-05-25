<?php // Needed to encode in UTF8 ààéàé //
class StyUserStorData
{
  const STYUSER_STATUS_AVAILABLE     = 0;
  const STYUSER_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $idstyusertype;
  private $login;
  private $firstname;
  private $name;
  private $linktopicture;
  private $size;
  private $type;
  private $pass;
  private $email;
  private $emailbackup;
  private $phone;
  private $mobile;
  private $initpass;
  private $idlanguage;
  private $idstyenterprise;
  private $statut;
  private $timestamp;

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
  public function getId()
  {
    return $this->id;
  }
  public function getIdStyUserType()
  {
    return $this->idstyusertype;
  }
  public function getLogin()
  {
    return $this->login;
  }

  public function getFirstName()
  {
    return $this->firstname;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getLinkToPicture()
  {
    return $this->linktopicture;
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
    return $this->emailbackup;
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
    return $this->initpass;
  }
  public function getIdLanguage()
  {
    return $this->idlanguage;
  }
  public function getIdStyEnterprise()
  {
    return $this->idstyenterprise;
  }
  public function getStatus()
  {
    return $this->statut;
  }
  public function getTimestamp()
  {
    return $this->timestamp;
  }
  public function isAvailable()
  {
    return ($this->statut == self::STYUSER_STATUS_AVAILABLE);
  }
  public function getAvailableValue()
  {
    return self::STYUSER_STATUS_AVAILABLE;
  }
  public function getUnavailableValue()
  {
    return self::STYUSER_STATUS_NOT_AVAILABLE;
  }
  // Sets
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setIdStyUserType($idStyUserType)
  {
    $this->idstyusertype = $idStyUserType;
  }
  public function setLogin($login)
  {
    $this->login = $login;
  }
  public function setFirstName($firstName)
  {
    $this->firstname = $firstName;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function setLinkToPicture($linkToPicture)
  {
    $this->linktopicture = $linkToPicture;
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
    $this->emailbackup = $emailBackup;
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
    $this->initpass = $initPass;
  }
  public function setIdLanguage($idLanguage)
  {
    $this->idlanguage = $idLanguage;
  }
  public function setIdStyEnterprise($idStyEnterprise)
  {
    $this->idstyenterprise = $idStyEnterprise;
  }
  public function setStatus($status)
  {
    $this->statut = $status;
  }
  public function setTimestamp($timestamp)
  {
    $this->timestamp = $timestamp;
  }
  public function setAvailable()
  {
    $this->statut = self::STYUSER_STATUS_AVAILABLE;
  }
  public function setUnavailable()
  {
    $this->statut = self::STYUSER_STATUS_NOT_AVAILABLE;
  }
}
