<?php // Needed to encode in UTF8 ààéàé //
class RecipeNameStorData extends DistriXSvcAppData {
  const RECIPENAME_STATUS_AVAILABLE     = 0;
  const RECIPENAME_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idrecipe;
  protected $idlanguage;
  protected $name;
  protected $statut;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idrecipe = 0;
      $this->idlanguage = 0;
      $this->name = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdRecipe():int { return $this->idrecipe; }
  public function getIdLanguage():int { return $this->idlanguage; }
  public function getName():string { return $this->name; }
  public function getStatus():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->statut == self::RECIPENAME_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::RECIPENAME_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::RECIPENAME_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdRecipe(int $idRecipe) { $this->idrecipe = $idRecipe; }
  public function setIdLanguage(int $idLanguage) { $this->idlanguage = $idLanguage; }
  public function setName(string $name) { $this->name = $name; }
  public function setStatus(int $status) { $this->statut = $status; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::RECIPENAME_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::RECIPENAME_STATUS_NOT_AVAILABLE; }
}
