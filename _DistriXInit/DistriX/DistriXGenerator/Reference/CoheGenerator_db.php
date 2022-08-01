<?php session_start();
//print_r($_POST);

$goto = "";
$table = ""; $nomfichier = ""; $repertoire = ""; $newdetail = false; $liste = false;
$tablename = ""; $phpname = "";
$field = array(); $fieldind = 0; $fieldsearch = ""; $fieldsearchtype = "";
$fieldliste = array(); $fieldlistemin = 0; $fieldlistemax = 0; $fieldunique = ""; $fielduniquetype = "";
$fieldtri = ""; $fieldtritype = "";
$posbegintable = 0; $orderlistedecroissant = false; $statutliste = "";

if (isset($_POST['Prepare']))
{
  $goto = "Location: CoheGenerator.php";
  
  if(@$_POST["table"]) $table = $_POST["table"];
//echo $table;

  if (strlen($table) > 0)
  {
    $postable = stripos($table, "TABLE");

    if ($postable !== false)
    {
      $posbegintable = stripos($table, "`", $postable);
      if ($posbegintable !== false)
      {
        $posstoptable  = stripos($table, "`", $posbegintable+1);
        if ($posstoptable !== false)
          $tablename = substr($table, $posbegintable + 1, ($posstoptable - $posbegintable)-1);
      }
    }
    if (strlen($tablename) > 0)
    {
      $isfield = strpos($table, "`", $posbegintable + strlen($tablename) + 2);
      while ($isfield !== false && $fieldind < 100)
      {
        $posendfield = strpos($table, "`", $isfield + 1);
        $field[$fieldind]["nom"]  = substr($table, $isfield+1, ($posendfield - $isfield) -1);
        
        $posstoptype = strpos($table, ")", $isfield);
        $posstopvirguletype = strpos($table, ",", $isfield);
        
        if ($posstopvirguletype < $posstoptype) $posstoptype = $posstopvirguletype-1;
        
        $field[$fieldind]["type"] = substr($table, $posendfield+2, $posstoptype - $posendfield - 1);
        
//echo "**".$field[$fieldind]["nom"]."%%".$field[$fieldind]["type"]."**<br/>";
        $fieldind += 1;
        
        $isfield = strpos($table, "`", strpos($table, ",", $posstoptype));
      }
      if ($fieldind > 0)
      {
        $_SESSION["sess_Table"]     = $table;
        $_SESSION["sess_Tablename"] = $tablename;
        $_SESSION["sess_LstField"]  = $field;
      }
      else
      {
        $_SESSION["sess_ErreurTable"] = "true";
        $_SESSION["sess_ErreurNoField"] = "true";
        $_SESSION["sess_Table"] = $table;
      }
    }
    else
    {
      $_SESSION["sess_ErreurTable"] = "true";
      $_SESSION["sess_ErreurNomTable"] = "true";
      $_SESSION["sess_Table"] = $table;
    }
  }
  else
  {
    $_SESSION["sess_ErreurTable"] = "true";
    $_SESSION["sess_ErreurNoTable"] = "true";
    $goto = "Location: CoheGenerator.php";
  }
}
else
{
  if (isset($_POST['Keep']))
  {
    foreach ($_POST as $key => $value)
    {
      if (strcmp($key, "tablename") == 0)          $tablename = $value;
      if (strcmp($key, "nomfichier") == 0)         $nomfichier = $value;
      if (strcmp($key, "repertoire") == 0)         $repertoire = $value;
      if (strcmp($key, "cbNewDetail") == 0)        $newdetail = true;
      if (strcmp($key, "cbListe") == 0)            $liste = true;
      if (strcmp($key, "rbunique") == 0)           $fieldsearch = $value;
      if (strcmp($key, "rbidliste") == 0)          $fieldunique = $value;
      if (strcmp($key, "rbtriliste") == 0)         $fieldtri = $value;
      if (strcmp($key, "cbListeDecroissant") == 0) $orderlistedecroissant = $value;
      if (strcmp($key, "statut") == 0)             $statutliste = $value;
      
      if (is_numeric($key))
      {
        $field[$fieldind]["nom"]  = substr($value, 0, stripos($value, "#@#"));
        $field[$fieldind]["type"] = substr($value, stripos($value, "#@#")+strlen("#@#"));
//echo "**".$field[$fieldind]["nom"]."%%".$field[$fieldind]["type"]."**<br/>";
        $fieldind += 1;
      }
      
      if (strpos($key, "liste_") !== false)
      {
        if ($value)
        {
          $fieldliste[$value]["nom"]  = substr($key, strlen("liste_"), stripos($key, "#@#")-strlen("liste_"));
          $fieldliste[$value]["type"] = substr($key, stripos($key, "#@#")+strlen("#@#"));
//echo "**".$fieldliste[$value]["nom"]."%%".$fieldliste[$value]["type"]."**$value<br/>";
          if ($value > $fieldlistemax) $fieldlistemax = $value;
          if ($value < $fieldlistemin || $fieldlistemin == 0) $fieldlistemin = $value;
        }
      }
//echo "**$fieldlistemin%%$fieldlistemax<br/>";
    }
//echo "<br/><br/>**$tablename**<br/><br/>";
    if (strlen($nomfichier) > 0 && strlen($repertoire) > 0 && strlen($tablename) > 0
        && ($newdetail || $liste) && ($fieldind > 0 || $fieldlistemax > 0))
    {
      if (substr($repertoire, strlen($repertoire) -1) != '\\') $repertoire .= '\\';
      $filename = $repertoire . $nomfichier;

      $phpname = strtoupper(substr($tablename, 0, 1)).substr($tablename, 1);
      
      $fieldsearchtype = substr($fieldsearch, stripos($fieldsearch, "#@#")+strlen("#@#"));
      $fieldsearch     = substr($fieldsearch, 0, stripos($fieldsearch, "#@#"));

      $fielduniquetype = substr($fieldunique, stripos($fieldunique, "#@#")+strlen("#@#"));
      $fieldunique     = substr($fieldunique, 0, stripos($fieldunique, "#@#"));

      $fieldtritype = substr($fieldtri, stripos($fieldtri, "#@#")+strlen("#@#"));
      $fieldtri     = substr($fieldtri, 0, stripos($fieldtri, "#@#"));
      
//echo "@@".$phpname."@@";
//echo "@@".$filename."@@";
echo "<br/><br/>**  Code Generation Start  **  ".date("H:i:s")."<br/><br/>";
    if ($newdetail)
    {
echo "<br/><br/>**  Code Generated in $filename<br/><br/>";

      $f=fopen($filename, 'w');
      fputs($f,'<?php session_start();'."\r\n");
      fputs($f,'$secuok     = false;'."\r\n");
      fputs($f,'$affiche    = true;'."\r\n");
      fputs($f,'$nomkeep    = "Ajouter un '.htmlentities($tablename).'";'."\r\n");
      fputs($f,'$titrepage  = "Nouveau '.htmlentities($tablename).'";'."\r\n");
      fputs($f,'$pagedetail = false;'."\r\n");
      fputs($f,'$txterreur  = "Le '.$tablename.' n\'a pas pu être créé avec les informations ci-dessous.";'."\r\n");
      fputs($f,"\r\n");
      fputs($f,'if (isset($_GET[\'id\']))'."\r\n");
      fputs($f,"{\r\n");
      fputs($f,'  $nomkeep    = "Modifier '.htmlentities($tablename).'";'."\r\n");
      fputs($f,'  $titrepage  = "D&eacute;tail de '.htmlentities($tablename).'";'."\r\n");
      fputs($f,'  $pagedetail = true;'."\r\n");
      fputs($f,'  $txterreur  = "Le '.$tablename.' n\'a pas pu être modifié avec les informations ci-dessous.";'."\r\n");
      fputs($f,"}\r\n");
      fputs($f,"\r\n");
      fputs($f,'include_once("_constsec.php");'."\r\n");
      fputs($f,'include_once("_util.php");'."\r\n");
      fputs($f,"\r\n");
      fputs($f,'$secuok = ($_SESSION["connected"]=="ok" && is_role_user(CONSULTANT));'."\r\n");
      fputs($f,"\r\n");
      fputs($f,'if ($secuok)'."\r\n");
      fputs($f,"{\r\n");
      fputs($f,'  $title = "Coherencia Consultant '.$phpname.' Page";'."\r\n");
      fputs($f,'  include(\'_metatags.php\');'."\r\n");
      fputs($f,"\r\n");
      fputs($f,'  $msgerreur = "";'."\r\n");
      fputs($f,"\r\n");
      
      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["type"], "int") !== false ||
            stripos($field[$i]["type"], "tinyint") !== false)
        {
          $txt = "";
          if (stripos($field[$i]["nom"], "id") !== false)
            $txt .= $tablename;

          fputs($f,'  $'.$txt.$field[$i]["nom"].' = 0;'."\r\n");
        }
        else
        {
          if (stripos($field[$i]["type"], "varchar") !== false ||
              stripos($field[$i]["type"], "char") !== false)
          {
            fputs($f,'  $'.$field[$i]["nom"].' = "";'."\r\n");
          }
          else
            fputs($f,'  $'.$field[$i]["nom"].' = "";'."\r\n");
        }
      }

      fputs($f,'  if (isset($_SESSION["sess_Erreur'.$phpname.'"]))'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    $msgerreur = $txterreur;'."\r\n");

      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["nom"], "id") === false)
          fputs($f,'    $'.$field[$i]["nom"].' = $_SESSION["sess_'.$field[$i]["nom"].'"];'."\r\n");
        else
          fputs($f,'    $'.$tablename.$field[$i]["nom"].' = $_SESSION["sess_'.$tablename.$field[$i]["nom"].'"];'."\r\n");
      }

      for ($i=0; $i < $fieldind; $i += 1)
      {
        fputs($f,'    unset($_SESSION["sess_'.$field[$i]["nom"].'"]);'."\r\n");
      }
      fputs($f,'    unset($_SESSION["sess_Erreur'.$phpname.'"]);'."\r\n");

      for ($i=0; $i < $fieldind; $i += 1)
      {
        fputs($f,'    if (isset($_SESSION["sess_Erreur'.$field[$i]["nom"].'"]))'."\r\n");
        fputs($f,'    {'."\r\n");
        fputs($f,'      unset($_SESSION["sess_Erreur'.$field[$i]["nom"].'"]);'."\r\n");
        fputs($f,'      $msgerreur .= "<br/>&nbsp;- Veuillez indiquer le '.$field[$i]["nom"]);
        fputs($f,' de le '.$tablename.'.";'."\r\n");
        fputs($f,'    }'."\r\n");
      }
      fputs($f,'    if (isset($_SESSION["sess_ErreurDb"]))'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      unset($_SESSION["sess_ErreurDb"]);'."\r\n");
      fputs($f,'      $msgerreur .= "<br/>&nbsp;- Erreur avec la base de donnée. Merci de le signaler à votre personne de contact.";'."\r\n");
      fputs($f,'    } '."\r\n");
      fputs($f,'    if (isset($_SESSION["sess_Erreur'.$phpname.'Existe"]))'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      unset($_SESSION["sess_Erreur'.$phpname.'Existe"]);'."\r\n");
      fputs($f,'      $msgerreur .= "<br/>&nbsp;- Un '.$tablename.' existe déjà avec ces informations.";'."\r\n");
      fputs($f,'    } '."\r\n");
      fputs($f,'  }'."\r\n");

      fputs($f,'  if ($pagedetail)'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    if (isset($_GET[\'id\'])) $'.$tablename.'id = $_GET[\'id\'];'."\r\n");
      fputs($f,'    if ($'.$tablename.'id != 0)'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      include(\'Infodb.php\');'."\r\n");
      fputs($f,'      // connexion'."\r\n");
      fputs($f,'      mysql_connect($host,$user,$passBD);'."\r\n");
      fputs($f,'      mysql_select_db($bdd);'."\r\n");

      fputs($f,'      $request  = "SELECT ');
      for ($i=0; $i < $fieldind; $i += 1)
      {
        fputs($f,$field[$i]["nom"]);
        if ($i != $fieldind-1) fputs($f,',');
      }
      fputs($f,'";'."\r\n");
      fputs($f,'      $request .= " FROM '.$tablename.'";'."\r\n");
      fputs($f,'      $request .= " WHERE id = $'.$tablename.'id";'."\r\n");
      fputs($f,'//echo "**" . $request . "**<p/>";'."\r\n");
      fputs($f,'      $result = mysql_query($request);'."\r\n");
      fputs($f,'      while ($val = mysql_fetch_array($result))'."\r\n");
      fputs($f,'      {'."\r\n");

      for ($i=0; $i < $fieldind; $i += 1)
      {
        fputs($f,'        $'.$field[$i]["nom"].' = $val["'.$field[$i]["nom"].'"];'."\r\n");
      }
      fputs($f,'      }'."\r\n");
      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["type"], "char") !== false)
        {
          fputs($f,'      if (strlen($'.$field[$i]["nom"].') == 0) $'.$tablename.'id = 0; // Ce '.$tablename.' n\'existe pas'."\r\n");
          break;
        }
      }
      fputs($f,''."\r\n");
      fputs($f,'      mysql_close();'."\r\n");
      fputs($f,'    }'."\r\n");
      fputs($f,'    if ($'.$tablename.'id == 0) // on a un problème !'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      $affiche    = false;'."\r\n");
      fputs($f,'      $msgerreur .= "Le '.$tablename.' n\'a pas été trouvé.<br/>&nbsp;";'."\r\n");
      fputs($f,'    }'."\r\n");
      fputs($f,'  }'."\r\n");
      fputs($f,'?>'."\r\n");

      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["nom"], "date") !== false)
        {
          fputs($f,'<script type="text/javascript" src="javascripts/ui/i18n/ui.datepicker-fr.js"></script>'."\r\n");
          break;
        }
      }
      fputs($f,''."\r\n");
      fputs($f,'</head>'."\r\n");
      fputs($f,'<body>'."\r\n");
      fputs($f,'<?php '."\r\n");
      fputs($f,'$selectedmenu = "'.strtoupper($tablename).'";'."\r\n");
      fputs($f,'include_once("ViewLogoConsultant.php");'."\r\n");
      fputs($f,'include_once("ViewMenuConsultant.php");'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'<table width="912" border="0" align="center" cellpadding="0" cellspacing="0">'."\r\n");
      fputs($f,'  <tr>'."\r\n");
      fputs($f,'    <td class="wide" id="page"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="content">'."\r\n");
      fputs($f,'		    <tr>'."\r\n");
      fputs($f,'			    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxA" id="box1">'."\r\n");
      fputs($f,'					    <tr>'."\r\n");
      fputs($f,'						    <td><div class="title">'."\r\n");
      fputs($f,'								    <h1><?php echo $titrepage; ?></h1>'."\r\n");
      fputs($f,'								    <h2></h2>'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'if (strlen($msgerreur) > 0) echo $msgerreur;'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'									      </div>'."\r\n");
      fputs($f,'	  			  			    </td>'."\r\n");
      fputs($f,'		  			  	    </tr>'."\r\n");
      fputs($f,'			  				    <tr>'."\r\n");
      fputs($f,'				  		    <td>'."\r\n");

      fputs($f,'<form action="'.substr($nomfichier, 0, strlen($nomfichier)-4).'_db.php" method="post" name="con'.$tablename.'">'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'if ($affiche) // on affiche'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'<input type="hidden" value="<?php echo $'.$tablename.'id;?>" name="'.$tablename.'id">'."\r\n");
      fputs($f,'<table cellpadding=2>'."\r\n");

      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (strcmp($field[$i]["nom"], "id") != 0)
        {
          fputs($f,'<tr>'."\r\n");
          fputs($f,' <td>'.$field[$i]["nom"].'</td>'."\r\n");
					if (stripos($field[$i]["nom"], "date") !== false)
					{
            fputs($f,'	<script type="text/javascript">'."\r\n");
            fputs($f,'	$(function() {'."\r\n");
            fputs($f,'		$("#'.$field[$i]["nom"].'").datepicker({'."\r\n");
            fputs($f,'		showOn: \'button\', buttonImage: \'images/calendar.gif\', buttonImageOnly: true});'."\r\n");
            fputs($f,'<?php'."\r\n");
            fputs($f,'if ($'.$field[$i]["nom"].' != 0)'."\r\n");
            fputs($f,'{'."\r\n");
            fputs($f,'  getjmaDate($'.$field[$i]["nom"].', $day, $month, $year);'."\r\n");
            fputs($f,'?>'."\r\n");
            fputs($f,'    $(\'#'.$field[$i]["nom"].'\').datepicker(\'setDate\', new Date('."\r\n");
            fputs($f,'<?php echo $year . \',\' . $month . \' - 1,\' . $day?>));'."\r\n");
            fputs($f,'<?php } ?>'."\r\n");
            fputs($f,'		$(\'#'.$field[$i]["nom"].'\').datepicker(\'option\', $.extend({showMonthAfterYear: false},'."\r\n");
            fputs($f,'				$.datepicker.regional[\'fr\']));'."\r\n");
            fputs($f,'    $(\'#'.$field[$i]["nom"].'\').datepicker(\'option\', \'dateFormat\', \'DD dd MM yy\');'."\r\n");
            fputs($f,'    $(\'#'.$field[$i]["nom"].'\').datepicker(\'option\', \'showButtonPanel\', \'true\');'."\r\n");
            fputs($f,'	});'."\r\n");
            fputs($f,'	</script>'."\r\n");
            fputs($f,' <td><input type="text" name="'.$field[$i]["nom"].'" size=30 id="'.$field[$i]["nom"].'" readonly></td>'."\r\n");
					}
					else
					{
            fputs($f,' <td><input type="text"'."\r\n");
            fputs($f,' value="<?php echo $'.$field[$i]["nom"].';?>" ');
            fputs($f,'name="'.$field[$i]["nom"].'" size=30></td>'."\r\n");
          }
          fputs($f,'</tr>'."\r\n");
        }
      }

      fputs($f,'</table>'."\r\n");
      fputs($f,'<p>'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'<table width="70%">'."\r\n");
      fputs($f,'<tr align=center>'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'if ($affiche) // on affiche'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'  echo \'<td><input type="Submit" name="Keep" value="\'.$nomkeep.\'"></td>\';'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'<td colspan="2"><input type="Submit" name="Retour" value="Retour"></td>'."\r\n");
      fputs($f,'</tr>'."\r\n");
      fputs($f,'</table>'."\r\n");
      fputs($f,'</form>'."\r\n");
      fputs($f,'<script type="text/javascript"> document.con'.$tablename.'.'.$field[1]["nom"].'.focus(); </script> '."\r\n");
      fputs($f,'							</tr>'."\r\n");
      fputs($f,'						</table></td>'."\r\n");
      fputs($f,'				</tr>'."\r\n");
      fputs($f,'			</table></td>'."\r\n");
      fputs($f,'	</tr>'."\r\n");
      fputs($f,'</table>'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'include_once("ViewFooterConsultant.php");'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'else header(\'Location: index.php\');?>'."\r\n");
      fputs($f,'</body>'."\r\n");
      fputs($f,'</html>'."\r\n");

      fclose($f);
      $filename = substr($filename, 0, strlen($filename)-4) . "_db". substr($filename, strlen($filename)-4);
