<?php // Needed to encode in UTF8 ààéàé //
class DietTemplateStorData {
  const DIETTEMPLATE_STATUS_AVAILABLE     = 0;
  const DIETTEMPLATE_STATUS_NOT_AVAILABLE = 1;

  private $id;
  private $iduser;
  private $name;
  private $duration;
  private $tags;
  private $statut;
  private $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->iduser = 0;
      $this->name = "";
      $this->duration = 0;
      $this->tags = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId() { return $this->id; }
  public function getIdUser() { return $this->iduser; }
  public function getName() { return $this->name; }
  public function getDuration() { return $this->duration; }
  public function getTags() { return $this->tags; }
  public function getStatut() { return $this->statut; }
  public function getTimestamp() { return $this->timestamp; }
  public function isAvailable() { return ($this->statut == self::DIETTEMPLATE_STATUS_AVAILABLE); }
  public function getAvailableValue() { return self::DIETTEMPLATE_STATUS_AVAILABLE; }
  public function getUnavailableValue() { return self::DIETTEMPLATE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId($id) { $this->id = $id; }
  public function setIdUser($idUser) { $this->iduser = $idUser; }
  public function setName($name) { $this->name = $name; }
  public function setDuration($duration) { $this->duration = $duration; }
  public function setTags($tags) { $this->tags = $tags; }
  public function setStatut($statut) { $this->statut = $statut; }
  public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::DIETTEMPLATE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::DIETTEMPLATE_STATUS_NOT_AVAILABLE; }
}
