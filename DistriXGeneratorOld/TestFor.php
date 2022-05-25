<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("TestFor", false)) {
  class TestFor extends DjangoSvcAppData {
    protected $dsf;
    const HAS_ARRAY = false;

    public function __construct() {
      parent::__construct(self::HAS_ARRAY);
      $this->dsf = false;
    }
// Gets
    public function getDsf():bool { return $this->dsf; }

// Sets
    public function setDsf(bool $dsf) { $this->dsf = $dsf; }
  }
  // End of class
}
// class_exists
?>
