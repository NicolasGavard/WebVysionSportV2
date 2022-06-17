<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionCurrentDietMealData", false)) {
  class DistriXNutritionCurrentDietMealData extends DistriXSvcAppData
  {
    protected $id;
    protected $idDiet;
    protected $idDietRecipe;
    protected $nameDietRecipe;
    protected $dayNumber;
    protected $idMealType;
    protected $nameMealType;
    protected $foods;
    protected $elemState;
    protected $timestamp;

    public function __construct()
    {
      $this->id             = 0;
      $this->idDiet         = 0;
      $this->idDietRecipe   = 0;
      $this->nameDietRecipe = "";
      $this->dayNumber      = 0;
      $this->idMealType     = 0;
      $this->nameMealType   = "";
      $this->foods          = [];
      $this->elemState      = 0;
      $this->timestamp      = 0;
    }
    // Gets
    public function getId():int { return $this->id; }
    public function getIdDiet():int { return $this->idDiet; }
    public function getIdDietRecipe():int { return $this->idDietRecipe; }
    public function getNameDietRecipe():string { return $this->nameDietRecipe; }
    public function getDayNumber():int { return $this->dayNumber; }
    public function getIdMealType():int { return $this->idMealType; }
    public function getNameMealType():string { return $this->nameMealType; }
    public function getFoods():array { return $this->foods; }
    public function getElemState():int { return $this->elemState; }
    public function getTimestamp():int { return $this->timestamp; }

    // Sets
    public function setId(int $id) { $this->id = $id; }
    public function setIdDiet(int $idDiet) { $this->idDiet = $idDiet; }
    public function setIdDietRecipe(int $idDietRecipe) { $this->idDietRecipe = $idDietRecipe; }
    public function setNameDietRecipe(int $nameDietRecipe) { $this->nameDietRecipe = $nameDietRecipe; }
    public function setDayNumber(string $dayNumber) { $this->dayNumber = $dayNumber; }
    public function setIdMealType(int $idMealType) { $this->idMealType = $idMealType; }
    public function setNameMealType(int $nameMealType) { $this->nameMealType = $nameMealType; }
    public function setFoods(int $foods) { $this->foods = $foods; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
