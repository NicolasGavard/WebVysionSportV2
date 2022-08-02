<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerConfigData", false)) {
  class DistriXDeployerConfigData extends DistriXSvcAppData
  {
    protected $buildVersion;
    protected $deploymentTrace;
    protected $maxFilesAtOne;
    protected $maxParallel;
    protected $environments;
    protected $servers;

    public function __construct()
    {
      $this->buildVersion     = false;
      $this->deploymentTrace  = false;
      $this->maxFilesAtOne    = 0;
      $this->maxParallel      = 0;
      $this->environments     = array();
      $this->servers          = array();
    }
    // Gets
    public function getBuildVersion(): bool
    {
      return $this->buildVersion;
    }
    public function getDeploymentTrace(): bool
    {
      return $this->deploymentTrace;
    }
    public function getMaxFilesAtOne(): int
    {
      return $this->maxFilesAtOne;
    }
    public function getMaxParallel(): int
    {
      return $this->maxParallel;
    }
    public function getEnvironments(): array
    {
      return $this->environments;
    }
    public function getServers(): array
    {
      return $this->servers;
    }

    // Sets
    public function setBuildVersion(bool $buildVersion)
    {
      $this->buildVersion = $buildVersion;
    }
    public function setDeploymentTrace(bool $deploymentTrace)
    {
      $this->deploymentTrace = $deploymentTrace;
    }
    public function setMaxFilesAtOne(int $maxFilesAtOne)
    {
      $this->maxFilesAtOne = $maxFilesAtOne;
    }
    public function setMaxParallel(int $maxParallel)
    {
      $this->maxParallel = $maxParallel;
    }
    public function setEnvironments(array $environments)
    {
      $this->environments = $environments;
    }
    public function setServers(array $servers)
    {
      $this->servers = $servers;
    }
  }
  // End of class
}
// class_exists
