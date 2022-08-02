<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXCdnData", false)) {
  class DistriXCdnData extends DistriXSvcAppData
  {
    protected $image;
    protected $imageFamily;
    protected $imageGroup;
    protected $imageName;
    protected $imageType;
    protected $imageUrl;

    public function __construct()
    {
      $this->image       = "";
      $this->imageFamily = "";
      $this->imageGroup  = "";
      $this->imageName   = "";
      $this->imageType   = "";
      $this->imageUrl    = "";
    }
    // Gets
    public function getImage(): string
    {
      return $this->image;
    }
    public function getImageFamily(): string
    {
      return $this->imageFamily;
    }
    public function getImageGroup(): string
    {
      return $this->imageGroup;
    }
    public function getImageName(): string
    {
      return $this->imageName;
    }
    public function getImageType(): string
    {
      return $this->imageType;
    }
    public function getImageUrl(): string
    {
      return $this->imageUrl;
    }
    // Sets
    public function setImage(string $image)
    {
      $this->image = $image;
    }
    public function setImageFamily(string $imageFamily)
    {
      $this->imageFamily = $imageFamily;
    }
    public function setImageGroup(string $imageGroup)
    {
      $this->imageGroup = $imageGroup;
    }
    public function setImageName(string $imageName)
    {
      $this->imageName = $imageName;
    }
    public function setImageType(string $imageType)
    {
      $this->imageType = $imageType;
    }
    public function setImageUrl(string $imageUrl)
    {
      $this->imageUrl = $imageUrl;
    }
  }
  // End of class
}
// class_exists
