<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists('GenIdData', false)) {
  class GenIdData implements Serializable {
    private $id;
    public function __construct($id = 0) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function serialize() { return serialize(array($this->id));}
    public function unserialize($data) {list($this->id) = unserialize($data);}
  }
}
?>