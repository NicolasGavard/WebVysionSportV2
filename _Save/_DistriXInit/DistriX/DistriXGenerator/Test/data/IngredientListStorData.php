<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("IngredientListStorData", false)) {
  class IngredientListStorData {
    private $ingredientStorData;
    private $supplierListStorData;

    public function __construct() {
      $this->ingredientStorData = null;
      $this->supplierListStorData = null;
    }
// Gets
    public function getIngredientStorData() { return $this->ingredientStorData; }
    public function getSupplierListStorData() { return $this->supplierListStorData; }
// Sets
    public function setIngredientStorData($ingredientStorData) { $this->ingredientStorData = $ingredientStorData; }
    public function setSupplierListStorData($supplierListStorData) { $this->supplierListStorData = $supplierListStorData; }

  }
// End of class
}
// class_exists
?>
