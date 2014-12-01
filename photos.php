<?php
require('include/include_init.php');

// Suppression d'une photo
if(isset($_GET['supprimerph']))
{
	DeleteQuery('DELETE FROM PHOTO WHERE PH_id ="'.$_GET['supprimerph'].'"');
}

// Déconnexion d'une galerie
if(isset($_GET['deconnectergal']))
{
	DeleteQuery('DELETE FROM GALERIE_DANS WHERE GAL_id ="'.$_GET['deconnectergal'].'"');
}

// Suppression d'une galerie
if(isset($_GET['supprimergal']))
{
	DeleteQuery('DELETE FROM PHOTO WHERE GAL_id ="'.$_GET['supprimergal'].'"');
	DeleteQuery('DELETE FROM GALERIE WHERE GAL_id ="'.$_GET['supprimergal'].'"');
	DeleteQuery('DELETE FROM GALERIE_DANS WHERE GAL_id ="'.$_GET['supprimergal'].'"');
}

// Raccordement d'une galerie à une classe
if(isset($_POST['formulaireConnecterGalerie']))
{
	InsertQuery('INSERT INTO GALERIE_DANS(GAL_id, CL_id) VALUES("'.$_POST['formulaireConnecterGalerie'].'", "'.$_SESSION['classe'].'")');
}

// Création ou modification d'une galerie
if(isset($_POST['nomGalerie']))
{
	$galerie = protect(array($_POST['nomGalerie'], $_POST['legendeGalerie']));
	
	// Mise à jour
	if(is_numeric($_POST['idGalerie']))	
		UpdateQuery('UPDATE GALERIE SET GAL_nom = "'.$galerie[0].'", GAL_legende = "'.$galerie[1].'" WHERE GAL_id = "'.$_POST['idGalerie'].'"');
	// Ajout
	else
	{
		InsertQuery('INSERT INTO GALERIE(GAL_id, GAL_nom, GAL_legende) VALUES("", "'.$galerie[0].'", "'.$galerie[1].'")');
	}
}

// Création ou modification d'une photo
if(isset($_POST['nomPhoto']))
{
	$photo = protect(array($_POST['nomPhoto'], $_POST['legendePhoto'], $_POST['miniPhoto'], $_POST['idGalerie']));
	
	// Mise à jour
	if(is_numeric($_POST['idPhoto']))	
		UpdateQuery('UPDATE PHOTO SET PH_photo = "'.$photo[0].'", PH_legende = "'.$photo[1].'", PH_mini = "'.$photo[2].'", GAL_id = "'.$photo[3].'" WHERE PH_id = "'.$_POST['idPhoto'].'"');
	// Ajout
	else
	{
		InsertQuery('INSERT INTO PHOTO(PH_id, PH_photo, PH_legende, PH_mini, GAL_id) VALUES("", "'.$photo[0].'", "'.$photo[1].'", "'.$photo[2].'", "'.$photo[3].'")');
	}
}

// Affichage d'une photo
if(isset($_GET['photo']))
	{
	$photo = SelectQuery('SELECT * FROM PHOTO WHERE PH_id = "'.$_GET['photo'].'"');
	
	$s->assign(array(
		'section' => 'Photo',
		'retour' => 'photos.php',
		'moreCss' => '<link rel="stylesheet" type="text/css" href="design/photos.css" media="screen, projection"/>',
		'moreJs' => '<script type="text/javascript" src="javascript/photos.js"></script>',
		'photo' => $photo,
	));
	
	$s->display('templates/photos_zoom.tpl');
	}

// Affichage d'une galerie	
elseif(isset($_GET['galerie']))

	{
	$galerie = SelectQuery('SELECT * FROM GALERIE WHERE GAL_id = "'.$_GET['galerie'].'"');
	$listePhotos = SelectQueryMultiple('SELECT * FROM PHOTO WHERE GAL_id = "'.$_GET['galerie'].'"');
	if (empty($listePhotos)) $afficher=0;
	else $afficher=1;
	
	$s->assign(array(
		'section' => 'Galerie - '.$galerie['GAL_nom'],
		'retour' => 'photos.php',
		'moreCss' => '<link rel="stylesheet" type="text/css" href="design/photos.css" media="screen, projection"/>',
		'moreJs' => '<script type="text/javascript" src="javascript/photos.js"></script>',
		'galerie' => $galerie,
		'listePhotos' => $listePhotos,
		'afficher' => $afficher,
	)); 

	$s->display('templates/photos_galerie.tpl');
	}
	
// Affichage standard
else

	{
	$listeGaleriesAConnecter = SelectQueryMultiple('SELECT * FROM GALERIE WHERE GAL_id NOT IN (SELECT GAL_id FROM GALERIE_DANS WHERE CL_id = "'.$_SESSION['classe'].'")');
	
	foreach($listeGaleriesAConnecter as $galerie)
	{
		$galeriesAConnecter[$galerie['GAL_id']] = $galerie['GAL_nom'];
	}
	
	$listeGaleriesClasse = SelectQueryMultiple('SELECT GAL_id FROM GALERIE_DANS WHERE CL_id = "'.$_SESSION['classe'].'"');


	$gal="(";
	$premier=0;
	$suite=0;
	foreach($listeGaleriesClasse as $galerie)
		{
		if ($premier == 0) $premier = 1;
		else $gal = $gal . ",";
		$gal = $gal . $galerie['GAL_id'];
		$suite++;
		}
	$gal = $gal . ")";

	if ($suite > 0 ) $listeGaleries = SelectQueryMultiple('SELECT * FROM GALERIE WHERE GAL_id IN '.$gal.' ');
	else $listeGaleries = array();

	$contient=array();
	foreach($listeGaleries as $galerie)
		{
		$fichier="galeries/".$galerie['GAL_id']."/m/1.jpg";
		if (file_exists($fichier)) $contient[$galerie['GAL_id']]=1;
		else $contient[$galerie['GAL_id']]=0;
		}
		
	if (!isset($galeriesAConnecter)) $galeriesAConnecter=array();
	
	$s->assign(array(
		'section' => 'Photos',
		'moreCss' => '<link rel="stylesheet" type="text/css" href="design/photos.css" media="screen, projection"/>',
		'moreJs' => '<script type="text/javascript" src="javascript/photos.js"></script>',
		'listeGaleries' => $listeGaleries,
		'galeriesAConnecter' => $galeriesAConnecter,
		'contient' => $contient,
	)); 

	$s->display('templates/photos.tpl');
	}

?>
