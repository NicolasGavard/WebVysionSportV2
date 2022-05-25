<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXSvcData", false)) {
  class DistriXSvcData
  {
    private $callerName;
    private $caller;
    private $curlHandle;
    private $outputOk;
    private $content;
    private $errorData;
    private $timeoutError;

    public function __construct($callerName, $caller)
    {
      $this->callerName     = $callerName;
      $this->caller         = $caller;
      $this->curlHandle     = FALSE;
      $this->outputOk       = false;
      $this->content        = null;
      $this->errorData      = null;
      $this->timeoutError   = false;
    }
    // Gets
    public function getCallerName()
    {
      return $this->callerName;
    }
    public function getCaller()
    {
      return $this->caller;
    }
    public function getCurlHandle()
    {
      return $this->curlHandle;
    }
    public function getOutputOk()
    {
      return $this->outputOk;
    }
    public function getContent()
    {
      return $this->content;
    }
    public function getErrorData()
    {
      return $this->errorData;
    }
    public function getTimeoutError()
    {
      return $this->timeoutError;
    }
    //Sets
    public function setCallerName($callerName)
    {
      $this->callerName = $callerName;
    }
    public function setCurlHandle($curlHandle)
    {
      $this->curlHandle = $curlHandle;
    }
    public function setOutputOk($outputOk)
    {
      $this->outputOk = $outputOk;
    }
    public function setCaller($caller)
    {
      $this->caller = $caller;
    }
    public function setContent($content)
    {
      $this->content = $content;
    }
    public function setErrorData($errorData)
    {
      $this->errorData = $errorData;
    }
    public function setTimeoutError($timeoutError)
    {
      $this->timeoutError = $timeoutError;
    }
  }
  // End of class
}
// class_exists
