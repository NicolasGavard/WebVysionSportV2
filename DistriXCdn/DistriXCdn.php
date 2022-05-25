<?php // Needed to encode in UTF8 ààéàé //
// Layers
include("Layers/DistriXCdnSvcCaller.php");
// Data
include("Data/DistriXCdnData.php");

if (!class_exists('DistriXCdn', false)) {
  class DistriXCdn
  {
    private $images;
    private $distriXMultiCall;

    public function __construct()
    {
      $this->images           = [];
      $this->distriXMultiCall = null;
    }

    public function addImage(DistriXCdnData $data): bool
    {
      $imageAdded = false;

      if (
        !is_null($data)
        && strlen($data->getImage()) > 0
        && strlen($data->getImageGroup()) > 0
        && strlen($data->getImageFamily()) > 0
        && strlen($data->getImageName()) > 0
        && strlen($data->getImageType()) > 0
      ) {
        $this->images[] = $data;
        $imageAdded = true;
      }
      return $imageAdded;
    }

    public function sendToCdn(): bool
    {
      $cdnServiceCalled = false;

      if (!empty($this->getImages())) {
        if (is_null($this->getDistriXMultiCall())) {
          $this->setDistriXMultiCall(new DistriXSvc());
        }
        foreach ($this->getImages() as $image) {
          $cdnSvcCall = new DistriXCdnSvcCaller();
          $cdnSvcCall->setServiceName("DistriXCdn/Svc/DistriXCdnSvcSendToDataSvc.php");
          $cdnSvcCall->addParameter($image->getImageName(), $image);
          $this->getDistriXMultiCall()->addToCall($image->getImageName(), $cdnSvcCall);
        }
        $cdnServiceCalled = $this->getDistriXMultiCall()->call();
      }
      return $cdnServiceCalled;
    }

    // Gets
    public function getImages(): array
    {
      return $this->images;
    }
    public function getDistriXMultiCall(): ?object
    {
      return $this->distriXMultiCall;
    }
    public function getResults(string $imageName): array
    {
      $outputok   = false;
      $output     = null;
      $errorData  = null;

      if (!is_null($this->distriXMultiCall)) {
        list($outputok, $output, $errorData) = $this->distriXMultiCall->getResult($imageName);
      }
      return array($outputok, $output, $errorData);
    }
    public function setDistriXMultiCall(object $distriXMultiCall): bool
    {
      $distriXMultiCallSet = false;
      if (!is_null($distriXMultiCall) && is_a($distriXMultiCall, 'DistriXSvc')) {
        $this->distriXMultiCall = $distriXMultiCall;
        $distriXMultiCallSet = true;
      }
      return $distriXMultiCallSet;
    }
  }
  // End of Class
}
