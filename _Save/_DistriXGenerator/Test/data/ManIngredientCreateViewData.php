<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("ManIngredientCreateViewData", false)) {
  class ManIngredientCreateViewData implements Serializable {
    private $id;
    private $idSupplier;
    private $name;

    public function __construct() {
      $this->id = 0;
      $this->idSupplier = 0;
      $this->name = "";
    }
// Gets
    public function getId() { return $this->id; }
    public function getIdSupplier() { return $this->idSupplier; }
    public function getName() { return $this->name; }

// Sets
    public function setId($id) { $this->id = $id; }
    public function setIdSupplier($idSupplier) { $this->idSupplier = $idSupplier; }
    public function setName($name) { $this->name = $name; }

// Serialization
    public function serialize() { 
      return serialize(array(
        $this->id,
        $this->idSupplier,
        $this->name
      ));
    }
    public function unserialize($data) { 
      list(
        $this->id,
        $this->idSupplier,
        $this->name
      ) = unserialize($data);
    }
  }
  // End of class
}
// class_exists
?>
