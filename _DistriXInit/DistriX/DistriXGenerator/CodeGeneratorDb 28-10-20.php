<?php // Needed to encode in UTF8 ààéàé //
//
// Version : 1-10
//
if (! class_exists('CodeGeneratorDb', false)) {
  class CodeGeneratorDb {

    public function __construct() { }

    public function generate($tableName, $storName, $field, $fieldind, $uniqueKey, $dbListObjectName, $dbDataObjectName, $directory,
                             $listSortedBy, $listField1, $listField2, $listField3, $listField4, $listField5, $listField6) {
      $done = false;
      $errorT = $errorR = "";
      $statusField = "status";
      $statusFieldBis = "statut";
      $hasStatusField = false;

      if (strlen($tableName) > 0 &&
          $fieldind > 0 &&
          $uniqueKey > -1 &&
          strlen($directory) > 0)
      {
        if (substr($directory, strlen($directory) -1) != '\\') $directory .= '\\';
        $filename = $directory.$storName.".php";
        $tableNameUpper = strtoupper($tableName);

       for ($i=0; $i < $fieldind; $i++) {
          if (strtoupper($field[$i]["nom"]) == strtoupper($statusField)
           || strtoupper($field[$i]["nom"]) == strtoupper($statusFieldBis)) {
            $hasStatusField = true;
            $field[$i]["up"] = $statusField;
            break;
          }
        }
        $f=fopen($filename, 'w');
        fputs($f,'<?php // Needed to encode in UTF8 ààéàé //'."\r\n");
        fputs($f,'//'."\r\n");
        fputs($f,'// Data Version : 1-10'."\r\n");
        fputs($f,'//'."\r\n");
        fputs($f,'class '.$storName.' {'."\r\n");

// Get List
        fputs($f,'  public function getList($all=false, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $request = "";'."\r\n");
        fputs($f,'    $data = new '.$dbDataObjectName.'();'."\r\n");
        fputs($f,'    $list = array(); $listInd = 0;'."\r\n");
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");
        fputs($f,'      $request  = "SELECT ');

        for ($i=0; $i < $fieldind; $i++) {
          if($i>0) fputs($f,',');
          fputs($f,$field[$i]["nom"]);
        }
/*
        if ($listField1 > -1) fputs($f,$field[$listField1]["nom"]);
        if ($listField2 > -1) fputs($f,','.$field[$listField2]["nom"]);
        if ($listField3 > -1) fputs($f,','.$field[$listField3]["nom"]);
        if ($listField4 > -1) fputs($f,','.$field[$listField4]["nom"]);
        if ($listField5 > -1) fputs($f,','.$field[$listField5]["nom"]);
        if ($listField6 > -1) fputs($f,','.$field[$listField6]["nom"]);
*/
        fputs($f,'";'."\r\n");
        fputs($f,'      $request .= " FROM '.$tableName.'";'."\r\n");
//        fputs($f,'      //$request .= " WHERE s.id = idsupplier";'."\r\n");
        // fputs($f,'      //$request .= " AND statut = ".$data->getAvailableValue();'."\r\n");
        fputs($f,'      if (!$all)'."\r\n");
        fputs($f,'        $request .= " WHERE statut = ".$data->getAvailableValue();'."\r\n");
        fputs($f,'      $request .= " ORDER BY '.$field[$listSortedBy]["nom"].'";'."\r\n");
        fputs($f,"\r\n");

        fputs($f,'//echo "*</p>*</p>*</p>*" . $request . "**";'."\r\n");
        fputs($f,'      foreach ($inDbConnection->query($request) as $val) {'."\r\n");
        fputs($f,'        $data = new '.$dbDataObjectName.'();'."\r\n");

        for ($i=0; $i < $fieldind; $i++) {
          fputs($f,'        $data->set'.ucfirst($field[$i]["up"]).'($val["'.$field[$i]["nom"].'"]);'."\r\n");
        }

/*
        if ($listField1 > -1)
          fputs($f,'        $data->set'.ucfirst($field[$listField1]["up"]).'($val["'.$field[$listField1]["nom"].'"]);'."\r\n");
        if ($listField2 > -1)
          fputs($f,'        $data->set'.ucfirst($field[$listField2]["up"]).'($val["'.$field[$listField2]["nom"].'"]);'."\r\n");
        if ($listField3 > -1)
          fputs($f,'        $data->set'.ucfirst($field[$listField3]["up"]).'($val["'.$field[$listField3]["nom"].'"]);'."\r\n");
        if ($listField4 > -1)
          fputs($f,'        $data->set'.ucfirst($field[$listField4]["up"]).'($val["'.$field[$listField4]["nom"].'"]);'."\r\n");
        if ($listField5 > -1)
          fputs($f,'        $data->set'.ucfirst($field[$listField5]["up"]).'($val["'.$field[$listField5]["nom"].'"]);'."\r\n");
        if ($listField6 > -1)
          fputs($f,'        $data->set'.ucfirst($field[$listField6]["up"]).'($val["'.$field[$listField6]["nom"].'"]);'."\r\n");

        fputs($f,'        $listData = new '.$dbListObjectName.'();'."\r\n");
        fputs($f,'        $listData->set'.$dbDataObjectName.'($data);'."\r\n");
        fputs($f,'        //$listData->setSupplierData($supplierData);'."\r\n");
        fputs($f,'        $list[$listInd] = $listData;'."\r\n");
*/
        fputs($f,'        $list[$listInd] = $data;'."\r\n");
        fputs($f,'        $listInd += 1;'."\r\n");
        fputs($f,'      }'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return array($list, $listInd);'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of getList'."\r\n");

// Read
        fputs($f,"\r\n");
        fputs($f,'  public function read($id, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $request = "";'."\r\n");
        fputs($f,'    $data = new '.$dbDataObjectName.'();'."\r\n");
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");
        fputs($f,'      $request  = "SELECT ');
        for ($i=0; $i < $fieldind; $i++) {
          if($i>0) fputs($f,',');
          fputs($f,$field[$i]["nom"]);
        }
        fputs($f,'";'."\r\n");
        fputs($f,'      $request .= " FROM '.$tableName.'";'."\r\n");
        fputs($f,'      $request .= " WHERE '.$field[$uniqueKey]["nom"].' = $id";'."\r\n");
        fputs($f,'//echo "*</p>*</p>*</p>*" . $request . "**";'."\r\n");
        fputs($f,'      foreach ($inDbConnection->query($request) as $val) {'."\r\n");
        fputs($f,'        $data = new '.$dbDataObjectName.'();'."\r\n");
        for ($i=0; $i < $fieldind; $i++) {
          fputs($f,'        $data->set'.ucfirst($field[$i]["up"]).'($val["'.$field[$i]["nom"].'"]);'."\r\n");
        }
        fputs($f,'      }'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return $data;'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of read'."\r\n");

// Update
        fputs($f,"\r\n");
        fputs($f,'  public function update($data, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $insere = false;'."\r\n");
        fputs($f,'    $request = "";'."\r\n");
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");

        fputs($f,'      $request  = "UPDATE '.$tableName.' SET ";'."\r\n");
        $alreadyOneField = false;
        for ($i=0; $i < $fieldind; $i++) {
          if ($i != $uniqueKey) {
            if ($alreadyOneField) fputs($f,' $request .= ",";'."\r\n");
            $alreadyOneField = true;
            if (stripos($field[$i]["type"], "int") !== false ||
                stripos($field[$i]["type"], "tinyint") !== false ||
                stripos($field[$i]["type"], "decimal") !== false ||
                stripos($field[$i]["type"], "bigint") !== false) {
              fputs($f,'      $request .= "'.$field[$i]["nom"].'=".$data->get'.ucfirst($field[$i]["up"]).'();');
            }
            else {
              fputs($f,'      $request .= "'.$field[$i]["nom"].'='."'".'".addslashes($data->get'.ucfirst($field[$i]["up"]).'())."'."'".'";');
            }
          }
        }
        fputs($f,"\r\n");
        fputs($f,'      $request .= " WHERE '.$field[$uniqueKey]["nom"].' = ".$data->get'.ucfirst($field[$uniqueKey]["up"]).'();'."\r\n");
        fputs($f,'      $count = $inDbConnection->exec($request);'."\r\n");
        fputs($f,'      $insere = ($count > 0);'."\r\n");
        fputs($f,'      if ($count == 0)'."\r\n");
        fputs($f,'        $insere = ($inDbConnection->errorCode() == 0);'."\r\n");
        fputs($f,'//echo "*update *'.$tableName.'" . $request . "**<p/>";'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return $insere;'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of update'."\r\n");

// putInDb
        fputs($f,"\r\n");
        fputs($f,'  public function save($data, $idUser, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $insere = false; $id = 0;'."\r\n");
        fputs($f,'    if ($data->getId() > 0) {'."\r\n");
        fputs($f,'      $id = $data->getId();'."\r\n");
        fputs($f,'      $data->setIdUserModif($idUser);'."\r\n");
        fputs($f,'      $data->setDateLastModif(getCurrentNumDate());'."\r\n");
        fputs($f,'      $data->setTimeLastModif(getCurrentNumTime());'."\r\n");
        fputs($f,'      $insere = $this->update($data, $inDbConnection);'."\r\n");
        fputs($f,'    } else {'."\r\n");
        fputs($f,'      $data->setIdUserCreate($idUser);'."\r\n");
        fputs($f,'      $data->setDateCreate(getCurrentNumDate());'."\r\n");
        fputs($f,'      $data->setTimeCreate(getCurrentNumTime());'."\r\n");
        fputs($f,'      list($insere, $id) = $this->create($data, $inDbConnection);'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return array($insere, $id);'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of save'."\r\n");

// remove
        fputs($f,"\r\n");
        fputs($f,'  public function remove($data, $idUser, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $insere = false;'."\r\n");
        fputs($f,'    if ($data->getId() > 0) {'."\r\n");
        fputs($f,'      $userPazziStorData = $this->read($data->getId(), $inDbConnection);'."\r\n");
        fputs($f,'      $userPazziStorData->setUnavailable();'."\r\n");
        fputs($f,'      $userPazziStorData->setIdUserDelete($idUser);'."\r\n");
        fputs($f,'      $userPazziStorData->setDateDelete(getCurrentNumDate());'."\r\n");
        fputs($f,'      $userPazziStorData->setTimeDelete(getCurrentNumTime());'."\r\n");
        fputs($f,'      $insere = $this->update($userPazziStorData, $inDbConnection);'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return $insere;'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of remove'."\r\n");

// restore
        fputs($f,"\r\n");
        fputs($f,'  public function restore($data, $idUser, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $insere = false;'."\r\n");
        fputs($f,'    if ($data->getId() > 0) {'."\r\n");
        fputs($f,'      $userPazziStorData = $this->read($data->getId(), $inDbConnection);'."\r\n");
        // fputs($f,'      $userPazziStorData->setAvailable();'."\r\n");
        fputs($f,'      $userPazziStorData->setIdUserModif($idUser);'."\r\n");
        fputs($f,'      $userPazziStorData->setDateLastModif(getCurrentNumDate());'."\r\n");
        fputs($f,'      $userPazziStorData->setTimeLastModif(getCurrentNumTime());'."\r\n");
        fputs($f,'      $userPazziStorData->setAvailable();'."\r\n");
        fputs($f,'      $insere = $this->update($userPazziStorData, $inDbConnection);'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return $insere;'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of restore'."\r\n");

// Create
        fputs($f,"\r\n");
        fputs($f,'  public function create($data, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $insere = false;'."\r\n");
        fputs($f,'    $request = "";'."\r\n");
        fputs($f,'    $'.$field[$uniqueKey]["up"].' = ');
        if (stripos($field[$uniqueKey]["type"], "int") !== false ||
            stripos($field[$uniqueKey]["type"], "tinyint") !== false ||
            stripos($field[$uniqueKey]["type"], "decimal") !== false ||
            stripos($field[$uniqueKey]["type"], "bigint") !== false) {
          fputs($f,'0;'."\r\n");
        }
        else {
          fputs($f,'"";'."\r\n");
        }
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");

        fputs($f,'      $request = "SELECT MAX('.$field[$uniqueKey]["nom"].') FROM '.$tableName.'";'."\r\n");
        fputs($f,'//echo "*</p>*</p>*</p>*" . $request . "**";'."\r\n");
        fputs($f,'      foreach ($inDbConnection->query($request) as $val) {'."\r\n");
        fputs($f,'        $'.$field[$uniqueKey]["up"].' = $val["MAX('.$field[$uniqueKey]["nom"].')"];'."\r\n");
        fputs($f,'      }'."\r\n");
        fputs($f,'      $data->set'.ucfirst($field[$uniqueKey]["up"]).'($'.$field[$uniqueKey]["up"].' + 1);'."\r\n");
        fputs($f,'      $insere = $this->insertDb($data, $inDbConnection);'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return array($insere, $data->getId());'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of create'."\r\n");

// insert
        fputs($f,"\r\n");
        fputs($f,'  public function insert($data, $inDbConnection) {'."\r\n");
        fputs($f,'    return $this->insertDb($data, $inDbConnection);'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of insert'."\r\n");

// insertDb
        fputs($f,"\r\n");
        fputs($f,'  public function insertDb($data, $inDbConnection) {'."\r\n");
        fputs($f,'    $insere = false;'."\r\n");
        fputs($f,'    $request = "";'."\r\n");
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");
        fputs($f,'      $request  = "INSERT INTO '.$tableName.'(";'."\r\n");
        fputs($f,'      $request .= "');
        for ($i=0; $i < $fieldind; $i++) {
          if($i>0) fputs($f,',');
          fputs($f,$field[$i]["nom"]);
        }
        fputs($f,')";'."\r\n");
        fputs($f,'      $request .= " VALUES(";'."\r\n");
        for ($i=0; $i < $fieldind; $i++) {
          if ($i > 0) fputs($f,' $request .= ",";'."\r\n");
          if (stripos($field[$i]["type"], "int") !== false ||
              stripos($field[$i]["type"], "tinyint") !== false ||
              stripos($field[$i]["type"], "decimal") !== false ||
              stripos($field[$i]["type"], "bigint") !== false) {
            fputs($f,'      $request .= $data->get'.ucfirst($field[$i]["up"]).'();');
          }
          else {
            fputs($f,'      $request .= "'."'".'".addslashes($data->get'.ucfirst($field[$i]["up"]).'())."'."'".'";');
          }
        }
        fputs($f,"\r\n");
        fputs($f,'      $request .= ")";'."\r\n");
        fputs($f,'      $count = $inDbConnection->exec($request);'."\r\n");
        fputs($f,'      $insere = ($count > 0);'."\r\n");
        fputs($f,'//echo "*insert *'.$tableName.'" . $request . "**<p/>";'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return $insere;'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of insertDb'."\r\n");


// getListForDeployment
        fputs($f,"\r\n");
        fputs($f,'  public function getListForDeployment($inDbConnection=null) {'."\r\n");
        fputs($f,'    $request = "";'."\r\n");
        fputs($f,'    $list = array(); $listInd = 0;'."\r\n");
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");
        fputs($f,'      $request  = "SELECT ');
        for ($i=0; $i < $fieldind; $i++) {
          if($i>0) fputs($f,',');
          fputs($f,$field[$i]["nom"]);
        }
        fputs($f,'";'."\r\n");
        fputs($f,'      $request .= " FROM '.$tableName.'";'."\r\n");
        fputs($f,'//echo "*</p>*</p>*</p>*" . $request . "**";'."\r\n");
        fputs($f,'      foreach ($inDbConnection->query($request) as $val) {'."\r\n");
        fputs($f,'        $data = new '.$dbDataObjectName.'();'."\r\n");
        for ($i=0; $i < $fieldind; $i++) {
          fputs($f,'        $data->set'.ucfirst($field[$i]["up"]).'($val["'.$field[$i]["nom"].'"]);'."\r\n");
        }
        fputs($f,'        $list[$listInd] = $data;'."\r\n");
        fputs($f,'        $listInd += 1;'."\r\n");
        fputs($f,'      }'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return array($list, $listInd);'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of getListForDeployment'."\r\n");

// Deployment
        fputs($f,"\r\n");
        fputs($f,"//\r\n");
        fputs($f,"//\r\n");
        fputs($f,"// D E P L O Y M E N T\r\n");
        fputs($f,"//\r\n");
        fputs($f,"//\r\n");

// getDataForDeployment
        fputs($f,"\r\n");
        fputs($f,'  public function getDataForDeployment($posVersion, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $request = "";'."\r\n");
        fputs($f,'    $list = array(); $listInd = 0;'."\r\n");
        fputs($f,'    $elements = array(); $elementsInd = 0;'."\r\n");
        fputs($f,'    $arrayName = "'.$tableName.'";'."\r\n");
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");
        fputs($f,'      list($list, $listInd) = $this->getListForDeployment($inDbConnection);'."\r\n");
        fputs($f,'      for ($indl=0; $indl<$listInd; $indl+=1) {'."\r\n");
        fputs($f,'        if ($posVersion == "1-10") {'."\r\n");

        for ($i=0; $i < $fieldind; $i++) {
          fputs($f,'          $elements[$arrayName][$indl]["'.$field[$i]["nom"].'"] = $list[$indl]->get'.ucfirst($field[$i]["up"]).'();'."\r\n");
        }
        fputs($f,'        }'."\r\n");
        fputs($f,'      }'."\r\n");
        fputs($f,'      $elementsInd += $indl;'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return array($elements, $elementsInd);'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of getDataForDeployment'."\r\n");

// setDataFromDeployment
        fputs($f,"\r\n");
        fputs($f,'  public function setDataFromDeployment($datas, $datasind, $inDbConnection=null) {'."\r\n");
        fputs($f,'    $insere = true;'."\r\n");
        fputs($f,'    $nbElem = 0;'."\r\n");
        fputs($f,"\r\n");
        fputs($f,'    if ($inDbConnection != null) {'."\r\n");
        fputs($f,'      for ($indl=0; $indl<$datasind && $insere; $indl+=1) {'."\r\n");
        fputs($f,'        $data = $this->read($datas[$indl]["'.$field[$uniqueKey]["nom"].'"], $inDbConnection);'."\r\n");
        fputs($f,"\r\n");
        for ($i=0; $i < $fieldind; $i++) {
          fputs($f,'        $data->set'.ucfirst($field[$i]["up"]).'($datas[$indl]["'.$field[$i]["nom"].'"]);'."\r\n");
        }
        fputs($f,"\r\n");
        fputs($f,'        if ($data->getId() > 0) {'."\r\n");
        fputs($f,'          $insere = $this->update($data, $inDbConnection);'."\r\n");
        fputs($f,'        }'."\r\n");
        fputs($f,'        else {'."\r\n");
        fputs($f,'          $data->set'.ucfirst($field[$uniqueKey]["up"]).'($datas[$indl]["'.$field[$uniqueKey]["nom"].'"]);'."\r\n");
        fputs($f,'          $insere = $this->insert($data, $inDbConnection);'."\r\n");
        fputs($f,'        }'."\r\n");
        fputs($f,'      }'."\r\n");
        fputs($f,'      $nbElem = $indl;'."\r\n");
        fputs($f,'    }'."\r\n");
        fputs($f,'    return array($insere, $nbElem);'."\r\n");
        fputs($f,'  }'."\r\n");
        fputs($f,'  // End of setDataFromDeployment'."\r\n");

// Close class and file
        fputs($f,"\r\n");
        fputs($f,'}'."\r\n");
        fputs($f,'// End of class'."\r\n");
        fputs($f,'?>'."\r\n");
        fclose($f);

        echo "ok";
        $done = true;
      }
      else
      {
        if (strlen($tableName) == 0)
        {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoTableName";
        }
        if ($fieldind == 0)
        {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoField";
        }
        if (strlen($uniqueKey) == 0)
        {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoUniqueKey";
        }
        if (strlen($directory) == 0)
        {
          $errorT = "sess_ErreurStorage";
          $errorR = "sess_ErreurNoDirectory";
        }
      }
      return array($done, $errorT, $errorR);
    }
// End of generate

  }
// End of Class
}
// class_exists
?>