<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionRecipeFoodData", false)) {
  class DistriXNutritionRecipeFoodData extends DistriXSvcAppData
  {
    protected $id;
    protected $idRecipe;
    protected $nameRecipe;
    protected $idFood;
    protected $nameFood;
    protected $weight;
    protected $idWeightType;
    protected $nameWeightType;
    protected $abbrWeightType;
    protected $calorie;
    protected $proetin;
    protected $glucide;
    protected $lipid;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idRecipe       = 0;
      $this->nameRecipe     = "";
      $this->idFood         = 0;
      $this->nameFood       = "";
      $this->weight         = 0.0;
      $this->idWeightType   = 0;
      $this->nameWeightType = "";
      $this->abbrWeightType = "";
      $this->calorie        = 0.0;
      $this->proetin        = 0.0;
      $this->glucide        = 0.0;
      $this->lipid          = 0.0;
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdRecipe():int { return $this->idRecipe; }
    public function getNameRecipe():string { return $this->nameRecipe; }
    public function getIdFood():int { return $this->idFood; }
    public function getNameFood():string { return $this->nameFood; }
    public function getWeight():string { return $this->weight; }
    public function getIdWeightType():int { return $this->idWeightType; }
    public function getNameWeightType():string { return $this->nameWeightType; }
    public function geAbbrWeightType():string { return $this->abbrWeightType; }
    public function getCalorie():float { return $this->calorie; }
    public function getProetin():float { return $this->proetin; }
    public function getGlucide():float{ return $this->glucide; }
    public function getLipid():float { return $this->lipid; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdRecipe(int $idRecipe) { $this->idRecipe = $idRecipe; }
    public function setNameRecipe(string $nameRecipe) { $this->nameRecipe = $nameRecipe; }
    public function setIdFood(int $idFood) { $this->idFood = $idFood; }
    public function setNameFood(string $nameFood) { $this->nameFood = $nameFood; }
    public function setWeight(string $weight) { $this->weight = $weight; }
    public function setIdWeightType(int $idWeightType) { $this->idWeightType = $idWeightType; }
    public function setNameWeightType(string $nameWeightType) { $this->nameWeightType = $nameWeightType; }
    public function setAbbrWeightType(string $abbrWeightType) { $this->abbrWeightType = $abbrWeightType; }
    public function setCalorie(float $calorie) { $this->calorie = $calorie; }
    public function setProetin(float $proetin) { $this->proetin = $proetin; }
    public function setGlucide(float $glucide) { $this->glucide = $glucide; }
    public function setLipid(float $lipid) { $this->lipid = $lipid; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
