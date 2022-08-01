<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerPackageBuildData", false)) {
  class DistriXDeployerPackageBuildData extends DistriXSvcAppData
  {
    protected $toDeploy;
    protected $folderFrom;
    protected $folderTo;
    protected $folderProd;
    protected $version;

    public function __construct()
    {
      $this->toDeploy           = false;
      $this->folderFrom         = "";
      $this->folderTo           = "";
      $this->folderProd         = "";
      $this->version            = "";
    }
    // Gets
    public function getToDeploy(): bool
    {
      return $this->toDeploy;
    }
    public function getFolderFrom(): string
    {
      return $this->folderFrom;
    }
    public function getFolderTo(): string
    {
      return $this->folderTo;
    }
    public function getFolderProd(): string
    {
      return $this->folderProd;
    }
    public function getVersion(): string
    {
      return $this->version;
    }

    // Sets
    public function setToDeploy(bool $toDeploy)
    {
      $this->toDeploy = $toDeploy;
    }
    public function setFolderFrom(string $folderFrom)
    {
      $this->folderFrom = $folderFrom;
    }
    public function setFolderTo(string $folderTo)
    {
      $this->folderTo = $folderTo;
    }
    public function setFolderProd(string $folderProd)
    {
      $this->folderProd = $folderProd;
    }
    public function setVersion(string $version)
    {
      $this->version = $version;
    }
  }
  // End of class
}
// class_exists
