<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("ManIngredientListViewData", false)) {
  class ManIngredientListViewData implements Serializable {
    private $id;
    private $name;
    private $supplierName;
    private $status;
    private $availableValue;
    private $unavailableValue;

    public function __construct() {
      $this->id = 0;
      $this->name = "";
      $this->supplierName = "";
      $this->status = 0;
      $this->availableValue = 0;
      $this->unavailableValue = 0;
    }
// Gets
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getSupplierName() { return $this->supplierName; }
    public function getStatus() { return $this->status; }
    public function getAvailableValue() { return $this->availableValue; }
    public function getUnavailableValue() { return $this->unavailableValue; }
    public function isAvailable() { return ($this->status == $this->availableValue); }

// Sets
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setSupplierName($supplierName) { $this->supplierName = $supplierName; }
    public function setStatus($status) { $this->status = $status; }
    public function setAvailableValue($availableValue) { $this->availableValue = $availableValue; }
    public function setUnavailableValue($unavailableValue) { $this->unavailableValue = $unavailableValue; }

// Serialization
    public function serialize() { 
      return serialize(array(
        $this->id,
        $this->name,
        $this->supplierName,
        $this->status,
        $this->availableValue,
        $this->unavailableValue
      ));
    }
    public function unserialize($data) { 
      list(
        $this->id,
        $this->name,
        $this->supplierName,
        $this->status,
        $this->availableValue,
        $this->unavailableValue
      ) = unserialize($data);
    }
  }
  // End of class
}
// class_exists
?>
