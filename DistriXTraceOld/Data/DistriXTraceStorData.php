<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXTraceStorData", false)) {
  class DistriXTraceStorData
  {
    private $id;
    private $iduser;
    private $databaseschema;
    private $operationtable;
    private $operationid;
    private $operationcode;
    private $operationdate;
    private $operationtime;
    private $operationdata;

    public function __construct()
    {
      $this->id             = 0;
      $this->iduser         = 0;
      $this->databaseschema = "";
      $this->operationtable = "";
      $this->operationid    = 0;
      $this->operationcode  = "";
      $this->operationdate  = 0;
      $this->operationtime  = 0;
      $this->operationdata  = "";
    }
    // Gets
    public function getId()
    {
      return $this->id;
    }
    public function getIdUser()
    {
      return $this->iduser;
    }
    public function getDataBaseschema()
    {
      return $this->databaseschema;
    }
    public function getOperationTable()
    {
      return $this->operationtable;
    }
    public function getOperationId()
    {
      return $this->operationid;
    }
    public function getOperationCode()
    {
      return $this->operationcode;
    }
    public function getOperationDate()
    {
      return $this->operationdate;
    }
    public function getOperationTime()
    {
      return $this->operationtime;
    }
    public function getOperationData()
    {
      return $this->operationdata;
    }
    // Sets
    public function setId($id)
    {
      $this->id = $id;
    }
    public function setIdUser($idUser)
    {
      $this->iduser = $idUser;
    }
    public function setDataBaseschema($dataBaseschema)
    {
      $this->databaseschema = $dataBaseschema;
    }
    public function setOperationTable($operationTable)
    {
      $this->operationtable = $operationTable;
    }
    public function setOperationId($operationid)
    {
      $this->operationid = $operationid;
    }
    public function setOperationCode($operationCode)
    {
      $this->operationcode = $operationCode;
    }
    public function setOperationDate($operationDate)
    {
      $this->operationdate = $operationDate;
    }
    public function setOperationTime($operationTime)
    {
      $this->operationtime = $operationTime;
    }
    public function setOperationData($operationData)
    {
      $this->operationdata = $operationData;
    }

    // End of class
  }
  // class_exists
}
