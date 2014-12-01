<?php
require('include/include_init.php');

// Si pas un prof, ouste
if($_SESSION['statut'] != 'prof')
	header('Location: ./index.php');

$s->assign(array(
	'section' => 'Gestion des élèves',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/gestion.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/gestion.js"></script>'
)); 

// Si on a demandé des changements
if(isset($_POST['ids']))
{
	// Pour chaque élève
	foreach($_POST['ids'] as $i => $id)
	{
		// Les informatiosn ont été modifiées
		if($_POST['modifie'][$i] == 1)
		{
			$nom = $_POST['noms'][$i];
			$prenom = $_POST['prenoms'][$i];
			$valeurs = protect(array($nom, $prenom));
			
			// Nouvelle élève
			if($id == '')
			{
				if($nom != '')
					InsertQuery('INSERT INTO ELEVE(EL_id, EL_nom, EL_prenom, CL_id) VALUES("", "'.$valeurs[0].'", "'.$valeurs[1].'", "'.$_SESSION['classe'].'")');
			}
			// Élève existant
			{
				// Modification
				if($nom != '')
					UpdateQuery('UPDATE ELEVE SET EL_nom ="'.$valeurs[0].'", EL_prenom = "'.$valeurs[1].'" WHERE EL_id = "'.$id.'"');
				// Suppression
				else
					DeleteQuery('DELETE FROM ELEVE WHERE EL_id = "'.$id.'"');
			}
			
		}
	}
}

// Récupération des élèves
$classe = getClasse($_SESSION['classe']);
$eleves = listeEleves($_SESSION['classe']);

$s->assign(array(
	'nomClasse' => $classe['CL_nom'],
	'eleves' => $eleves,
));

$s->display('templates/gestion.tpl');
?>
