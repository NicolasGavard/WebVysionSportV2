<?php // Needed to encode in UTF8 ààéàé //
class RecipeingredientStorData extends DistriXSvcAppData {
  const RECIPEINGREDIENT_STATUS_AVAILABLE     = 0;
  const RECIPEINGREDIENT_STATUS_NOT_AVAILABLE = 1;

  protected $id;
  protected $idrecipe;
  protected $idingredient;
  protected $weight;
  protected $calorie;
  protected $proetin;
  protected $glucide;
  protected $lipid;
  protected $type;
  protected $statut;
  protected $timestamp;

  public function __construct() {
      $this->id = 0;
      $this->idrecipe = 0;
      $this->idingredient = 0;
      $this->weight = 0;
      $this->calorie = 0;
      $this->proetin = 0;
      $this->glucide = 0;
      $this->lipid = 0;
      $this->type = "";
      $this->statut = 0;
      $this->timestamp = 0;
    }
// Gets
  public function getId():int { return $this->id; }
  public function getIdRecipe():int { return $this->idrecipe; }
  public function getIdIngredient():int { return $this->idingredient; }
  public function getWeight():int { return $this->weight; }
  public function getCalorie():int { return $this->calorie; }
  public function getProetin():int { return $this->proetin; }
  public function getGlucide():int { return $this->glucide; }
  public function getLipid():int { return $this->lipid; }
  public function getType():string { return $this->type; }
  public function getStatus():int { return $this->statut; }
  public function getTimestamp():int { return $this->timestamp; }
  public function isAvailable():bool { return ($this->statut == self::RECIPEINGREDIENT_STATUS_AVAILABLE); }
  public function getAvailableValue():int { return self::RECIPEINGREDIENT_STATUS_AVAILABLE; }
  public function getUnavailableValue():int { return self::RECIPEINGREDIENT_STATUS_NOT_AVAILABLE; }
// Sets
  public function setId(int $id) { $this->id = $id; }
  public function setIdRecipe(int $idRecipe) { $this->idrecipe = $idRecipe; }
  public function setIdIngredient(int $idIngredient) { $this->idingredient = $idIngredient; }
  public function setWeight(int $weight) { $this->weight = $weight; }
  public function setCalorie(int $calorie) { $this->calorie = $calorie; }
  public function setProetin(int $proetin) { $this->proetin = $proetin; }
  public function setGlucide(int $glucide) { $this->glucide = $glucide; }
  public function setLipid(int $lipid) { $this->lipid = $lipid; }
  public function setType(string $type) { $this->type = $type; }
  public function setStatus(int $status) { $this->statut = $status; }
  public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }
  public function setAvailable() { $this->statut = self::RECIPEINGREDIENT_STATUS_AVAILABLE; }
  public function setUnavailable() { $this->statut = self::RECIPEINGREDIENT_STATUS_NOT_AVAILABLE; }
}
