<?php
require('./include/include_init.php');

// Pas connecté
if(!isset($_SESSION['statut']))
{
	
	// Récupération des profs et classes
	$listeProfs = listeProfs();
	$listeClasses = listeClasses(false);
	
	$listeIdClasses = array();
	foreach($listeClasses as $classe)
	{
		$listeIdClasses[] = $classe['CL_id'];
	}
	
	// Récupération des élèves des classes actives
	$listeEleves = listeEleves($listeIdClasses);
	$listeElevesParClasse = rangerParClasse($listeEleves);
	
	$s->assign(array(
		'listeProfs' => $listeProfs,
		'listeClasses' => $listeClasses,
		'listeEleves' => $listeElevesParClasse, 
		));
	
	$s->display('templates/connexion.tpl');
}
// Déjà connecté
else
{
	$s->display('templates/deconnexion.tpl');
}
?>
