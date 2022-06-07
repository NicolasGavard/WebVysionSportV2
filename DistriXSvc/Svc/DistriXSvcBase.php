<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXSvcBase', false)) {
  class DistriXSvcBase
  {
    protected $serverSslInfo;
    protected $serverSslPath;
    protected $serviceName;
    protected $methodName;
    protected $apiToken;
    protected $secretKey;
    protected $layerData;
    protected $response;
    protected $parameters;
    protected $svcDebugMode;
    protected $svcDebugBuffer;
    protected $jsonCall;
    private   $isAuthorized;

    public function __construct()
    {
      $this->serverSslInfo  = "";
      $this->serverSslPath  = "";
      $this->serviceName    = "";
      $this->methodName     = "";
      $this->apiToken       = null;
      $this->secretKey      = "";
      $this->layerData      = new DistriXSvcLayerData();
      $this->response       = [];
      $this->parameters     = [];
      $this->svcDebugMode   = DISTRIX_SVC_NO_LAYER_NOT_IN_DEBUG_MODE;
      $this->svcDebugBuffer = "";
      $this->jsonCall       = false;
      $this->isAuthorized   = $this->validateAuthorization();
      if ($this->isAuthorized()) {
        $this->getInputParameters();
      }
      if ($this->isAuthorized() && strlen($this->getSecretKey())) {
        $this->isAuthorized = $this->validateSecretKey();
      }
    }

    private function validateAuthorization()
    {
      $isValid = false;
      $ipAdresses = DistriXSvcAuthData::getIpAddresses();
      $hosts = DistriXSvcAuthData::getHosts();

      $currentIpAddress = $_SERVER['SERVER_ADDR'];
      $currentHost = gethostname();

      foreach ($ipAdresses as $ipAdress) {
        if ($currentIpAddress == $ipAdress || $ipAdress == "*") {
          $isValid = true;
          break;
        }
      }
      if ($isValid) {
        $isValid = false;
        foreach ($hosts as $host) {
          if ($currentHost == $host || $host == "*") {
            $isValid = true;
            break;
          }
        }
      }

      return $isValid;
      // return true;
    }

    private function validateSecretKey()
    {
      $isValid = false;
      $secretKeys = DistriXSvcAuthData::getSecretKeys();
      $secretKeyToValidation = $this->getSecretKey();
      foreach ($secretKeys as $secretKey) {
        if ($secretKeyToValidation == $secretKey || $secretKey == "*") {
          $isValid = true;
          break;
        }
      }
      return $isValid;
    }

    public function isAuthorized()
    {
      return $this->isAuthorized;
    }

    public function getFormattedResponse()
    {
      $formattedResponse = "";

      if ($this->isAuthorized) {
        $formattedResponse = json_encode($this->response);
      }
      return $formattedResponse;
    }

    public function addToResponse($key, $data)
    {
      $added = false;

      if (
        $this->isAuthorized
        && $key != DISTRIX_SVC_RESPONSE_SERVICE_NAME_PARAMETER
        && $key != DISTRIX_SVC_RESPONSE_METHOD_NAME_PARAMETER
        && $key != DISTRIX_SVC_RESPONSE_LAYER_DATA_PARAMETER
        && $key != DISTRIX_SVC_RESPONSE_DEBUG_MODE_PARAMETER
        && $key != DISTRIX_SVC_RESPONSE_DEBUG_INFO_PARAMETER
        && $key != DISTRIX_SVC_RESPONSE_ERROR
        && $key != DISTRIX_SVC_RESPONSE_SECURITY_DATA_PARAMETER
      ) {
        $this->response[$key] = $data;
        $added = true;
      }
      return $added;
    }
    public function addErrorToResponse($data)
    {
      $added = false;

      if ($this->isAuthorized) {
        $this->response[DISTRIX_SVC_RESPONSE_ERROR] = $data;
        $added = true;
      }
      return $added;
    }

    public function getRawParameters()
    {
      if ($this->isAuthorized) {
        return $this->parameters;
      }
      return [];
    }

    public function getRawLayerData()
    {
      if ($this->isAuthorized) {
        return $this->layerData;
      }
      return new DistriXSvcLayerData();
    }

    public function getServerSslInfo()
    {
      if ($this->isAuthorized) {
        return $this->serverSslInfo;
      }
      return "";
    }

    public function getServerSslPath()
    {
      if ($this->isAuthorized) {
        return $this->serverSslPath;
      }
      return "";
    }

    public function getServiceName()
    {
      if ($this->isAuthorized) {
        $myServiceName = $this->serviceName;
        if (strpos($this->serviceName, DISTRIX_SVC_SERVICE_LEVEL) !== FALSE) {
          $myServiceName = substr($this->serviceName, strlen(DISTRIX_SVC_SERVICE_LEVEL));
        }
        return $myServiceName;
      }
      return "";
    }
    public function getMethodName()
    {
      if ($this->isAuthorized) {
        return $this->methodName;
      }
      return "";
    }
    public function getApiToken()
    {
      // Not really mandatory. Token must be used without Authorization.
      // So Authorization will be set to *. Yvan 08-Dec-21
      if ($this->isAuthorized) {
        return $this->apiToken;
      }
      return null;
    }
    public function getSecretKey()
    {
      if ($this->isAuthorized) {
        return $this->secretKey;
      }
      return "";
    }

    public function getParameter($key, $appDataClass = null)
    {
      $value = null;
      if (
        $this->isAuthorized
        && isset($this->parameters[$key])
      ) {
        if ($appDataClass != null) {
          list($value, $jsonError) = $appDataClass::getJsonData($this->parameters[$key]);
        } else {
          if (is_string($this->parameters[$key])) {
            $value = json_decode($this->parameters[$key], true);
          } else {
            $value = $this->parameters[$key];
          }
        }
      }
      return $value;
    }
    public function getRawParameter($key)
    {
      $value = null;
      if (
        $this->isAuthorized
        && isset($this->parameters[$key])
      ) {
        $value = $this->parameters[$key];
      }
      return $value;
    }

    public function getLayerData()
    {
      if ($this->isAuthorized) {
        if (is_string($this->layerData)) {
          list($this->layerData, $jsonError) = DistriXSvcLayerData::getJsonData($this->layerData);
        }
        return $this->layerData;
      }
      return new DistriXSvcLayerData();
    }

    public function getDebugMode()
    {
      if ($this->isAuthorized) {
        return $this->svcDebugMode;
      }
      return -1;
    }

    private function getInputParameters()
    {
      if ($this->isAuthorized) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)) {
          $_POST = json_decode(file_get_contents('php://input'), TRUE);
          $this->setJsonCall(true);
        }
        if (is_null($_POST)) {
          $_POST = [];
        }
        foreach ($_POST as $key => $value) {
          if (
            $key == DISTRIX_SVC_RESPONSE_METHOD_NAME_PARAMETER
            || $key == DISTRIX_SVC_RESPONSE_APITOKEN_PARAMETER
            || $key == DISTRIX_SVC_RESPONSE_SECRET_KEY_PARAMETER
            || $key == DISTRIX_SVC_RESPONSE_SERVICE_NAME_JSON_PARAMETER
            || $key == DISTRIX_SVC_RESPONSE_SERVICE_NAME_PARAMETER
            || $key == DISTRIX_SVC_RESPONSE_LAYER_DATA_PARAMETER
            || $key == DISTRIX_SVC_RESPONSE_DEBUG_MODE_PARAMETER
          ) {
            if ($key == DISTRIX_SVC_RESPONSE_SERVICE_NAME_PARAMETER || $key == DISTRIX_SVC_RESPONSE_SERVICE_NAME_JSON_PARAMETER) {
              $this->setServiceName($value);
            }
            if ($key == DISTRIX_SVC_RESPONSE_METHOD_NAME_PARAMETER) {
              $this->setMethodName($value);
            }
            if ($key == DISTRIX_SVC_RESPONSE_SECRET_KEY_PARAMETER) {
              $this->setSecretKey($value);
            }
            if ($key == DISTRIX_SVC_RESPONSE_APITOKEN_PARAMETER) {
              $tokenData = new DistriXApiTokenData();
              $data = json_decode($value);
              if (!is_null($data)) {
                list($tokenData, $jsonError) = $tokenData::getJsonData($data);
              }
              $this->setApiToken($tokenData);
            }
            if ($key == DISTRIX_SVC_RESPONSE_LAYER_DATA_PARAMETER) {
              $newLayerData = new DistriXSvcLayerData();
              $data = json_decode($value);
              if (!is_null($data)) {
                list($newLayerData, $jsonError) = $newLayerData::getJsonData($data);
              }
              $this->setLayerData($newLayerData);
            }
            if ($key == DISTRIX_SVC_RESPONSE_DEBUG_MODE_PARAMETER) {
              $this->setDebugMode($value);
            }
          } else {
            $this->addParameter($key, $value);
          }
        }
        if ($this->getJsonCall()) { // Empty $_POST for the next call. 1st SvcGeneric, 2nd Bus or Data Svc
          $_POST = [];
        }
      }
    }

    public function isBusSvcInDebugMode()
    {
      if ($this->isAuthorized) {
        return ($this->svcDebugMode == DISTRIX_SVC_BUS_LAYER_IN_DEBUG_MODE
          || $this->svcDebugMode == DISTRIX_SVC_ALL_LAYERS_IN_DEBUG_MODE);
      }
      return -1;
    }

    public function isDataSvcInDebugMode()
    {
      if ($this->isAuthorized) {
        return ($this->svcDebugMode == DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE
          || $this->svcDebugMode == DISTRIX_SVC_ALL_LAYERS_IN_DEBUG_MODE);
      }
      return -1;
    }

    public function startDebug()
    {
      if ($this->isAuthorized && $this->isDataSvcInDebugMode()) {
        ob_start();
      }
      return -1;
    }

    public function getJsonCall()
    {
      if ($this->isAuthorized) {
        return $this->jsonCall;
      }
      return -1;
    }

    // Set's
    private function setDebugMode($debugMode)
    {
      if ($this->isAuthorized && is_numeric($debugMode)) {
        $this->svcDebugMode = $debugMode;
      }
    }

    protected function setServerAddress($serverAddress)
    {
      if ($this->isAuthorized) {
        $this->serverAddress = $serverAddress;
      }
    }

    protected function setServerCall($serverCall)
    {
      if ($this->isAuthorized) {
        $this->serverCall = $serverCall;
      }
    }

    protected function setServerSslInfo($serverSslInfo)
    {
      if ($this->isAuthorized) {
        $this->serverSslInfo = $serverSslInfo;
      }
    }

    protected function setServerSslPath($serverSslPath)
    {
      if ($this->isAuthorized) {
        $this->serverSslPath = $serverSslPath;
      }
    }

    protected function setServerDirectory($serverDirectory)
    {
      if ($this->isAuthorized) {
        $this->serverDirectory = $serverDirectory;
      }
    }

    public function addParameter($name, $value)
    {
      if ($this->isAuthorized) {
        $this->parameters["$name"] = $value;
      }
    }

    public function setResponse($response)
    {
      if ($this->isAuthorized) {
        $this->response = $response;
      }
    }

    public function setServiceName($serviceName)
    {
      if ($this->isAuthorized) {
        $this->serviceName = $serviceName;
      }
    }

    public function setMethodName($methodName)
    {
      if ($this->isAuthorized) {
        $this->methodName = $methodName;
      }
    }

    public function setApiToken($apiToken)
    {
      // Not really mandatory. Token must be used without Authorization.
      // So Authorization will be set to *. Yvan 08-Dec-21
      if ($this->isAuthorized) {
        $this->apiToken = $apiToken;
      }
    }

    public function setSecretKey($secretKey)
    {
      if ($this->isAuthorized) {
        $this->secretKey = $secretKey;
      }
    }

    public function setLayerData($value)
    {
      if ($this->isAuthorized) {
        $this->layerData = $value;
      }
    }

    public function setJsonCall($value)
    {
      if ($this->isAuthorized) {
        $this->jsonCall = $value;
      }
    }

    // Debug functions
    protected function addToBaseDebug($layer, $debugData)
    {
      if ($this->isAuthorized) {
        if ($layer == "data" && $this->isDataSvcInDebugMode()) {
          $this->svcDebugBuffer .= $debugData;
        }
        if ($layer == "bus" && $this->isBusSvcInDebugMode()) {
          $this->svcDebugBuffer .= $debugData;
        }
      }
    }

    // End
    public function endOfBaseService($layer)
    {
      if ($this->isAuthorized) {
        if ($layer == DISTRIX_SVC_BUS_DEBUG && $this->isBusSvcInDebugMode()) {
          $this->svcDebugBuffer .= ob_get_contents();
          ob_end_clean();
          $this->addToResponse("debugBus", $this->svcDebugBuffer);
        }
        if ($layer == DISTRIX_SVC_DATA_DEBUG && $this->isDataSvcInDebugMode()) {
          $this->svcDebugBuffer .= ob_get_contents();
          ob_end_clean();
          $this->addToResponse("debugData", $this->svcDebugBuffer);
        }
        echo $this->getFormattedResponse();
      }
    }
  }
  // End of Class
}
// class_exists
