<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerSentData", false)) {
  class DistriXDeployerSentData extends DistriXSvcAppData
  {
    protected $senderServerAdress;
    protected $senderServerDirectory;
    protected $receiverServerAdress;
    protected $receiverServerDirectory;
    protected $path;
    protected $file;
    protected $content;

    public function __construct()
    {
      $this->senderServerAdress       = "";
      $this->receiverServerAdress     = "";
      $this->path                     = "";
      $this->file                     = "";
      $this->content                  = "";
    }
    // Gets
    public function getSenderServerAdress(): string
    {
      return $this->senderServerAdress;
    }
    public function getSenderServerDirectory(): string
    {
      return $this->senderServerDirectory;
    }
    public function getReceiverServerAdress(): string
    {
      return $this->receiverServerAdress;
    }
    public function getReceiverServerDirectory(): string
    {
      return $this->receiverServerDirectory;
    }
    public function getPath(): string
    {
      return $this->path;
    }
    public function getFile(): string
    {
      return $this->file;
    }
    public function getContent(): string
    {
      return $this->content;
    }
    // Sets
    public function setSenderServerAdress(string $senderServerAdress)
    {
      $this->senderServerAdress = $senderServerAdress;
    }
    public function setSenderServerDirectory(string $senderServerDirectory)
    {
      $this->senderServerDirectory = $senderServerDirectory;
    }
    public function setReceiverServerAdress(string $receiverServerAdress)
    {
      $this->receiverServerAdress = $receiverServerAdress;
    }
    public function setReceiverServerDirectory(string $receiverServerDirectory)
    {
      $this->receiverServerDirectory = $receiverServerDirectory;
    }
    public function setPath(string $path)
    {
      $this->path = $path;
    }
    public function setFile(string $file)
    {
      $this->file = $file;
    }
    public function setContent(string $content)
    {
      $this->content = $content;
    }
  }
  // End of class
}
// class_exists
