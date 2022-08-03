<?php // Needed to encode in UTF8 ààéàé //

if (!class_exists("ApplicationLayerData", false)) {
  class ApplicationLayerData extends DistriXSvcLayerData
  {
    protected $idPos;

    public function getIdPos()
    {
      return $this->idPos;
    }
    public function setIdPos($idPos)
    {
      $this->idPos = $idPos;
    }
  }
  // End of class
}
// class_exists
