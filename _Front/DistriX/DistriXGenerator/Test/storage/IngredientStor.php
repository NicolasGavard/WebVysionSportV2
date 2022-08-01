<?php // Needed to encode in UTF8 ààéàé //
//
// Data Version : 1-10
//
class IngredientStor {
  public function getList($all=false, $inDbConnection=null) {
    $request = "";
    $data = new IngredientStorData();
    $list = array(); $listInd = 0;

    if ($inDbConnection != null) {
      $request  = "SELECT i.id,i.name iname, s.name sname, i.statut";
      $request .= " FROM ingredient i, supplier s";
      $request .= " WHERE s.id = idsupplier";
      if (!$all)
      $request .= " AND i.statut = ".$data->getAvailableValue();
      $request .= " ORDER BY iname";

//echo "*</p>*</p>*</p>*" . $request . "**";
      foreach ($inDbConnection->query($request) as $val) {
        $data = new IngredientStorData();
        $data->setId($val["id"]);
        $data->setName($val["iname"]);
        $data->setStatus($val["statut"]);
        $listData = new IngredientListStorData();
        $listData->setIngredientStorData($data);
        $supplierListData = new SupplierListStorData();
        $supplierListData->setName($val["sname"]);
        $listData->setSupplierListStorData($supplierListData);
        $list[$listInd] = $listData;
        $listInd += 1;
      }
    }
    return array($list, $listInd);
  }  // End of getList

  public function read($id, $inDbConnection=null) {
    $request = "";
    $data = new IngredientStorData();

    if ($inDbConnection != null) {
      $request  = "SELECT id,idsupplier,name,idconditionningtype,contentleft,contentright,idunittype,idcontainingtype,quantity,idunittypeformat,idcalibertype,itemlength,itemwidth,itemthickness,density,weighttrayten,weighttrayfifty,idstatetype,usebydate,usebeforedate,wastetreatment,delay,freeofchargelimit,shippingcosts,orderminimumweight,statut,idusercreate,datecreate,timecreate,idusermodif,datelastmodif,timelastmodif,iduserdelete,datedelete,timedelete";
      $request .= " FROM ingredient";
      $request .= " WHERE id = $id";
//echo "*</p>*</p>*</p>*" . $request . "**";
      foreach ($inDbConnection->query($request) as $val) {
        $data = new IngredientStorData();
        $data->setId($val["id"]);
        $data->setIdSupplier($val["idsupplier"]);
        $data->setName($val["name"]);
        $data->setIdConditionningType($val["idconditionningtype"]);
        $data->setContentLeft($val["contentleft"]);
        $data->setContentRight($val["contentright"]);
        $data->setIdUnitType($val["idunittype"]);
        $data->setIdContainingType($val["idcontainingtype"]);
        $data->setQuantity($val["quantity"]);
        $data->setIdUnitTypeFormat($val["idunittypeformat"]);
        $data->setIdCaliberType($val["idcalibertype"]);
        $data->setItemLength($val["itemlength"]);
        $data->setItemWidth($val["itemwidth"]);
        $data->setItemThickness($val["itemthickness"]);
        $data->setDensity($val["density"]);
        $data->setWeightTrayTen($val["weighttrayten"]);
        $data->setWeightTrayFifty($val["weighttrayfifty"]);
        $data->setIdStateType($val["idstatetype"]);
        $data->setUseByDate($val["usebydate"]);
        $data->setUseBeforeDate($val["usebeforedate"]);
        $data->setWasteTreatment($val["wastetreatment"]);
        $data->setDelay($val["delay"]);
        $data->setFreeOfChargeLimit($val["freeofchargelimit"]);
        $data->setShippingCosts($val["shippingcosts"]);
        $data->setOrderMinimumWeight($val["orderminimumweight"]);
        $data->setStatus($val["statut"]);
        $data->setIdUserCreate($val["idusercreate"]);
        $data->setDateCreate($val["datecreate"]);
        $data->setTimeCreate($val["timecreate"]);
        $data->setIdUserModif($val["idusermodif"]);
        $data->setDateModif($val["datelastmodif"]);
        $data->setTimeModif($val["timelastmodif"]);
        $data->setIdUserDelete($val["iduserdelete"]);
        $data->setDateDelete($val["datedelete"]);
        $data->setTimeDelete($val["timedelete"]);
      }
    }
    return $data;
  }
  // End of read

