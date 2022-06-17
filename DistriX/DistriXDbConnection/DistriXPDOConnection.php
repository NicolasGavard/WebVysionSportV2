<?php // Needed to encode in UTF8 ààéàé //
include(__DIR__ . "/../DistriXCrypto/DistriXCrypto.php");

if (!class_exists('DistriXPDOConnection', false)) {
  class DistriXPDOConnection extends PDO
  {
    private $connectionFile;
    private $errorData;
    private $distriXTrace;

    public function __construct(string $connectionFile, string $encryptionKey)
    {
      $this->connectionFile = $connectionFile;
      $this->errorData      = null;
      $this->distriXTrace   = null;
      if (strlen($this->connectionFile) > 0) {
        include($this->connectionFile);
        // connexion
        if (strlen($encryptionKey) > 0) {
          $bdd = DistriXCrypto::decode($bdd, $encryptionKey);
          $host = DistriXCrypto::decode($host, $encryptionKey);
          $user = DistriXCrypto::decode($user, $encryptionKey);
          $passBD = DistriXCrypto::decode($passBD, $encryptionKey);
        }
        if (
          strlen($bdd) > 0 && strlen($host) > 0 &&
          strlen($user) > 0 && strlen($passBD) > 0
        ) {
          $dsn = "mysql:dbname=$bdd;host=$host;charset=utf8";
          try {
            parent::__construct($dsn, $user, $passBD);
          } catch (PDOException $e) {
            $error = new DistriXSvcErrorData();
            $error->setTypeSystem();
            $error->setSeverityCritical();
            $error->setCode($e->getCode() . " - Connection failed. file : " . $connectionFile);
            $error->setTextToAllText($e->getMessage());
            $error->setParameters($e->getTrace());
            $error->setFileName($e->getFile() . ", line " . $e->getLine());
            $this->errorData = $error;
          }
        } else {
          $error = new DistriXSvcErrorData();
          $error->setTypeSystem();
          $error->setSeverityCritical();
          $error->setCode($e->getCode() . " - Connection failed. file : " . $connectionFile);
          $error->setTextToAllText($e->getMessage());
          $error->setParameters($e->getTrace());
          $error->setFileName($e->getFile() . ", line " . $e->getLine());
          $this->errorData = $error;
        }
      } else {
        $error = new DistriXSvcErrorData();
        $error->setTypeSystem();
        $error->setSeverityCritical();
        $error->setCode("Database");
        $error->setTextToAllText("No Connection file");
        $this->errorData = $error;
      }
    }
    /* End __construct */

    public function commit(): bool
    {
      $confirmCommit = false;
      $traceConfirm  = true;
      $trace = $this->getTrace();
      if (!is_null($trace) && $trace->getCommitBefore()) {
        $traceConfirm = $trace->commitTrace($this);
      }
      if ($traceConfirm) {
        $confirmCommit = parent::commit();
      }
      if ($confirmCommit) {
        if (!is_null($trace) && !$trace->getCommitBefore()) {
          $traceConfirm = $trace->commitTrace($this);
          if (!$traceConfirm) {
            $error = new DistriXSvcErrorData();
            $error->setTypeSystem();
            $error->setSeverityCritical();
            $error->setCode("Database_Trace_Commit");
            $error->setTextToAllText("Error Trace Commit");
            $this->errorData = $error;
          }
        }
      } else {
        $error = new DistriXSvcErrorData();
        $error->setTypeSystem();
        $error->setSeverityCritical();
        $error->setCode("Database_Commit");
        $error->setTextToAllText("Error Database Commit");
        $this->errorData = $error;
      }
      return $confirmCommit;
    }
    /* End commit */

    public function getError(): ?DistriXSvcErrorData
    {
      return $this->errorData;
    }
    /* End function getError */

    public function getTrace(): ?DistriXTrace
    {
      return $this->distriXTrace;
    }
    /* End function getTrace */

    public function setTrace(DistriXTrace $distriXTrace)
    {
      $this->distriXTrace = $distriXTrace;
    }
    /* End function setTrace */
  }
  // End of Class
}
