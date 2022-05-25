<?php // Needed to encode in UTF8 ààéàé //
//
// Version : 1-01
//
// 17 Nov 21
// - Renamed to PHP_D_SvcCallerSvc

if (!class_exists('PHP_D_SvcCaller', false)) {
  class PHP_D_SvcCaller
  {
    const CURL_TIMEOUT_ERROR_NUMBER = 28;

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
      $this->genericServiceName     = "PHP_D_Svc/SvcGeneric/PHP_D_SvcGeneric.php";
      $this->serviceName            = "";
      $this->methodName             = "";
      $this->parameters             = array();
      $this->layerData              = null;
      $this->debugMode              = PHP_D_SVC_NO_LAYER_NOT_IN_DEBUG_MODE;

      if (is_subclass_of($svcCaller, "PHP_D_SvcBase")) {
        $this->setServiceName($svcCaller->getServiceName());
        $this->setMethodName($svcCaller->getMethodName());
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
      if (is_numeric($debugMode)) $this->debugMode = $debugMode;
    }
    public function setDebugModeAllLayerOn()
    {
      $this->debugMode = PHP_D_SVC_ALL_LAYERS_IN_DEBUG_MODE;
    }
    public function setDebugModeAllLayerOff()
    {
      $this->debugMode = PHP_D_SVC_NO_LAYER_NOT_IN_DEBUG_MODE;
    }
    public function setDebugModeBusLayerOn()
    {
      if ($this->debugMode < PHP_D_SVC_BUS_LAYER_IN_DEBUG_MODE)
        $this->debugMode += PHP_D_SVC_BUS_LAYER_IN_DEBUG_MODE;
    }
    public function setDebugModeBusLayerOff()
    {
      if ($this->debugMode >= PHP_D_SVC_BUS_LAYER_IN_DEBUG_MODE)
        $this->debugMode -= PHP_D_SVC_BUS_LAYER_IN_DEBUG_MODE;
    }
    public function setDebugModeDataLayerOn()
    {
      if ($this->debugMode < PHP_D_SVC_DATA_LAYER_IN_DEBUG_MODE)
        $this->debugMode += PHP_D_SVC_DATA_LAYER_IN_DEBUG_MODE;
    }
    public function setDebugModeDataLayerOff()
    {
      if ($this->debugMode >= PHP_D_SVC_DATA_LAYER_IN_DEBUG_MODE)
        $this->debugMode -= PHP_D_SVC_DATA_LAYER_IN_DEBUG_MODE;
    }

    private function callServer($curladdress)
    {
      $outputok = false;
      $output = null;
      $error = "";
      $errorData = null;
      $timeoutError = false;

      $ch = curl_init($curladdress);
      if ($ch !== FALSE) {
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($this->getServerTimeoutSeconds() > 0)
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->getServerTimeoutSeconds());

        //SSL
        if (strpos($this->getServerCall(), "https") !== FALSE) {
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
          // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
          // curl_setopt($ch, CURLOPT_CAINFO, $this->getServerSslInfo());
          // curl_setopt($ch, CURLOPT_CAPATH, $this->getServerSslPath());
        }
        $curlfields_string = "";
        $curlfields_string .= PHP_D_SVC_RESPONSE_SERVICE_NAME_PARAMETER . "=" . urlencode($this->getServiceName()) . "&";
        $curlfields_string .= PHP_D_SVC_RESPONSE_METHOD_NAME_PARAMETER . "=" . urlencode($this->getMethodName()) . "&";
        $layerData = $this->getLayerData();
        if (!is_string($layerData)) $layerData = serialize($layerData);
        $curlfields_string .= PHP_D_SVC_RESPONSE_LAYER_DATA_PARAMETER . "=" . urlencode($layerData) . "&";
        $curlfields_string .= PHP_D_SVC_RESPONSE_DEBUG_MODE_PARAMETER . "=" . urlencode($this->getDebugMode()) . "&";
        if (!empty($this->parameters)) {
          foreach ($this->parameters as $key => $value) {
            if (!is_string($value)) $value = serialize($value);
            $curlfields_string .= $key . "=" . urlencode($value) . "&";
          }
        }
        $curlfields_string = rtrim($curlfields_string, '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlfields_string);

        // grab URL and pass it to the browser
        $output = curl_exec($ch);
        if ($output !== false) {
          $outputok = true;

          if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != '200') {
            $outputok = false;
            $error .= "Error " . $this->serviceName . " Call Number : " . curl_errno($ch) . "<br>";
            $error .= "Error HTTP return code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "<br>";
            $error .= "Error Call String : " . $output;

            // $errorData = new DjangoSvcErrorData();
            // $errorData->setErrorTypeSystem();
            // $errorData->setErrorSeverityCritical();
            // $errorData->setErrorCode(DJANGO_SVC_ERROR_RESPONSE);
            // $errorData->setErrorTextToAllText($error);
          }
        } else {
          $outputok = false;
          $error .= "Error " . $this->serviceName . " Call Number : " . curl_errno($ch) . "<br>";
          $timeoutError = (curl_errno($ch) == self::CURL_TIMEOUT_ERROR_NUMBER);
          $error .= "Error Call String : " . curl_error($ch);

          // $errorData = new DjangoSvcErrorData();
          // $errorData->setErrorTypeSystem();
          // $errorData->setErrorSeverityCritical();
          // $errorData->setErrorCode(DJANGO_SVC_ERROR_CALLER);
          // $errorData->setErrorTextToAllText($error);
        }
        // close cURL resource, and free up system resources
        curl_close($ch);
      } else {
        $outputok = false;

        $error .= "Init " . $this->serviceName . " failed <br/>";
        $error .= "Error String : " . $curladdress;

        // $errorData = new DjangoSvcErrorData();
        // $errorData->setErrorTypeSystem();
        // $errorData->setErrorSeverityCritical();
        // $errorData->setErrorCode(DJANGO_SVC_ERROR_CURL_INIT);
        // $errorData->setErrorTextToAllText($error);
      }
      return array($outputok, $output, $errorData, $timeoutError);
    }

    // call
    public function call($wantUsableData)
    {
      $outputok = false;
      $output = null;
      $errorData = null;
      $timeoutError = false;

      $curladdress  = $this->getServerCall() . "://";
      $curladdress .= $this->getServerAddress() . "/" . $this->getServerDirectory() . "/";
      if (strlen($this->getGenericServiceName()) > 0) $curladdress .= $this->getGenericServiceName();

      list($outputok, $output, $errorData, $timeoutError) = $this->callServer($curladdress);
      if ($timeoutError) {
        if (strlen($this->getServerTimeoutCall()) > 0) {
          $curladdress  = $this->getServerTimeoutCall() . "://";
          $curladdress .= $this->getServerTimeoutAddress() . "/" . $this->getServerTimeoutDirectory() . "/";
          if (strlen($this->getGenericServiceName()) > 0) $curladdress .= $this->getGenericServiceName();
          list($outputok, $output, $errorData, $timeoutError) = $this->callServer($curladdress);
        }
      }
      if ($wantUsableData) {
        try {
          $lenOutput = strlen($output);
          for ($indO = 0; $indO < $lenOutput; $indO++) {
            if (ord($output[$indO]) != 10) break;
          }
          $output = substr($output, $indO);

          $oldOutput     = $output;
          $unserOutput   = @unserialize($output);
          if (is_array($unserOutput)) {
            $output = $unserOutput;
            if ($errorData) {
              $outputok = false;
            }
          } else $output = $oldOutput;

          if (is_string($output)) {
            $unserOutput = @json_decode($output, true);
            if (!is_array($unserOutput)) $unserOutput = @unserialize($output);
            if (is_array($unserOutput)) $output = $unserOutput;
          }

          if (is_array($output)) {
            if ($errorData) {
              $outputok = false;
            }
          }
        } catch (Exception $e) {
          $output[SVC_RESPONSE_ERROR] = $e;
          $outputok = false;
        }
      }
      return array($outputok, $output, $errorData);
    }
  }
  // End of Class
}
// class_exists
