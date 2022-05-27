<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodLabelData", false)) {
  class DistriXFoodLabelData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $name;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $elemstate;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->code           = "";
      $this->name           = "";
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->elemstate         = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId() { return $this->id; }
    public function getCode() { return $this->code; }
    public function getName() { return $this->name; }
    public function getLinkToPicture() { return $this->linkToPicture; }
    public function getSize() { return $this->size; }
    public function getType() { return $this->type; }
    public function getElemState() { return $this->elemstate; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setCode($code) { $this->code = $code; }
    public function setName($name) { $this->name = $name; }
    public function setLinkToPicture($linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize($size) { $this->size = $size; }
    public function setType($type) { $this->type = $type; }
    public function setElemState($elemstate) { $this->elemstate = $elemstate; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
