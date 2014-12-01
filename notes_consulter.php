<?php
require('include/include_init.php');

// Pas d'ID d'épreuve
if(!isset($_GET['id']))
{
	header('Location: notes.php');
}

// Récupération des informations de l'épreuve
$epreuve = SelectQuery('SELECT * FROM EPREUVE WHERE EP_id = "'.$_GET['id'].'"');

// Épreuve inexistante
if(empty($epreuve))
	header('Location: notes.php');

$s->assign(array(
	'section' => 'Notes',
	'retour' => 'notes.php',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/notes.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/notes.js"></script>',
	
	'intituleEpreuve' => $epreuve['EP_titre'],
	'idEpreuve' => $epreuve['EP_id'],
)); 

// Si le formulaire des notes a été envoyé
if(isset($_POST['ids']))
{
	// Pour chaque note
	foreach($_POST['ids'] as $i => $idEleve)
	{
		$note = protect(array(str_replace(',', '.', $_POST['notes'][$i])));
		
		// Mise à jour ou création d'une note
		if(is_numeric($note[0]))
		{
			InsertQuery('REPLACE INTO EPREUVE_NOTE(EL_id, EP_id, EPN_note) VALUES('.$idEleve.', '.$_GET['id'].', '.$note[0].')');
		}
		// Suppression d'une note
		else
		{
			DeleteQuery('DELETE FROM EPREUVE_NOTE WHERE EL_id = '.$idEleve.' AND EP_id = '.$_GET['id']);
		}
	}
}

// Récupération des notes des élèves à l'épreuve demandée
$notes = SelectQueryMultiple('SELECT ELEVE.EL_id, EL_nom, EL_prenom, EPN_note FROM (SELECT EL_id, EPN_note FROM EPREUVE_NOTE WHERE EP_id = '.$_GET['id'].') notes RIGHT JOIN ELEVE ON notes.EL_id = ELEVE.EL_id WHERE ELEVE.CL_id = ' . $_SESSION['classe'] . ' ORDER BY EL_nom, EL_prenom');

$s->assign(array(
	'notes' => $notes,
));

$s->display('templates/notes_consulter.tpl');

?>
