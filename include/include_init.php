<?php
// Initialisation de Smarty
require('include/tpl/Smarty.class.php');
$s = new Smarty();

// Paramètres
require('include/include_parametres.php');

if($installed == false)
{
	header('Location: installation.php');
}

// Fonctions de gestion de la session
require('include/include_session.php');

// Fonctions de la base de données 
require('include/include_sql.php');

// Fonctions usuelles
require('include/include_fonctions.php');

// Warnings
//error_reporting(E_ALL | E_STRICT);

// Fuseau horaire
date_default_timezone_set('Europe/Paris');

// Assignation de quelques variables de base
$s->assign(array(
	'nomEcole'	=> $nomEcole,
	'moreJs' 	=> '',
	'moreCss' 	=> '',
));

// Si admin, création de la liste des classes pour pouvoir toutes les gérer
if($estAdmin)
{
	$listeClassesAdmin = listeClasses();
	
	if(!isset($_SESSION['classe']) && !empty($listeClassesAdmin))
	{
		$_SESSION['classe'] = $listeClassesAdmin[0]['CL_id'];
		$s->assign(array('classe' => $_SESSION['classe']));
	}
	
	$s->assign(array('listeClassesAdmin' => $listeClassesAdmin));
}
else
{
	$s->assign(array('admin' => 0));
}
?>