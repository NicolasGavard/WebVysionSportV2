<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXStyUserRightsData", false)) {
  class DistriXStyUserRightsData extends DistriXSvcAppData
  {
    protected $applicationCode;
    protected $moduleCode;
    protected $functionalityCode;
    protected $sumOfRights;

    public function __construct()
    {
      $this->applicationCode = "";
      $this->moduleCode = "";
      $this->functionalityCode = "";
      $this->sumOfRights = 0;
    }
    // Gets
    public function getApplicationCode()
    {
      return $this->applicationCode;
    }
    public function getModuleCode()
    {
      return $this->moduleCode;
    }
    public function getFunctionalityCode()
    {
      return $this->functionalityCode;
    }
    public function getSumOfRights()
    {
      return $this->sumOfRights;
    }

    // Sets
    public function setApplicationCode($applicationCode)
    {
      $this->applicationCode = $applicationCode;
    }
    public function setModuleCode($moduleCode)
    {
      $this->moduleCode = $moduleCode;
    }
    public function setFunctionalityCode($functionalityCode)
    {
      $this->functionalityCode = $functionalityCode;
    }
    public function setSumOfRights($sumOfRights)
    {
      $this->sumOfRights = $sumOfRights;
    }
  }
  // End of class
}
// class_exists
