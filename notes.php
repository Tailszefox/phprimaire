<?php
require('include/include_init.php');

// Suppression d'une épreuve
if(isset($_GET['supprimer']))
{
	DeleteQuery('DELETE FROM EPREUVE WHERE EP_id ="'.$_GET['supprimer'].'"');
	DeleteQuery('DELETE FROM EPREUVE_NOTE WHERE EP_id ="'.$_GET['supprimer'].'"');
}

// Enregistrement d'une épreuve
if(isset($_POST['titreEpreuve']))
{
	$coefficient = str_replace(',', '.', $_POST['coefficientEpreuve']);
	$epreuve = protect(array($_POST['titreEpreuve'], $coefficient));
	
	// Mise à jour d'une épreuve
	if(is_numeric($_POST['idEpreuve']))
		UpdateQuery('UPDATE EPREUVE SET EP_titre = "'.$epreuve[0].'", EP_coeff = "'.$epreuve[1].'" WHERE EP_id = "'.$_POST['idEpreuve'].'"');
	// Nouvelle épreuve
	else
		InsertQuery('INSERT INTO EPREUVE(EP_id, EP_titre, EP_coeff, CL_id) VALUES("", "'.$epreuve[0].'", "'.$epreuve[1].'", "'.$_SESSION['classe'].'")');
}

// Récupération de la liste des épreuves
$listeEpreuves = SelectQueryMultiple('SELECT * FROM EPREUVE WHERE CL_id = "'.$_SESSION['classe'].'"');

$s->assign(array(
	'section' => 'Notes',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/notes.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/notes.js"></script>',
	'listeEpreuves' => $listeEpreuves,
)); 

$s->display('templates/notes.tpl');
?>
