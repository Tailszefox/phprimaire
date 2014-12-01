<?php
require('include/include_init.php');

// Récupération de la liste des liens
$listeLiens = SelectQueryMultiple('SELECT * FROM LIEN WHERE LI_id IN (SELECT LI_id FROM APPARTIENT WHERE CL_id = "'.$_SESSION['classe'].'")');
$listeMatieres = SelectQueryMultiple('SELECT * FROM MATIERE');
$listeGroupes = SelectQueryMultiple('SELECT * FROM GROUPE');

$possedeMatiere = array();
$possedeGroupe = array();
$relationGroupeMatiere = array();

foreach($listeGroupes as $groupe)
{
	$relationGroupeMatiere[$groupe['GR_id']] = $groupe['MAT_id'];
}

foreach($listeLiens as $lien)
{
	if(empty($lien['GR_id']))
		$possedeMatiere[$lien['MAT_id']] = 1;
	else
	{
		$possedeMatiere[$relationGroupeMatiere[$lien['GR_id']]] = 1;
		$possedeGroupe[$lien['GR_id']] = 1;
	}
}

$s->assign(array(
	'section' => 'Liens',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/liens.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/liens.js"></script>',
	'listeLiens' => $listeLiens,
	'listeMatieres' => $listeMatieres,
	'listeGroupes' => $listeGroupes,
	'possedeMatiere' => $possedeMatiere,
	'possedeGroupe' => $possedeGroupe,
)); 

$s->display('templates/liens.tpl');