  public function update($data, $inDbConnection=null) {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "UPDATE ingredient SET ";
      $request .= "id=".$data->getId(); $request .= ",";
      $request .= "idsupplier=".$data->getIdSupplier(); $request .= ",";
      $request .= "name='".addslashes($data->getName())."'"; $request .= ",";
      $request .= "idconditionningtype=".$data->getIdConditionningType(); $request .= ",";
      $request .= "contentleft=".$data->getContentLeft(); $request .= ",";
      $request .= "contentright=".$data->getContentRight(); $request .= ",";
      $request .= "idunittype=".$data->getIdUnitType(); $request .= ",";
      $request .= "idcontainingtype=".$data->getIdContainingType(); $request .= ",";
      $request .= "quantity=".$data->getQuantity(); $request .= ",";
      $request .= "idunittypeformat=".$data->getIdUnitTypeFormat(); $request .= ",";
      $request .= "idcalibertype=".$data->getIdCaliberType(); $request .= ",";
      $request .= "itemlength=".$data->getItemLength(); $request .= ",";
      $request .= "itemwidth=".$data->getItemWidth(); $request .= ",";
      $request .= "itemthickness=".$data->getItemThickness(); $request .= ",";
      $request .= "density=".$data->getDensity(); $request .= ",";
      $request .= "weighttrayten=".$data->getWeightTrayTen(); $request .= ",";
      $request .= "weighttrayfifty=".$data->getWeightTrayFifty(); $request .= ",";
      $request .= "idstatetype=".$data->getIdStateType(); $request .= ",";
      $request .= "usebydate='".addslashes($data->getUseByDate())."'"; $request .= ",";
      $request .= "usebeforedate='".addslashes($data->getUseBeforeDate())."'"; $request .= ",";
      $request .= "wastetreatment='".addslashes($data->getWasteTreatment())."'"; $request .= ",";
      $request .= "delay='".addslashes($data->getDelay())."'"; $request .= ",";
      $request .= "freeofchargelimit=".$data->getFreeOfChargeLimit(); $request .= ",";
      $request .= "shippingcosts=".$data->getShippingCosts(); $request .= ",";
      $request .= "orderminimumweight='".addslashes($data->getOrderMinimumWeight())."'"; $request .= ",";
      $request .= "statut=".$data->getStatus(); $request .= ",";
      $request .= "idusercreate=".$data->getIdUserCreate(); $request .= ",";
      $request .= "datecreate=".$data->getDateCreate(); $request .= ",";
      $request .= "timecreate=".$data->getTimeCreate(); $request .= ",";
      $request .= "idusermodif=".$data->getIdUserModif(); $request .= ",";
      $request .= "datelastmodif=".$data->getDateModif(); $request .= ",";
      $request .= "timelastmodif=".$data->getTimeModif(); $request .= ",";
      $request .= "iduserdelete=".$data->getIdUserDelete(); $request .= ",";
      $request .= "datedelete=".$data->getDateDelete(); $request .= ",";
      $request .= "timedelete=".$data->getTimeDelete();
      $request .= " WHERE id = ".$data->getId();
      $count = $inDbConnection->exec($request);
      $insere = ($count > 0);
      if ($count == 0)
        $insere = ($inDbConnection->errorCode() == 0);
//echo "*update *ingredient" . $request . "**<p/>";
    }
    return $insere;
  }
  // End of update

  public function create($data, $inDbConnection=null) {
    $insere = false;
    $request = "";
    $id = 0;

    if ($inDbConnection != null) {
      $request = "SELECT MAX(id) FROM ingredient";
//echo "*</p>*</p>*</p>*" . $request . "**";
      foreach ($inDbConnection->query($request) as $val) {
        $id = $val["MAX(id)"];
      }
      $data->setId($id + 1);
      $insere = $this->insertDb($data, $inDbConnection);
    }
    return array($insere, $data->getId());
  }
  // End of create

  public function insert($data, $inDbConnection) {
    return $this->insertDb($data, $inDbConnection);
  }
  // End of insert

  public function insertDb($data, $inDbConnection) {
    $insere = false;
    $request = "";

    if ($inDbConnection != null) {
      $request  = "INSERT INTO ingredient(";
      $request .= "id,idsupplier,name,idconditionningtype,contentleft,contentright,idunittype,idcontainingtype,quantity,idunittypeformat,idcalibertype,itemlength,itemwidth,itemthickness,density,weighttrayten,weighttrayfifty,idstatetype,usebydate,usebeforedate,wastetreatment,delay,freeofchargelimit,shippingcosts,orderminimumweight,statut,idusercreate,datecreate,timecreate,idusermodif,datelastmodif,timelastmodif,iduserdelete,datedelete,timedelete)";
      $request .= " VALUES(";
      $request .= $data->getId(); $request .= ",";
      $request .= $data->getIdSupplier(); $request .= ",";
      $request .= "'".addslashes($data->getName())."'"; $request .= ",";
      $request .= $data->getIdConditionningType(); $request .= ",";
      $request .= $data->getContentLeft(); $request .= ",";
      $request .= $data->getContentRight(); $request .= ",";
      $request .= $data->getIdUnitType(); $request .= ",";
      $request .= $data->getIdContainingType(); $request .= ",";
      $request .= $data->getQuantity(); $request .= ",";
      $request .= $data->getIdUnitTypeFormat(); $request .= ",";
      $request .= $data->getIdCaliberType(); $request .= ",";
      $request .= $data->getItemLength(); $request .= ",";
      $request .= $data->getItemWidth(); $request .= ",";
      $request .= $data->getItemThickness(); $request .= ",";
      $request .= $data->getDensity(); $request .= ",";
      $request .= $data->getWeightTrayTen(); $request .= ",";
      $request .= $data->getWeightTrayFifty(); $request .= ",";
      $request .= $data->getIdStateType(); $request .= ",";
      $request .= "'".addslashes($data->getUseByDate())."'"; $request .= ",";
      $request .= "'".addslashes($data->getUseBeforeDate())."'"; $request .= ",";
      $request .= "'".addslashes($data->getWasteTreatment())."'"; $request .= ",";
      $request .= "'".addslashes($data->getDelay())."'"; $request .= ",";
      $request .= $data->getFreeOfChargeLimit(); $request .= ",";
      $request .= $data->getShippingCosts(); $request .= ",";
      $request .= "'".addslashes($data->getOrderMinimumWeight())."'"; $request .= ",";
      $request .= $data->getStatus(); $request .= ",";
      $request .= $data->getIdUserCreate(); $request .= ",";
      $request .= $data->getDateCreate(); $request .= ",";
      $request .= $data->getTimeCreate(); $request .= ",";
      $request .= $data->getIdUserModif(); $request .= ",";
      $request .= $data->getDateModif(); $request .= ",";
      $request .= $data->getTimeModif(); $request .= ",";
      $request .= $data->getIdUserDelete(); $request .= ",";
      $request .= $data->getDateDelete(); $request .= ",";
      $request .= $data->getTimeDelete();
      $request .= ")";
      $count = $inDbConnection->exec($request);
      $insere = ($count > 0);
//echo "*insert *ingredient" . $request . "**<p/>";
    }
    return $insere;
  }
  // End of insertDb

  public function getListForDeployment($inDbConnection=null) {
    $request = "";
    $list = array(); $listInd = 0;

    if ($inDbConnection != null) {
      $request  = "SELECT id,idsupplier,name,idconditionningtype,contentleft,contentright,idunittype,idcontainingtype,quantity,idunittypeformat,idcalibertype,itemlength,itemwidth,itemthickness,density,weighttrayten,weighttrayfifty,idstatetype,usebydate,usebeforedate,wastetreatment,delay,freeofchargelimit,shippingcosts,orderminimumweight,statut,idusercreate,datecreate,timecreate,idusermodif,datelastmodif,timelastmodif,iduserdelete,datedelete,timedelete";
      $request .= " FROM ingredient";
//echo "*</p>*</p>*</p>*" . $request . "**";
      foreach ($inDbConnection->query($request) as $val) {
        $data = new IngredientStorData();
        $data->setId($val["id"]);
        $data->setIdSupplier($val["idsupplier"]);
        $data->setName($val["name"]);
        $data->setIdConditionningType($val["idconditionningtype"]);
        $data->setContentLeft($val["contentleft"]);
        $data->setContentRight($val["contentright"]);
        $data->setIdUnitType($val["idunittype"]);
        $data->setIdContainingType($val["idcontainingtype"]);
        $data->setQuantity($val["quantity"]);
        $data->setIdUnitTypeFormat($val["idunittypeformat"]);
        $data->setIdCaliberType($val["idcalibertype"]);
        $data->setItemLength($val["itemlength"]);
        $data->setItemWidth($val["itemwidth"]);
        $data->setItemThickness($val["itemthickness"]);
        $data->setDensity($val["density"]);
        $data->setWeightTrayTen($val["weighttrayten"]);
        $data->setWeightTrayFifty($val["weighttrayfifty"]);
        $data->setIdStateType($val["idstatetype"]);
        $data->setUseByDate($val["usebydate"]);
        $data->setUseBeforeDate($val["usebeforedate"]);
        $data->setWasteTreatment($val["wastetreatment"]);
        $data->setDelay($val["delay"]);
        $data->setFreeOfChargeLimit($val["freeofchargelimit"]);
        $data->setShippingCosts($val["shippingcosts"]);
        $data->setOrderMinimumWeight($val["orderminimumweight"]);
        $data->setStatus($val["statut"]);
        $data->setIdUserCreate($val["idusercreate"]);
        $data->setDateCreate($val["datecreate"]);
        $data->setTimeCreate($val["timecreate"]);
        $data->setIdUserModif($val["idusermodif"]);
        $data->setDateModif($val["datelastmodif"]);
        $data->setTimeModif($val["timelastmodif"]);
        $data->setIdUserDelete($val["iduserdelete"]);
        $data->setDateDelete($val["datedelete"]);
        $data->setTimeDelete($val["timedelete"]);
        $list[$listInd] = $data;
        $listInd += 1;
      }
    }
    return array($list, $listInd);
  }
  // End of getListForDeployment

