<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyLanguageData", false)) {
  class DistriXStyLanguageData extends DistriXSvcAppData
  {
    protected $id;
    protected $code;
    protected $description;
    protected $linkToPicture;
    protected $size;
    protected $type;
    protected $status;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->code           = "";
      $this->description    = "";
      $this->linkToPicture  = "";
      $this->size           = 0;
      $this->type           = "";
      $this->status         = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId()
    {
      return $this->id;
    }
    public function getCode()
    {
      return $this->code;
    }
    public function getDescription()
    {
      return $this->description;
    }
    public function getLinkToPicture()
    {
      return $this->linkToPicture;
    }
    public function getSize()
    {
      return $this->size;
    }
    public function getType()
    {
      return $this->type;
    }
    public function getStatus()
    {
      return $this->status;
    }
    public function getTimestamp()
    {
      return $this->timestamp;
    }

    // Sets
    public function setId($id)
    {
      $this->id = $id;
    }
    public function setCode($code)
    {
      $this->code = $code;
    }
    public function setDescription($description)
    {
      $this->description = $description;
    }
    public function setLinkToPicture($linkToPicture)
    {
      $this->linkToPicture = $linkToPicture;
    }
    public function setSize($size)
    {
      $this->size = $size;
    }
    public function setType($type)
    {
      $this->type = $type;
    }
    public function setStatus($status)
    {
      $this->status = $status;
    }
    public function setTimestamp($timestamp)
    {
      $this->timestamp = $timestamp;
    }
  }
  // End of class
}
// class_exists
