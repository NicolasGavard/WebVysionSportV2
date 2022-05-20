<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerTransferErrorData", false)) {
  class DistriXDeployerTransferErrorData extends DistriXSvcAppData
  {
    protected $code;
    protected $message;

    public function __construct()
    {
      $this->code = 0;
      $this->message = "";
    }
    // Gets
    public function getCode(): int
    {
      return $this->code;
    }
    public function getMessage(): string
    {
      return $this->message;
    }

    // Sets
    public function setCode(int $code)
    {
      $this->code = $code;
    }
    public function setMessage(string $message)
    {
      $this->message = $message;
    }
  }
  // End of class
}
// class_exists
