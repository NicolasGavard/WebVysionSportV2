<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("TestDataNo1", false)) {
  class TestDataNo1 extends PHP_D_SvcAppData {
    protected $a1;
    protected $b2;
    protected $c3;
    protected $d4;
    protected $e5;
    protected $f6;
    protected $g7;
    protected $h8;

    public function __construct() {
      $this->a1 = [];
      $this->b2 = false;
      $this->c3 = 0.0;
      $this->d4 = 0;
      $this->e5 = null;
      $this->f6 = "";
      $this->g7 = [];
      $this->h8 = false;
    }
// Gets
    public function getA1():array { return $this->a1; }
    public function getB2():bool { return $this->b2; }
    public function getC3():float { return $this->c3; }
    public function getD4():int { return $this->d4; }
    public function getE5() { return $this->e5; }
    public function getF6():string { return $this->f6; }
    public function getG7():array { return $this->g7; }
    public function getH8():bool { return $this->h8; }

// Sets
    public function setA1(array $a1) { $this->a1 = $a1; }
    public function setB2(bool $b2) { $this->b2 = $b2; }
    public function setC3(float $c3) { $this->c3 = $c3; }
    public function setD4(int $d4) { $this->d4 = $d4; }
    public function setE5($e5) { $this->e5 = $e5; }
    public function setF6(string $f6) { $this->f6 = $f6; }
    public function setG7(array $g7) { $this->g7 = $g7; }
    public function setH8(bool $h8) { $this->h8 = $h8; }
  }
  // End of class
}
// class_exists
?>
