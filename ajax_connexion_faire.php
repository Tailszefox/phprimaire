<?php
require('./include/include_init.php');

// L'élève veut se connecter, on le fait directement
if($_POST['type'] == 'eleve')
{
	$id = str_replace('eleve_', '', $_POST['id']);
	$eleve = getEleve($id);
	
	$_SESSION['id'] = $eleve['EL_id'];
	$_SESSION['nom'] = $eleve['EL_nom'];
	$_SESSION['prenom'] = $eleve['EL_prenom'];
	$_SESSION['classe'] = $eleve['CL_id'];
	$_SESSION['statut'] = 'eleve';
}
// Le prof veut se connecter, on vérifie son mot de passe
else if($_POST['type'] == 'prof')
{
	$id = str_replace('prof_', '', $_POST['id']);
	$prof = getProf($id);
	$classe = getClasseDeProf($id);
	
	// Mot de passe correct
	if(md5($_POST['mdp']) == $prof['PR_mdp'])
	{
		$_SESSION['id'] = $prof['PR_id'];
		$_SESSION['nom'] = $prof['PR_nom'];
		$_SESSION['prenom'] = $prof['PR_prenom'];
		$_SESSION['classe'] = $classe;
		$_SESSION['statut'] = 'prof';
		$_SESSION['admin'] = $prof['PR_admin'];
		
		echo '1';
	}
	// Mot de passe incorrect
	else
	{
		echo '0';
	}
}
?>
