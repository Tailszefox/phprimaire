<?php
require('include/include_init.php');

if(!$estAdmin)
	header('Location: ./index.php');

// Changement du nom de l'école
if(isset($_POST['nomEcoleChamp']))
{
	$s->assign(array('nomEcole' => $_POST['nomEcoleChamp']));
	ecrireParametres($_POST['nomEcoleChamp'], $db_adresse, $db_user, $db_password, $db_nom);
}
// Ajout ou modification d'un prof
elseif(isset($_POST['formulaireProfAjouter']))
{
	$nomEtPrenom = protect(array($_POST['formulaireProfNom'], $_POST['formulaireProfPrenom']));
	$password = protect(array($_POST['formulaireProfPassword']), false);
	$civilite = $_POST['formulaireProfCivilite'];
	
	if($_POST['formulaireProfAdmin'] == 'on')
		$admin = 1;
	else
		$admin = 0;
	
	// Mise à jour du professeur
	if(is_numeric($_POST['formulaireProfId']))
	{
		if(empty($password[0]))
			$passwordSql = 'PR_mdp';
		else
			$passwordSql = '"'.md5($password[0]).'"';
		
		UpdateQuery('UPDATE PROF SET PR_nom = "'.$nomEtPrenom[0].'", PR_prenom = "'.$nomEtPrenom[1].'", PR_civilite = "'.$civilite.'", PR_admin = "'.$admin.'", PR_mdp = '.$passwordSql.' WHERE PR_ID = "'.$_POST['formulaireProfId'].'"');
	}
	// Nouveau professeur
	else
	{
		InsertQuery('INSERT INTO PROF(PR_id, PR_nom, PR_prenom, PR_mdp, PR_civilite, PR_admin) VALUES("", "'.$nomEtPrenom[0].'", "'.$nomEtPrenom[1].'", "'.md5($password[0]).'", "'.$civilite.'", '.$admin.')');
	}
}
// Suppression d'un prof
elseif(isset($_GET['supprimerProf']))
{
	DeleteQuery('DELETE FROM PROF WHERE PR_id = "'.$_GET['supprimerProf'].'"');
	DeleteQuery('DELETE FROM CLASSE WHERE PR_id = "'.$_GET['supprimerProf'].'"');
}
// Ajout ou modification d'une classe
elseif(isset($_POST['formulaireClasseAjouter']))
{
	$informations = protect(array($_POST['formulaireClasseNom'], $_POST['formulaireClasseAnneeDebut'], $_POST['formulaireClasseAnneeFin']));
	$annee = $informations[1] . '-' . $informations[2];
	
	if($_POST['formulaireClasseAffichage'] == 'on')
		$affichage = 1;
	else
		$affichage = 0;
	
	// Mise à jour de l'année
	ReplaceQuery('REPLACE INTO ANNEE(annee) VALUES("'.$annee.'")');
	
	// Mise à jour de la classe
	if(is_numeric($_POST['formulaireClasseId']))
	{		
		UpdateQuery('UPDATE CLASSE SET CL_nom = "'.$informations[0].'", annee = "'.$annee.'", CL_affichage = "'.$affichage.'", PR_id = "'.$_POST['formulaireClasseProf'].'" WHERE CL_id = "'.$_POST['formulaireClasseId'].'"');
	}
	// Nouveau professeur
	else
	{
		InsertQuery('INSERT INTO CLASSE(CL_id, CL_nom, CL_affichage, annee, PR_id) VALUES("", "'.$informations[0].'", "'.$affichage.'", "'.$annee.'", "'.$_POST['formulaireClasseProf'].'")');
	}
}
// Suppression d'une classe
elseif(isset($_GET['supprimerClasse']))
{
	DeleteQuery('DELETE FROM CLASSE WHERE CL_id = "'.$_GET['supprimerClasse'].'"');
	DeleteQuery('DELETE FROM ELEVE WHERE CL_id = "'.$_GET['supprimerClasse'].'"');
}

$listeProfs = listeProfs();
$listeClasses = listeClasses(false);

foreach($listeProfs as $prof)
{
	$profsNom[$prof['PR_id']] = $prof['PR_prenom'] . ' ' . $prof['PR_nom'];
}

$s->assign(array(
	'section' => 'Administration générale',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/administration.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/administration.js"></script>',
	'listeProfs' => $listeProfs,
	'listeClasses' => $listeClasses,
	'profsNom' => $profsNom,
));

$s->display('templates/administration.tpl');

?>
