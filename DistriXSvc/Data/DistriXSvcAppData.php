<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXSvcAppData", false)) {
  class DistriXSvcAppData implements JsonSerializable
  {
    // Set Data
    public function setData($dataObject, $mappingArray = null)
    {
      $setString = "set";
      $methods = get_class_methods($this);
      foreach ($dataObject as $element => $dataToSet) {
        $isSet = false;
        foreach ($methods as $method) {
          if (substr_compare($method, $setString, 0, 3) == 0) {
            $methodDataNameString = substr($method, strlen($setString));
            if (strcmp(strtolower($element), strtolower($methodDataNameString)) == 0) {
              $this->$method($dataToSet);
              $isSet = true;
            }
          }
        }
        if (!$isSet && $mappingArray) {
          foreach ($mappingArray as $mappingMethod => $mappingValue) {
            foreach ($methods as $method) {
              if (substr_compare($method, $setString, 0, 3) == 0) {
                $methodDataNameString = substr($method, strlen($setString));
                if (strcmp(strtolower($mappingValue), strtolower($methodDataNameString)) == 0) {
                  $this->$method($dataObject[$mappingMethod]);
                }
              }
            }
          }
        }
      }
    }

    // Serialization
    public function __serialize(): array
    {
      return get_object_vars($this);
    }
    public function __unserialize(array $data): void
    {
      foreach ($data as $key => $value) {
        if (property_exists($this, $key)) {
          $this->$key = $value;
        }
      }
    }
    public static function jsonSerializeArray($array)
    {
      $resp = [];
      foreach ($array as $element) {
        $resp[] = $element->jsonSerialize();
      }
      return $resp;
    }

    public function jsonSerialize(): mixed
    {
      $data = get_object_vars($this);
      foreach ($data as $key => $value) {
        $func = "get" . ucfirst($key);
        if (gettype($this->$key) == "array") {
          $dataArray = array();
          if (!empty($this->$func())) {
            for ($indC = 0; $indC < count($this->$func()); $indC++) {
              $dataArray[$indC] = $this->$func()[$indC]->jsonSerialize();
            }
          }
          $data[$key] = $dataArray;
        }
        $type = "";
        try {
          $reflection = new ReflectionMethod($this, $func);
          $type = $reflection->getReturnType()->getName();
        } catch (\Throwable $th) {
          //throw $th;
        }
        if ($type == "bool") {
          $data[$key] = (int)$value;
        }
        if ($type == "int") {
          $data[$key] = (int)$value;
        }
        if ($type == "float") {
          $data[$key] = (float)$value;
        }
        if ($type == "string") {
          $data[$key] = (string)$value;
        }
      }
      return $data;
    }

    /**
     * @param string|array $json
     * @return $this
     */
    public static function getJsonData($json): array
    {
      $errorData = new DistriXSvcErrorData();

      $className = get_called_class();
      $classInstance = new $className();
      if (!is_null($json)) {
        if (is_string($json)) {
          $json = json_decode($json);
        }
        foreach ($json as $key => $value) {
          $setMethodName = "set" . ucfirst($key);
          if (method_exists($classInstance, $setMethodName)) {
            try {
              $classInstance->$setMethodName($value);
            } catch (\Throwable $th) {
              $errorData->setCode(DISTRIX_SVC_ERROR_DATA_VALUE);
              $errorData->setTextToAllText("Method : " . $setMethodName);
            }
          }
        }
      } else {
        $errorData->setCode(DISTRIX_SVC_ERROR_DATA_VALUE);
        $errorData->setTextToAllText("Data is null");
      }
      return array($classInstance, $errorData);
    }

    /**
     * @param string $json
     * @return $this[]
     */
    public static function getJsonArray($json): array
    {
      $errorData = new DistriXSvcErrorData();
      $items = [];

      if (!is_null($json)) {
        if (is_string($json)) {
          $json = json_decode($json);
        }
        foreach ($json as $item) {
          list($data, $errorData) = self::getJsonData($item);
          if ($errorData->getCode() == "") {
            $items[] = $data;
          }
        }
      } else {
        $errorData->setCode(DISTRIX_SVC_ERROR_DATA_VALUE);
        $errorData->setTextToAllText("Data is null");
      }
      return array($items, $errorData);
    }
  }
  // End of class
}
// class_exists
