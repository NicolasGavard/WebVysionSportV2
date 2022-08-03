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
        Element name
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" value="<?php echo ucfirst($tablename);?>" id="elementName">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Application prefix
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" value="ManX" id="appPrefix">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Data Object name
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" value="<?php echo "ManX".ucfirst($tablename)."Data";?>" id="dataObjectName">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Generate from Db
      </div>
      <div class="col-sm-8 col-md-8 dbLabel">
        <div class="row">
          <div class="col-sm-2 col-md-2 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" checked type="checkbox" id="cbGenerateFromDb" style="margin-top:-6px;">
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-9 col-md-9">
            <div class="row">
              <div class="col-sm-1 col-md-1 dbLabel">
                in
              </div>
              <div class="col-sm-11 col-md-11">
                <input class="form-control" type="text" value="c:/dev/ManX/ManXPhp/data/" id="generateFromDbDirectory">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-4 col-md-4 dbLabel">
        Functions
      </div>
      <div class="col-sm-8 col-md-8 dbLabel">
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" checked type="checkbox" id="cbList" style="margin-top:-6px;">
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
                  <input class="form-control" checked type="checkbox" id="cbView" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  View
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" checked type="checkbox" id="cbSave" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Save
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" checked type="checkbox" id="cbDelete" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Delete
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" checked type="checkbox" id="cbRestore" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Restore
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
        PHP directory + name
      </div>
      <div class="col-sm-8 col-md-8">
        <input class="form-control" type="text" value="<?php echo "c:/dev/ManX/ManXPhp/".ucfirst($tablename).".php";?>" id="phpName">
      </div>
    </div>
    </p>
  </div>
  <div class="col-sm-5 col-md-5">
    <div class="row">
      <div class="col-sm-3 col-md-3 dbLabel">
        <div class="row">
          <label style="font-weight: normal; display: inline;">
            <div class="col-sm-1 col-md-1" style="margin-top:0px;">
              <input class="form-control" checked type="checkbox" id="cbBusService" style="margin-top:-6px;">
            </div>
            <div class="col-sm-9 col-md-9">
              Bus
            </div>
          </label>
        </div>
      </div>
      <div class="col-sm-9 col-md-9">
        <input class="form-control" type="text" value="<?php echo "AppManX".ucfirst($tablename)."BusSvc";?>" id="busServiceName">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-3 col-md-3 dbLabel">
        <div class="row">
          <label style="font-weight: normal; display: inline;">
            <div class="col-sm-1 col-md-1" style="margin-top:0px;">
              <input class="form-control" checked type="checkbox" id="cbDataService" style="margin-top:-6px;">
            </div>
            <div class="col-sm-9 col-md-9">
              Data
            </div>
          </label>
        </div>
      </div>
      <div class="col-sm-9 col-md-9">
        <input class="form-control" type="text" value="<?php echo "AppManX".ucfirst($tablename)."DataSvc";?>" id="dataServiceName">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-3 col-md-3 dbLabel">
        Services directory
      </div>
      <div class="col-sm-9 col-md-9">
        <input class="form-control" type="text" value="<?php echo "c:/dev/ManX/ManXServices/".ucfirst($tablename);?>" id="servicesName">
      </div>
    </div>
    </p>
    <div class="row">
      <div class="col-sm-3 col-md-3 dbLabel">
        Code tables
      </div>
      <div class="col-sm-9 col-md-9 dbLabel">
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbLanguage" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Language
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbCountry" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Country
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbCaliber" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Caliber
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbContaining" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Containing
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbConditionning" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Conditionning
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbMoney" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Money
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbRegion" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Region
                </div>
              </label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbState" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  State
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 dbLabel">
            <div class="row">
              <label style="font-weight: normal; display: inline;">
                <div class="col-sm-1 col-md-1" style="margin-top:0px;">
                  <input class="form-control" type="checkbox" id="cbUnit" style="margin-top:-6px;">
                </div>
                <div class="col-sm-9 col-md-9">
                  Unit
                </div>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    </p>
  </div>
</div>
<br/>
<div class="row" id="result" style="display:none">
  <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 text-center" id="resultText">
  </div>
</div>
<br/>
<div class="row">
  <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 text-center">
    <input class="form-control" type="button" id="genMan" value="Generate">
  </div>
</div>
<script>
$("#genMan").click(function(){ 
 var elemName=$("#elementName").val(),
 appPrefix=$("#appPrefix").val(),
 dataObjectName=$("#dataObjectName").val(),
 generateFromDbDirectory=$("#generateFromDbDirectory").val();
 var generateFromDb=0;if($("#cbGenerateFromDb").is(":checked"))generateFromDb=1;
 var fList=fView=fSave=fDelete=fRestore=0;
 if($("#cbList").is(":checked"))fList=1;
 if($("#cbView").is(":checked"))fView=1;
 if($("#cbSave").is(":checked"))fSave=1;
 if($("#cbDelete").is(":checked"))fDelete=1;
 if($("#cbRestore").is(":checked"))fRestore=1;
 var phpName=$("#phpName").val();
 var svcBus=svcData=0;
 if($("#cbBusService").is(":checked"))svcBus=1;
 var busServiceName=$("#busServiceName").val();
 if($("#cbDataService").is(":checked"))svcData=1;
 var dataServiceName=$("#dataServiceName").val();
 var servicesName=$("#servicesName").val();
 var tcLanguage=tcCountry=tcCaliber=tcContaining=tcConditionning=tcMoney=tcRegion=tcState=tcUnit=0;
 if($("#cbLanguage").is(":checked"))tcLanguage=1;
 if($("#cbCountry").is(":checked"))tcCountry=1;
 if($("#cbCaliber").is(":checked"))tcCaliber=1;
 if($("#cbContaining").is(":checked"))tcContaining=1;
 if($("#cbConditionning").is(":checked"))tcConditionning=1;
 if($("#cbMoney").is(":checked"))tcMoney=1;
 if($("#tcRegion").is(":checked"))cbRegion=1;
 if($("#cbState").is(":checked"))tcState=1;
 if($("cbUnit").is(":checked"))tcUnit=1;

 $.ajax({async:false,url:"CodeGeneratorManGenerate.php",type:"POST",
 data:{
  elemName=elemName,
  appPrefix=appPrefix,
  dataObjectName=dataObjectName,
  generateFromDbDirectory=generateFromDbDirectory,
  generateFromDb=generateFromDb,
  fList=fList,
  fView=fView,
  fSave=fSave,
  fDelete=fDelete,
  fRestore=fRestore,
  phpName=phpName,
  svcBus=svcBus,
  busServiceName=busServiceName,
  dataServiceName=dataServiceName,
  servicesName=servicesName,
  tcLanguage=tcLanguage,
  tcCountry=tcCountry,
  tcCaliber=tcCaliber,
  tcContaining=tcContaining,
  tcConditionning=tcConditionning,
  tcMoney=tcMoney,
  tcRegion=tcRegion,
  tcState=tcState,
  tcUnit=tcUnit   
 },
 complete: function (msg) { response=jQuery.parseJSON(msg.responseText);
   $("#resultText").html(response.responseText); }});
});
</script>
