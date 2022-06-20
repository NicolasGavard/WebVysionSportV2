<?php // Needed to encode in UTF8 ààéàé //
//
// Version : 1-10
//
if (! class_exists('BaseSvcCall', false)) {
  class BaseSvcCall implements Serializable {
    const SVC_KIND_OF_CALL_LOCAL  = 1;
    const SVC_KIND_OF_CALL_GLOBAL = 2;

    protected $serverAddress;
    protected $serverCall;
    protected $serverDirectory;
    protected $kindOfCall;
    protected $serviceName;
    protected $methodName;
    protected $parameters;

    public function __construct() {
      $this->serverAddress   = "";
      $this->serverCall      = "";
      $this->serverDirectory = "";
      $this->kindOfCall      = "";
      $this->serviceName     = "";
      $this->methodName      = "";
      $this->parameters      = array();
    }

// Get's
    protected function getServerAddress() { return $this->serverAddress; }
    protected function getServerCall() { return $this->serverCall; }
    protected function getServerDirectory() { return $this->serverDirectory; }

    public function getServiceName() { return $this->serviceName; }
    public function getMethodName() { return $this->methodName; }
    public function getParameters() { return $this->parameters; }
    public function isKindOfCallLocal() { return ($this->kindOfCall == self::SVC_KIND_OF_CALL_LOCAL); }
    public function isKindOfCallGlobal() { return ($this->kindOfCall == self::SVC_KIND_OF_CALL_GLOBAL); }

// Set's
    protected function callLocal() {
      $outputok = false;
      $output = $json_result = null;
      $error = "";

echo "<br/>i'm in local...";
      $methodName = $this->methodName;
      $output = include($this->serviceName);
    //echo "<br/>right after include in local call...<br/> Output :";
    //print_r($output);
    //echo "<br/><br/>";

//echo "<br/><br/>";

      if ($output !== false && $output != 1) {
        $outputok = true;
        $json_result = json_decode($output, true);
      }
      else {
        $outputok = false;
        $error .= "Error Content";
      }
      return array($outputok, $output, $json_result, $error);
    }

    protected function setServerAddress($serverAddress) { $this->serverAddress = $serverAddress; }
    protected function setServerCall($serverCall) { $this->serverCall = $serverCall; }
    protected function setServerDirectory($serverDirectory) { $this->serverDirectory = $serverDirectory; }

    public function setServiceName($serviceName) { $this->serviceName = $serviceName; }
    public function setMethodName($methodName) { $this->methodName = $methodName; }
    public function setParameters($parameters) { $this->parameters = $parameters; }
    public function setKindOfCallLocal() { $this->kindOfCall = self::SVC_KIND_OF_CALL_LOCAL; }
    public function setKindOfCallGlobal() { $this->kindOfCall = self::SVC_KIND_OF_CALL_GLOBAL; }
    public function addParameter($name, $value) { $this->parameters["$name"] = $value; }
    public function call() {
      $outputok = false;
      $output = $json_result = null;
      $error = "";

      if ($this->isKindOfCallLocal()) {
        list($outputok, $output, $json_result, $error) = $this->callLocal();
      }
      else {
        $curladdress  = $this->getServerCall()."://";
        $curladdress .= $this->getServerAddress()."/".$this->getServerDirectory()."/";
        $curladdress .= $this->serviceName;

        $ch = curl_init($curladdress);
        if ($ch !== FALSE) {
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      
          $curlfields_string = "";
          $curlfields_string .= "met=".urlencode($this->getMethodName())."&";
          foreach($this->parameters as $key=>$value) {
            $curlfields_string .= $key."=".urlencode($value)."&";
          }
          $curlfields_string = rtrim($curlfields_string, '&');
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $curlfields_string);

  // grab URL and pass it to the browser
          $output=curl_exec($ch);
          if ($output !== false) {
            $outputok = true;
            $json_result = json_decode($output, true);
          }
          else {
            $outputok = false;
            $error .= "Error Number:".curl_errno($ch)."<br>";
            $error .= "Error String:".curl_error($ch);
          }
  // close cURL resource, and free up system resources
          curl_close($ch);
        }
        else {
          $error .= "Init failed Error Number:".curl_errno($ch)."<br>";
          $error .= "Error String:".curl_error($ch);
        }
      }
      return array($outputok, $output, $json_result, $error);
    }

    public function callNoReturn() {
      $outputok = false;
      $output = $json_result = null;
      $error = "";

      $curladdress  = $this->getServerCall()."://";
      $curladdress .= $this->getServerAddress()."/".$this->getServerDirectory()."/";
      $curladdress .= $this->serviceName;

      $ch = curl_init($curladdress);
      if ($ch !== FALSE) {
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
        $curlfields_string = "";
        $curlfields_string .= "met=".urlencode($this->getMethodName())."&";
        foreach($this->parameters as $key=>$value) {
          $curlfields_string .= $key."=".urlencode($value)."&";
        }
        $curlfields_string = rtrim($curlfields_string, '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlfields_string);

// grab URL and pass it to the browser
        $output=curl_exec($ch);
        if ($output !== false) {
          $outputok = true;
      //$json_result = json_decode($output, true);
        }
        else {
          $outputok = false;
          $error .= "Error Number:".curl_errno($ch)."<br>";
          $error .= "Error String:".curl_error($ch);
        }
// close cURL resource, and free up system resources
        curl_close($ch);
      }
      else {
        $error .= "Init failed Error Number:".curl_errno($ch)."<br>";
        $error .= "Error String:".curl_error($ch);
      }
      return array($outputok, $output, $error);
    }

    public function serialize() {
      return serialize([
        $this->serviceName,
        $this->methodName,
        $this->parameters
      ]);
    }

    public function unserialize($data) {
      list(
        $this->serviceName,
        $this->methodName,
        $this->parameters
      ) = unserialize($data);
    }
// End of Class
  }
// class_exists
}
?>