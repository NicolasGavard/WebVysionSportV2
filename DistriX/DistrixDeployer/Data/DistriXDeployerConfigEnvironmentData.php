<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerConfigEnvironmentData", false)) {
  class DistriXDeployerConfigEnvironmentData extends DistriXSvcAppData
  {
    protected $environment;
    protected $sender;
    protected $receiver;

    public function __construct()
    {
      $this->environment  = "";
      $this->sender       = "";
      $this->receiver     = "";
    }
    // Gets
    public function getEnvironment(): string
    {
      return $this->environment;
    }
    public function getSender(): string
    {
      return $this->sender;
    }
    public function getReceiver(): string
    {
      return $this->receiver;
    }
    
    // Sets
    public function setEnvironment(string $environment)
    {
      $this->environment = $environment;
    }
    public function setSender(string $sender)
    {
      $this->sender = $sender;
    }
    public function setReceiver(string $receiver)
    {
      $this->receiver = $receiver;
    }
  }
  // End of class
}
// class_exists