//
//
// D E P L O Y M E N T
//
//

  public function getDataForDeployment($posVersion, $inDbConnection=null) {
    $request = "";
    $list = array(); $listInd = 0;
    $elements = array(); $elementsInd = 0;
    $arrayName = "ingredient";

    if ($inDbConnection != null) {
      list($list, $listind) = $this->getListForDeployment($inDbConnection);
      for ($indl=0; $indl<$listind; $indl+=1) {
        if ($posVersion == "1-10") {
          $elements[$arrayName][$indl]["id"] = $list[$indl]->getId();
          $elements[$arrayName][$indl]["idsupplier"] = $list[$indl]->getIdSupplier();
          $elements[$arrayName][$indl]["name"] = $list[$indl]->getName();
          $elements[$arrayName][$indl]["idconditionningtype"] = $list[$indl]->getIdConditionningType();
          $elements[$arrayName][$indl]["contentleft"] = $list[$indl]->getContentLeft();
          $elements[$arrayName][$indl]["contentright"] = $list[$indl]->getContentRight();
          $elements[$arrayName][$indl]["idunittype"] = $list[$indl]->getIdUnitType();
          $elements[$arrayName][$indl]["idcontainingtype"] = $list[$indl]->getIdContainingType();
          $elements[$arrayName][$indl]["quantity"] = $list[$indl]->getQuantity();
          $elements[$arrayName][$indl]["idunittypeformat"] = $list[$indl]->getIdUnitTypeFormat();
          $elements[$arrayName][$indl]["idcalibertype"] = $list[$indl]->getIdCaliberType();
          $elements[$arrayName][$indl]["itemlength"] = $list[$indl]->getItemLength();
          $elements[$arrayName][$indl]["itemwidth"] = $list[$indl]->getItemWidth();
          $elements[$arrayName][$indl]["itemthickness"] = $list[$indl]->getItemThickness();
          $elements[$arrayName][$indl]["density"] = $list[$indl]->getDensity();
          $elements[$arrayName][$indl]["weighttrayten"] = $list[$indl]->getWeightTrayTen();
          $elements[$arrayName][$indl]["weighttrayfifty"] = $list[$indl]->getWeightTrayFifty();
          $elements[$arrayName][$indl]["idstatetype"] = $list[$indl]->getIdStateType();
          $elements[$arrayName][$indl]["usebydate"] = $list[$indl]->getUseByDate();
          $elements[$arrayName][$indl]["usebeforedate"] = $list[$indl]->getUseBeforeDate();
          $elements[$arrayName][$indl]["wastetreatment"] = $list[$indl]->getWasteTreatment();
          $elements[$arrayName][$indl]["delay"] = $list[$indl]->getDelay();
          $elements[$arrayName][$indl]["freeofchargelimit"] = $list[$indl]->getFreeOfChargeLimit();
          $elements[$arrayName][$indl]["shippingcosts"] = $list[$indl]->getShippingCosts();
          $elements[$arrayName][$indl]["orderminimumweight"] = $list[$indl]->getOrderMinimumWeight();
          $elements[$arrayName][$indl]["statut"] = $list[$indl]->getStatus();
          $elements[$arrayName][$indl]["idusercreate"] = $list[$indl]->getIdUserCreate();
          $elements[$arrayName][$indl]["datecreate"] = $list[$indl]->getDateCreate();
          $elements[$arrayName][$indl]["timecreate"] = $list[$indl]->getTimeCreate();
          $elements[$arrayName][$indl]["idusermodif"] = $list[$indl]->getIdUserModif();
          $elements[$arrayName][$indl]["datelastmodif"] = $list[$indl]->getDateModif();
          $elements[$arrayName][$indl]["timelastmodif"] = $list[$indl]->getTimeModif();
          $elements[$arrayName][$indl]["iduserdelete"] = $list[$indl]->getIdUserDelete();
          $elements[$arrayName][$indl]["datedelete"] = $list[$indl]->getDateDelete();
          $elements[$arrayName][$indl]["timedelete"] = $list[$indl]->getTimeDelete();
        }
      }
      $elementsInd += $indl;
    }
    return array($elements, $elementsInd);
  }
  // End of getDataForDeployment

  public function setDataFromDeployment($datas, $datasind, $inDbConnection=null) {
    $insere = true;
    $nbElem = 0;

    if ($inDbConnection != null) {
      for ($indl=0; $indl<$datasind && $insere; $indl+=1) {
        $data = $this->read($datas[$indl]["id"], $inDbConnection);

        $data->setId($datas[$indl]["id"]);
        $data->setIdSupplier($datas[$indl]["idsupplier"]);
        $data->setName($datas[$indl]["name"]);
        $data->setIdConditionningType($datas[$indl]["idconditionningtype"]);
        $data->setContentLeft($datas[$indl]["contentleft"]);
        $data->setContentRight($datas[$indl]["contentright"]);
        $data->setIdUnitType($datas[$indl]["idunittype"]);
        $data->setIdContainingType($datas[$indl]["idcontainingtype"]);
        $data->setQuantity($datas[$indl]["quantity"]);
        $data->setIdUnitTypeFormat($datas[$indl]["idunittypeformat"]);
        $data->setIdCaliberType($datas[$indl]["idcalibertype"]);
        $data->setItemLength($datas[$indl]["itemlength"]);
        $data->setItemWidth($datas[$indl]["itemwidth"]);
        $data->setItemThickness($datas[$indl]["itemthickness"]);
        $data->setDensity($datas[$indl]["density"]);
        $data->setWeightTrayTen($datas[$indl]["weighttrayten"]);
        $data->setWeightTrayFifty($datas[$indl]["weighttrayfifty"]);
        $data->setIdStateType($datas[$indl]["idstatetype"]);
        $data->setUseByDate($datas[$indl]["usebydate"]);
        $data->setUseBeforeDate($datas[$indl]["usebeforedate"]);
        $data->setWasteTreatment($datas[$indl]["wastetreatment"]);
        $data->setDelay($datas[$indl]["delay"]);
        $data->setFreeOfChargeLimit($datas[$indl]["freeofchargelimit"]);
        $data->setShippingCosts($datas[$indl]["shippingcosts"]);
        $data->setOrderMinimumWeight($datas[$indl]["orderminimumweight"]);
        $data->setStatus($datas[$indl]["statut"]);
        $data->setIdUserCreate($datas[$indl]["idusercreate"]);
        $data->setDateCreate($datas[$indl]["datecreate"]);
        $data->setTimeCreate($datas[$indl]["timecreate"]);
        $data->setIdUserModif($datas[$indl]["idusermodif"]);
        $data->setDateModif($datas[$indl]["datelastmodif"]);
        $data->setTimeModif($datas[$indl]["timelastmodif"]);
        $data->setIdUserDelete($datas[$indl]["iduserdelete"]);
        $data->setDateDelete($datas[$indl]["datedelete"]);
        $data->setTimeDelete($datas[$indl]["timedelete"]);

        if ($data->getId() > 0) {
          $insere = $this->update($inDbConnection, $data);
        }
        else {
          $data->setId($datas[$indl]["id"]);
          $insere = $this->insert($inDbConnection, $data);
        }
      }
      $nbElem = $indl;
    }
    return array($insere, $nbElem);
  }
  // End of setDataFromDeployment

}
// End of class
?>
