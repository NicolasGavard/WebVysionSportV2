<?php session_start(); 
// Needed to encode in UTF8 ààéàé //

// Global
// Storage
// Data
// Security

$table = $tablename = $msgerreur = "";
$field = array(); $fieldInd = 0;
  
if (isset($_SESSION["sess_ErreurTable"]))
{
  $msgerreur = "Erreur avec le générateur.";
  if (isset($_SESSION["sess_Table"]))
  {
    $table = $_SESSION["sess_Table"];
    unset($_SESSION["sess_Table"]);
  }
  
  unset($_SESSION["sess_ErreurTable"]);
  if (isset($_SESSION["sess_ErreurNoField"]))
  {
    unset($_SESSION["sess_ErreurNoField"]);
    $msgerreur .= "<br/>&nbsp;- Aucun champ n'a été trouvé.";
  } 
  if (isset($_SESSION["sess_ErreurNomTable"]))
  {
    unset($_SESSION["sess_ErreurNomTable"]);
    $msgerreur .= "<br/>&nbsp;- Le nom de la table n'a pas été trouvé.";
  } 
  if (isset($_SESSION["sess_ErreurNoTable"]))
  {
    unset($_SESSION["sess_ErreurNoTable"]);
    $msgerreur .= "<br/>&nbsp;- Merci de fournir le code SQL de la création de la table.";
  } 
}

if (isset($_SESSION["sess_LstField"]))
{
  $field = $_SESSION["sess_LstField"];
  $fieldInd = sizeof($field);

  if (isset($_SESSION["sess_Tablename"])) {
    $tablename = $_SESSION["sess_Tablename"];
  }
}
?>
<style>
</style>
</p>
<div class="row">
  <div class="col-sm-7 col-md-7">
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Service Name<br/>(List, Create, Remove, Restore, Find)
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" id="serviceName">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Application Acronym
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" id="appAcronym">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Service Element Name
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" id="serviceElementName" value="">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        View Data Directory
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" id="serviceViewDataDirectory">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Data Data Objects
      </div>
      <div class="col-sm-8 col-md-8 dbLabel">
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbListDataData" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  List
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbDetailDataData" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Detail
                </div>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Data Data Directory
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" id="serviceDataDataDirectory">
      </div>
    </div>
  </div>
  <div class="col-sm-5 col-md-5">
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Fields
      </div>
      <div class="col-sm-8 col-md-8">
        <textarea class="form-control" id="svcFields" ROWS=<?php if ($fieldInd < 11) echo ($fieldInd+1); else echo "11";?>><?php
for ($j=0;$j<$fieldInd;$j += 1)
{
  echo $field[$j]["up"]."\r\n"; 
  if ($field[$j]["nom"] == "statut" || $field[$j]["nom"] == "status")
    echo "availableValue\r\nunavailableValue\r\n"; 
}?></textarea>
      </div>
    </div>
  </div>
</div>
<br/>
<div class="row">
  <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 text-center">
    <input class="form-control" type="button" id="genServices" value="Generate Services">
  </div>
</div>
<br/>
<div class="row">
  <div class="col-sm-5 col-md-5 text-center">Calls</div>
  <div class="col-sm-7 col-md-7 text-center">
    <div class="row">
      <div class="col-sm-4 col-md-4 text-center">
        <span class=" genArea genAreaCurrent" id="viewService">View Service</span>
      </div>
      <div class="col-sm-4 col-md-4 text-center">
        <span class="genArea" id="busService">Bus Service</span>
      </div>
      <div class="col-sm-4 col-md-4 text-center">
        <span class="genArea" id="dataService">Data Service</span>
      </div>
     </div>
  </div>
</div>
</p>
<div class="row">
  <div class="col-sm-5 col-md-5">
    <textarea class="form-control" id="svcCall" ROWS=17></textarea>
  </div>
  <div class="col-sm-7 col-md-7">
    <textarea class="form-control" id="viewSvc" ROWS=17></textarea>
    <textarea class="form-control" id="busSvc" ROWS=17 style="display: none;"></textarea>
    <textarea class="form-control" id="dataSvc" ROWS=17 style="display: none;"></textarea>
  </div>
</div>
</p>

<script>
$("#genServices").click(function(){ 
 var na=$("#serviceName").val(),ac=$("#appAcronym").val(),el=$("#serviceElementName").val();
 var cl=cd=0;if($("#cbListDataData").is(":checked"))cl=1;if($("#cbDetailDataData").is(":checked"))cd=1;
 var vd=$("#serviceViewDataDirectory").val(),dd=$("#serviceDataDataDirectory").val(),fi=$("#svcFields").val();
 $.ajax({async:false,url:"CodeGeneratorServicesGenerate.php",type:"POST",data:{na:na,ac:ac,el:el,vd:vd,cl:cl,cd:cd,dd:dd,fi:fi},
 complete: function (msg) { response = jQuery.parseJSON(msg.responseText);
  $("#svcCall").html(response.call); $("#viewSvc").html(response.viewSvc);
  $("#busSvc").html(response.busSvc); $("#dataSvc").html(response.dataSvc); }});
});
$("#viewService").click(function(){ $("#busService, #dataService").removeClass("genAreaCurrent");
  $("#busSvc, #dataSvc").hide(); $(this).addClass("genAreaCurrent"); $("#viewSvc").show(); 
});
$("#busService").click(function(){ $("#viewService, #dataService").removeClass("genAreaCurrent");
  $("#viewSvc, #dataSvc").hide(); $(this).addClass("genAreaCurrent"); $("#busSvc").show(); 
});
$("#dataService").click(function(){ $("#viewService, #busService").removeClass("genAreaCurrent");
  $("#viewSvc, #busSvc").hide(); $(this).addClass("genAreaCurrent"); $("#dataSvc").show(); 
});
</script>
