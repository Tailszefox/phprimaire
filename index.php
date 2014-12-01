<?php
// Initialisation de toutes les variables nécessaires
require('include/include_init.php');

// Variables utilisées par le template
$s->assign(array(
	'section' => 'Menu principal',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/index.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/index.js"></script>'
)); 

// Affichage du template
$s->display('templates/index.tpl');
?>
