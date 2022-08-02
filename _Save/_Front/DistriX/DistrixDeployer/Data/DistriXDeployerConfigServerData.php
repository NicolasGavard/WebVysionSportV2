<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerConfigServerData", false)) {
  class DistriXDeployerConfigServerData extends DistriXSvcAppData
  {
    protected $application;
    protected $server;
    protected $folder;
    protected $backup;

    public function __construct()
    {
      $this->application  = "";
      $this->server       = "";
      $this->folder       = "";
      $this->backup       = array();
    }
    // Gets
    public function getApplication(): string
    {
      return $this->application;
    }
    public function getServer(): string
    {
      return $this->server;
    }
    public function getFolder(): string
    {
      return $this->folder;
    }
    public function getBackup(): array
    {
      return $this->backup;
    }
    
    // Sets
    public function setApplication(string $application)
    {
      $this->application = $application;
    }
    public function setServer(string $server)
    {
      $this->server = $server;
    }
    public function setFolder(string $folder)
    {
      $this->folder = $folder;
    }
    public function setBackup(array $backup)
    {
      $this->backup = $backup;
    }
  }
  // End of class
}
// class_exists
