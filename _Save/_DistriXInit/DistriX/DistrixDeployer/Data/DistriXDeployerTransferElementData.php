<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXDeployerTransferElementData", false)) {
  class DistriXDeployerTransferElementData extends DistriXSvcAppData
  {
    protected $element;
    protected $isFile;
    protected $isDir;
    protected $isSql;
    protected $isCreateOnly;
    protected $error;

    public function __construct()
    {
      $this->element = "";
      $this->isFile = false;
      $this->isDir = false;
      $this->isSql = false;
      $this->isCreateOnly = false;
      $this->error = null;
    }
    // Gets
    public function getElement(): string
    {
      return $this->element;
    }
    public function getIsFile(): bool
    {
      return $this->isFile;
    }
    public function getIsDir(): bool
    {
      return $this->isDir;
    }
    public function getIsSql(): bool
    {
      return $this->isSql;
    }
    public function getIsCreateOnly(): bool
    {
      return $this->isCreateOnly;
    }
    public function getError()
    {
      return $this->error;
    }

    // Sets
    public function setElement(string $element)
    {
      $this->element = $element;
    }
    public function setIsFile(bool $isFile)
    {
      $this->isFile = $isFile;
    }
    public function setIsDir(bool $isDir)
    {
      $this->isDir = $isDir;
    }
    public function setIsSql(bool $isSql)
    {
      $this->isSql = $isSql;
    }
    public function setIsCreateOnly(bool $isCreateOnly)
    {
      $this->isCreateOnly = $isCreateOnly;
    }
    public function setError($error)
    {
      $this->error = $error;
    }
  }
  // End of class
}
// class_exists
