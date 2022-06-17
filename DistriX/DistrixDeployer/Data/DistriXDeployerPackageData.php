<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerPackageData", false)) {
  class DistriXDeployerPackageData extends DistriXSvcAppData
  {
    protected $name;
    protected $toDeploy;
    protected $deployerBuild;
    protected $deployerElements;

    public function __construct()
    {
      $this->name                 = "";
      $this->toDeploy             = false;
      $this->deployerBuild        = null;
      $this->deployerElements     = [];
    }
    // Gets
    public function getName(): string
    {
      return $this->name;
    }
    public function getToDeploy(): bool
    {
      return $this->toDeploy;
    }
    public function getDeployerBuild(): array
    {
      return $this->deployerBuild;
    }
    public function getDeployerElements(): array
    {
      return $this->deployerElements;
    }

    // Sets
    public function setName(string $name)
    {
      $this->name = $name;
    }
    public function setToDeploy(bool $toDeploy)
    {
      $this->toDeploy = $toDeploy;
    }
    public function setDeployerBuild($deployerBuild)
    {
      $this->deployerBuild = $deployerBuild;
    }
    public function setDeployerElements(array $deployerElements)
    {
      $this->deployerElements = $deployerElements;
    }
  }
  // End of class
}
// class_exists
