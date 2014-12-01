<?php
require('include/include_init.php');

// Suppression d'un sujet
if(isset($_GET['supprimer']))
{
	DeleteQuery('DELETE FROM RENDU_SUJET WHERE RS_id ="'.$_GET['supprimer'].'"');
	DeleteQuery('DELETE FROM RENDU_ELEVE WHERE RS_id ="'.$_GET['supprimer'].'"');
}

// Enregistrement d'un sujet
if(isset($_POST['sujetRendu']))
{
	$devoir = protect(array($_POST['titreRendu'], $_POST['sujetRendu']));
	
	// Mise à jour
	if(is_numeric($_POST['idRendu']))	
		UpdateQuery('UPDATE RENDU_SUJET SET RS_titre = "'.$devoir[0].'", RS_sujet = "'.$devoir[1].'" WHERE RS_id = "'.$_POST['idRendu'].'"');
	// Ajout
	else
	{
		InsertQuery('INSERT INTO RENDU_SUJET(RS_id, RS_titre, RS_sujet, CL_id) VALUES("", "'.$devoir[0].'", "'.$devoir[1].'", "'.$_SESSION['classe'].'")');
	}
}

// Récupération de la liste des sujets
$listeDevoirs = SelectQueryMultiple('SELECT * FROM RENDU_SUJET WHERE CL_id = "'.$_SESSION['classe'].'"');

$s->assign(array(
	'section' => 'Rendus',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/rendus.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/rendus.js"></script>',
	'listeDevoirs' => $listeDevoirs,
)); 

$s->display('templates/rendus.tpl');
?>
