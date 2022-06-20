<?php session_start();
$title = "Coherencia Generator Page";
include('_metatags.php');

  $table = ""; $tablename = ""; $field = array(); $fieldind = 0; $msgerreur = "";

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
    unset($_SESSION["sess_LstField"]);

    $table = $_SESSION["sess_Table"];
    unset($_SESSION["sess_Table"]);

    $tablename = $_SESSION["sess_Tablename"];
    unset($_SESSION["sess_Tablename"]);
  }

?>

</head>
<body>
<table width="912" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td class="wide" id="page"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="content">
				<tr>
					<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxA" id="box1">
							<tr>
								<td><div class="title">
										<h1>Coherencia  G E N E R A T O R</h1>
										<h2></h2>
<?php
if (strlen($msgerreur) > 0) echo $msgerreur;
?>
									</div>
							  </td>
							</tr>
							<tr>
					<td>
<form action="CoheGenerator_db.php" method="post" name="cohegenerator">
<table cellpadding=2>
<tr>
 <td>Table</td>
 <td colspan=5>
  <TEXTAREA NAME="table" COLS=77 ROWS=6><?php echo $table;?></TEXTAREA></td>
</tr>
<?php
if ($fieldind > 0)
{
?>
<tr>
 <td>Nom de la table</td>
 <td colspan=5><input type="text" name="tablename" value="<?php echo $tablename;?>" size=80></td></td>
</tr>
<?php
  for ($i=0; $i < $fieldind; $i += 1)
  {
    echo '<tr>';
    echo '<td>'.$field[$i]["nom"].'</td>';
    echo '<td><input type="checkbox" name="'.$i.'" ';
    echo 'value="'.$field[$i]["nom"].'#@#'.$field[$i]["type"].'">';
    echo 'A g&eacute;n&eacute;rer</td>';
    echo '<td><input type="radio" name="rbunique" ';
    echo 'value="'.$field[$i]["nom"].'#@#'.$field[$i]["type"].'">';
    echo 'Pour recherche existence</td>';
    echo '<td>Liste : <input type="text" size=1 name="liste_'.$field[$i]["nom"].'#@#'.$field[$i]["type"].'" ';
    echo 'value="">';
    echo ' Ordre</td>';
    echo '<td><input type="radio" name="rbidliste" ';
    echo 'value="'.$field[$i]["nom"].'#@#'.$field[$i]["type"].'">';
    echo 'Id unique</td>';
    echo '<td><input type="radio" name="rbtriliste" ';
    echo 'value="'.$field[$i]["nom"].'#@#'.$field[$i]["type"].'">';
    echo 'Tri&eacute; par</td>';
    echo '</tr>';
  }
?>
<tr>
 <td>Nouveau & D&eacute;tail</td>
 <td colspan=5><input type="checkbox" name="cbNewDetail" value="new"></td>
</tr>
<tr>
 <td>Liste</td>
 <td><input type="checkbox" name="cbListe" value="liste"></td>
 <td><input type="checkbox" name="cbListeDecroissant" value="listedecroissant">Affichage dans l'ordre d&eacute;croissant</td>
 <td colspan=5><input type="text" size=10 name="statut" value=""> Valeur du statut</td>
</tr>
<tr>
 <td>Nom fichier</td><td colspan=5><input type="text" name="nomfichier" size=80></td>
</tr>
<tr>
 <td>Répertoire</td><td colspan=5><input type="text" name="repertoire" size=80></td>
</tr>
<tr>
 <td>Aide pour répertoire</td><td colspan=5><input type="file" name="aiderep"></td>
</tr>
<?php
}
?>
</table>
<p>
<table width="70%">
<tr align=center>
<td><input type="Submit" name="Prepare" value="Pr&eacute;parer la g&eacute;n&eacute;ration"></td>
<td><input type="Submit" name="Retour" value="Exit"></td>
<?php
if ($fieldind > 0)
{
?>
<td><input type="Submit" name="Keep" value="G&eacute;n&eacute;rer"></td>
<?php
}
?>
</tr>
</table>
</form>
<?php
if ($fieldind == 0)
  echo '<script type="text/javascript"> document.cohegenerator.table.focus(); </script>'
?>
							</tr>
						</table></td>
				</tr>
			</table></td>
	</tr>
</table>
</body>
</html>
