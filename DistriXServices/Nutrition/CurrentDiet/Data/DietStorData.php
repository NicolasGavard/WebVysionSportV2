<?php // Needed to encode in UTF8 ààéàé //
class DietStorData {
  const DIET_STATUS_AVAILABLE     = 0;
  const DIET_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $iduser;
  private $iddiettemplate;
  private $datestart;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->iduser = 0;
      $this->iddiettemplate = 0;
      $this->datestart = 0;
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdUser() { return $this->iduser; }
  public function getIdDietTemplate() { return $this->iddiettemplate; }
  public function getDateStart() { return $this->datestart; }
  public function getStatut() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::DIET_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::DIET_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::DIET_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdUser($idUser) { $this->iduser = $idUser; }
  public function setIdDietTemplate($idDietTemplate) { $this->iddiettemplate = $idDietTemplate; }
  public function setDateStart($dateStart) { $this->datestart = $dateStart; }
  public function setStatut($statut) { $this->statut = $statut; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::DIET_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::DIET_STATUS_NOT_AVAILABLE; }
}
