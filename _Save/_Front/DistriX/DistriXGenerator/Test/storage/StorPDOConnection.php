<?php // Needed to encode in UTF8 ààéàé //

if (! class_exists('StorPDOConnection', false)) {

class StorPDOConnection
{
private $databaseConnection;
private $connectionFile;

public function __construct($connectionFile="")
{
  $this->connectionFile = $connectionFile;
  $this->databaseConnection = null;
}

public function getConnection()
{
  return $this->databaseConnection;
}
public function openConnection($connectionFile="")
{
$errortxt = "";
$error = false;

  if (strlen($connectionFile) > 0)
    $this->connectionFile = $connectionFile;

  if (strlen($this->connectionFile) > 0)
  {
    include($this->connectionFile);
// connexion
    $dsn = "mysql:dbname=$bdd;host=$host;charset=utf8";
    try {
      $this->databaseConnection = new PDO($dsn, $user, $passBD);
    } 
    catch (PDOException $e) {
      $error    = true;
      $errortxt = 'Connection failed: ' . $e->getMessage();
    }
  }
  else
  {
    $error    = true;
    $errortxt = 'No Connection file';
  }
  return array($this->databaseConnection, $error, $errortxt);
}
/* End function openConnection */

public function closeConnection()
{
  $databaseConnection = null;
}
/* End function closeConnection */

}
// End of Class
}
?>