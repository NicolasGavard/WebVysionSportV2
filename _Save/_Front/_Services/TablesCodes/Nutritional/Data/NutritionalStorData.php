<?php // Needed to encode in UTF8 ààéàé //
class NutritionalStorData extends DistriXSvcAppData {
  const NUTRITIONAL_STATUS_AVAILABLE     = 0;
  const NUTRITIONAL_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $code;
  protected $name;
  protected $iscalorie;
  protected $isproetin;
  protected $isglucide;
  protected $islipid;
  protected $isvitamin;
  protected $istraceelement;
  protected $ismineral;
  protected $elemstate;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->code = "";
      $this->name = "";
      $this->iscalorie = 0;
      $this->isproetin = 0;
      $this->isglucide = 0;
      $this->islipid = 0;
      $this->isvitamin = 0;
      $this->istraceelement = 0;
      $this->ismineral = 0;
      $this->elemstate = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getCode():string { return $this->code; }
  public function getName():string { return $this->name; }
  public function getIsCalorie():int { return $this->iscalorie; }
  public function getIsProetin():int { return $this->isproetin; }
  public function getIsGlucide():int { return $this->isglucide; }
  public function getIsLipid():int { return $this->islipid; }
  public function getIsVitamin():int { return $this->isvitamin; }
  public function getIstTaceElement():int { return $this->istraceelement; }
  public function getIsMineral():int { return $this->ismineral; }
  public function getElemState():int { return $this->elemstate; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->elemstate == self::NUTRITIONAL_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::NUTRITIONAL_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::NUTRITIONAL_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setCode(string $code) { $this->code = $code; }
  public function setName(string $name) { $this->name = $name; }
  public function setIsCalorie(int $isCalorie) { $this->iscalorie = $isCalorie; }
  public function setIsProetin(int $isProetin) { $this->isproetin = $isProetin; }
  public function setIsGlucide(int $isGlucide) { $this->isglucide = $isGlucide; }
  public function setIsLipid(int $isLipid) { $this->islipid = $isLipid; }
  public function setIsVitamin(int $isVitamin) { $this->isvitamin = $isVitamin; }
  public function setIstTaceElement(int $istTaceElement) { $this->istraceelement = $istTaceElement; }
  public function setIsMineral(int $isMineral) { $this->ismineral = $isMineral; }
  public function setElemState(int $elemState) { $this->elemstate = $elemState; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->elemstate = self::NUTRITIONAL_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->elemstate = self::NUTRITIONAL_STATUS_NOT_AVAILABLE; }
}
