<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodWeightData", false)) {
  class DistriXFoodWeightData extends DistriXSvcAppData
  {
    protected $id;
    protected $idFood;
    protected $idWeightType;
    protected $nameWeightType;
    protected $weight;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $elemstate;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idFood         = 0;
      $this->idWeightType   = 0;
      $this->nameWeightType = '';
      $this->weight         = 0.0;
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->elemstate         = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdFood() { return $this->idFood; }
    public function getIdWeightType() { return $this->idWeightType; }
    public function getNameWeightType() { return $this->nameWeightType; }
    public function getWeight() { return $this->weight; }
    public function getLinkToPicture() { return $this->linkToPicture; }
    public function getSize() { return $this->size; }
    public function getType() { return $this->type; }
    public function getElemState() { return $this->elemstate; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdFood($idFood) { $this->idFood = $idFood; }
    public function setIdWeightType($idWeightType) { $this->idWeightType = $idWeightType; }
    public function setNameWeightType($nameWeightType) { $this->nameWeightType = $nameWeightType; }
    public function setWeight($weight) { $this->weight = $weight; }
    public function setLinkToPicture($linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize($size) { $this->size = $size; }
    public function setType($type) { $this->type = $type; }
    public function setElemState($elemstate) { $this->elemstate = $elemstate; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
