<?php
require('include/include_init.php');

// Suppression d'un quizz
if(isset($_GET['supprimer']))
{
	DeleteQuery('DELETE FROM QUIZ WHERE QZ_id ="'.$_GET['supprimer'].'"');
	DeleteQuery('DELETE FROM QUESTIONS WHERE QZ_id ="'.$_GET['supprimer'].'"');
	DeleteQuery('DELETE FROM NOTE WHERE QZ_id ="'.$_GET['supprimer'].'"');
}

// Enregistrement d'un quizz
if(isset($_POST['nomQuizz']))
{
	$quizz = protect(array($_POST['nomQuizz']));
	
	if(is_numeric($_POST['minuteQuizz']))
		$temps = intval($_POST['minuteQuizz']) * 60 + intval($_POST['secondeQuizz']);
	else
		$temps = 'NULL';
	
	$id = InsertQuery('INSERT INTO QUIZ(QZ_id, QZ_nom, QZ_temps, CL_id) VALUES("", "'.$quizz[0].'", '.$temps.', '.$_SESSION['classe'].')');
	header('Location: quizz_editer.php?id=' . $id);
}

// Récupération de la liste des quizz
$listeQuizz = SelectQueryMultiple('SELECT * FROM QUIZ WHERE CL_id = "'.$_SESSION['classe'].'"');

$s->assign(array(
	'section' => 'Quizz',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/quizz.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/quizz.js"></script>',
	'listeQuizz' => $listeQuizz,
)); 

$s->display('templates/quizz.tpl');
?>
