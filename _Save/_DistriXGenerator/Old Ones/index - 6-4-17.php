<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
session_start(); 
$title = "Generator Page";
include('_metatagsGenerator.php');

  $table = $tablename = $msgerreur = "";
  $field = array(); $fieldind = 0;
  $fieldUp = array(); $fieldUpInd = 0;

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
    $fieldind = sizeof($field);
//    unset($_SESSION["sess_LstField"]);

    $fieldUp = $_SESSION["sess_LstFieldUp"];
    $fieldUpInd = sizeof($fieldUp);

    $table = $_SESSION["sess_Table"];
    unset($_SESSION["sess_Table"]);

    $tablename = $_SESSION["sess_Tablename"];
    unset($_SESSION["sess_Tablename"]);
  }

?>

</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-7 col-md-7 text-center">
      <h1>Process & Data Wizard's  G E N E R A T O R</h1>
    </div>
    <div class="col-sm-5 col-md-5 text-center">
      <h4><?php if (strlen($msgerreur) > 0) echo $msgerreur;?></h4>
    </div>
  </div>
<form action="CodeGenerator_db.php" method="post" name="codegenerator">
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Table
    </div>
    <div class="col-sm-5 col-md-5">
      <textarea class="form-control" NAME="table" COLS=77 ROWS=6><?php echo $table;?></textarea>
    </div>
<?php
if ($fieldUpInd > 0)
{
?>
    <div class="col-sm-5 col-md-5">
      <textarea class="form-control" NAME="fieldUp" ROWS=6><?php
for ($j=0;$j<$fieldUpInd;$j += 1)
{
  echo $fieldUp[$j]["nom"]."\r\n"; 
}?></textarea>
    </div>
<?php 
}
?>
  </div>
  </p>