echo "<br/><br/>**  Code Generated in $filename<br/><br/>";
      $f=fopen($filename, 'w');
      fputs($f,'<?php session_start();'."\r\n");
      fputs($f,'include_once(\'_util.php\');'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'$insere = false;'."\r\n");
      fputs($f,'$found = false;'."\r\n");
      fputs($f,'$goto = \'Location: '.substr($nomfichier, 0, strlen($nomfichier)-4).'Liste.php\';'."\r\n");
      fputs($f,'//print_r($_POST);'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'if (isset($_POST[\'Keep\']))'."\r\n");
      fputs($f,'{'."\r\n");
      
      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["type"], "int") !== false ||
            stripos($field[$i]["type"], "tinyint") !== false)
        {
          $txt = "";
          if (stripos($field[$i]["nom"], "id") !== false)
            $txt .= $tablename;

          fputs($f,'  $'.$txt.$field[$i]["nom"].' = 0;'."\r\n");
        }
        else
        {
          if (stripos($field[$i]["type"], "varchar") !== false ||
              stripos($field[$i]["type"], "char") !== false)
          {
            fputs($f,'  $'.$field[$i]["nom"].' = "";'."\r\n");
          }
          else
            fputs($f,'  $'.$field[$i]["nom"].' = "";'."\r\n");
        }
      }
      fputs($f,''."\r\n");
      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["type"], "int") !== false ||
            stripos($field[$i]["type"], "tinyint") !== false)
        {
          $txt = "";
          if (stripos($field[$i]["nom"], "id") !== false) $txt .= $tablename;

          if (stripos($field[$i]["nom"], "date") !== false)
          {
            fputs($f,'  if(@$_POST["'.$txt.$field[$i]["nom"].'"]) $');
            fputs($f,$txt.$field[$i]["nom"].' = getNumDate(addslashes($_POST["'.$txt.$field[$i]["nom"].'"]));'."\r\n");
          }
          else
          {
            fputs($f,'  if(@$_POST["'.$txt.$field[$i]["nom"].'"]) $');
            fputs($f,$txt.$field[$i]["nom"].' = $_POST["'.$txt.$field[$i]["nom"].'"];'."\r\n");
          }
        }
        else
        {
          if (stripos($field[$i]["type"], "varchar") !== false ||
              stripos($field[$i]["type"], "char") !== false)
          {
            fputs($f,'  if(@$_POST["'.$field[$i]["nom"].'"]) $');
            fputs($f,$field[$i]["nom"].' = addslashes($_POST["'.$field[$i]["nom"].'"]);'."\r\n");
          }
          else
          {
            fputs($f,'  if(@$_POST["'.$field[$i]["nom"].'"]) $');
            fputs($f,$field[$i]["nom"].' = addslashes($_POST["'.$field[$i]["nom"].'"]);'."\r\n");
          }
        }
      }
      fputs($f,''."\r\n");

      fputs($f,'  if (');
      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["nom"], "id") === false)
        {
          if (stripos($field[$i]["type"], "int") !== false ||
              stripos($field[$i]["type"], "tinyint") !== false)
          {
              fputs($f,'      $'.$field[$i]["nom"].' > 0');
          }
          else
          {
            if (stripos($field[$i]["type"], "varchar") !== false ||
                stripos($field[$i]["type"], "char") !== false)
            {
              fputs($f,'      $'.$field[$i]["nom"].' != ""');
            }
            else
              fputs($f,'      $'.$field[$i]["nom"].' != ""');
          }
          if ($i < $fieldind - 1) fputs($f,' && '."\r\n");
        }
      }
      fputs($f,')'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    include(\'Infodb.php\');'."\r\n");
      fputs($f,'    mysql_connect($host,$user,$passBD);'."\r\n");
      fputs($f,'    mysql_select_db($bdd);'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'    if ($'.$tablename.'id > 0)'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      $request  = "UPDATE '.$tablename.' SET ";'."\r\n");
      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["nom"], "id") === false)
        {
          if (stripos($field[$i]["type"], "int") !== false ||
              stripos($field[$i]["type"], "tinyint") !== false)
          {
            fputs($f,'      $request .= "'.$field[$i]["nom"].' = $'.$field[$i]["nom"]);
          }
          else
          {
            if (stripos($field[$i]["type"], "varchar") !== false ||
                stripos($field[$i]["type"], "char") !== false)
            {
              fputs($f,'      $request .= "'.$field[$i]["nom"].' = \'$'.$field[$i]["nom"]."'");
            }
            else
              fputs($f,'      $request .= "'.$field[$i]["nom"].' = \'$'.$field[$i]["nom"]."'");
          }
          fputs($f,',";'."\r\n");
        }
      }
      fputs($f,'      $request .= "idusermodif=".$_SESSION["userid"].",";'."\r\n");
      fputs($f,'      $request .= "datelastmodif=".getCurrentNumDate().",";'."\r\n");
      fputs($f,'      $request .= "timelastmodif=".getCurrentNumTime()."";'."\r\n");
      fputs($f,'      $request .= " WHERE id = $'.$tablename.'id AND ');
      fputs($f,'idutilisateur = ".$_SESSION["userid"];'."\r\n");
      fputs($f,'      $insere = mysql_query($request);'."\r\n");
      fputs($f,'//echo "*update '.$tablename.'*" . $request . "**<p/>";'."\r\n");
      fputs($f,'    }'."\r\n");
      fputs($f,'    else'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      $request  = "SELECT id FROM '.$tablename.'";'."\r\n");
      fputs($f,'      $request .= " WHERE idutilisateur = ".$_SESSION["userid"]." AND ');
      if (stripos($fieldsearchtype, "int") !== false ||
          stripos($fieldsearchtype, "tinyint") !== false)
      {
        fputs($f,$fieldsearch.' = $'.$fieldsearch.'";'."\r\n");
      }
      else
      {
        if (stripos($fieldsearchtype, "varchar") !== false ||
            stripos($fieldsearchtype, "char") !== false)
        {
          fputs($f,$fieldsearch.' = \'$'.$fieldsearch.'\'";'."\r\n");
        }
        else
          fputs($f,$fieldsearch.' = \'$'.$fieldsearch.'\'";'."\r\n");
      }
      fputs($f,'//echo "*found '.$tablename.'*" . $request . "**<p/>";'."\r\n");
      fputs($f,'      $result = mysql_query($request);'."\r\n");
      fputs($f,'      while ($val = mysql_fetch_array($result))'."\r\n");
      fputs($f,'      {'."\r\n");
      fputs($f,'       $found = true;'."\r\n");
      fputs($f,'       break;'."\r\n");
      fputs($f,'      }'."\r\n");
      fputs($f,'//echo "***$found***<p/>";'."\r\n");
      fputs($f,'      if (!$found)'."\r\n");
      fputs($f,'      {'."\r\n");
      fputs($f,'        $request  = "SELECT max(id) FROM '.$tablename.'";'."\r\n");
      fputs($f,'        $result = mysql_query($request);'."\r\n");
      fputs($f,'        while ($val = mysql_fetch_array($result))'."\r\n");
      fputs($f,'        {'."\r\n");
      fputs($f,'         $'.$tablename.'id = $val[\'max(id)\'];'."\r\n");
      fputs($f,'         break;'."\r\n");
      fputs($f,'        }'."\r\n");
      fputs($f,'        $'.$tablename.'id += 1;'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'        $request  = "INSERT INTO '.$tablename.'('."\r\n");
      for ($i=0; $i < $fieldind; $i += 1)
      {
        fputs($f,'                    '.$field[$i]["nom"].','."\r\n");
      }
      fputs($f,'                    ";'."\r\n");
      fputs($f,'        $request .= "idutilisateur,statut,idusercreate,datecreate,timecreate)";'."\r\n");
      fputs($f,'        $request .= " VALUES(');
      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["type"], "int") !== false ||
            stripos($field[$i]["type"], "tinyint") !== false)
        {
          if (stripos($field[$i]["nom"], "id") === false)
            fputs($f,'                    $'.$field[$i]["nom"].','."\r\n");
          else
            fputs($f,'                    $'.$tablename.$field[$i]["nom"].','."\r\n");
        }
        else
        {
          if (stripos($field[$i]["type"], "varchar") !== false ||
              stripos($field[$i]["type"], "char") !== false)
          {
            fputs($f,'                    \'$'.$field[$i]["nom"].'\','."\r\n");
          }
          else
            fputs($f,'                    \'$'.$field[$i]["nom"].'\','."\r\n");
        }
      }
      fputs($f,'                    ";'."\r\n");
      fputs($f,'        $request .= $_SESSION["userid"].",0,".$_SESSION["userid"].",";'."\r\n");
      fputs($f,'        $request .= getCurrentNumDate().",".getCurrentNumTime().")";'."\r\n");
      fputs($f,'        $insere = mysql_query($request);'."\r\n");
      fputs($f,'//echo "*insert '.$tablename.'*" . $request . "**<p/>";'."\r\n");
      fputs($f,'      }'."\r\n");
      fputs($f,'      if ($insere == false) $'.$tablename.$fieldunique.' = 0;'."\r\n");
      fputs($f,'    }'."\r\n");
      fputs($f,'    if ($insere == false && !$found) $_SESSION["sess_ErreurDb"] = "true";'."\r\n");
      fputs($f,'    mysql_close();'."\r\n");
      fputs($f,'  }'."\r\n");
      fputs($f,'  if ($insere == false)'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    $goto = "Location: '.$nomfichier.'";'."\r\n");
      fputs($f,'    if ($'.$tablename.'id > 0)'."\r\n");
      fputs($f,'      $goto .= "?id=".$'.$tablename.'id;'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'    $_SESSION["sess_Erreur'.$phpname.'"] = "true";'."\r\n");

      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["nom"], "id") === false)
        {
          if (stripos($field[$i]["type"], "int") !== false ||
              stripos($field[$i]["type"], "tinyint") !== false)
          {
              fputs($f,'    if ($'.$field[$i]["nom"].'== 0)');
              fputs($f,' $_SESSION["sess_Erreur'.$field[$i]["nom"].'"] = "true";'."\r\n");
          }
          else
          {
            if (stripos($field[$i]["type"], "varchar") !== false ||
                stripos($field[$i]["type"], "char") !== false)
            {
              fputs($f,'    if (strlen($'.$field[$i]["nom"].') == 0)');
              fputs($f,' $_SESSION["sess_Erreur'.$field[$i]["nom"].'"] = "true";'."\r\n");
            }
            else
            {
              fputs($f,'    if (strlen($'.$field[$i]["nom"].') == 0)');
              fputs($f,' $_SESSION["sess_Erreur'.$field[$i]["nom"].'"] = "true";'."\r\n");
            }
          }
        }
      }
      fputs($f,'    if ($found) $_SESSION["sess_Erreur'.$phpname.'Existe"] = "true";'."\r\n");
      fputs($f,''."\r\n");

      for ($i=0; $i < $fieldind; $i += 1)
      {
        if (stripos($field[$i]["type"], "int") !== false ||
            stripos($field[$i]["type"], "tinyint") !== false)
        {
          if (stripos($field[$i]["nom"], "id") === false)
            fputs($f,'    $_SESSION["sess_'.$field[$i]["nom"].'"] = $'.$field[$i]["nom"].';'."\r\n");
          else
            fputs($f,'    $_SESSION["sess_'.$tablename.$field[$i]["nom"].'"] = $'.$tablename.$field[$i]["nom"].';'."\r\n");
        }
        else
        {
          if (stripos($field[$i]["type"], "varchar") !== false ||
              stripos($field[$i]["type"], "char") !== false)
          {
            fputs($f,'    $_SESSION["sess_'.$field[$i]["nom"].'"] = stripslashes($'.$field[$i]["nom"].');'."\r\n");
          }
          else
            fputs($f,'    $_SESSION["sess_'.$field[$i]["nom"].'"] = stripslashes($'.$field[$i]["nom"].');'."\r\n");
        }
      }
      fputs($f,'  }'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'header($goto);'."\r\n");
      fputs($f,'?>'."\r\n");

      fclose($f);
    } // End if ($newdtail)

    if ($liste)
    {
      $filename = $repertoire . substr($nomfichier, 0, strlen($nomfichier)-4) . "Liste". substr($nomfichier, strlen($nomfichier)-4);
echo "<br/><br/>**  Code Generated in $filename<br/><br/>";
      $f=fopen($filename, 'w');
      fputs($f,'<?php session_start();'."\r\n");
      fputs($f,'include_once("_constsec.php");'."\r\n");
      fputs($f,'include_once("_constdb.php");'."\r\n");
      fputs($f,'include_once("_util.php");'."\r\n");
      fputs($f,"\r\n");
      fputs($f,'if ($_SESSION["connected"]=="ok" && is_role_user(CONSULTANT))'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'$title = \'D&eacute;marche Coherencia\';'."\r\n");
      fputs($f,'include(\'_metatags.php\');'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'$'.$tablename.' = array(); $'.$tablename.'ind = 0;'."\r\n");
      fputs($f,'include(\'Infodb.php\');'."\r\n");
      fputs($f,'// connexion'."\r\n");
      fputs($f,'$connection = mysql_connect($host,$user,$passBD);'."\r\n");
      fputs($f,'if ($connection)'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'  mysql_select_db($bdd);'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'  $request  = "SELECT ');
      fputs($f,$fieldunique);
      for ($i=$fieldlistemin; $i <= $fieldlistemax; $i += 1)
      {
         fputs($f,','.$fieldliste[$i]["nom"]);
      }
      fputs($f,' FROM '.$tablename.'";'."\r\n");

      fputs($f,'  $request .= " WHERE statut=".'.$statutliste.'." AND idutilisateur = ";'."\r\n");
      fputs($f,'  $request .= $_SESSION["userid"]." ORDER BY '.$fieldtri);
      if ($orderlistedecroissant)
        fputs($f,' DESC');
      fputs($f,'";'."\r\n");
      fputs($f,'//echo "**" . $request . "**<p/>";'."\r\n");
      fputs($f,'  $result = mysql_query($request);'."\r\n");
      fputs($f,'  while ($val = mysql_fetch_array($result))'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    $'.$tablename.'[$'.$tablename.'ind]["'.$fieldunique.'"] = $val["'.$fieldunique.'"];'."\r\n");
      for ($i=$fieldlistemin; $i <= $fieldlistemax; $i += 1)
      {
        if (stripos($fieldliste[$i]["type"], "int") !== false ||
            stripos($fieldliste[$i]["type"], "tinyint") !== false)
        {
          if (stripos($fieldliste[$i]["nom"], "date") === false)
            fputs($f,'    $'.$tablename.'[$'.$tablename.'ind]["'.$fieldliste[$i]["nom"].'"] = $val["'.$fieldliste[$i]["nom"].'"];'."\r\n");
          else
            fputs($f,'    $'.$tablename.'[$'.$tablename.'ind]["'.$fieldliste[$i]["nom"].'"] = htmlentities(getStringDate($val["'.$fieldliste[$i]["nom"].'"], false));'."\r\n");
        }
        else
        {
          if (stripos($fieldliste[$i]["type"], "varchar") !== false ||
              stripos($fieldliste[$i]["type"], "char") !== false)
          {
            fputs($f,'    $'.$tablename.'[$'.$tablename.'ind]["'.$fieldliste[$i]["nom"].'"] = htmlentities($val["'.$fieldliste[$i]["nom"].'"]);'."\r\n");
          }
          else
            fputs($f,'    $'.$tablename.'[$'.$tablename.'ind]["'.$fieldliste[$i]["nom"].'"] = htmlentities($val["'.$fieldliste[$i]["nom"].'"]);'."\r\n");
        }
      }
      fputs($f,'    $'.$tablename.'ind += 1;'."\r\n");
      fputs($f,'  }'."\r\n");
      fputs($f,'  mysql_close();'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'<script type="text/javascript">'."\r\n");
      fputs($f,'function enableButtonRetirer(nbtotal, currentcheckbox)'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'var enable = false;'."\r\n");
      $nomformliste = strtolower(substr($nomfichier, 0, strpos($nomfichier, ".php"))."liste");
      fputs($f,'var button = document.'.$nomformliste.'.Retirer'.$phpname.';'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'for (i = 0; i < nbtotal; i++)'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'  var field = document.getElementsByName("cbretirer"+i);'."\r\n");
      fputs($f,'  if (field.item(0).checked) enable = true;'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,' button.disabled = !enable;'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'</script>'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'</head>'."\r\n");
      fputs($f,'<body>'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'$selectedmenu = "'.strtoupper($tablename).'";'."\r\n");
      fputs($f,'include(\'ViewLogoConsultant.php\');'."\r\n");
      fputs($f,'include(\'ViewMenuConsultant.php\');'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'<table width="912" border="0" align="center" cellpadding="0" cellspacing="0">'."\r\n");
      fputs($f,'	<tr>'."\r\n");
      fputs($f,'		<td class="wide" id="page"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="content">'."\r\n");
      fputs($f,'				<tr>'."\r\n");
      fputs($f,'					<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxA" id="box1">'."\r\n");
      fputs($f,'							<tr>'."\r\n");
      fputs($f,'								<td><div class="title">'."\r\n");
      fputs($f,'										<h1>Liste des '.strtoupper(substr($tablename,0,1)).substr($tablename,1).'s - '."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'echo "$'.$tablename.'ind '.$tablename.'s";'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'										</h1>'."\r\n");
      fputs($f,'										<h2></h2>'."\r\n");
      fputs($f,'									</div>'."\r\n");
      fputs($f,'							  </td>'."\r\n");
      fputs($f,'							</tr>'."\r\n");
      fputs($f,'							<tr>'."\r\n");
      fputs($f,'					<td>'."\r\n");
      fputs($f,'              <form action="'.substr($nomfichier, 0, strlen($nomfichier)-4).'Liste_db.php" method="post" name="'.$nomformliste.'">'."\r\n");
      fputs($f,'						<table width=100% cellpadding=4>'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'if ($'.$tablename.'ind > 0)'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'  for ($i=0; $i < $'.$tablename.'ind; $i +=1)'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    echo \'<tr>\';'."\r\n");
      fputs($f,'    echo \'<td><input type="checkbox" onClick="enableButtonRetirer(\'.$'.$tablename.'ind.\', \'.$i.\')" \';'."\r\n");
      fputs($f,'    echo \'name="cbretirer\'.$i.\'" value="\' . $'.$tablename.'[$i][\'id\'] . \'"></td>\';'."\r\n");
      fputs($f,'    echo \'<td style="color: #83A400;"><a href="'.substr($nomfichier, 0, strlen($nomfichier)-4).'.php?id=\'.$'.$tablename.'[$i]["'.$fieldunique.'"].\'">\';'."\r\n");

      for ($i=$fieldlistemin; $i <= $fieldlistemax; $i += 1)
      {
        if ($i == $fieldlistemin)
          fputs($f,'    echo $'.$tablename.'[$i]["'.$fieldliste[$i]["nom"].'"].\'</a></td>\';'."\r\n");
        else
          fputs($f,'    echo \'<td valign=top>\'.$'.$tablename.'[$i]["'.$fieldliste[$i]["nom"].'"].\'</td>\';'."\r\n");
      }
      fputs($f,'    echo \'</tr>\';'."\r\n");
      fputs($f,'  }'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'else'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'    echo \'<tr>\';'."\r\n");
      fputs($f,'    echo \'<td style="color: #83A400;">Aucune '.$tablename.'</td>\';'."\r\n");
      fputs($f,'    echo \'</tr>\';'."\r\n");
      fputs($f,'    echo \'<tr>\';'."\r\n");
      fputs($f,'    echo \'<td colspan=2>D&eacute;sol&eacute;, aucun '.$tablename.' n&apos;a &eacute;t&eacute; trouv&eacute;.</td>\';'."\r\n");
      fputs($f,'    echo \'</tr>\';'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'echo \'</table>\';'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'            </td>'."\r\n");
      fputs($f,'           </tr>'."\r\n");
      fputs($f,'           <tr>'."\r\n");
      fputs($f,'            <td>'."\r\n");
      fputs($f,'              <table>'."\r\n");
      fputs($f,'                <tr align=center>'."\r\n");
      fputs($f,'                <td><input type="Submit" name="Ajouter'.$phpname.'" value="Nouveau..."></td>'."\r\n");
      fputs($f,'                <?php if ($'.$tablename.'ind > 0) {?>'."\r\n");
      fputs($f,'<td><input type="Submit" name="Retirer'.$phpname.'" value="Retirer" disabled></td>'."\r\n");
      fputs($f,'<?php }?>'."\r\n");
      fputs($f,'</tr></table>'."\r\n");
      fputs($f,'              </form>'."\r\n");
      fputs($f,'            </td>'."\r\n");
      fputs($f,'           </tr>'."\r\n");
      fputs($f,'           </table>'."\r\n");
      fputs($f,'          </td>'."\r\n");
      fputs($f,'				</tr>'."\r\n");
      fputs($f,'			</table></td>'."\r\n");
      fputs($f,'	</tr>'."\r\n");
      fputs($f,'</table>'."\r\n");
      fputs($f,'<?php'."\r\n");
      fputs($f,'include(\'ViewFooterConsultant.php\');'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'else header(\'Location: index.php\');'."\r\n");
      fputs($f,'?>'."\r\n");
      fputs($f,'</body>'."\r\n");
      fputs($f,'</html>'."\r\n");
      fclose($f);

      $filename = substr($filename, 0, strlen($filename)-4) . "_db". substr($filename, strlen($filename)-4);
echo "<br/><br/>**  Code Generated in $filename<br/><br/>";
      $f=fopen($filename, 'w');
      fputs($f,'<?php session_start();'."\r\n");
      fputs($f,'$goto = \'Location: '.substr($nomfichier, 0, strlen($nomfichier)-4) . substr($nomfichier, strlen($nomfichier)-4).'\';'."\r\n");
      fputs($f,'//print_r($_POST); //used to display all submitted information'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'$cb = array(); $cbind = 0;'."\r\n");
      fputs($f,'if (isset($_POST[\'Retirer'.$phpname.'\'])) '."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'  foreach ($_POST as $key => $value)'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    if (is_numeric($value) && strpos($key, "cbreti") !== false)'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      $cb[$cbind] = $value;'."\r\n");
      fputs($f,'      $cbind += 1;'."\r\n");
      fputs($f,'    }'."\r\n");
      fputs($f,'  }'."\r\n");
      fputs($f,'  $_SESSION["sess_cbarray"] = $cb;'."\r\n");
      fputs($f,'  $goto = \'Location: '.substr($nomfichier, 0, strlen($nomfichier)-4) . "Retirer". substr($nomfichier, strlen($nomfichier)-4).'\';'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'header($goto);'."\r\n");
      fputs($f,'?>'."\r\n");
      fclose($f);

      $filename = $repertoire . substr($nomfichier, 0, strlen($nomfichier)-4) . "Retirer". substr($nomfichier, strlen($nomfichier)-4);
echo "<br/><br/>**  Code Generated in $filename<br/><br/>";
      $f=fopen($filename, 'w');
      fputs($f,'<?php session_start();'."\r\n");
      fputs($f,'include_once("_constdb.php");'."\r\n");
      fputs($f,'include_once("_util.php");'."\r\n");
      fputs($f,"\r\n");
      fputs($f,'$insere = false;'."\r\n");
      fputs($f,'$goto = \'Location: '.substr($nomfichier, 0, strlen($nomfichier)-4) . "Liste". substr($nomfichier, strlen($nomfichier)-4).'\';'."\r\n");
      fputs($f,'$cb = array();'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'if (isset($_SESSION["sess_cbarray"]))'."\r\n");
      fputs($f,'{'."\r\n");
      fputs($f,'  include(\'Infodb.php\');'."\r\n");
      fputs($f,'  // connexion'."\r\n");
      fputs($f,'  mysql_connect($host,$user,$passBD);'."\r\n");
      fputs($f,'  mysql_select_db($bdd);'."\r\n");
      fputs($f,'  '."\r\n");
      fputs($f,'  $cb = $_SESSION["sess_cbarray"];'."\r\n");
      fputs($f,'  unset($_SESSION["sess_cbarray"]);'."\r\n");
      fputs($f,''."\r\n");
      fputs($f,'  foreach ($cb as $key => $value)'."\r\n");
      fputs($f,'  {'."\r\n");
      fputs($f,'    if (is_numeric($value))'."\r\n");
      fputs($f,'    {'."\r\n");
      fputs($f,'      $request  = "SELECT id FROM '.$tablename.' WHERE id = $value";'."\r\n");
      fputs($f,'      $result = mysql_query($request);'."\r\n");
      fputs($f,'      if ($val = mysql_fetch_array($result))'."\r\n");
      fputs($f,'      {'."\r\n");
      fputs($f,'        $request  = "UPDATE '.$tablename.' SET statut=".DELETED.", datedelete=".getCurrentNumDate().",";'."\r\n");
      fputs($f,'        $request .= "iduserdelete=".$_SESSION["userid"].",";'."\r\n");
      fputs($f,'        $request .= "timedelete=".getCurrentNumTime();'."\r\n");
      fputs($f,'        $request .= " WHERE id = $value";'."\r\n");
      fputs($f,'        $result2 = mysql_query($request);'."\r\n");
      fputs($f,'      }'."\r\n");
      fputs($f,'    }'."\r\n");
      fputs($f,'  }'."\r\n");
      fputs($f,'  mysql_close();'."\r\n");
      fputs($f,'}'."\r\n");
      fputs($f,'header($goto);'."\r\n");
      fputs($f,'?>'."\r\n");
      fclose($f);
    } // End if ($liste)

echo "<br/><br/>**  Code Generation End  **  ".date("H:i:s")."<br/><br/>";
    }
  }
  else exit(0);
}
header($goto);
?>
