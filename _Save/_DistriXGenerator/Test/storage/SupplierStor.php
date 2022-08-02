<?php // Needed to encode in UTF8 ààéàé //
//
// Data Version : 1-10
//
class SupplierStor
{
private $connectionFile;

public function __construct($connectionFile="") { $this->connectionFile = $connectionFile; }
public function getConnectionFile() { return $this->connectionFile; }
public function setConnectionFile($connectionFile) { $this->connectionFile = $connectionFile; }

public function read($id, $InDbConnection=null)
{
$dbConnection=$connect=null;
$request = $errortxt = "";
$error = false;
$supplierData = new SupplierData();

  $dbConnection = $InDbConnection;
  if ($dbConnection == null)
  {
    $connect = new StorPDOConnection($this->connectionFile);
    list($dbConnection, $error, $errortxt) = $connect->openConnection();
  }
  if ($dbConnection != null)
  {
    $request  = "SELECT id,code,name,website,email,phone,mobile,co,street,zipcode,city,region,idcountry,idlanguage,";
    $request .= "statut,idusercreate,datecreate,timecreate,";
    $request .= "idusermodif,datelastmodif,timelastmodif,iduserdelete,datedelete,timedelete";
    $request .= " FROM supplier";
    $request .= " WHERE id = $id";
//echo "*</p>*</p>*</p>*" . $request . "**";
    foreach ($dbConnection->query($request) as $val)
    {
      $supplierData = new SupplierData($val["id"], $val["code"]);
      $supplierData->setName($val["name"]);
      $supplierData->setWebSite($val["website"]);
      $supplierData->setEmail($val["email"]);
      $supplierData->setPhone($val["phone"]);
      $supplierData->setMobile($val["mobile"]);
      $supplierData->setCo($val["co"]);
      $supplierData->setStreet($val["street"]);
      $supplierData->setZipCode($val["zipcode"]);
      $supplierData->setCity($val["city"]);
      $supplierData->setRegion($val["region"]);
      $supplierData->setIdCountry($val["idcountry"]);
      $supplierData->setIdLanguage($val["idlanguage"]);
      $supplierData->setStatus($val["statut"]);
      $supplierData->setUserCreate($val["idusercreate"]);
      $supplierData->setDateCreate($val["datecreate"]);
      $supplierData->setTimeCreate($val["timecreate"]);
      $supplierData->setUserModif($val["idusermodif"]);
      $supplierData->setDateModif($val["datelastmodif"]);
      $supplierData->setTimeModif($val["timelastmodif"]);
      $supplierData->setUserDelete($val["iduserdelete"]);
      $supplierData->setDateDelete($val["datedelete"]);
      $supplierData->setTimeDelete($val["timedelete"]);
    }
    if ($InDbConnection == null) $connect->closeConnection();
  }
  return $supplierData;
}
// End of read

public function getList($all=false, $InDbConnection=null)
{
$dbConnection=$connect=null;
$request = $errortxt = "";
$error = false;
$supplierlist = array(); $supplierlistind = 0;
$data = new SupplierData();

  $dbConnection = $InDbConnection;
  if ($dbConnection == null)
  {
    $connect = new StorPDOConnection($this->connectionFile);
    list($dbConnection, $error, $errortxt) = $connect->openConnection();
  }
  if ($dbConnection != null)
  {
    $request  = "SELECT id,code,name,website,email,phone,mobile,co,street,zipcode,city,region,idcountry,idlanguage,";
    $request .= "statut,idusercreate,datecreate,timecreate,";
    $request .= "idusermodif,datelastmodif,timelastmodif,iduserdelete,datedelete,timedelete";
    $request .= " FROM supplier p";
    if (!$all)
      $request .= " WHERE p.statut = ".$data->getAvailableValue();
    $request .= " ORDER BY name";

//echo "*</p>*</p>*</p>*" . $request . "**";
    foreach ($dbConnection->query($request) as $val)
    {
      $supplierData = new SupplierData($val["id"], $val["code"]);
      $supplierData->setName($val["name"]);
      $supplierData->setWebSite($val["website"]);
      $supplierData->setEmail($val["email"]);
      $supplierData->setPhone($val["phone"]);
      $supplierData->setMobile($val["mobile"]);
      $supplierData->setCo($val["co"]);
      $supplierData->setStreet($val["street"]);
      $supplierData->setZipCode($val["zipcode"]);
      $supplierData->setCity($val["city"]);
      $supplierData->setRegion($val["region"]);
      $supplierData->setIdCountry($val["idcountry"]);
      $supplierData->setIdLanguage($val["idlanguage"]);
      $supplierData->setStatus($val["statut"]);
      $supplierData->setUserCreate($val["idusercreate"]);
      $supplierData->setDateCreate($val["datecreate"]);
      $supplierData->setTimeCreate($val["timecreate"]);
      $supplierData->setUserModif($val["idusermodif"]);
      $supplierData->setDateModif($val["datelastmodif"]);
      $supplierData->setTimeModif($val["timelastmodif"]);
      $supplierData->setUserDelete($val["iduserdelete"]);
      $supplierData->setDateDelete($val["datedelete"]);
      $supplierData->setTimeDelete($val["timedelete"]);
      $supplierlist[$supplierlistind] = $supplierData;
      $supplierlistind += 1;
    }
    if ($InDbConnection == null) $connect->closeConnection();
  }
  return array($supplierlist, $supplierlistind);
}
// End of getList

public function update($dbConnection, $supplierData)
{
$insere = $codeexists = $nameexists = false;
$request = "";

  if ($dbConnection != null)
  {
    $request  = "SELECT code FROM supplier p";
    $request .= " WHERE p.code = '".$supplierData->getCode()."'";
    $request .= " AND p.id !=".$supplierData->getId();
//echo "*</p>*</p>*</p>*" . $request . "**";
    foreach ($dbConnection->query($request) as $val)
    {
      $codeexists = true;
    }
    $request  = "SELECT name FROM supplier p";
    $request .= " WHERE p.name = '".$supplierData->getName()."'";
    $request .= " AND p.id !=".$supplierData->getId();
//echo "*</p>*</p>*</p>*" . $request . "**";
    foreach ($dbConnection->query($request) as $val)
    {
      $nameexists = true;
    }
    if (!$codeexists && !$nameexists)
    {
      $request  = "UPDATE supplier SET code='".$supplierData->getCode()."',";
      $request .= "name='".$supplierData->getName()."',";
      $request .= "website='".$supplierData->getWebSite()."',";
      $request .= "email='".$supplierData->getEmail()."',";
      $request .= "phone='".$supplierData->getPhone()."',";
      $request .= "mobile='".$supplierData->getMobile()."',";
      $request .= "co='".$supplierData->getCo()."',";
      $request .= "street='".$supplierData->getStreet()."',";
      $request .= "zipcode='".$supplierData->getZipCode()."',";
      $request .= "city='".$supplierData->getCity()."',";
      $request .= "region='".$supplierData->getRegion()."',";
      $request .= "idcountry=".$supplierData->getIdCountry().",";
      $request .= "idlanguage=".$supplierData->getIdLanguage().",";
      $request .= "statut=".$supplierData->getStatus().",";
      $request .= "idusermodif=".$supplierData->getUserModif().",";
      $request .= "datelastmodif=".$supplierData->getDateModif().",";
      $request .= "timelastmodif=".$supplierData->getTimeModif()."";
      $request .= " WHERE id = ".$supplierData->getId();
      $count = $dbConnection->exec($request);
      $insere = ($count > 0);
      if ($count == 0)
        $insere = ($dbConnection->errorCode() == 0);
//echo "*update *Supplier" . $request . "**<p/>";
    }
  }
  return array($insere, $codeexists, $nameexists);
}
// End of update

public function create($dbConnection, $supplierData)
{
$insere = $codeexists = false;
$request = "";
$idsupplier = 0;

  if ($dbConnection != null)
  {
    $request  = "SELECT code FROM supplier p";
    $request .= " WHERE p.code = '".$supplierData->getCode()."'";
//echo "*</p>*</p>*</p>*" . $request . "**";
    foreach ($dbConnection->query($request) as $val)
    {
      $codeexists = true;
    }
    if (!$codeexists)
    {
      $request = "SELECT MAX(id) FROM supplier";
//echo "*</p>*</p>*</p>*" . $request . "**";
      foreach ($dbConnection->query($request) as $val)
      {
        $idsupplier = $val["MAX(id)"];
      }
      $supplierData->setId($idsupplier + 1);
      $insere = $this->insertDb($dbConnection, $supplierData);
    }
  }
  return array($insere, $supplierData->getId(), $codeexists);
}
// End of create

public function insert($dbConnection, $supplierData)
{
  return $this->insertDb($dbConnection, $supplierData);
}
// End of insert

private function insertDb($dbConnection, $supplierData)
{
$insere = false;
$request = "";

  if ($dbConnection != null)
  {
    $request  = "INSERT INTO supplier(id,code,name,website,email,phone,mobile,";
    $request .= "co,street,zipcode,city,region,idcountry,idlanguage,statut,";
    $request .= "idusercreate,datecreate,timecreate)";
    $request .= " VALUES(";
    $request .= $supplierData->getId().",";
    $request .= "'".$supplierData->getCode()."',";
    $request .= "'".$supplierData->getName()."',";
    $request .= "'".$supplierData->getWebSite()."',";
    $request .= "'".$supplierData->getEmail()."',";
    $request .= "'".$supplierData->getPhone()."',";
    $request .= "'".$supplierData->getMobile()."',";
    $request .= "'".$supplierData->getCo()."',";
    $request .= "'".$supplierData->getStreet()."',";
    $request .= "'".$supplierData->getZipCode()."',";
    $request .= "'".$supplierData->getCity()."',";
    $request .= "'".$supplierData->getRegion()."',";
    $request .= $supplierData->getIdCountry().",";
    $request .= $supplierData->getIdLanguage().",";
    $request .= $supplierData->getStatus().",";
    $request .= $supplierData->getUserCreate().",";
    $request .= $supplierData->getDateCreate().",";
    $request .= $supplierData->getTimeCreate();
    $request .= ")";
    $count = $dbConnection->exec($request);
    $insere = ($count > 0);
//echo "*insert *Supplier" . $request . "**<p/>";
  }
  return $insere;
}
// End of insertDb

//
//
// D E P L O Y M E N T
//
//

public function getDataForDeployment($posVersion, $InDbConnection=null)
{
$dbConnection=$connect=null;
$request = $errortxt = "";
$error = false;
$list = array(); $listind = 0;
$elements = array(); $elementsind = 0;
$arrayName = "supplier";

  $dbConnection = $InDbConnection;
  if ($dbConnection == null)
  {
    $connect = new StorPDOConnection($this->connectionFile);
    list($dbConnection, $error, $errortxt) = $connect->openConnection();
  }
  if ($dbConnection != null)
  {
    list($list, $listind) = $this->getList(true, $dbConnection); // Get everything
    for ($indl=0; $indl<$listind; $indl+=1)
    {
      if ($posVersion == "1-10")
      {
        $elements[$arrayName][$indl]["id"] = $list[$indl]->getId();
        $elements[$arrayName][$indl]["code"] = $list[$indl]->getCode();
        $elements[$arrayName][$indl]["name"] = $list[$indl]->getName();
        $elements[$arrayName][$indl]["website"] = $list[$indl]->getWebSite();
        $elements[$arrayName][$indl]["email"] = $list[$indl]->getEmail();
        $elements[$arrayName][$indl]["phone"] = $list[$indl]->getPhone();
        $elements[$arrayName][$indl]["mobile"] = $list[$indl]->getMobile();
        $elements[$arrayName][$indl]["co"] = $list[$indl]->getCo();
        $elements[$arrayName][$indl]["street"] = $list[$indl]->getStreet();
        $elements[$arrayName][$indl]["zipcode"] = $list[$indl]->getZipCode();
        $elements[$arrayName][$indl]["city"] = $list[$indl]->getCity();
        $elements[$arrayName][$indl]["region"] = $list[$indl]->getRegion();
        $elements[$arrayName][$indl]["idcountry"] = $list[$indl]->getIdCountry();
        $elements[$arrayName][$indl]["idlanguage"] = $list[$indl]->getIdLanguage();
        $elements[$arrayName][$indl]["statut"] = $list[$indl]->getStatus();
        $elements[$arrayName][$indl]["idusercreate"] = $list[$indl]->getUserCreate();
        $elements[$arrayName][$indl]["datecreate"] = $list[$indl]->getDateCreate();
        $elements[$arrayName][$indl]["timecreate"] = $list[$indl]->getTimeCreate();
        $elements[$arrayName][$indl]["idusermodif"] = $list[$indl]->getUserModif();
        $elements[$arrayName][$indl]["datelastmodif"] = $list[$indl]->getDateModif();
        $elements[$arrayName][$indl]["timelastmodif"] = $list[$indl]->getTimeModif();
        $elements[$arrayName][$indl]["iduserdelete"] = $list[$indl]->getUserDelete();
        $elements[$arrayName][$indl]["datedelete"] = $list[$indl]->getDateDelete();
        $elements[$arrayName][$indl]["timedelete"] = $list[$indl]->getTimeDelete();
      }
    }
    $elementsind += $indl;

    if ($InDbConnection == null) $connect->closeConnection();
  }
  return array($elements, $elementsind);
}
// End of getDataForDeployment

public function setDataFromDeployment($InDbConnection=null, $datas, $datasind)
{
$dbConnection=$connect=null;
$insere = false;
$nbelem = 0;

  $dbConnection = $InDbConnection;
  if ($dbConnection == null)
  {
    $connect = new StorPDOConnection($this->connectionFile);
    list($dbConnection, $error, $errortxt) = $connect->openConnection();
  }
  if ($dbConnection != null)
  {
    $insere = true; // To enter in the first loop...
    for ($indl=0; $indl<$datasind && $insere; $indl+=1)
    {
      $data = $this->read($datas[$indl]["id"], $dbConnection);
      $data->setCode(addslashes($datas[$indl]["code"]));
      $data->setName(addslashes($datas[$indl]["name"]));
      $data->setEmail(addslashes($datas[$indl]["email"]));
      $data->setWebSite(addslashes($datas[$indl]["website"]));
      $data->setPhone(addslashes($datas[$indl]["phone"]));
      $data->setMobile(addslashes($datas[$indl]["mobile"]));
      $data->setCo(addslashes($datas[$indl]["co"]));
      $data->setStreet(addslashes($datas[$indl]["street"]));
      $data->setZipCode(addslashes($datas[$indl]["zipcode"]));
      $data->setCity(addslashes($datas[$indl]["city"]));
      $data->setRegion($datas[$indl]["region"]);
      $data->setIdCountry($datas[$indl]["idcountry"]);
      $data->setIdLanguage($datas[$indl]["idlanguage"]);
      $data->setStatus($datas[$indl]["statut"]);
      $data->setUserCreate($datas[$indl]["idusercreate"]);
      $data->setDateCreate($datas[$indl]["datecreate"]);
      $data->setTimeCreate($datas[$indl]["timecreate"]);
      $data->setUserModif($datas[$indl]["idusermodif"]);
      $data->setDateModif($datas[$indl]["datelastmodif"]);
      $data->setTimeModif($datas[$indl]["timelastmodif"]);
      $data->setUserDelete($datas[$indl]["iduserdelete"]);
      $data->setDateDelete($datas[$indl]["datedelete"]);
      $data->setTimeDelete($datas[$indl]["timedelete"]);

      if ($data->getId() > 0)
      {
        $insere = $this->update($dbConnection, $data);
      }
      else
      {
        $data->setId($datas[$indl]["id"]);
        $insere = $this->insert($dbConnection, $data);
      }
    }
    $nbelem = $indl;
    if ($InDbConnection == null) $connect->closeConnection();
  }
  return array($insere, $nbelem);
}
// End of setDataFromDeployment
}
// End of Class
?>