<?php
if ($fieldind > 0)
{
?>
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Nom de la table
    </div>
    <div class="col-sm-6 col-md-6">
      <input class="form-control" type="text" name="tablename" value="<?php echo $tablename;?>">
    </div>
  </div>
  </p>
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Pour recherche existence
    </div>
    <div class="col-sm-6 col-md-6">
      <select class="form-control" name="rbunique">
        <option value="-1">&nbsp;</option> 
<?php
for ($j=0;$j<$fieldind;$j += 1)
{
  echo '<option value="'.$j.'">'.$field[$j]["nom"]."</option>"; 
}
?>
      </select>
    </div>
  </div>
  </p>
  <div class="row">
    <div class="col-sm-2 col-md-2">
     Id unique
    </div>
    <div class="col-sm-6 col-md-6">
      <select class="form-control" name="rbidliste">
        <option value="-1">&nbsp;</option> 
<?php
for ($j=0;$j<$fieldind;$j += 1)
{
  echo '<option value="'.$j.'">'.$field[$j]["nom"]."</option>"; 
}
?>
      </select>
    </div>
  </div>
  </p>
  <div class="row">
    <div class="col-sm-2 col-md-2">
     Trié par
    </div>
    <div class="col-sm-6 col-md-6">
      <select class="form-control" name="rbtriliste">
        <option value="-1">&nbsp;</option> 
<?php
for ($j=0;$j<$fieldind;$j += 1)
{
  echo '<option value="'.$j.'">'.$field[$j]["nom"]."</option>"; 
}
?>
      </select>
    </div>
  </div>
  </p>
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Liste Elément
    </div>
    <div class="col-sm-1 col-md-1">No 1</div>
    <div class="col-sm-2 col-md-2">
      <select class="form-control" name="listefield1">
        <option value="-1">&nbsp;</option> 
<?php
for ($j=0;$j<$fieldind;$j += 1)
{
  echo '<option value="'.$j.'">'.$field[$j]["nom"]."</option>"; 
}
?>
      </select>
    </div>
    <div class="col-sm-1 col-md-1">No 2</div>
    <div class="col-sm-2 col-md-2">
      <select class="form-control" name="listefield2">
        <option value="-1">&nbsp;</option> 
<?php
for ($j=0;$j<$fieldind;$j += 1)
{
  echo '<option value="'.$j.'">'.$field[$j]["nom"]."</option>"; 
}
?>
      </select>
    </div>
    <div class="col-sm-1 col-md-1">No 3</div>
    <div class="col-sm-2 col-md-2">
      <select class="form-control" name="listefield3">
        <option value="-1">&nbsp;</option> 
<?php
for ($j=0;$j<$fieldind;$j += 1)
{
  echo '<option value="'.$j.'">'.$field[$j]["nom"]."</option>"; 
}
?>
      </select>
    </div>
  </div>
  </p>
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Générer
    </div>
    <div class="col-sm-1 col-md-1" style="padding-left:100px;">
      <input class="form-control" type="checkbox" name="cbData">
    </div>
    <div class="col-sm-1 col-md-1" style="margin-top:10px;padding:0px;">
      Data
    </div>
    <div class="col-sm-2 col-md-2" style="margin:0px;padding:0px;">
      <input class="form-control" type="text" name="datadirectory" value="Y:\09. SI\21. Generator"><!--Y:\09. SI\08. Data\Data 1-10!-->
    </div>
    <div class="col-sm-1 col-md-1" style="padding-left:100px;">
      <input class="form-control" type="checkbox" name="cbStorage">
    </div>
    <div class="col-sm-1 col-md-1" style="margin-top:10px;padding:0px;">
      Storage
    </div>
    <div class="col-sm-2 col-md-2" style="margin:0px;padding:0px;">
      <input class="form-control" type="text" name="storagedirectory" value="Y:\09. SI\21. Generator"><!--Y:\09. SI\09. Storage\Storage 1-10!-->
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-md-2">
    </div>
    <div class="col-sm-1 col-md-1" style="padding-left:100px;">
      <input class="form-control" type="checkbox" name="cbListe">
    </div>
    <div class="col-sm-1 col-md-1" style="margin-top:10px;padding:0px;">
      Liste
    </div>
    <div class="col-sm-2 col-md-2" style="margin:0px;padding:0px;">
      <input class="form-control" type="text" name="listdirectory" value="Y:\09. SI\16. Man">
    </div>
    <div class="col-sm-1 col-md-1" style="padding-left:100px;">
      <input class="form-control" type="checkbox" name="cbListeDecroissant">
    </div>
    <div class="col-sm-5 col-md-5" style="margin-top:10px;padding:0px;">
      Affichage dans l'ordre décroissant
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Nom fichier
    </div>
    <div class="col-sm-6 col-md-6">
      <input class="form-control" type="text" name="nomfichier" size=80>
    </div>
  </div>
  </p>
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Répertoire
    </div>
    <div class="col-sm-6 col-md-6">
      <input class="form-control" type="text" name="repertoire" size=80>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-md-2">
      Aide pour répertoire
    </div>
    <div class="col-sm-6 col-md-6">
      <input type="file" name="aiderep">
    </div>
  </div>
<?php
}
?>
  <p>
  <div class="row">
<?php
$nbcol = 2;
if ($fieldind > 0) $nbcol = 3;
?>
    <div class="col-sm-<?php echo $nbcol;?> <?php echo $nbcol;?> text-center">
      <input class="form-control" type="Submit" name="Prepare" value="Pr&eacute;parer la g&eacute;n&eacute;ration">
    </div>
    <div class="col-sm-<?php echo $nbcol;?> <?php echo $nbcol;?> text-center">
      <input class="form-control" type="Submit" name="Retour" value="Exit">
    </div>
<?php
if ($fieldind > 0)
{
?>
    <div class="col-sm-<?php echo $nbcol;?> <?php echo $nbcol;?> text-center">
      <input class="form-control" type="Submit" name="Keep" value="G&eacute;n&eacute;rer">
    </div>
<?php
}
?>
</form>
<?php
if ($fieldind == 0)
  echo '<script type="text/javascript"> document.codegenerator.table.focus(); </script>'
?>
							</tr>
						</table></td>
				</tr>
			</table></td>
	</tr>
</table>
<?php include('_metatagsGeneratorjs.php');?>
</body>
</html>
