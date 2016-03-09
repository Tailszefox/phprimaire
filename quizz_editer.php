<?php
require('include/include_init.php');

// Pas d'ID ou pas prof
if(!isset($_GET['id']) || !isset($_SESSION['statut']) || $_SESSION['statut'] != 'prof')
{
	header('Location: quizz.php');
}

// Suppression d'une question
if(isset($_GET['supprimer']))
{
	DeleteQuery('DELETE FROM QUESTIONS WHERE QU_id ="'.$_GET['supprimer'].'"');
}

// Modification du quizz
if(isset($_POST['editerQuizz']))
{
	$quizz = protect(array($_POST['nomQuizz']));
	
	if(is_numeric($_POST['minuteQuizz']))
	{
		$temps = intval($_POST['minuteQuizz']) * 60 + intval($_POST['secondeQuizz']);
		if($temps == 0)
			$temps = 'NULL';
	}
	else
		$temps = 'NULL';
	
	UpdateQuery('UPDATE QUIZ SET QZ_nom = "'.$quizz[0].'", QZ_temps =  '.$temps.' WHERE QZ_id = '. $_GET['id']);
}
elseif(isset($_POST['ajouterQuestion']))
{
	$question = protect(array($_POST['question'], $_POST['image'], $_POST['choix1'], $_POST['choix2'], $_POST['choix3'], $_POST['choix4']));

	$responsesCorrectes = implode(protect($_POST['formulaireCorrect']));
	
	// Mise à jour d'une question
	if(is_numeric($_POST['formulaireIdQuestion']))	
		UpdateQuery('UPDATE QUESTIONS SET QU_question = "'.$question[0].'", QU_photo = "'.$question[1].'", QU_choix1 = "'.$question[2].'", QU_choix2 = "'.$question[3].'", QU_choix3 = "'.$question[4].'", QU_choix4 = "'.$question[5].'", QU_correct = "'.$responsesCorrectes.'" WHERE QU_id = '.$_POST['formulaireIdQuestion'].'');
	// Ajout d'une question
	else
		InsertQuery('INSERT INTO QUESTIONS(QU_id, QU_question, QU_photo, QU_choix1, QU_choix2, QU_choix3, QU_choix4, QU_correct, QZ_id) VALUES("", "'.$question[0].'", "'.$question[1].'", "'.$question[2].'", "'.$question[3].'", "'.$question[4].'", "'.$question[5].'", "'.$responsesCorrectes.'",  '.$_GET['id'].')');
}

// Récupération du quizz
$quizz = SelectQuery('SELECT * FROM QUIZ WHERE QZ_id = "'.$_GET['id'].'"');
$questions = SelectQueryMultiple('SELECT * FROM QUESTIONS WHERE QZ_id = "'.$_GET['id'].'" ORDER BY QU_id'); 

// Quizz inexistant
if(empty($quizz))
	header('Location: quizz.php');

$s->assign(array(
	'section' => 'Quizz',
	'retour' => 'quizz.php',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/quizz.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/quizz.js"></script>',
	'quizz' => $quizz,
	'tempsMinute' => floor($quizz['QZ_temps'] / 60),
	'tempsSeconde' => $quizz['QZ_temps'] % 60,
	'questions' => $questions,
	'nbQuestions' => sizeof($questions),
)); 

$s->display('templates/quizz_editer.tpl');
?>
