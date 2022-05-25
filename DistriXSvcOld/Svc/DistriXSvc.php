<?php // Needed to encode in UTF8 ààéàé //

use DistriXSvc as GlobalDistriXSvc;

if (!class_exists("DistriXSvc", false)) {
  class DistriXSvc
  {
    const CURL_TIMEOUT_ERROR_NUMBER = 28;

    private $callers;
    private $results;
    public function __construct()
    {
      $this->callers = [];
      $this->results = [];
    }
    public function addToCall($callerName, $caller)
    {
      $data = new DistriXSvcData($callerName, $caller);
      $this->callers[$callerName] = $data;
    }
    private function cleanCallers()
    {
      $this->callers = null;
    }
    private function addToResult($resultName, $resultData)
    {
      $this->results[$resultName] = $resultData;
    }
    private function callServer($useTimeoutData = false)
    {
      $error = "";
      $allCallersOk = true;
      global $DISTRIX_UNAVAILABLE_SERVER;

      if (is_array($this->callers)) {
        foreach ($this->callers as $callerName => $callerData) {
          $caller = $callerData->getCaller();

          $primaryServerAvailable = $timeoutServerAvailable = true;
          if (isset($DISTRIX_UNAVAILABLE_SERVER) && is_array($DISTRIX_UNAVAILABLE_SERVER)) {
            foreach ($DISTRIX_UNAVAILABLE_SERVER as $unavailableServer) {
              if (strcasecmp($caller->getServerAddress(), $unavailableServer) == 0) {
                $primaryServerAvailable = false;
              }
              if (strcasecmp($caller->getServerTimeoutAddress(), $unavailableServer) == 0) {
                $timeoutServerAvailable = false;
              }
            }
          }
          $curlAddress = $wantedAddress = "";
          if ($primaryServerAvailable) {
            $curlAddress .= $caller->getServerCall() . "://";
            $curlAddress .= $caller->getServerAddress() . "/" . $caller->getServerDirectory() . "/";
          }
          if (
            $useTimeoutData && strlen($caller->getServerTimeoutCall()) > 0 && $timeoutServerAvailable
            || strlen($caller->getServerTimeoutCall()) > 0 && $timeoutServerAvailable && !$primaryServerAvailable
          ) {
            $curlAddress .= $caller->getServerTimeoutCall() . "://";
            $curlAddress .= $caller->getServerTimeoutAddress() . "/" . $caller->getServerTimeoutDirectory() . "/";
          }
          if (strlen($curlAddress) > 0 && strlen($caller->getGenericServiceName()) > 0) {
            $curlAddress .= $caller->getGenericServiceName();
          } else {
            $wantedAddress  = $caller->getServerCall() . "://";
            $wantedAddress .= $caller->getServerAddress() . "/" . $caller->getServerDirectory() . "/";
            if ($useTimeoutData) {
              $wantedAddress  = $caller->getServerTimeoutCall() . "://";
              $wantedAddress .= $caller->getServerTimeoutAddress() . "/" . $caller->getServerTimeoutDirectory() . "/";
            }
          }
          if (strlen($curlAddress) > 0) {
            $ch = curl_init($curlAddress);
            if ($ch !== FALSE) {
              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
              if ($caller->getServerTimeoutSeconds() > 0) {
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $caller->getServerTimeoutSeconds());
              }

              //SSL
              if (strpos($caller->getServerCall(), "https") !== FALSE) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                // curl_setopt($ch, CURLOPT_CAINFO, $caller->getServerSslInfo());
                // curl_setopt($ch, CURLOPT_CAPATH, $caller->getServerSslPath());
              }
              $curlfields_string = "";
              $curlfields_string .= DISTRIX_SVC_RESPONSE_SERVICE_NAME_PARAMETER . "=" . urlencode(DISTRIX_SVC_SERVICE_LEVEL . $caller->getServiceName()) . "&";
              $curlfields_string .= DISTRIX_SVC_RESPONSE_METHOD_NAME_PARAMETER . "=" . urlencode($caller->getMethodName()) . "&";
              $curlfields_string .= DISTRIX_SVC_RESPONSE_APITOKEN_PARAMETER . "=" . urlencode(serialize($caller->getApiToken())) . "&";
              $curlfields_string .= DISTRIX_SVC_RESPONSE_SECRET_KEY_PARAMETER . "=" . urlencode($caller->getSecretKey()) . "&";
              $layerData = $caller->getLayerData();
              if (!is_string($layerData)) {
                $layerData = serialize($layerData);
              }
              $curlfields_string .= DISTRIX_SVC_RESPONSE_LAYER_DATA_PARAMETER . "=" . urlencode($layerData) . "&";
              $curlfields_string .= DISTRIX_SVC_RESPONSE_DEBUG_MODE_PARAMETER . "=" . urlencode($caller->getDebugMode()) . "&";
              if (!empty($caller->getParameters())) {
                foreach ($caller->getParameters() as $key => $value) {
                  if (!is_string($value)) {
                    $value = serialize($value);
                  }
                  $curlfields_string .= $key . "=" . urlencode($value) . "&";
                }
              }
              $curlfields_string = rtrim($curlfields_string, '&');
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $curlfields_string);

              $callerData->setCurlHandle($ch);
            } else {
              $callerData->setOutputOk(false);

              $error .= "Init " . $caller->getServiceName() . " failed <br/>";
              $error .= "Error String : " . $curlAddress;
              $errorData = new DistriXSvcErrorData();
              $errorData->setTypeSystem();
              $errorData->setSeverityCritical();
              $errorData->setCode(DISTRIX_SVC_ERROR_CURL_INIT);
              $errorData->setTextToAllText($error);
              $callerData->setErrorData($errorData);
              $this->addToResult($callerName, $callerData);
              $allCallersOk = false;
            }
          } else {
            $callerData->setOutputOk(false);

            $error .= "Init " . $caller->getServiceName() . " failed <br/>";
            $error .= "Error Address : " . $wantedAddress;
            $errorData = new DistriXSvcErrorData();
            $errorData->setTypeSystem();
            $errorData->setSeverityCritical();
            $errorData->setCode(DISTRIX_SVC_ERROR_SERVER_ADDRESS);
            $errorData->setTextToAllText($error);
            $callerData->setErrorData($errorData);
            $this->addToResult($callerName, $callerData);
            $allCallersOk = false;
          }
        }
        if ($allCallersOk) {
          $mh = curl_multi_init();
          foreach ($this->callers as $callerName => $callerData) {
            curl_multi_add_handle($mh, $callerData->getCurlHandle());
          }

          do {
            curl_multi_exec($mh, $active);
            curl_multi_select($mh);
          } while ($active > 0);

          foreach ($this->callers as $callerName => $callerData) {
            $ch     = $callerData->getCurlHandle();
            $caller = $callerData->getCaller();

            $output = curl_multi_getcontent($ch);
            if ($output !== false) {
              $callerData->setOutputOk(true);
              $callerData->setContent($output);

              if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != '200') {
                $callerData->setOutputOk(false);
                $error .= "Error " . $caller->getServiceName() . " Call Number : " . curl_errno($ch) . "<br>";
                $error .= "Error HTTP return code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "<br>";
                $error .= "Error Call String : " . $output;

                $errorData = new DistriXSvcErrorData();
                $errorData->setTypeSystem();
                $errorData->setSeverityCritical();
                $errorData->setCode(DISTRIX_SVC_ERROR_RESPONSE);
                $errorData->setTextToAllText($error);
                $callerData->setErrorData($errorData);
              }
            } else {
              $callerData->setOutputOk(false);
              $error .= "Error " . $caller->getServiceName() . " Call Number : " . curl_errno($ch) . "<br>";
              $callerData->setTimeoutError((curl_errno($ch) == $this->CURL_TIMEOUT_ERROR_NUMBER));
              $error .= "Error Call String : " . curl_error($callerData->getCurlHandle());

              $errorData = new DistriXSvcErrorData();
              $errorData->setTypeSystem();
              $errorData->setSeverityCritical();
              $errorData->setCode(DISTRIX_SVC_ERROR_CALLER);
              $errorData->setTextToAllText($error);
              $callerData->setErrorData($errorData);
            }
            // close cURL resource, and free up system resources
            curl_multi_remove_handle($mh, $ch);

            $this->addToResult($callerName, $callerData);
          }
          curl_multi_close($mh);
        }
      } else {
        $allCallersOk = false;
      }
      return $allCallersOk;
    }
    public function call()
    {
      $allCallersOk = $this->callServer(false);
      if (!$allCallersOk) {
        $this->cleanCallers();
        $needAnotherCall = false;
        foreach ($this->results as $resultName => $result) {
          if ($result->getTimeoutError()) {
            $caller = $result->getCaller();
            if (strlen($caller->getServerTimeoutCall()) > 0) {
              $this->addToCall($resultName, $result->getCaller());
              $needAnotherCall = true;
            }
          }
        }
        if ($needAnotherCall) {
          $allCallersOk = $this->callServer(true);
        }
      }
      if ($allCallersOk) {
        foreach ($this->results as $resultName => $result) {
          if ($result->getOutputOk()) {
            try {
              $output = $result->getContent();

              $lenOutput = strlen($output);
              for ($indO = 0; $indO < $lenOutput; $indO++) {
                if (ord($output[$indO]) != 10) {
                  break;
                }
              }
              $output = substr($output, $indO);

              $oldOutput     = $output;
              $unserOutput   = @unserialize($output);
              if (is_array($unserOutput)) {
                if (isset($unserOutput[DISTRIX_SVC_RESPONSE_ERROR])) {
                  $result->setErrorData($unserOutput[DISTRIX_SVC_RESPONSE_ERROR]);
                  unset($unserOutput[DISTRIX_SVC_RESPONSE_ERROR]);
                  $result->setOutputOk(false);
                }
                $result->setContent($unserOutput);
              } else {
                $output = $oldOutput;
              }

              if (is_string($output)) {
                $unserOutput = @json_decode($output, true);
                if (!is_array($unserOutput)) {
                  $unserOutput = @unserialize($output);
                }
                if (is_array($unserOutput)) {
                  if (isset($unserOutput[DISTRIX_SVC_RESPONSE_ERROR])) {
                    $result->setErrorData($unserOutput[DISTRIX_SVC_RESPONSE_ERROR]);
                    unset($unserOutput[DISTRIX_SVC_RESPONSE_ERROR]);
                    $result->setOutputOk(false);
                  }
                  $result->setContent($unserOutput);
                }
              }
            } catch (Exception $e) {
              $errorData = new DistriXSvcErrorData();
              $errorData->setTypeSystem();
              $errorData->setSeverityCritical();
              $errorData->setCode(DISTRIX_SVC_ERROR_RESPONSE);
              $errorData->setDefaultText($e->getCode());
              $errorData->setText($e->getMessage());
              $errorData->setParameters($e->getTrace());
              $errorData->setFileName($e->getFile() . ", line " . $e->getLine());
              $result->setErrorData($unserOutput[DISTRIX_SVC_RESPONSE_ERROR]);
              $result->setOutputOk(false);
            }
          }
        }
      }
      return $allCallersOk;
    }
    public function getResult($callerName)
    {
      $outputOk = false;
      $output   = "";
      $errorData = null;

      if (isset($this->results[$callerName])) {
        $result = $this->results[$callerName];
        unset($this->results[$callerName]);
        $outputOk  = $result->getOutputOk();
        $output    = $result->getContent();
        $errorData =  $result->getErrorData();
      } else {
        $errorData = new DistriXSvcErrorData();
        $errorData->setCode(DISTRIX_SVC_ERROR_CALLER_NAME);
        $errorData->setTextToAllText($callerName);
      }
      return array($outputOk, $output, $errorData);
    }
  }
  // End of class
}
// class_exists
