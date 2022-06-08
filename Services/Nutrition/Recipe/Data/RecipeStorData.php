<?php // Needed to encode in UTF8 ààéàé //
class RecipeStorData extends DistriXSvcAppData {
  const RECIPE_STATUS_AVAILABLE     = 0;
  const RECIPE_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idusercoach;
  protected $code;
  protected $name;
  protected $description;
  protected $linktopicture;
  protected $size;
  protected $type;
  protected $rating;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idusercoach = 0;
      $this->code = "";
      $this->name = "";
      $this->description = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->rating = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdUserCoach():int { return $this->idusercoach; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getDescription():string { return $this->description; }
  public function getLinkToPicture():string { return $this->linktopicture; }
  public function getSize():int { return $this->size; }
  public function getType():string { return $this->type; }
  public function getRating():int { return $this->rating; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::RECIPE_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::RECIPE_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::RECIPE_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdUserCoach(int $idUserCoach) { $this->idusercoach = $idUserCoach; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setDescription(string $description) { $this->description = $description; }
  public function setLinkToPicture(string $linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize(int $size) { $this->size = $size; }
  public function setType(string $type) { $this->type = $type; }
  public function setRating(int $rating) { $this->rating = $rating; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::RECIPE_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::RECIPE_STATUS_NOT_AVAILABLE; }
}
