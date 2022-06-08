<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodBrandData", false)) {
  class DistriXFoodBrandData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $name;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->code           = "";
      $this->name           = "";
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getCode():string { return $this->code; }
    public function getName():string { return $this->name; }
    public function getLinkToPicture():string { return $this->linkToPicture; }
    public function getSize():int { return $this->size; }
    public function getType():string { return $this->type; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
