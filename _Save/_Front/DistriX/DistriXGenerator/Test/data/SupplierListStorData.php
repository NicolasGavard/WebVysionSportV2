<?php // Needed to encode in UTF8 ààéàé //
//
// Data Version : 1-10
//
if (! class_exists('SupplierListStorData', false)) {
  class SupplierListStorData {
    private $id;
    private $name;
    private $status;
    private $availableValue;
    private $unavailableValue;

    public function __construct() {
      $this->id = 0;
      $this->name = "";
      $this->status = 0;
      $this->availableValue = 0;
      $this->unavailableValue = 0;
    }
  // Gets
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getStatus() { return $this->status; }
    public function isAvailable() { return ($this->status == $this->availableValue); }
    public function getAvailableValue() { return $this->availableValue; }
    public function getUnavailableValue() { return $this->unavailableValue; }

  // Sets
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setStatus($status) { $this->status = $status; }
    public function setAvailableValue($availableValue) { $this->availableValue = $availableValue; }
    public function setUnavailableValue($unavailableValue) { $this->unavailableValue = $unavailableValue; }

  }
  // End of class
}
// class_exists
?>