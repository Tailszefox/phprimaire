<?php
require('include/include_init.php');

// Pas d'ID ou pas connecté
if(!isset($_GET['id']) || !isset($_SESSION['statut']) || $_SESSION['statut'] == '')
{
	header('Location: rendus.php');
}

// Récupération du sujet
$devoir = SelectQuery('SELECT * FROM RENDU_SUJET WHERE RS_id = "'.$_GET['id'].'"');

// Sujet inexistant
if(empty($devoir))
	header('Location: rendus.php');

// Appel par AJAX, aucun autre traitement nécessaire
if(isset($_GET['ajax']))
{
	echo($devoir['RS_sujet']);
	die();
}

$s->assign(array(
	'section' => 'Rendus',
	'retour' => 'rendus.php',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/rendus.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/rendus.js"></script>',
	
	'titreDevoir' => $devoir['RS_titre'],
	'sujetDevoir' => $devoir['RS_sujet'],
	'idDevoir' => $devoir['RS_id'],
)); 

// Si un élève consulte
if($_SESSION['statut'] == 'eleve')
{
	// Il vient d'envoyer son rendu, on l'enregistre
	if(isset($_POST['renduDevoir']))
	{
		$texte = protect(array($_POST['renduDevoir']));
		ReplaceQuery('REPLACE INTO RENDU_ELEVE(RS_id, EL_id, RE_rendu) VALUES('.$_GET['id'].', '.$_SESSION['id'].', "'.$texte[0].'")');
		header('Location: rendus.php');
	}
	
	// Récupération du texte rendu
	$texte = SelectQuery('SELECT RE_rendu FROM RENDU_ELEVE WHERE RS_id = '.$_GET['id'].' AND EL_id = '.$_SESSION['id']);
	
	$s->assign(array(
		'texte' => $texte['RE_rendu'],
		));
	
	// Affichage du template élève
	$s->display('templates/rendus_consulter_eleve.tpl');
}
// Si un prof consulte
else if($_SESSION['statut'] == 'prof')
{
	// Récupération des rendus des élèves
	$rendus = SelectQueryMultiple('SELECT EL_nom, EL_prenom, RE_rendu FROM RENDU_ELEVE JOIN ELEVE ON RENDU_ELEVE.EL_id = ELEVE.EL_id WHERE RS_id = '.$_GET['id']);
	
	$s->assign(array(
		'rendus' => $rendus,
		));
	
	// Affichage du template prof
	$s->display('templates/rendus_consulter_prof.tpl');
}
?>
