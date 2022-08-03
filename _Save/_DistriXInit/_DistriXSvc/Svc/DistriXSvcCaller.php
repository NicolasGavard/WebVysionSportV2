<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXSvcCaller', false)) {
  class DistriXSvcCaller
  {
    protected $serverAddress;
    protected $serverSslInfo;
    protected $serverSslPath;
    protected $serverCall;
    protected $serverDirectory;
    protected $serverTimeoutSeconds;
    protected $serverTimeoutAddress;
    protected $serverTimeoutCall;
    protected $serverTimeoutDirectory;
    protected $genericServiceName;
    protected $serviceName;
    protected $methodName;
    protected $apiToken;
    protected $secretKey;
    protected $parameters;
    protected $layerData;
    protected $debugMode;

    public function __construct($svcCaller = null)
    {
      $this->serverAddress          = "";
      $this->serverCall             = "";
      $this->serverSslInfo          = "";
      $this->serverSslPath          = "";
      $this->serverDirectory        = "";
      $this->serverTimeoutSeconds   = 0;
      $this->serverTimeoutAddress   = "";
      $this->serverTimeoutCall      = "";
      $this->serverTimeoutDirectory = "";
      // $this->genericServiceName     = "DistriX/DistriXSvc/DistriXServices.php";
      $this->genericServiceName     = "DistriXSvc/DistriXServices.php";
      $this->serviceName            = "";
      $this->methodName             = "";
      $this->apiToken               = null;
      $this->secretKey              = "";
      $this->parameters             = [];
      $this->layerData              = null;
      $this->debugMode              = DISTRIX_SVC_NO_LAYER_NOT_IN_DEBUG_MODE;

      if (is_subclass_of($svcCaller, "DistriXSvcBase")) {
        $this->setServiceName($svcCaller->getServiceName());
        $this->setMethodName($svcCaller->getMethodName());
        $this->setApiToken($svcCaller->getApiToken());
        $this->setSecretKey($svcCaller->getSecretKey());
        $this->setLayerData($svcCaller->getRawLayerData());
        $this->setDebugMode($svcCaller->getDebugMode());
        $this->setParameters($svcCaller->getRawParameters());
      }
    }
    // Get's
    public function getServerAddress()
    {
      return $this->serverAddress;
    }
    public function getServerTimeoutAddress()
    {
      return $this->serverTimeoutAddress;
    }
    public function getServerCall()
    {
      return $this->serverCall;
    }
    public function getServerTimeoutSeconds()
    {
      return $this->serverTimeoutSeconds;
    }
    public function getServerTimeoutCall()
    {
      return $this->serverTimeoutCall;
    }
    public function getServerDirectory()
    {
      return $this->serverDirectory;
    }
    public function getServerTimeoutDirectory()
    {
      return $this->serverTimeoutDirectory;
    }
    public function getServerSslInfo()
    {
      return $this->serverSslInfo;
    }
    public function getServerSslPath()
    {
      return $this->serverSslPath;
    }
    public function getGenericServiceName()
    {
      return $this->genericServiceName;
    }
    public function getServiceName()
    {
      return $this->serviceName;
    }
    public function getMethodName()
    {
      return $this->methodName;
    }
    public function getApiToken()
    {
      return $this->apiToken;
    }
    public function getSecretKey()
    {
      return $this->secretKey;
    }
    public function getParameters()
    {
      return $this->parameters;
    }
    public function getLayerData()
    {
      return $this->layerData;
    }
    public function getDebugMode()
    {
      return $this->debugMode;
    }

    // Set's
    public function setServerAddress($serverAddress)
    {
      $this->serverAddress = $serverAddress;
    }
    public function setServerTimeoutAddress($serverTimeoutAddress)
    {
      $this->serverTimeoutAddress = $serverTimeoutAddress;
    }
    public function setServerCall($serverCall)
    {
      $this->serverCall = $serverCall;
    }
    public function setServerTimeoutSeconds($serverTimeoutSeconds)
    {
      $this->serverTimeoutSeconds = $serverTimeoutSeconds;
    }
    public function setServerTimeoutCall($serverTimeoutCall)
    {
      $this->serverTimeoutCall = $serverTimeoutCall;
    }
    public function setServerDirectory($serverDirectory)
    {
      $this->serverDirectory = $serverDirectory;
    }
    public function setServerTimeoutDirectory($serverTimeoutDirectory)
    {
      $this->serverTimeoutDirectory = $serverTimeoutDirectory;
    }
    public function setServerSslInfo($serverSslInfo)
    {
      $this->serverSslInfo = $serverSslInfo;
    }
    public function setServerSslPath($serverSslPath)
    {
      $this->serverSslPath = $serverSslPath;
    }
    public function setGenericServiceName($genericServiceName)
    {
      $this->genericServiceName = $genericServiceName;
    }
    public function setServiceName($serviceName)
    {
      $this->serviceName = $serviceName;
    }
    public function setMethodName($methodName)
    {
      $this->methodName = $methodName;
    }
    public function setApiToken($apiToken)
    {
      $this->apiToken = $apiToken;
    }
    public function setSecretKey($secretKey)
    {
      $this->secretKey = $secretKey;
    }
    public function setParameters($parameters)
    {
      $this->parameters = $parameters;
    }
    public function addParameter($name, $value)
    {
      $this->parameters["$name"] = $value;
    }
    public function setLayerData($value)
    {
      $this->layerData = $value;
    }
    public function setDebugMode($debugMode)
    {
      if (is_numeric($debugMode)) {
        $this->debugMode = $debugMode;
      }
    }
    public function setDebugModeAllLayerOn()
    {
      $this->debugMode = DISTRIX_SVC_ALL_LAYERS_IN_DEBUG_MODE;
    }
    public function setDebugModeAllLayerOff()
    {
      $this->debugMode = DISTRIX_SVC_NO_LAYER_NOT_IN_DEBUG_MODE;
    }
    public function setDebugModeBusLayerOn()
    {
      if ($this->debugMode < DISTRIX_SVC_BUS_LAYER_IN_DEBUG_MODE) {
        $this->debugMode += DISTRIX_SVC_BUS_LAYER_IN_DEBUG_MODE;
      }
    }
    public function setDebugModeBusLayerOff()
    {
      if ($this->debugMode >= DISTRIX_SVC_BUS_LAYER_IN_DEBUG_MODE) {
        $this->debugMode -= DISTRIX_SVC_BUS_LAYER_IN_DEBUG_MODE;
      }
    }
    public function setDebugModeDataLayerOn()
    {
      if ($this->debugMode < DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE) {
        $this->debugMode += DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE;
      }
    }
    public function setDebugModeDataLayerOff()
    {
      if ($this->debugMode >= DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE) {
        $this->debugMode -= DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE;
      }
    }

    // call
    public function call()
    {
      $output    = null;
      $outputok  = false;
      $errorData = null;

      $parallel = new DistriXSvc();
      $parallel->addToCall("DistriXMyOnlyOneService", $this);
      $callsOk = $parallel->call();
      list($outputok, $output, $errorData) = $parallel->getResult("DistriXMyOnlyOneService");
      return array($outputok, $output, $errorData);
    }
  }
  // End of Class
}
// class_exists
