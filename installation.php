<?php
// Initialisation de Smarty
require('include/tpl/Smarty.class.php');
$s = new Smarty();

// Paramètres
require('include/include_parametres.php');

// Fonctions usuelles
require('include/include_fonctions.php');

// Tester la connexion à la base
if(isset($_POST['installationBaseTester']))
{
	$db_adresse = $_POST['installationBaseAdresse'];
	$db_user = $_POST['installationBaseUsername'];
	$db_password = $_POST['installationBasePassword'];
	$db_nom = $_POST['installationBaseBase'];
	
	ecrireParametres('', $db_adresse, $db_user, $db_password, $db_nom, false);
	
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	try
	{
		$bd = new PDO('mysql:host='.$db_adresse, $db_user, $db_password, $pdo_options);
		$requeteCreate = 'CREATE DATABASE IF NOT EXISTS '.$db_nom;
		$bd->exec($requeteCreate);
		$bd = null;

		$bd = new PDO('mysql:host='.$db_adresse.';dbname=' . $db_nom, $db_user, $db_password, $pdo_options);
		$statutInstallation = 'creation';
		
		$create = explode(';', file_get_contents('create.sql'));
		
		foreach($create as $c)
		{
			$requete = trim($c);
			if(!empty($requete))
			  $bd->exec($requete);
		}
	}
	catch(Exception $e)
	{
		$statutInstallation = 'erreur';
		$s->assign(array('erreur' => $e->getMessage()));
	}
}
// Ajouter l'administateur
elseif(isset($_POST['formulaireAdministrateurAjouter']))
{
	require('include/include_sql.php');
	
	$nomEtPrenom = protect(array($_POST['formulaireAdministrateurNom'], $_POST['formulaireAdministrateurPrenom']));
	$password = protect(array($_POST['formulaireAdministrateurPassword']), false);
	$nomEcole = protect(array($_POST['formulaireAdministrateurEcole']));
	$civilite = $_POST['formulaireAdministrateurCivilite'];
	
	ecrireParametres($nomEcole[0], $db_adresse, $db_user, $db_password, $db_nom);
	
	InsertQuery('INSERT INTO PROF(PR_id, PR_nom, PR_prenom, PR_mdp, PR_civilite, PR_admin) VALUES(1, "'.$nomEtPrenom[0].'", "'.$nomEtPrenom[1].'", "'.md5($password[0]).'", "'.$civilite.'", 1)');
	
	if(isset($_POST['formulaireAdministrateurInserer']) && $_POST['formulaireAdministrateurInserer'] == 'on')
	{
		$insert = explode(';', file_get_contents('insert.sql'));
		
		foreach($insert as $i)
		{
			$requete = trim($i);
			if(!empty($requete))
			  InsertQuery($requete);
		}
	}
	else
	{
		InsertQuery('INSERT INTO ANNEE VALUES ("2010-2011")');
		InsertQuery('INSERT INTO CLASSE VALUES (1, "Test", 0, 1, "2010-2011")');
	}
	
	$statutInstallation = 'termine';
}
else
{
	$statutInstallation = 'debut';
}

$s->assign(array(
	'adresse' => $db_adresse,
	'username' => $db_user,
	'password' => $db_password,
	'base' => $db_nom,
	'statut' => $statutInstallation,
));

$s->display('installation.tpl');
?>

