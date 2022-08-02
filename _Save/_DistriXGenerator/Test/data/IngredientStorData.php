<?php // Needed to encode in UTF8 ààéàé //
if (! class_exists("IngredientStorData", false)) {
  class IngredientStorData {
    const INGREDIENT_STATUS_AVAILABLE     = 0;
    const INGREDIENT_STATUS_NOT_AVAILABLE = 1;

    private $id;
    private $idSupplier;
    private $name;
    private $idConditionningType;
    private $contentLeft;
    private $contentRight;
    private $idUnitType;
    private $idContainingType;
    private $quantity;
    private $idUnitTypeFormat;
    private $idCaliberType;
    private $itemLength;
    private $itemWidth;
    private $itemThickness;
    private $density;
    private $weightTrayTen;
    private $weightTrayFifty;
    private $idStateType;
    private $useByDate;
    private $useBeforeDate;
    private $wasteTreatment;
    private $delay;
    private $freeOfChargeLimit;
    private $shippingCosts;
    private $orderMinimumWeight;
    private $status;
    private $idUserCreate;
    private $dateCreate;
    private $timeCreate;
    private $idUserModif;
    private $dateModif;
    private $timeModif;
    private $idUserDelete;
    private $dateDelete;
    private $timeDelete;

    public function __construct($id=0) {
      $this->id = $id;
      $this->idSupplier = 0;
      $this->name = "";
      $this->idConditionningType = 0;
      $this->contentLeft = 0;
      $this->contentRight = 0;
      $this->idUnitType = 0;
      $this->idContainingType = 0;
      $this->quantity = 0;
      $this->idUnitTypeFormat = 0;
      $this->idCaliberType = 0;
      $this->itemLength = 0;
      $this->itemWidth = 0;
      $this->itemThickness = 0;
      $this->density = 0;
      $this->weightTrayTen = 0;
      $this->weightTrayFifty = 0;
      $this->idStateType = 0;
      $this->useByDate = "";
      $this->useBeforeDate = "";
      $this->wasteTreatment = "";
      $this->delay = "";
      $this->freeOfChargeLimit = 0;
      $this->shippingCosts = 0;
      $this->orderMinimumWeight = "";
      $this->status = 0;
      $this->idUserCreate = 0;
      $this->dateCreate = 0;
      $this->timeCreate = 0;
      $this->idUserModif = 0;
      $this->dateModif = 0;
      $this->timeModif = 0;
      $this->idUserDelete = 0;
      $this->dateDelete = 0;
      $this->timeDelete = 0;
    }
// Gets
    public function getId() { return $this->id; }
    public function getIdSupplier() { return $this->idSupplier; }
    public function getName() { return $this->name; }
    public function getIdConditionningType() { return $this->idConditionningType; }
    public function getContentLeft() { return $this->contentLeft; }
    public function getContentRight() { return $this->contentRight; }
    public function getIdUnitType() { return $this->idUnitType; }
    public function getIdContainingType() { return $this->idContainingType; }
    public function getQuantity() { return $this->quantity; }
    public function getIdUnitTypeFormat() { return $this->idUnitTypeFormat; }
    public function getIdCaliberType() { return $this->idCaliberType; }
    public function getItemLength() { return $this->itemLength; }
    public function getItemWidth() { return $this->itemWidth; }
    public function getItemThickness() { return $this->itemThickness; }
    public function getDensity() { return $this->density; }
    public function getWeightTrayTen() { return $this->weightTrayTen; }
    public function getWeightTrayFifty() { return $this->weightTrayFifty; }
    public function getIdStateType() { return $this->idStateType; }
    public function getUseByDate() { return $this->useByDate; }
    public function getUseBeforeDate() { return $this->useBeforeDate; }
    public function getWasteTreatment() { return $this->wasteTreatment; }
    public function getDelay() { return $this->delay; }
    public function getFreeOfChargeLimit() { return $this->freeOfChargeLimit; }
    public function getShippingCosts() { return $this->shippingCosts; }
    public function getOrderMinimumWeight() { return $this->orderMinimumWeight; }
    public function getStatus() { return $this->status; }
    public function getIdUserCreate() { return $this->idUserCreate; }
    public function getDateCreate() { return $this->dateCreate; }
    public function getTimeCreate() { return $this->timeCreate; }
    public function getIdUserModif() { return $this->idUserModif; }
    public function getDateModif() { return $this->dateModif; }
    public function getTimeModif() { return $this->timeModif; }
    public function getIdUserDelete() { return $this->idUserDelete; }
    public function getDateDelete() { return $this->dateDelete; }
    public function getTimeDelete() { return $this->timeDelete; }
    public function isAvailable() { return ($this->status == self::INGREDIENT_STATUS_AVAILABLE); }
    public function getAvailableValue() { return self::INGREDIENT_STATUS_AVAILABLE; }
    public function getUnavailableValue() { return self::INGREDIENT_STATUS_NOT_AVAILABLE; }
// Sets
    public function setId($id) { $this->id = $id; }
    public function setIdSupplier($idSupplier) { $this->idSupplier = $idSupplier; }
    public function setName($name) { $this->name = $name; }
    public function setIdConditionningType($idConditionningType) { $this->idConditionningType = $idConditionningType; }
    public function setContentLeft($contentLeft) { $this->contentLeft = $contentLeft; }
    public function setContentRight($contentRight) { $this->contentRight = $contentRight; }
    public function setIdUnitType($idUnitType) { $this->idUnitType = $idUnitType; }
    public function setIdContainingType($idContainingType) { $this->idContainingType = $idContainingType; }
    public function setQuantity($quantity) { $this->quantity = $quantity; }
    public function setIdUnitTypeFormat($idUnitTypeFormat) { $this->idUnitTypeFormat = $idUnitTypeFormat; }
    public function setIdCaliberType($idCaliberType) { $this->idCaliberType = $idCaliberType; }
    public function setItemLength($itemLength) { $this->itemLength = $itemLength; }
    public function setItemWidth($itemWidth) { $this->itemWidth = $itemWidth; }
    public function setItemThickness($itemThickness) { $this->itemThickness = $itemThickness; }
    public function setDensity($density) { $this->density = $density; }
    public function setWeightTrayTen($weightTrayTen) { $this->weightTrayTen = $weightTrayTen; }
    public function setWeightTrayFifty($weightTrayFifty) { $this->weightTrayFifty = $weightTrayFifty; }
    public function setIdStateType($idStateType) { $this->idStateType = $idStateType; }
    public function setUseByDate($useByDate) { $this->useByDate = $useByDate; }
    public function setUseBeforeDate($useBeforeDate) { $this->useBeforeDate = $useBeforeDate; }
    public function setWasteTreatment($wasteTreatment) { $this->wasteTreatment = $wasteTreatment; }
    public function setDelay($delay) { $this->delay = $delay; }
    public function setFreeOfChargeLimit($freeOfChargeLimit) { $this->freeOfChargeLimit = $freeOfChargeLimit; }
    public function setShippingCosts($shippingCosts) { $this->shippingCosts = $shippingCosts; }
    public function setOrderMinimumWeight($orderMinimumWeight) { $this->orderMinimumWeight = $orderMinimumWeight; }
    public function setStatus($status) { $this->status = $status; }
    public function setIdUserCreate($idUserCreate) { $this->idUserCreate = $idUserCreate; }
    public function setDateCreate($dateCreate) { $this->dateCreate = $dateCreate; }
    public function setTimeCreate($timeCreate) { $this->timeCreate = $timeCreate; }
    public function setIdUserModif($idUserModif) { $this->idUserModif = $idUserModif; }
    public function setDateModif($dateModif) { $this->dateModif = $dateModif; }
    public function setTimeModif($timeModif) { $this->timeModif = $timeModif; }
    public function setIdUserDelete($idUserDelete) { $this->idUserDelete = $idUserDelete; }
    public function setDateDelete($dateDelete) { $this->dateDelete = $dateDelete; }
    public function setTimeDelete($timeDelete) { $this->timeDelete = $timeDelete; }
    public function setAvailable() { $this->status = self::INGREDIENT_STATUS_AVAILABLE; }
    public function setUnavailable() { $this->status = self::INGREDIENT_STATUS_NOT_AVAILABLE; }

// End of class
  }
// class_exists
}
?>
