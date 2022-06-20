<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerElementData", false)) {
  class DistriXDeployerElementData extends DistriXSvcAppData
  {
    protected $element;
    protected $toDeploy;
    protected $transferElements;
    protected $excludeElements;
    protected $discoveringCompleted;
    protected $senderCompleted;
    protected $receiverCompleted;

    public function __construct()
    {
      $this->element = null;
      $this->toDeploy = false;
      $this->transferElements = [];
      $this->excludeElements = [];
      $this->discoveringCompleted = false;
      $this->senderCompleted = false;
      $this->receiverCompleted = false;
    }
    // Gets
    public function getElement()
    {
      return $this->element;
    }
    public function getToDeploy(): bool
    {
      return $this->toDeploy;
    }
    public function getTransferElements(): array
    {
      return $this->transferElements;
    }
    public function getExcludeElements(): array
    {
      return $this->excludeElements;
    }
    public function getDiscoveringCompleted(): bool
    {
      return $this->discoveringCompleted;
    }
    public function getSenderCompleted(): bool
    {
      return $this->senderCompleted;
    }
    public function getReceiverCompleted(): bool
    {
      return $this->receiverCompleted;
    }

    // Sets
    public function setElement($element)
    {
      $this->element = $element;
    }
    public function setToDeploy(bool $toDeploy)
    {
      $this->toDeploy = $toDeploy;
    }
    public function setTransferElements(array $transferElements)
    {
      $this->transferElements = $transferElements;
    }
    public function setExcludeElements(array $excludeElements)
    {
      $this->excludeElements = $excludeElements;
    }
    public function setDiscoveringCompleted(bool $discoveringCompleted)
    {
      $this->discoveringCompleted = $discoveringCompleted;
    }
    public function setSenderCompleted(bool $senderCompleted)
    {
      $this->senderCompleted = $senderCompleted;
    }
    public function setReceiverCompleted(bool $receiverCompleted)
    {
      $this->receiverCompleted = $receiverCompleted;
    }
  }
  // End of class
}
// class_exists
