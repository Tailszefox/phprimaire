<?php
// Démarrage de la session
session_start();

$estAdmin = false;

// Connecté
if(isset($_SESSION['statut']))
{
	// Prof
	if($_SESSION['statut'] == 'prof')
	{
		$s->assign(array('admin' => $_SESSION['admin']));
		
		if($_SESSION['admin'] == 1)
		{
			$estAdmin = true;
			
			// Gestion d'une autre classe
			if(isset($_POST['changerClasse']))
			{
				$_SESSION['classe'] = $_POST['changerClasse'];
			}
		}
	}
	
	$s->assign(array(
		'id' => $_SESSION['id'],
		'statut' => $_SESSION['statut'],
		'nom' => $_SESSION['nom'],
		'prenom' => $_SESSION['prenom'],
		'classe' => $_SESSION['classe'],
		));
}
// Non connecté
else
{
	$_SESSION['classe'] = -1;
	$s->assign(array(
		'statut' => '',
		));
}
?>