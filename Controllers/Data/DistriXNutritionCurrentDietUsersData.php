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
    public function getIdUser() { return $this->idUser; }
    public function getNameUser() { return $this->nameUser; }
    public function getFirstNameUser() { return $this->firstNameUser; }
    // Sets
    public function setIdUser($idUser) { $this->idUser = $idUser; }
    public function setNameUser($nameUser) { $this->nameUser = $nameUser; }
    public function setFirstNameUser($firstNameUser) { $this->firstNameUser = $firstNameUser; }
  }
  // End of class
}
// class_exists
