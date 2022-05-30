<?php // Needed to encode in UTF8 ààéàé //
class FoodWeightStorData extends DistriXSvcAppData {
  const FOODWEIGHT_STATUS_AVAILABLE     = 0;
  const FOODWEIGHT_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idfood;
  protected $idweighttype;
  protected $weight;
  protected $linktopicture;
  protected $size;
  protected $type;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idfood = 0;
      $this->idweighttype = 0;
      $this->weight = "";
      $this->linktopicture = "";
      $this->size = 0;
      $this->type = "";
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdFood():int { return $this->idfood; }
  public function getIdWeightType():int { return $this->idweighttype; }
  public function getWeight():string { return $this->weight; }
  public function getLinkToPicture():string { return $this->linktopicture; }
  public function getSize():int { return $this->size; }
  public function getType():string { return $this->type; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():int { return ($this->elemstate == self::FOODWEIGHT_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::FOODWEIGHT_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::FOODWEIGHT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdFood(int $idFood) { $this->idfood = $idFood; }
  public function setIdWeightType(int $idWeightType) { $this->idweighttype = $idWeightType; }
  public function setWeight(string $weight) { $this->weight = $weight; }
  public function setLinkToPicture(string $linkToPicture) { $this->linktopicture = $linkToPicture; }
  public function setSize(int $size) { $this->size = $size; }
  public function setType(string $type) { $this->type = $type; }
  public function setElemState(int $elemstate) { $this->elemstate = $elemstate; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::FOODWEIGHT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::FOODWEIGHT_STATUS_NOT_AVAILABLE; }
}
