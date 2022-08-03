<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXSvcDataService', false)) {
  class DistriXSvcDataService extends DistriXSvcBase
  {
    // Debug functions
    public function addToDebug($value)
    {
      parent::addToBaseDebug(DISTRIX_SVC_DATA_DEBUG, $value);
    }

    public function endOfService()
    {
      parent::endOfBaseService(DISTRIX_SVC_DATA_DEBUG);
    }
  }
  // End of Class
}
// class_exists
