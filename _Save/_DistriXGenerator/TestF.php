<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("TestF", false)) {
  class TestF extends DjangoSvcAppData {
    protected $dsf;
    const HAS_ARRAY = true;

    public function __construct() {
      parent::__construct(self::HAS_ARRAY);
      $this->dsf = [];
    }
// Gets
    public function getDsf():array { return $this->dsf; }

// Sets
    public function setDsf(array $dsf) { $this->dsf = $dsf; }
  }
  // End of class
}
// class_exists
?>
