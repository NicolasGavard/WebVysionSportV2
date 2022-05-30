<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXNutritionCurrentDietUsersData", false)) {
  class DistriXNutritionCurrentDietUsersData extends DistriXSvcAppData
  {
    protected $idUser;
    protected $nameUser;
    protected $firstNameUser;
    
    public function __construct()
    {
      $this->idUser         = 0;
      $this->nameUser       = "";
      $this->firstNameUser  = "";
    }
    // Gets
    public function getIdUser():int { return $this->idUser; }
    public function getNameUser():string { return $this->nameUser; }
    public function getFirstNameUser():string { return $this->firstNameUser; }
    // Sets
    public function setIdUser(int $idUser) { $this->idUser = $idUser; }
    public function setNameUser(string $nameUser) { $this->nameUser = $nameUser; }
    public function setFirstNameUser(string $firstNameUser) { $this->firstNameUser = $firstNameUser; }
  }
  // End of class
}
// class_exists
