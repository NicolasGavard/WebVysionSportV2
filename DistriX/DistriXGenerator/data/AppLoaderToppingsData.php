<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("AppLoaderToppingsData", false)) {
  class AppLoaderToppingsData implements Serializable {
    private $idToppingType;
    private $toppingName;
    private $image;
    private $status;
    const HAS_ARRAY = false;

    public function __construct() {
      $this->idToppingType = 0;
      $this->toppingName = "";
      $this->image = null;
      $this->status = 0;
    }
// Gets
    public function getIdToppingType() { return $this->idToppingType; }
    public function getToppingName() { return $this->toppingName; }
    public function getImage() { return $this->image; }
    public function getStatus() { return $this->status; }

// Sets
    public function setIdToppingType($idToppingType) { $this->idToppingType = $idToppingType; }
    public function setToppingName($toppingName) { $this->toppingName = $toppingName; }
    public function setImage($image) { $this->image = $image; }
    public function setStatus($status) { $this->status = $status; }

// Get Data
    public function getData() {
      $data = get_object_vars($this);
      if (self::HAS_ARRAY) {
        foreach ($data as $key => $value) {
          if (gettype($this->$key) == "array") {
            $dataArray = array();
            $func = "get".ucfirst($key);
            for ($indC=0; $indC < sizeof($this->$func()); $indC++) {
              $dataArray[$indC] = $this->$func()[$indC]->getData();
            }
            $data[$key] = $dataArray;
          }
        }
      }
      return $data;
    }

// Serialization
    public function serialize() { 
      $ser = get_object_vars($this);
      foreach ($ser as $key => $value) {
        $lower = strtolower($key);
        if (strpos($lower, "image") !== FALSE || strpos($lower, "sound") !== FALSE) {
          if (strpos($lower, "name") === FALSE) {
            if (strpos($lower, "size") === FALSE) {
              if (strpos($lower, "type") === FALSE) {
                $ser[$key] = base64_encode($value);
              }
            }
          }
        }
      }
      $ser = serialize($ser);
      return $ser;
    }

    public function unserialize($data) { 
      $unSer = unserialize($data);
      $thisData = get_object_vars($this);
      foreach ($unSer as $key => $value) { 
        if (isset($thisData[$key])) {
          $this->$key = $value;
          $lower = strtolower($key);
          if (strpos($lower, "image") !== FALSE || strpos($lower, "sound") !== FALSE) {
            if (strpos($lower, "name") === FALSE) {
              if (strpos($lower, "size") === FALSE) {
                if (strpos($lower, "type") === FALSE) {
                  $this->$key = base64_decode($value);
                }
              }
            }
          }
        }
      }
    }
  }
  // End of class
}
// class_exists
?>
