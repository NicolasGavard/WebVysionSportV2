<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXFoodFoodData", false)) {
  class DistriXFoodFoodData extends DistriXSvcAppData
  {
    protected $id;
    protected $idBrand;
    protected $nameBrand;
    protected $pictureBrand;
    protected $idScoreNutri;
    protected $pictureScoreNutri;
    protected $idScoreNova;
    protected $pictureScoreNova;
    protected $idScoreEco;
    protected $pictureScoreEco;
    protected $code;
    protected $name;
    protected $description;
    protected $foodCategories;
    protected $foodLabels;
    protected $foodNutritionals;
    protected $foodWeights;
    protected $statut;
    protected $timestamp;

    public function __construct()
    {
      $this->id               = 0;
      $this->idBrand          = 0;
      $this->nameBrand        = "";
      $this->pictureBrand     = "";
      $this->idScoreNutri     = 0;
      $this->pictureScoreNutri= "";
      $this->idScoreNova      = 0;
      $this->pictureScoreNova = "";
      $this->idScoreEco       = 0;
      $this->pictureScoreEco  = "";
      $this->code             = "";
      $this->name             = "";
      $this->description      = "";
      $this->foodCategories  = [];
      $this->foodLabels       = [];
      $this->foodNutritionals = [];
      $this->foodWeights      = [];
      $this->statut           = 0;
      $this->timestamp        = 0;

    }
    // Gets
    public function getId() { return $this->id; }
    public function getIdBrand() { return $this->idBrand; }
    public function getNameBrand() { return $this->nameBrand; }
    public function getPictureBrand() { return $this->pictureBrand; }
    public function getIdScoreNutri() { return $this->idScoreNutri; }
    public function getPictureScoreNutri() { return $this->pictureScoreNutri; }
    public function getIdScoreNova() { return $this->idScoreNova; }
    public function getPictureScoreNova() { return $this->pictureScoreNova; }
    public function getIdScoreEco() { return $this->idScoreEco; }
    public function getPictureScoreEco() { return $this->pictureScoreEco; }
    public function getCode() { return $this->code; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getFoodCategories() { return $this->foodCategories; }
    public function getFoodLabels() { return $this->foodLabels; }
    public function getFoodNutritionals() { return $this->foodNutritionals; }
    public function getFoodWeights() { return $this->foodWeights; }
    public function getStatut() { return $this->statut; }
    public function getTimestamp() { return $this->timestamp; }

    // Sets
    public function setId($id) { $this->id = $id; }
    public function setIdBrand($idBrand) { $this->idBrand = $idBrand; }
    public function setNameBrand($nameBrand) { $this->nameBrand = $nameBrand; }
    public function setPictureBrand($pictureBrand) { $this->pictureBrand = $pictureBrand; }
    public function setIdScoreNutri($idScoreNutri) { $this->idScoreNutri = $idScoreNutri; }
    public function setPictureScoreNutri($pictureScoreNutri) { $this->pictureScoreNutri = $pictureScoreNutri; }
    public function setIdScoreNova($idScoreNova) { $this->idScoreNova = $idScoreNova; }
    public function setPictureScoreNova($pictureScoreNova) { $this->pictureScoreNova = $pictureScoreNova; }
    public function setIdScoreEco($idScoreEco) { $this->idScoreEco = $idScoreEco; }
    public function setPictureScoreEco($pictureScoreEco) { $this->pictureScoreEco = $pictureScoreEco; }
    public function setCode($code) { $this->code = $code; }
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setFoodCategories($foodCategories) { $this->foodCategories = $foodCategories; }
    public function setFoodLabels($foodLabels) { $this->foodLabels = $foodLabels; }
    public function setFoodNutritionals($foodNutritionals) { $this->foodNutritionals = $foodNutritionals; }
    public function setFoodWeights($foodWeights) { $this->foodWeights = $foodWeights; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
  }
  // End of class
}
// class_exists
