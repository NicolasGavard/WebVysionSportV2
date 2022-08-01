<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerData", false)) {
  class DistriXDeployerData extends DistriXSvcAppData
  {
    protected $deploymentFile;
    protected $environmentToDeploy;
    protected $moduleName;
    protected $deployerPackages;

    public function __construct()
    {
      $this->deploymentFile       = "";
      $this->environmentToDeploy  = "";
      $this->moduleName           = "";
      $this->deployerPackages     = array();
    }
    // Gets
    public function getDeploymentFile(): string
    {
      return $this->deploymentFile;
    }
    public function getEnvironmentToDeploy(): string
    {
      return $this->environmentToDeploy;
    }
    public function getModuleName(): string
    {
      return $this->moduleName;
    }
    public function getDeployerPackages(): array
    {
      return $this->deployerPackages;
    }

    // Sets
    public function setDeploymentFile(string $deploymentFile)
    {
      $this->deploymentFile = $deploymentFile;
    }
    public function setEnvironmentToDeploy(string $environmentToDeploy)
    {
      $this->environmentToDeploy = $environmentToDeploy;
    }
    public function setModuleName(string $moduleName)
    {
      $this->moduleName = $moduleName;
    }
    public function setDeployerPackages(array $deployerPackages)
    {
      $this->deployerPackages = $deployerPackages;
    }
  }
  // End of class
}
// class_exists
