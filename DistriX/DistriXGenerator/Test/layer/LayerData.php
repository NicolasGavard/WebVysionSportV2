<?php // Needed to encode in UTF8 ààéàé //
//
// Data Version : 1-10
//
if (! class_exists('LayerData', false)) {
class LayerData implements Serializable
{
private $idPos;
private $idPlatform;
private $dataVersion;
private $softVersion;
private $idLanguage;
private $idCountry;
private $idCustomer;
private $customerIpAddress;
private $idUser;

public function __construct()
{
  $this->idPos             = 0;
  $this->idPlatform        = 0;
  $this->dataVersion       = "";
  $this->softVersion       = "";
  $this->idLanguage        = 0;
  $this->idCountry         = 0;
  $this->idCustomer        = 0;
  $this->customerIpAddress = "";
  $this->idUser            = 0;
}

// Get's
public function getIdPos() { return $this->idPos; }
public function getIdPlatform() { return $this->idPlatform; }
public function getDataVersion() { return $this->dataVersion; }
public function getSoftVersion() { return $this->softVersion; }
public function getIdLanguage() { return $this->idLanguage; }
public function getIdCountry() { return $this->idCountry; }
public function getIdCustomer() { return $this->idCustomer; }
public function getCustomerIpAddress() { return $this->customerIpAddress; }
public function getIdUser() { return $this->idUser; }

// Set's
public function setIdPos($idPos) { $this->idPos = $idPos; }
public function setIdPlatform($idPlatform) { $this->idPlatform = $idPlatform; }
public function setDataVersion($dataVersion) { $this->dataVersion = $dataVersion; }
public function setSoftVersion($softVersion) { $this->softVersion = $softVersion; }
public function setIdLanguage($idLanguage) { $this->idLanguage = $idLanguage; }
public function setIdCountry($idCountry) { $this->idCountry = $idCountry; }
public function setIdCustomer($idCustomer) { $this->idCustomer = $idCustomer; }
public function setCustomerIpAddress($customerIpAddress) { $this->customerIpAddress = $customerIpAddress; }
public function setIdUser($idUser) { $this->idUser = $idUser; }

public function serialize()
{
  return serialize([
    $this->idPos,
    $this->idPlatform,
    $this->dataVersion,
    $this->softVersion,
    $this->idLanguage,
    $this->idCountry,
    $this->idCustomer,
    $this->customerIpAddress,
    $this->idUser
  ]);
}
public function unserialize($data)
{
  list(
    $this->idPos,
    $this->idPlatform,
    $this->dataVersion,
    $this->softVersion,
    $this->idLanguage,
    $this->idCountry,
    $this->idCustomer,
    $this->customerIpAddress,
    $this->idUser
  ) = unserialize($data);
}
// End of Class
}
// class_exists
}
?>